    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <img src="http://cursosrandom.com.br/img/logo_menu.png" />
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Acesse o sistema administrativo</p>

                <form action="<?= base_url("index.php/login/registrar");?>" method="POST">
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" name="txtEmail" placeholder="Email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="txtSenha" placeholder="Senha">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        
                        <!-- /.col -->
                        <div class="col-xs-offset-8 col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat"><span class="fa fa-key"></span> Entrar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->

    </body>
</html>
