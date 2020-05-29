<?php
header("Content-Type: text/html; charset=utf-32");
$path=isset($_GET['path']) ? $_GET['path'] : 'ничего нет';
$links=["home", "about", "services"];
foreach($links as $key=>$value){
	if($path==$value){
		echo "<a id='current' href='index.php?path=$value'>$value </a>"."<br>";
	}
	else{
		echo "<a  href='index.php?path=$value'>$value </a>"."<br>";
	}
}
if ($path=='home'){
	require_once("home.php");
}
if ($path=='about'){
	require_once("about.php");
}
if ($path=='services'){
	require_once("services.php");
}
echo "<a href='var6.php'>Вариант 6</a>";	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-32">
	<title>Hello</title>
	<style>
   		#current { 
    			background: red;
   		}
  	</style>
</head>
</html>
