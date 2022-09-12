<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <b><?= $this->config->config["pageTitle"] ?></b>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <p><?php if(isset($error)) { echo $error; }; ?></p>
                <form method="post">
                    <div class="input-group mb-3">
                        <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <?= form_error('username'); ?>
                    </div>
                    <div class="input-group mb-3">
                        <input class="form-control" placeholder="Password" name="password" type="password" value="">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <?= form_error('password'); ?>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
</body>