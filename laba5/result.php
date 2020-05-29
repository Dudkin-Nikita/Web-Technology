<? php

$dbname = $_POST["dbname"];
$count = $_POST["count"];

if (isset($dbname) && isset($count)) {
    $mysqli = new mysqli('localhost', 'root', 'password123', $dbname);
    $mysqli->set_charset('UTF8');
    $mysqli->query("SET CHARACTER SET 'UTF8'");
    $mysqli->query("SET CHARSET 'UTF8'");
    $mysqli->query("SET NAMES 'UTF8'");
    $result = $mysqli->query("SHOW TABLES");
    $tables = array();
    if ($result !== false) {
        while ($row = $result->fetch_assoc()) {
            $tables[] = $row;
        }
        $result->free();
    }
    $t = array_rand($tables);
    $table = $tables[$t];
    $table = array_values($table);
    $table = $table[0];
    $result = $mysqli->query("SELECT * FROM `$table`");
    $array = array();
    if ($result !== false) {
        while ($row = $result->fetch_assoc()) {
            $array[] = $row;
        }
        $result->free();
    }
    if ($count == 1 || count($array) == 1) {
        $randomList = array(array_rand($array));
    } elseif ($count <= count($array)) {
        $randomList = array_rand($array, $count);
    } else {
        $randomList = array_rand($array, count($array));
    }
    echo "<table>";
    foreach ($randomList as $k) {
        $t = $array[$k];
        echo "<tr> <td>";
        foreach ($t as $val) {
            echo $val . " ";
        }
        echo "</td> </tr>";
    }
    echo "</table><br/>";
    $mysqli->close();
}

