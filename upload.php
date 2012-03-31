<?php
$tmp_str= $_FILES['file']['name']; 

$tmp_file_dir = $_FILES['file']['tmp_name'];
$file_name = $_FILES['file']['name'];
$time_now = time();


$tmp_file_name = 'upload/'.$time_now.'.'.$file_name;
if(move_uploaded_file($tmp_file_dir, $tmp_file_name)){
	$img_url = getImgUrl($tmp_file_name);
	echo $img_url;
}
else{
	echo "wrong.png";
}


function getImgUrl($filename){
	$my_host = "localhost"
	$tmp_url = $my_host.$filename;

	$ch = curl_init();
	//get qrcode img.
	//use qrcode.kaywa.com
	$data = array('qr_cnt_frmt'=>$tmp_url, 'qr_cnt_type'=>'qr_cnt_type_url' , 'qr_cnt'=>$tmp_url, 'qr_size'=>'5');
	curl_setopt($ch, CURLOPT_URL, 'http://qrcode.kaywa.com/');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	curl_exec($ch);
	$result = curl_multi_getcontent($ch);


	//use simple_html_dom
	require_once("simple_html_dom.php");
	$html = str_get_html($result);
	$tmp_img_url = $html->find('img[id=qrcode]',0)->src;
	return $tmp_img_url;
}
?>
