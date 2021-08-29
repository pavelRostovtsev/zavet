<?php
//
//use public_html\application\services\Flash;
//
//?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<!--    <script src="/public_html/public/scripts/form.js"></script>-->
</head>
<body class="d-flex flex-column min-vh-100">
<header>
    <nav class="navbar navbar-light bg-info d-flex justify-content-between">
        <div>
            <a class="badge badge-warning" href="#"><h2>Админ панель</h2></a>
        </div>
        <div>
            <a class="badge badge-danger" href="/admin/logOut"><h2>Выйти</h2></a>
        </div>
    </nav>
</header>
<main class="mt-2"><?=$content?></main>
<footer class="mastfoot mt-auto bg-info d-flex justify-content-center ">
    <div class="inner">
        <a class="badge badge-warning" href="https://barnaul.hh.ru/resume/717d48caff07d50fac0039ed1f755564677454#key-skills">hh</a>
    </div>
</footer>

<?php if (!Flash::existsFlash('success')) : ?>
    <div class="flash alert alert-success alert-dismissible fade show fixed-top" role="alert">
        <p class="text-center"><?=Flash::flash('success');?></p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
     </button>
    </div>
<?php elseif (!Flash::existsFlash('errors')) : ?>
    <div class="flash alert alert-danger alert-dismissible fade show fixed-top" role="alert">
        <p class="text-center"><?=Flash::flash('errors');?></p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif;?>

</body>
</html>