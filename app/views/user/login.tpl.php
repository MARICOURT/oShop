<div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
        <?php
        // On inclut des sous-vues => "partials"
        include __DIR__.'/../partials/flash_messages.tpl.php';
        ?>
            <div id="login-column" class="col-md-6">
                <div class="box">
                    <div class="shape1"></div>
                    <div class="shape2"></div>
                    <div class="shape3"></div>
                    <div class="shape4"></div>
                    <div class="shape5"></div>
                    <div class="shape6"></div>
                    <div class="shape7"></div>
                    <div class="float">
                        <form class="form" action="<?= $router->generate('user-loginpost') ?>" method="post">
                            <div class="form-group">
                                <label for="username" class="text-white">E-mail:</label><br>
                                <input type="text" name="email" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-white">Mot de passe :</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-info btn-md" value="Connexion">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>