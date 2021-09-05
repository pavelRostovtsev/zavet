<?php

use app\core\Flash;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    <title><?=$title?></title>
</head>
<body>
<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="/" class="nav-link px-2 text-secondary">Home</a></li>
                <?if($statusAuth === true) :?>
                    <li><a href="articles/create" class="nav-link px-2 text-secondary">Create Post</a></li>
                <?php endif; ?>

            </ul>

            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                <input name="title" type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
            </form>

            <div class="text-end">
                <?if($statusAuth === false) :?>
                    <a href="/admin/login"><button type="button" class="btn btn-outline-light me-2">Login</button></a>
                    <a href="/admin/registration"><button type="button" class="btn btn-warning me-2">Registration</button></a>
                <?else :?>
                    <a href="/admin/logOut"><button type="button" class="btn btn-danger">LogOut</button></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>
<?php if (!Flash::existsFlash('success')) : ?>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            alert("<?=Flash::flash('success');?>");
        });
    </script>

<?php elseif (!Flash::existsFlash('errors')) : ?>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            alert("<?=Flash::flash('errors');?>");
        });
    </script>
<?php endif;?>
<?=$content?>
</body>
</html>
