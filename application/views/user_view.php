		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1>User</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
								<li class="breadcrumb-item"><a href="<?= site_url(array('user')) ?>">User</a></li>
								<li class="breadcrumb-item active">Lihat</li>
							</ol>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-9">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">User Detail</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<table class="table table-striped">
										<tbody>
										<tr>
											<td style="width: 30%;">Nama</td>
											<td><?= $data->nama ?></td>
										</tr>
										<tr>
											<td>Username</td>
											<td><?= $data->username ?></td>
										</tr>
										<tr>
											<td>Password</td>
											<td><?= $data->password ?></td>
										</tr>
										<tr>
											<td>Level</td>
											<td><?= $data->level ?></td>
										</tr>
										</tbody>
									</table>
								</div>
								<!-- /.card-body -->
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
									<a href="<?= site_url(array('user')) ?>" class="btn btn-block btn-primary">Tabel</a>
									<a href="<?= site_url(array('user', 'update', $data->id)) ?>" class="btn btn-block btn-warning">Ubah</a>
									<a href="<?= site_url(array('user', 'delete', $data->id)) ?>" class="btn btn-block btn-danger" onclick="return confirm('Apakah anda yakin?')">Hapus</a>
								</div>
							</div>
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
				</div>
				<!-- /.container-fluid -->
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<script>
		$(function () {
			$("#mytable").DataTable({
				"responsive": true,
				"autoWidth": false,
			});
		});
		</script>