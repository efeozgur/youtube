<?php require('fonksiyon.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Youtube Kanal</title>
</head>
<style>
	.videolar {background: lightgreen}
	.videolar ul {list-style: none; background: #efefef; float: left; width: 300px; margin:5px; padding:5px; height: 280px; border:1px solid #C2C3CA; border-radius:5px;}
	.videolar ul li span{font-size: 10px}
	.videolar ul li {padding: 2px}
	.videolar ul li img {border-radius: 10px}
	.aktifkanal {border:1px solid #ddd; color:black; padding:20px; text-align: center; margin:5px; font-weight: bolder; font-size:20px;}
	.siyah {background: #7B7D81; color:white; padding:10px; border-radius: 5px}
</style>
<body>
<?php 
	//error_reporting(0);
error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('html_errors', 'Off'); 	
	if ($_GET) {
		$link = $_GET['link'];
		$kanal = $_GET['kanal'];

	} else {echo "gelen bişey yok";}
	



	$site = file_get_contents_curl('https://www.youtube.com/channel/'.$link.'/videos');
	$re = '/https:\/\/i.ytimg.com\/vi\/(.*?)"/is';
	$re1 = '/dir="ltr" title="(.*?)"/is';
	$re2 = '/<ul class="yt-lockup-meta-info"><li>(.*?)<\/li><li>(.*?)<\/li><\/ul>/is';
$re3 = '/data-sessionlink="[a-zA-Z0-9\=\&\;\-]+" href="\/watch\?v=(.*?)">/is';

	preg_match_all($re, $site, $resim);
	preg_match_all($re1, $site, $baslik);
	preg_match_all($re2, $site, $goruntulenme);
	preg_match_all($re3, $site, $vlink);
	$res = $resim[1];
	$bas = $baslik[1];
	$gor = $goruntulenme[1];
	$tarih =  $goruntulenme[2];
	$videolink = $vlink[1];

	

 ?>

<div class="aktifkanal"><?php echo "<span class='siyah'>".$kanal." kanalındasınız...</span>"; ?> </div>

<div class="videolar">  
<?php 
	for ($i=0; $i < count($res); $i++) { 
		# code...
	
 ?>
	<ul>
		<li><center><?php echo "<a href='https://www.youtube.com/watch?v=$videolink[$i]'><img src='https://i.ytimg.com/vi/$res[$i]'></a>"; ?></center></li>
		<li><h3><?php echo $bas[$i]; ?></h3></li>
		<li><span><?php echo $gor[$i]; ?></span></li>
		<li><kbd style="font-size: 10px"><?php echo $tarih[$i]; ?> önce yüklendi</kbd></li>
		<li></li>
	</ul>
<?php }; ?>
</div>

</body>
</html>