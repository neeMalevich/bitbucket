<?php require_once 'views/components/header.php' ?>

    <section class="bg-image"
             style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3 pt-5 pb-5">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Регистрация</h2>

                                <form onsubmit="return true;" action="/auth/register" method="post">
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example1cg">Введите ваш логин</label>
                                        <input type="text" name="login" class="form-control form-control-lg"
                                               placeholder="введите ваш логин" required/>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label">Введите ваш пароль</label>
                                        <input type="password" name="password" class="form-control form-control-lg"
                                               placeholder="введите ваш пароль" required/>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label">Повторите ваш пароль</label>
                                        <input type="password" name="confirm_password"
                                               class="form-control form-control-lg" placeholder="повторите ваш пароль"
                                               required/>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label">Введите ваш email</label>
                                        <input type="email" name="email" class="form-control form-control-lg"
                                               placeholder="повторите ваш email" required/>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example1cg">Введите имя</label>
                                        <input type="text" name="name" class="form-control form-control-lg"
                                               placeholder="Введите имя" required/>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit"
                                                class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">
                                            Регистрация
                                        </button>
                                    </div>

                                    <?php if (isset($_SESSION['message'])) : ?>
                                        <div class="alert alert-primary mt-2" role="alert">
                                            <ul class="mb-0">
                                            <?php foreach ($_SESSION['message'] as $message) : ?>
                                                <li><?= $message ?></li>
                                            <?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <?php
                                        unset($_SESSION['message']);
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