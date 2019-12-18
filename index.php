<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>
<script>

 function  changeClass() {
     $(this).prev().toggleClass('active')
 }
 $(function () {
 $('p').slideUp();

 })

 $(function () {
     $('.alert').click(function () {

         $(this).next().slideToggle();
         $(this).toggleClass('active');
     });
 });
</script>

    <title>Document</title>
</head>
<body>
<div class="container">
<div style="text-align: center" class="alert alert-info"><h3> Парсинг новостных сайтов</h3> <a href="http://10.64.143.29/statistica/">Выход</a></div>

    <?php

    require_once "libs/pattern.php";
    require_once "libs/array.php";
    $host = 'localhost'; // хост
    $dbname = 'parser'; // название базы
    $user = "root"; // логин пользователя
    $pass = ''; // пароль
    $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    // Переменная хранит число сообщений выводимых на станице
    $num = 5;
    // Извлекаем из URL текущую страницу
    $page = $_GET['page'];
    // Определяем общее число сообщений в базе данных
    $sth = $db->prepare("SELECT count(*) c FROM p_table ");
    $sth->execute();
    $catalogCount = $sth->fetchAll(PDO::FETCH_ASSOC);

    $catalogCount[0]['c'];
    // Находим общее число страниц
    $total = intval(($catalogCount[0]['c'] - 1) / $num) + 1;

    // Определяем начало сообщений для текущей страницы
    $page = intval($page);
    // Если значение $page меньше единицы или отрицательно
    // переходим на первую страницу
    // А если слишком большое, то переходим на последнюю
    if(empty($page) or $page < 0) $page = 1;
    if($page > $total) $page = $total;
    // Вычисляем начиная к какого номера
    // следует выводить сообщения
     $start = $page * $num - $num;

    $finish=$start+$num;
    // Выбираем $num сообщений начиная с номера $start
    $sth = $db->prepare("SELECT * FROM p_table where id>$start and id<=$finish ORDER BY id");
    $sth->execute();
    $results= $sth->fetchAll(PDO::FETCH_ASSOC);


     $dir= __DIR__;
    $scandir= scandir($dir);
     $implode = implode(" ",$scandir);
     $count_array= count($array);
     $count = count($scandir)-8;
     echo "<div class='alert alert-warning'>";

     echo "<h5>Всего: ".$count_array." сайтов. В работе: ".$count. " </h5>";
     echo "<div style='font-size: 14px'>";
     echo$preg = preg_replace("~[.]php|README[.]md|[.]git|[.]|index[.]php|libs|img|css~siU"," ",$implode);
     echo "</div>";

     echo "<h5>Ключевые слова:</h5>";

    echo "<div style='font-size: 14px'>";
     echo preg_replace('~[|]~',', ',$text);
     echo "</div>";
     echo "</div>";




    foreach ($results as $result ){
        echo'<div class="alert alert-success ">';
        echo $result['date']." ".$result['ahref']."<br>";
        echo '</div>';
        echo "<p class='active'>";
        $res_replace = preg_replace("~($text)~i", '<b>\1</b>', $result['text']);
        echo $res_replace."<br>";
        echo "</p>";

    }
    ?>


<?php
// Проверяем нужны ли стрелки назад
if ($page != 1) $pervpage = '<a href= ./index.php?page=1><<</a>
<a href= ./index.php?page='. ($page - 1) .'><</a> ';
// Проверяем нужны ли стрелки вперед
if ($page != $total) $nextpage = ' <a href= ./index.php?page='. ($page + 1) .'>></a>
<a href= ./index.php?page=' .$total. '>>></a>';

// Находим две ближайшие станицы с обоих краев, если они есть
if($page - 2 > 0) $page2left = ' <a href= ./index.php?page='. ($page - 2) .'>'. ($page - 2) .'</a> | ';
if($page - 1 > 0) $page1left = '<a href= ./index.php?page='. ($page - 1) .'>'. ($page - 1) .'</a> | ';
if($page + 2 <= $total) $page2right = ' | <a href= ./index.php?page='. ($page + 2) .'>'. ($page + 2) .'</a>';
if($page + 1 <= $total) $page1right = ' | <a href= ./index.php?page='. ($page + 1) .'>'. ($page + 1) .'</a>';

// Вывод меню

echo "<div style='text-align: center' class='alert alert-dark'>";
      echo $pervpage.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$nextpage;

      echo "</div>";
      ?>

</div>
</body>
</html>