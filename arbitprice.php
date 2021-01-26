<?php
$indodax = json_decode(file_get_contents("https://indodax.com/api/usdt_idr/ticker"));
$binance = json_decode(file_get_contents("https://api.binance.com/api/v1/ticker/24hr?symbol=USDTBIDR"));
$tokocrypto = json_decode(file_get_contents("https://www.tokocrypto.com/v1/market/trading-pair?symbol=USDT_BIDR"));
$coingecko = json_decode(file_get_contents("https://api.coingecko.com/api/v3/simple/price?ids=tether&vs_currencies=idr"));
?>


<style>
body {background-color: #9B9898;}
table.xd tr td { font-size: 20px; }
</style>
<center><b>
<h1>USDT - IDR INSTANT</h1>
<table class=xd border="1">
<tr>
<th>Pair</th>
<th>Source</th>
<th>ASK</th>
<th>BID</th>
</tr>
<tr>
<td>USDT_BIDR</td>
<td>Binance</td>
<td><a href="https://www.binance.com/en/trade/USDT_BIDR"><?php echo floor($binance->askPrice);?></a> (BELI)</td>
<td><a href="https://www.binance.com/en/trade/USDT_BIDR"><?php echo floor($binance->bidPrice);?></a></td>
</tr>
<tr>
<td>USDT_IDR</td>
<td>Indodax</td>
<td><a href="https://indodax.com/market/USDTIDR"><?php echo $indodax->ticker->buy;?></a> (JUAL)</td>
<td><?php echo $indodax->ticker->sell;?> </td>
</tr>
<tr>
<td>USDT_IDR</td>
<td>Coingecko</td>
<td><?php echo floor($hargacoingecko);?> (--)</td>
<td>(--)</td>
</tr>
</table>
</b>


<form action="" method="POST">
IDR: <input type="text" name="idr" value="100000000"/>
<input type="submit" name="submit" value="Hitung">
</form>




<?php
if(isset($_POST['idr'])){
$idr = $_POST['idr'];
function buy($idr,$buyprice){
	return $idr / $buyprice;
}

function sell($idr,$sellprice){
	return $idr * $sellprice;
}

function opit($idr,$idr2){
	return $idr - $idr2;
}

function ubah($value){
return "".number_format($value, 0, ".", ".")."";
}
$binancebuyinstant = floor($binance->askPrice);
$indodaxsellinstant = $indodax->ticker->buy;
$binancesellinstant = floor($binance->bidPrice);
$indodaxbuyinstant = $indodax->ticker->sell;

echo "
<h1>SIMULASI ARBIT</h1>
<table class=xd border=2>
<tr>
<th>MODAL</th>
<th>BELI</th>
<th>JUAL</th>
<th>OPIT?</th>
</tr>
<tr>
<td>".$_POST['idr']."</td>
<td>".ubah(buy($idr,$binancebuyinstant))." USDT (".ubah($binancebuyinstant)." Binance BUY)</td>
<td>".ubah(sell($indodaxsellinstant,buy($idr,$binancebuyinstant)))." IDR (".ubah($indodaxsellinstant)." Indodax SELL)</td>
<td>".ubah((sell($indodaxsellinstant,buy($idr,$binancebuyinstant)) - $idr))." IDR</td>
</tr>";
echo "
<tr>
<td>".$_POST['idr']."</td>
<td>".ubah(buy($idr,$indodaxbuyinstant))." USDT (".ubah($indodaxbuyinstant)." Indodax BUY)</td>
<td>".ubah(sell($binancesellinstant,buy($idr,$indodaxbuyinstant)))." BIDR (".ubah($binancesellinstant)." Binance SELL)</td>
<td>".ubah((sell($binancesellinstant,buy($idr,$indodaxbuyinstant)) - $idr))."</td>
</tr></table>";
}
?>

