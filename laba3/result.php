<? php
$errorField = '';
$errorVerdict = '';
$name = '';
$maxDate = '';
$minDate = '';
function getDatePost($label)
{
    global $errorField;
    global $errorVerdict;
    $time = strtotime($_POST[$label]);
    if ($time) {
        return date('Y-m-d', $time);
    } else {
        $errorField = $label;
        $errorVerdict = 'Некорректный формат даты';
        return false;
    }
}

function getDateInterval()
{
    $data = array();
    if ($data['dateFrom'] = getDatePost('dateFrom')) {
        if ($data['dateTo'] = getDatePost('dateTo')) {
            return $data;
        }
    }
    return false;

}

function getNeededFiles($dir)
{
    global $errorField;
    global $errorVerdict;
    $allFiles = scandir($dir);
    if (!$allFiles) {
        $errorField = 'dir';
        $errorVerdict = 'Каталог не найден';
        return false;
    }
    $directory = new \RecursiveDirectoryIterator($dir);
    $filter = new \RecursiveCallbackFilterIterator($directory, function ($current, $key, $iterator) {
        global $name;
        global $maxDate;
        global $minDate;
        if ($current->getFilename()[0] === '.') {
            return FALSE;
        }
        if (date('Y-m-d', $current->getCTime()) > $maxDate) {
            return FALSE;
        }
        if (date('Y-m-d', $current->getCTime()) < $minDate) {
            return FALSE;
        }
        return is_int(strpos($current->getFilename(), $name));
    });
    $iterator = new \RecursiveIteratorIterator($filter);
    foreach ($iterator as $info) {
        echo $info->getPathname();
        if (is_dir($info->getPathname())) {
            echo '(каталог)';
        }
        echo '<br/>';
    }
    return true;
}

function main()
{
    global $errorField;
    global $errorVerdict;
    $info = getDateInterval();
    if (!$info) {
        return false;
    }
    if ($info['dateFrom'] > $info['dateTo']) {
        $errorField = 'dateFrom';
        $errorVerdict = 'Не может быть больше, чем максимальная';
        return false;
    }
    if (!isset($_POST['dir'])) {
        $errorField = 'dir';
        $errorVerdict = 'Не может быть пустым';
        return false;
    }
    if (!isset($_POST['name']) || $_POST['name'] == '') {
        $errorField = 'name';
        $errorVerdict = 'Не может быть пустым';
        return false;
    }
    global $name;
    global $minDate;
    global $maxDate;
    $minDate = $info['dateFrom'];
    $maxDate = $info['dateTo'];
    $name = $_POST['name'];
    $files = getNeededFiles($_POST['dir']);
    return $files;
}

if (!main() && $errorField != '') {
    require_once 'index.php';
}
?>