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
						<div class="col-md-3">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Interface</h3>
								</div>
								<div class="card-body">
									<?php
									for($i=0; $i<count($ifaces); $i++){
										if($ifaces[$i]['disabled']=="false"){
									?>
									<a href="<?= site_url(array('device', 'iface', $data->id))."?monitor=".$ifaces[$i]['name'] ?>" class="btn btn-block btn-primary"><?= $ifaces[$i]['name'] ?></a>
									<?php
										}
									}
									?>
								</div>
							</div>
						</div>
						<div class="col-md-9">
							<?php if(!empty($monitor)){ ?>
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Monitor <b><?= $monitor['iface'] ?></b></h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<div id="graph"></div>
									<script>
										var grafik = Morris.Area({
												element: 'graph',
												data: [],
												xkey: 'x',
												parseTime: false,
												ykeys: ['y', 'z'],
												labels: ['Rx', 'Tx']
											}).on('click', function(i, row){
												console.log(i, row);
											});

										getdata = function(){
											$.ajax({
												url   : '<?= site_url(array('device', 'monitor')) ?>',
												type  : 'POST',
												dataType : 'json',
												data: {device:'<?= $data->id ?>', 'iface':'<?= $monitor['iface'] ?>'},
												success : function(data){
													$("#rxpower").html("Rx Power : "+data.rxpower+" dbm");
													$("#txpower").html("Tx Power : "+data.txpower+" dbm");

													grafik.setData(data.datamonitor);

													window.setTimeout(function () {
														getdata();
													}, 10000);
												}
											});
										}
										getdata();
									</script>
									<br><br>
									<div width="100%">
										<div style="text-align:center; float:left;" id="rxpower">Rx-Power : 0 dbm</div>
										<div style="text-align:center; float:left; margin-left: 50px;" id="txpower">Tx-Power : 0 dbm</div>
									</table>
								</div>
								<!-- /.card-body -->
							</div>
							<?php } ?>
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