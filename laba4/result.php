<? php
if (isset($_FILES) && $_FILES['inputfile']['error'] == 0) { // Проверяем, загрузил ли пользователь файл
    $text = file_get_contents($_FILES['inputfile']['tmp_name']);
    $matches = array();
    $pattern = '/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i';
    preg_match_all($pattern, $text, $matches);
    foreach ($matches[0] as $match) {
        $text = str_replace($match, '<a href="mailto:' . $match . '" style = "color:red;">' . $match . '</a>', $text);
    }
    echo $text;
    echo '<ul>';
    foreach ($matches[0] as $match) {
        echo '<li>', $match, '</li>';
    }
    echo '</ul>';
} else {
    echo 'Файл не был загружен';
}
?>