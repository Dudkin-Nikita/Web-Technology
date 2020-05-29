<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-32">
    <title>lab8</title>
</head>
<body>
<h1>Вариант 7</h1>
<a href="openLink.php?link=http://tut.by">tut.by</a>
<br/>
<?php
$filename = "counter.txt";
if (file_exists($filename)) {
    $file = fopen($filename, "r");
    $count = fread($file, filesize($filename));
    fclose($file);
    echo "Ссылка была открыта " . $count . " раз(а)";
} else {
    echo "Ссылка еще не была открыта";
}
?>
</body>
</html>
