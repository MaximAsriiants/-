<?
$host = 'localhost';
$login = 'root';
$pass = 'root';
$db_name = 'cersy-store';
$link=mysqli_connect($host, $login, $pass, $db_name) or die('Не удаётся подключиться к БД! Обновите страницу или попробуйте позже!');
$link->set_charset("utf8");
?>