<!DOCTYPE html>
<html>
	<head>
		<meta name="robots" content="noindex,nofollow"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="UTF-8">
		<meta name="google" content="notranslate">
		<meta http-equiv="Content-Language" content="en">
		<meta http-equiv="X-UA-Compatible" content="chrome=1" />
		<title><?php
			echo substr($pl, 0, 1) . ": " . round($btcArr['roi'], 2) . " " . $fiat;
			?> - Wallet Watcher</title>
		<link href='//fonts.googleapis.com/css?family=Droid+Sans:700' rel='stylesheet'>
		<link href='walletwatcher.css' rel='stylesheet'>
		<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>

		
		<script>
			$(document).ready(function () {
				$('#autorefresh').click(function () {
					if ($(this).is(':checked')) {
						window.location.href = 'index.php?autorefresh=on';
					} else {
						window.location.href = 'index.php';
					}
				});
			});
<?php
if(isset($_REQUEST['autorefresh']) && $_REQUEST['autorefresh'] == "on")
{
	echo "setTimeout(function () {
				window.location.reload(1);
			}, 30000);";
}
?>
		</script>
	</head>
	<body background="p2pbg.jpg">
		<div class="container">
			<form id="bitform" action="index.php<?= (isset($_REQUEST['autorefresh']) && $_REQUEST['autorefresh'] == "on" ? "?autorefresh=on" : "") ?>" method="post">
				<input type="checkbox" name="autorefresh" id="autorefresh" <?= (isset($_REQUEST['autorefresh']) && $_REQUEST['autorefresh'] == "on" ? "checked" : "") ?> /> Auto-refresh
				<input type="text" name="xpub" id="xpub" placeholder="public key/address" />
				<input type="submit" />
			</form>
			<h1 class="headline1">Wallet Watcher - <?= $xpub ?></h1>
			<div class="btc">
				<div class="center" style="">
					<h1 style="text-align:center">Wallet</h1>
				</div>
				<div class="center wallet" style="">
					<strong>
						<?php
						echo "BTC: " . $btcArr['balance'] . " BTC<br />";
						?>
					</strong>
					<strong>
						<?php
						echo $fiat . ": " . round($btcArr['total'], 2) . " " . $fiat . "<br />";
						?>
					</strong>
					<strong>
						<?php
						echo "Invested: " . round($btcArr['original'], 2) . " " . $fiat . "<br />";
						?>
					</strong>
					<strong style="color:<?= $color ?>;">
						<?php
						echo $pl . ": " . round($btcArr['roi'], 2) . " " . $fiat . "<br />";
						?>
					</strong>
					<p>
						<?php
						echo "Avg Buy Rate: " . round($btcArr['originalrate'], 2) . " " . $fiat . "<br />";
						echo "Avg Profit per BTC: " . round($btcArr['profitperbtc'], 2) . " " . $fiat . "<br />";
						?>
					</p>
				</div>
				<div class="center" style="">
					<?php
					echo "Spot Price: " . $btcArr['spotprice'] . " " . $fiat . "<br />";
					echo "Rate: " . $btcArr['rates'] . " " . $fiat . " <br />";
					?>
				</div>
				<div class="center" style="">
					<?php
					echo "Updated: " . date('H:i:s');
					?>
				</div>
			</div>
			<div class="graphs">
				<div class="center" style="">
					<h1>Graphs</h1>
				</div>
				<div class="center" style="">
					<img src="http://bitcoinity.org/markets/image?span=24h&size=medium&currency=<?= $fiat ?>&exchange=bitstamp" alt="bitcoin price chart"/>
				</div>
				<div class="center" style="">
					<img src="http://bitcoinity.org/markets/image?span=7d&size=medium&currency=<?= $fiat ?>&exchange=bitstamp" alt="bitcoin price chart"/>
				</div>
			</div>
			<div class="tx">
				<div class="center" style="">
					<h1>Transactions</h1>
				</div>
				<div class="center transactions" style="">
					<ul>
						<?php
						if(is_array($btcArr['txs'])){
							foreach($btcArr['txs'] as $key => $transaction)
							{
								echo "<li><a href='https://blockchain.info/tx/" . $transaction['hash'] . "' target='_blank'>View Transaction</a> - " . ($transaction['value'] / 100000000) . " BTC</li>";
							}
						}
						?>
					</ul>
				</div>
			</div>
		</div>
	</body>
</html>


