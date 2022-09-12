<?php $this->load->view('lte/header', $data); ?>

<body class="hold-transition sidebar-mini layout-fixed">

    <div id="wrapper" class="wrapper">

        <?php $this->load->view('lte/navigation'); ?>

        <div id="page-wrapper">
         
        <?php $this->load->view($view, $data); ?>

        </div>
        <!-- /#page-wrapper -->

		<footer class="main-footer">
			<div class="float-right d-none d-sm-block">
				<b>Version</b> 1.0
			</div>
			<strong>Copyright &copy; 2020 <?= $this->config->config['pageTitle'] ?>.</strong> Layout by <a href="http://adminlte.io">AdminLTE.io</a>.
		</footer>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
		<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->

    </div>
    <!-- /#wrapper -->

<?php $this->load->view('lte/footer'); ?>
