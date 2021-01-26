<?php
for ($x = 0; $x <= 10000000; $x++) {
$x++;
    $url = 'https://indodax.com/tapi';
    $key = '';
    $secretKey = '';
    
	$data = [
        'method' => 'openOrders',
        'timestamp' => '1578304294000',
        'recvWindow' => '1578303937000',
        'pair' => 'usdt_idr'
    ];
	$post_data = http_build_query($data, '', '&');
    $sign = hash_hmac('sha512', $post_data, $secretKey);

    $headers = ['Key:'.$key,'Sign:'.$sign];

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_RETURNTRANSFER => true
    ));

    $response = json_decode(curl_exec($curl));
if (empty($response->return->orders)) {
echo "KOSONG";
 echo file_get_contents('https://api.telegram.org/botx/sendMessage?parse_mode=markdown&chat_id=id&text=ORDER+KOSONG');
	break;
	exit;
}else{
//echo 'ada';
}
sleep(800);
}
