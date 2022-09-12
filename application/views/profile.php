        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Profil</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
                                <li class="breadcrumb-item active">Profil</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data User</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <tbody>
                                        <tr>
                                            <td style="width: 30%;">Nama</td>
                                            <td><?= user_logged_in()['user_nama'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Level</td>
                                            <td><?= user_logged_in()['user_levelnama'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Grup</td>
                                            <td><?= user_logged_in()['user_grupnama'] ?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <div class="col-md-12">
                            <?php if($data['error']!=""){ ?>
                            <div class="callout callout-danger">
                                <h5><i class="fas fa-info"></i> <?= $data['error'] ?></h5>
                            </div>
                            <?php } ?>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Akun</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form method="POST">
                                    <table class="table table-striped">
                                        <tbody>
                                        <tr>
                                            <td style="width: 30%;">Username</td>
                                            <td><?= user_logged_in()['user_username'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Password</td>
                                            <td><input class="form-control" placeholder="Password" name="password" type="password" value=""></td>
                                        </tr>
                                        <tr>
                                            <td>Password Baru</td>
                                            <td><input class="form-control" placeholder="Password Baru" name="passwordbaru1" type="password" value=""></td>
                                        </tr>
                                        <tr>
                                            <td>Ulangi Pass Baru</td>
                                            <td><input class="form-control" placeholder="Ulangi Password Baru" name="passwordbaru2" type="password" value=""></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td align="right"><input class="btn btn-primary" type="submit" value="Ubah Password"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    </form>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->