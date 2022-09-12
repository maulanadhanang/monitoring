		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1>Device</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
								<li class="breadcrumb-item"><a href="<?= site_url(array('device')) ?>">Device</a></li>
								<li class="breadcrumb-item active"><?= ($this->uri->segment('2')=="create")?"Tambah":"Ubah" ?></li>
							</ol>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<!-- left column -->
						<div class="col-md-9">
							<?php if($data['pesan']!=""){ ?>
							<div class="callout callout-danger">
								<h5><i class="fas fa-info"></i> <?= $data['pesan'] ?></h5>
							</div>
							<?php } ?>
							<!-- general form elements -->
							<div class="card <?= ($this->uri->segment('2')=="create")?"card-primary":"card-warning" ?>">

								<div class="card-header">
									<h3 class="card-title"><?= ($this->uri->segment('2')=="create")?"Tambah":"Ubah" ?> User</h3>
								</div>
								<!-- /.card-header -->

								<!-- form start -->
								<form role="form" method="POST">
								<div class="card-body">
									<div class="form-group">
										<label for="nama">Nama</label>
										<input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" value="<?= ($data['device'] != new stdClass())?$data['device']->nama:"" ?>">
									</div>
									<div class="form-group">
										<label for="host">IP Host</label>
										<input type="text" class="form-control" id="host" name="host" placeholder="Masukkan IP Host" value="<?= ($data['device'] != new stdClass())?$data['device']->host:"" ?>">
									</div>
									<div class="form-group">
										<label for="port">Port</label>
										<input type="text" class="form-control" id="port" name="port" placeholder="Masukkan Port" value="<?= ($data['device'] != new stdClass())?$data['device']->port:"" ?>">
									</div>
									<div class="form-group">
										<label for="username">Username</label>
										<input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" value="<?= ($data['device'] != new stdClass())?$data['device']->username:"" ?>">
									</div>
									<div class="form-group">
										<label for="password">Password</label>
										<input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" value="<?= ($data['device'] != new stdClass())?$data['device']->password:"" ?>">
									</div>
								</div>
								<!-- /.card-body -->
								<div class="card-footer">
									<button type="submit" class="btn btn-primary float-sm-right">Simpan</button>
								</div>
								</form>
							</div>
							<!-- /.card -->	
						</div>
						<div class="col-md-3">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Aksi</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<a href="<?= site_url(array('device')) ?>" class="btn btn-block btn-primary">Tabel</a>
									<?php if($this->uri->segment('2')=="update"){ ?>
									<a href="<?= site_url(array('device', 'view', $data['user']->id)) ?>" class="btn btn-block btn-info">Lihat</a>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<!-- /.row -->
				</div><!-- /.container-fluid -->
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->