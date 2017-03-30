<?php
date_default_timezone_set("Europe/Dublin");
$fiat = "EUR";
$xpub = "";
if(isset($_POST['xpub']) && $_POST['xpub']){
	setcookie("xpub", $_POST['xpub'], time()+3600, '/');
	$xpub=$_POST['xpub'];
}
elseif(isset($_COOKIE['xpub'])){
	$xpub=$_COOKIE['xpub'];
}



$balanceurl = "https://blockchain.info/rawaddr/" . $xpub;
$ratesurl = "https://blockchain.info/ticker";
$fromBTC =  "https://blockchain.info/frombtc";

$original = 0;
$tx=array();
$wallet= makeRequest($balanceurl,true);
$rates=makeRequest($ratesurl,true);
if(is_array($wallet['txs'])){
	foreach($wallet['txs'] as $key=>$transaction){
		foreach($transaction['out'] as $subkey=>$output){
			if($output['addr']==$xpub){
				if($output['n']==0)$original+= makeRequest($fromBTC."?currency=".$fiat."&value=".abs($output['value'])."&time=".($transaction['time'] * 1000));
				$output['hash']=$transaction['hash'];
				$output['time']=$transaction['time'];
				$tx[]=$output;
			}
		}
	}
}
$btcArr = array(
	"original" => $original,
	"balance" => $wallet['final_balance']>0?$wallet['final_balance']/100000000:0,
	"originalrate" => $wallet['final_balance']>0?round($original / ($wallet['final_balance']/100000000), 2):0,
	"total" => makeRequest($fromBTC."?value=".($wallet['final_balance'])."&currency=".$fiat),
	"profitperbtc" => $wallet['final_balance']>0?$rates[$fiat]['sell'] - round($original / ($wallet['final_balance']/100000000), 2):0,
	"roi" => (makeRequest($fromBTC."?value=".($wallet['final_balance'])."&currency=".$fiat) - $original),
	"rates" => $rates[$fiat]['sell'],
	"spotprice" => $rates[$fiat]['15m'],
	"txs" => $tx
);

if(isset($_GET['format']) && $_GET['format'] == 'json')
{
	echo json_encode($btcArr);
}
else
{
	$color = round($btcArr['roi'], 2) > 0 ? "#00FF00" : "#FF0000";
	$pl = round($btcArr['roi'], 2) > 0 ? "Profit" : "Loss";
	include('wallet_tpl.php');
}

function makeRequest($url,$json=false)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	$result = curl_exec($ch);
	curl_close($ch);
	if($json==true){
		return json_decode($result, true);
	}
	else{
		return str_replace(",","",$result);
	}
}

?>