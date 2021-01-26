<?php
set_time_limit(0);
date_default_timezone_set('Asia/Jakarta');

function rupiah($angka){
	$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
	return $hasil_rupiah;
}
//echo rupiah(120000000);

//start 201.784.145 IDR
//17jan 207.965.103 IDR
//18jan 208.015.800 IDR
function buy($idr,$buyprice){
	return $idr / $buyprice;
}

function sell($idr,$sellprice){
	return $idr * $sellprice;
}

function opit($idr,$idr2){
	return $idr - $idr2;
}




for ($x = 0; $x <= 10000000; $x++) {
$x++;

cekharga:
	$pair = 'usdt';
    $modal = 100000000;
    $request = json_decode(file_get_contents("https://indodax.com/api/summaries"), true);
    $priceBuy = $request['tickers'][$pair."_idr"]['buy'];
    $priceSell = $request['tickers'][$pair."_idr"]['sell'];
    $priceLow = $request['tickers'][$pair."_idr"]['low'];
    $targetbuy = 14100;//$priceLow + rand(20,50);
    $targetsell = 14260;// opit 1jtan lek tukune 100jt $targetbuy + 160;//14300;
   // echo " Buy ".rupiah($priceSell)." - Sell ".rupiah($priceBuy)." - TargetBuy $targetbuy - ".$request['tickers'][$pair."_idr"]['last']."\n";



//if($targetbuy > $request['tickers'][$pair."_idr"]['last']){
if($targetbuy > 14200){
    echo "target buy lebih mahal dari 14.200";//last
}else{
    //echo "Buy ".rupiah($priceSell)." - Sell ".rupiah($priceBuy)." - TargetBuy $targetbuy #".$request['tickers'][$pair."_idr"]['last']."\n".chr(10);
    echo "MODAL 100jt dapet ".buy($modal, floor($targetbuy))." USDT di harga $targetbuy\n".chr(10);
    echo "JUAL ".buy($modal, floor($targetbuy))." USDT dapet ".rupiah(buy($modal, floor($targetbuy)) * $targetsell)."".chr(10);
    $opit = (buy($modal, floor($targetbuy)) * $targetsell) - $modal;
    echo "OPIT: $opit".chr(10);
    	
}


if($priceSell < 14150){
  echo file_get_contents('https://api.telegram.org/botx/sendMessage?parse_mode=markdown&chat_id=id&text='.rupiah($priceSell));
	break;
	exit;
	
}elseif ($priceBuy > 14260) {
  echo file_get_contents('https://api.telegram.org/botx/sendMessage?parse_mode=markdown&chat_id=id&text=JUAL!!!!!USDT'.rupiah($priceSell));
	break;
	exit;
	
}

sleep(15);
goto cekharga;

}


?>
