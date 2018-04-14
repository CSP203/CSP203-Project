<?php
/*- User set variables ----------------------------------------------------------------- */
// Variables
$api_password = "qw2e3erty6uiop";


/*- Get extention ---------------------------------------------------------------------- */
function getExtension($str) {
	$i = strrpos($str,".");
	if (!$i) { return ""; } 
	$l = strlen($str) - $i;
	$ext = substr($str,$i+1,$l);
	return $ext;
}

/*- Script Start ----------------------------------------------------------------------- */

// API Password
if(isset($_POST['inp_api_password'])){
	$inp_api_password = $_POST['inp_api_password'];
	
	if($inp_api_password != "$api_password"){
		echo"Wrong API Password";
		die;
	}
}
else{
	echo"Missing API Password";
	die;
}


// Image
$img_code = $_POST['inp_image_base'];
$img_data = base64_decode($img_code);

$datetime = date("YmdHis");

$image_path = "../images/" . $datetime . ".jpg";
$extension = getExtension($image_path);
file_put_contents($image_path,$img_data);

// Convert it to PNG
if(file_exists("$image_path")){
	list($width,$height) = getimagesize($image_path);
	
	if($width == "" OR $height == ""){
		echo"getimagesize_failed";
		unlink("$image_path");
	}
	else{	
		$image_final_path = "../images/" . $datetime . ".png";

		// Image should be 1000 x dynamic
		if($width > 1000){
			$newwidth=1000;
			$newheight=($height/$width)*$newwidth; 
		}
		else{
			$newwidth = $width;
			$newheight = $height;
		}
		$tmp=imagecreatetruecolor($newwidth,$newheight);
						
		if($extension == "jpg" || $extension == "jpeg" ){
			$src = imagecreatefromjpeg($image_path);
		}
		else{
			$src = imagecreatefrompng($image_path);
		}

		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight, $width,$height);
		imagepng($tmp, $image_final_path);
		imagedestroy($tmp);

		// Unlink image path
		unlink("$image_path");

		// Give path
		echo"$image_final_path";
	}
}

?>