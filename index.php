
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Youtube Botu</title>
	<link rel="stylesheet" href="css/bootstrap.min.css" />
</head>

<style>
	.col-md-8 ul {list-style: none;}
	.col-md-8 ul li {float: left; margin:10px;}
	.col-md-8 ul li img {border-radius: 20px}

}
</style>
<body>
<form action="index.php" method="POST">
	<table class="table table-bordered">
		<tr>
			<td valign="100" width="200">Aranacak Kanal İsmi</td>
			<td><input placeholder="Kanal Ara..." name="kanaladi" class="form-control" type="text" />	</td>
		</tr>
		<tr>
		<td></td>
			<td><input class="form-control" type="submit" value="Kanalı Ara" />	</td>
		</tr>
	</table>
</form>
<?php 
require('fonksiyon.php');

function boslukSil ($veri) {
	$veri = trim($veri);
	$veri = str_replace(" ", "+", $veri);
	return $veri;
}


?>


<?php 
	if ($_POST) {
		error_reporting(0);
		$kanal = $_POST['kanaladi'];
		$kanal = boslukSil($kanal);
		if (!empty($kanal)) {
			$site = file_get_contents_curl('https://www.youtube.com/channels?q='.$kanal);
			$re = '/<a dir="ltr" href="\/channel\/(.*?)" class="\syt-uix-sessionlink" title="(.*?)"/is';
			preg_match_all($re, $site, $kanal);

			$link = $kanal[1];
			$baslik = $kanal[2];
			
 ?>

<div class="col-md-2"></div>
<div class="col-md-8">
<ul>
	<?php 
		
		for ($i=0; $i < count($link); $i++) { 
			echo "<li><a href='yicerik.php?link=$link[$i]&kanal=$baslik[$i]'> $baslik[$i] </a></li>";
		}

	 ?>
</ul>
</div>
<div class="col-md-2"></div>

<?php }} ?>



</body>
</html>