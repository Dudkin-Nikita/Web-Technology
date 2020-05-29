<?php
function createOption($value, $text, $isSelected)
{
    if ($isSelected) {
        echo "<option selected value=\"$value\">$text</option>";
    } else {
        echo "<option value=\"$value\">$text</option>";
    }
}

$default = array(
    "background" => "white",
    "commonColor" => "black",
    "commonSize" => "14px",
    "titleColor" => "black",
    "titleSize" => "24px");

function setup($property)
{
    if (isset($_POST[$property])) {
        $_SESSION[$property] = $_POST[$property];
    } elseif (!isset($_SESSION[$property])) {
        global $default;
        $_SESSION[$property] = $default[$property];
    }
}

$colors = array(
    array("value" => "blue", "text" => "Синий"),
    array("value" => "white", "text" => "Белый"),
    array("value" => "red", "text" => "Красный"),
    array("value" => "black", "text" => "Черный"),
);

$sizes = array(
    array("value" => "14px", "text" => "Стандартный"),
    array("value" => "8px", "text" => "Мелкий"),
    array("value" => "24px", "text" => "Крупный"),
    array("value" => "36px", "text" => "Огромный")
);

session_start();

foreach ($default as $key => $value) {
    setup($key);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-32">
    <title>lab6</title>
    <style>
        <?php
        echo "h1{color:".$_SESSION["titleColor"].";\nfont-size: ".$_SESSION["titleSize"].";}\n";
        echo "p{color:".$_SESSION["commonColor"].";\nfont-size: ".$_SESSION["commonSize"].";}\n";
        echo "*{background-color:".$_SESSION["background"].";}";
        ?>
    </style>
</head>
<body>
<h1>Вариант 5</h1>
<form action="index.php" method="post">
    <p>Фон страницы
        <select name="background">
            <?php
            foreach ($colors as $color) {
                createOption($color["value"], $color["text"], $color["value"] == $_SESSION["background"]);
            }
            ?>
        </select>
    </p>
    <p>Цвет обычного текста
        <select name="commonColor">
            <?php
            foreach ($colors as $color) {
                createOption($color["value"], $color["text"], $color["value"] == $_SESSION["commonColor"]);
            }
            ?>
        </select>
    </p>
    <p>Размер обычного текста
        <select name="commonSize">
            <?php
            foreach ($sizes as $size) {
                createOption($size["value"], $size["text"], $size["value"] == $_SESSION["commonSize"]);
            }
            ?>
        </select>
    </p>
    <p>Цвет заголовка
        <select name="titleColor">
            <?php
            foreach ($colors as $color) {
                createOption($color["value"], $color["text"], $color["value"] == $_SESSION["titleColor"]);
            }
            ?>
        </select>
    </p>
    <p>Размер заголовка
        <select name="titleSize">
            <?php
            foreach ($sizes as $size) {
                createOption($size["value"], $size["text"], $size["value"] == $_SESSION["titleSize"]);
            }
            ?>
        </select>
    </p>
    <p><input type="submit" value="Применить"></p>
</form>
</body>
</html>
