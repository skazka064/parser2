<?php
$host = 'localhost'; // хост
$dbname = 'parser'; // название базы
$user = "root"; // логин пользователя
$pass = ''; // пароль
$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
$sth = $db->prepare("SELECT * FROM p_table order by id desc ");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);

$ahref[] = [];
for ($i = 0; $i < count($result); $i++) {
    $ahref[$i] = $result[$i]['ahref'];
}






?>
