<?php
if (!$_SESSION['name']){
    \App\Services\Router::redirect('/');
}
?>

<?php require_once 'views/components/header.php' ?>

<h1 class="text-center">Hello <?php echo $_SESSION['name']; ?></h1>

<?php require_once 'views/components/footer.php' ?>