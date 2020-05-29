<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-32">
</head>
<body>
<?php
function generateField($type, $name, $text){
    global $errorField;
    global $errorVerdict;
    if(isset($errorField)){
        echo $text,'<input type = "',$type,'" name = "', $name, '" value = "', $_POST[$name], '"/><br/>';
        if($errorField == $name){
            echo '<div style = "color:red">',$errorVerdict,"</div>";
        }
    }else{
        echo $text,'<input type = "',$type,'" name = "', $name, '" value = ""/><br/>';
    }
    echo '<br/>';
}
?>
<h1>Вариант 6</h1>
<form action="result.php" method="POST">
    <?php
    generateField('text', 'dir', 'Сканируемый каталог');
    generateField('date', 'dateFrom', 'Минимальная дата');
    generateField('date', 'dateTo', 'Максимальная дата');
    generateField('text', 'name', 'Кусочек имени');
    ?>

    <input type="submit" value="Ввод">
</form>
</body>
</html>