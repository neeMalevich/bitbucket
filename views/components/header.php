<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Click media test</title>
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body class="d-flex min-vh-100 justify-content-between flex-column">
<header class="header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container d-flex justify-content-between">
            <a class="navbar-brand" href="/">Malevich тестовое задание</a>
            <?php if (isset($_SESSION['name']) && !empty($_SESSION['name'])) : ?>
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="/user">Личный кабинет</a>
                    </li>
                    <form action="/auth/logout" method="post">
                        <button type="submit" class="nav-link btn btn-danger">Выйти</button>
                    </form>
                </ul> 
            <?php else : ?>
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="/login">Войти</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Регистрация</a>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </nav>
</header>