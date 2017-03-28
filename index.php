<?php

date_default_timezone_set("Europe/Dublin");
$xpub = "1PTCe6VEMAUmQZVw1g984SYTTLji8CpgH7";
$ratesurl = "https://api.coinbase.com/v2/exchange-rates?currency=BTC";
$spotpriceurl = "https://api.coinbase.com/v2/prices/BTC-EUR/spot";
$balanceurl = "https://blockchain.info/q/addressbalance/" . $xpub;
$original = 1568.34;

$btcArr = array(
	"original" => $original,
	"balance" => makeRequest($balanceurl) / 100000000,
	"originalrate" => round($original / (makeRequest($balanceurl) / 100000000), 2),
	"total" => (makeRequest($balanceurl) / 100000000) * makeRequest($spotpriceurl)['data']['amount'],
	"profitperbtc" => makeRequest($spotpriceurl)['data']['amount'] - round($original / (makeRequest($balanceurl) / 100000000), 2),
	"roi" => ((makeRequest($balanceurl) / 100000000) * makeRequest($spotpriceurl)['data']['amount'] - $original),
	"rates" => makeRequest($ratesurl),
	"spotprice" => makeRequest($spotpriceurl)
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

function makeRequest($url)
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
	return json_decode($result, true);
}

?>