<?php

//print_r($_REQUEST);
$img_name = $_REQUEST['name'];
$img = $_REQUEST['imagedata'];

//$img_src = "icon_clock_2.gif";
//$imgbinary = fread(fopen($img_src, "r"), filesize($img_src));
//$img = base64_encode($imgbinary);
//echo '<img src="data:image/jpg;base64,'.$img_str.'" />';

//$ext = pathinfo($img_src, PATHINFO_EXTENSION);
define('UPLOAD_DIR', 'uploads/');
	$data1 = base64_decode($img);
	$f = finfo_open();
	$mime_type = finfo_buffer($f, $data1, FILEINFO_MIME_TYPE);
	$img = str_replace('data:'.$mime_type.';base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = UPLOAD_DIR . $img_name;
	$success = file_put_contents($file, $data);
	print $success ? $file : 'Unable to save the file.';




	/*
$img = base64_encode($imgbinary);


define('UPLOAD_DIR', 'uploads/');
	//$img = $_POST['img'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$f = finfo_open();
	echo $mime_type = finfo_buffer($f, $data, FILEINFO_MIME_TYPE);
	$file = UPLOAD_DIR . time() . '.png';
	$success = file_put_contents($file, $data);
	print $success ? $file : 'Unable to save the file.';
*/
?>
