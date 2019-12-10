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
<div style="text-align: center" class="alert alert-success"><h1> Парсинг новостных сайтов</h1></div>

    <?php
    require_once "libs/db.php";
    require_once "libs/pattern.php";
    foreach ($results as $result ){
        echo'<div class="alert alert-primary ">';
        echo $result['date']." ".$result['ahref']."<br>";
        echo '</div>';
        echo "<p class='active'>";



        $res_replace = preg_replace("~($text)~i", '<b>\1</b>', $result['text']);

        echo $res_replace."<br>";
        echo "</p>";

    }
    ?>
    <div class="alert alert-secondary">
        <a href="http://10.64.143.29/statistica/">Выход</a>
    </div>
</div>

</body>
</html>
