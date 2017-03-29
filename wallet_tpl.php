<!DOCTYPE html>
<html>
	<head>
		<meta name="robots" content="noindex,nofollow"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php
			echo substr($pl, 0, 1) . ": " . round($btcArr['roi'], 2) . " " . $fiat;
			?> - Wallet Watcher</title>
		<link href='http://fonts.googleapis.com/css?family=Droid+Sans:700' rel='stylesheet'>
		<style>
			h1 {
				text-align:center;
				font-family: 'Droid Sans', sans-serif;
				font-size: 22px;
			}

			.headline1 {
				position: relative;
				margin-left: -22px; /* 15px padding + 7px border ribbon shadow*/
				margin-right: -22px;
				padding: 15px;
				background: #e5e5e5;
				background: linear-gradient(#f5f5f5, #e5e5e5);
				box-shadow: 0 -1px 0 rgba(255,255,255,.8) inset;
				text-shadow: 0 1px 0 #fff;
			}

			.headline1:before,
			.headline1:after {
				position: absolute;
				left: 0;
				bottom: -6px;
				content:'';
				border-top: 6px solid #555;
				border-left: 6px solid transparent;
			}

			.headline1:before {
				border-top: 6px solid #555;
				border-right: 6px solid transparent;
				border-left: none;
				left: auto;
				right: 0;
				bottom: -6px;
			}

			.center h1 {
				text-align:center;

			}
			.center {
				margin: auto;
				width: 50%;
				padding: 10px;
				width:350px;
				border:1px solid #000;
				background-color:#fff
			}
			.container {
				width: 90%;
				margin: auto;
				padding: 10px;
			}
			.btc {
				float:left;
			}
			.graphs {
				float:left;
			}
			.tx {
				float:left;
			}
			.wallet {
				height:252px;
			}
			.transactions {
				height:350px;
			}

			@media screen and (max-width: 400px) {
				.center {
					width:240px;
				}
				.btc { 
					width: 15%;
					float: none;  
					margin-bottom: 20px;
				}
				.graphs {
					width: 15%;
					float: none;  
					margin-bottom: 20px;
				}
				.tx {
					width: 15%;
					float: none;  
					margin-bottom: 20px;
				}
				ul {
					width:150px;
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
			<h1 class="headline1">Wallet Watcher</h1>
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
					<img src="http://bitcoinity.org/markets/image?span=24h&size=medium&currency=<?= $fiat ?>&exchange=coinbase" alt="bitcoin price chart"/>
				</div>
				<div class="center" style="">
					<img src="http://bitcoinity.org/markets/image?span=7d&size=medium&currency=<?= $fiat ?>&exchange=coinbase" alt="bitcoin price chart"/>
				</div>
			</div>
			<div class="tx">
				<div class="center" style="">
					<h1>Transactions</h1>
				</div>
				<div class="center transactions" style="">
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


