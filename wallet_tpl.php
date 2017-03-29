<!DOCTYPE html>
<html>
	<head>
		<meta name="robots" content="noindex,nofollow"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php
			echo substr($pl, 0, 1) . ": " . round($btcArr['roi'], 2) . " " . $fiat;
			?> - Wallet Watcher</title>
		<style>
			.center {
				margin: auto;
				width: 50%;
				padding: 10px;
			}
			.container {
				width: 50%;
				height: 200px;
				margin: auto;
				padding: 10px;
			}
			.btc {
				float:left;
			}
			.tx {
				float:left;
			}

			@media screen and (max-width: 400px) {
				.btc { 
					width: 15%;
					float: none;  
					margin-bottom: 20px;
				}
				.tx {
					width: 15%;
					float: none;  
					margin-bottom: 20px;
				}
			}
		</style>
		<script>
			setTimeout(function () {
				window.location.reload(1);
			}, 10000);
		</script>
	</head>
	<body background="p2pbg.jpg">
		<div class="container">
			<div class="btc">
				<div class="center" style="width:240px;border:1px solid #000;background-color:#fff">
					<h1 style="text-align:center">Wallet Watcher</h1>
				</div>
				<div class="center" style="width:240px;border:1px solid #000;background-color:#fff">
					<h2>
						<?php
						echo "BTC: " . $btcArr['balance'] . " BTC<br />";
						?>
					</h2>
					<h2>
						<?php
						echo $fiat . ": " . round($btcArr['total'], 2) . " " . $fiat . "<br />";
						?>
					</h2>
					<p>
						<?php
						echo "Invested: " . round($btcArr['original'], 2) . " " . $fiat . "<br />";
						?>
					</p>
					<h2 style="color:<?= $color ?>;text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;">
						<?php
						echo $pl . ": " . round($btcArr['roi'], 2) . " " . $fiat . "<br />";
						?>
					</h2>
					<p>
						<?php
						echo "Avg Buy Rate: " . round($btcArr['originalrate'], 2) . " " . $fiat . "<br />";
						?>
					</p>
					<p>
						<?php
						echo "Avg Profit per BTC: " . round($btcArr['profitperbtc'], 2) . " " . $fiat . "<br />";
						?>
					</p>
				</div>
				<div class="center" style="width:240px;border:1px solid #000;background-color:#fff">
					<?php
					echo "Spot Price: " . $btcArr['spotprice'] . " " . $fiat . "<br />";
					echo "Rate: " . $btcArr['rates'] . " " . $fiat . " <br />";
					?>
				</div>
				<div class="center" style="width:240px;border:1px solid #000;background-color:#fff">
					<?php
					echo "Updated: " . date('H:i:s');
					?>
				</div>
				<div class="center" style="width:240px;border:1px solid #000;background-color:#fff">
					<img src="http://bitcoinity.org/markets/image?span=24h&size=medium&currency=<?= $fiat ?>&exchange=coinbase" alt="bitcoin price chart"/>
				</div>
				<div class="center" style="width:240px;border:1px solid #000;background-color:#fff">
					<img src="http://bitcoinity.org/markets/image?span=7d&size=medium&currency=<?= $fiat ?>&exchange=coinbase" alt="bitcoin price chart"/>
				</div>
			</div>
			<div class="tx">
				<div class="center" style="width:240px;border:1px solid #000;background-color:#fff">
					<h1 style="text-align:center">Transactions</h1>
				</div>
				<div class="center" style="width:240px;border:1px solid #000;background-color:#fff">
					<ul>
						<?php
						foreach($btcArr['txs'] as $key => $transaction)
						{
							echo "<li><a href='https://blockchain.info/tx/" . $transaction['hash'] . "' target='_blank'>View Transaction</a> - " . ($transaction['value'] / 100000000) . " BTC</li>";
						}
						?>
					</ul>
				</div>
			</div>
		</div>
	</body>
</html>


