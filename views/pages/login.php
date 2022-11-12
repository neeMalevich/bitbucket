<?php require_once 'views/components/header.php' ?>

    <section class="bg-image"
             style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3 pt-5 pb-5">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Авторизация</h2>

                                <form id="login-form" action="/auth/login" method="post">
                                    <div class="form-outline mb-4">
                                        <label class="form-label">Введите ваш логин</label>
                                        <input type="text" name="login" class="form-control form-control-lg"
                                               placeholder="введите ваш логин"/>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label">Введите ваш пароль</label>
                                        <input type="password" name="password" class="form-control form-control-lg"
                                               placeholder="введите ваш пароль"/>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button id="login-btn" type="submit"
                                                class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">
                                            Вход
                                        </button>
                                    </div>

                                    <div class="alert alert-danger d-none" id="sign-up-errors"></div>
                                    <div class="alert alert-success d-none" id="sign-up-success"></div>

                                    <?php if (isset($_SESSION['message_login'])) : ?>
                                        <div class="alert alert-primary mt-2" role="alert">
                                            <ul class="mb-0">
                                                <?php foreach ($_SESSION['message_login'] as $message) : ?>
                                                    <li><?= $message ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <?php
                                        unset($_SESSION['message_login']);
                                    endif;
                                    ?>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php require_once 'views/components/footer.php' ?>