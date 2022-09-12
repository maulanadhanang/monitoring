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
								<li class="breadcrumb-item"><a href="<?= site_url(array('device')) ?>">Device</a></li>
								<li class="breadcrumb-item active">Tabel</li>
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
									<h3 class="card-title">Table Device</h3>
									<a href="<?= site_url(array('device', 'create')) ?>" class="btn btn-primary btn-sm float-sm-right">Tambah</a>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<table id="mytable" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th width="80%">NAMA</th>
											<th width="20%"></th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($data as $dt) {
										?>
										<tr>
											<td><?= $dt->nama ?></td>
											<td align="center"><a href="<?= site_url(array('device', 'view', $dt->id)) ?>" class="btn btn-info btn-xs">Lihat</a> &nbsp; <a href="<?= site_url(array('device', 'update', $dt->id)) ?>" class="btn btn-warning btn-xs">Ubah</a> &nbsp; <a href="<?= site_url(array('device', 'delete', $dt->id)) ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin?')">Hapus</a></td>
										</tr>
										<?php
										}
										?>
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