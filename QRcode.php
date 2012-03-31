<?php
	//curl -F
	//curl -F qr_cnt_frmt=http://xxxxxxx -F qr_cnt_type=qr_cnt_type_url -F qr_cnt=http://xxxxxxx -F qr_size=8 "http://qrcode.kaywa.com/"\

	$ch = curl_init();
	$data = array('qr_cnt_frmt'=>'http://xxxxxxx', 'qr_cnt_type'=>'qr_cnt_type_url' , 'qr_cnt'=>'http://xxxxxxx', 'qr_size'=>'8');
	curl_setopt($ch, CURLOPT_URL, 'http://qrcode.kaywa.com/');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	curl_exec($ch);
	$result = curl_multi_getcontent($ch);


	//$html_str = '<!doctype html><html><body><img src="xxx.gif" alt="xxx" id="iimg" /></body></html>';	
	//$doc = new DOMDocument();
	//$doc->loadHTML($html_str);
	//$doc->loadHTML($result);
	//var_dump($doc->getElementById("iimg"));
	//echo $doc->saveHTML();
	//$img_src = $doc->getElementById("qrcode")->getAttribute("src");
	//echo $img_src;
	//use simple_html_dom
	require_once("simple_html_dom.php");
	$html = str_get_html($result);
	echo $html->find('img[id=qrcode]',0)->src;
?>
