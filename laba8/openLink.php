<?php
if (isset($_GET['link'])) {
    $filename = "counter.txt";
    if (!file_exists($filename)) {
        $file = fopen($filename, "w");
        $count = 0;
    } else {
        $file = fopen($filename, "r+");
        $count = fread($file, filesize($filename));
        rewind($file);
    }
    fwrite($file, $count + 1);
    fclose($file);

    $link = $_GET['link'];
    header('Location: ' . $link);
}