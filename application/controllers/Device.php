<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Device extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('myModel');
		if(!user_logged_in()){
        	redirect('login');
        }

        $this->user_access();
	}

	function user_access(){
		if(!is_allow_access($this->uri->segment('1')."/".$this->uri->segment('2'))){
        	redirect('denied');
        }else{
        	return true;
        }
	}

	function index()
	{
		$users = $this->myModel->getAllQuery("SELECT * FROM t_device");

		$data = array(
			'view'  => 'device',
			'data' => $users
		);

		$this->load->view('lte/main', $data);
	}

	function create()
	{
		$device = new stdClass();
		$pesan = "";

		if(isset($_POST['nama'])){
			$device->nama = $this->input->post('nama');
			$device->host = $this->input->post('host');
			$device->port = $this->input->post('port');
			$device->username = $this->input->post('username');
			$device->password = $this->input->post('password');

			if($device->nama=="") $pesan = "Masukkan nama";
			else if($device->host=="") $pesan = "Masukkan ip host";
			else if($device->port=="") $pesan = "Masukkan port";
			else if($device->username=="") $pesan = "Masukkan username";
			else if($device->password=="") $pesan = "Masukkan password";
			else{
				$id = $this->myModel->insert('t_device', $device);
				if($id!=null){
					redirect('device/view/'.$id);
				}else{
					$pesan = "Gagal simpan data";
				}
			}
		}

		$data = array(
			'view' => 'device_form',
			'data' => array(
					'device' => $device,
					'pesan' => $pesan
				)
		);

		$this->load->view('lte/main', $data);
	}

	function update($id=null)
	{
		$device = $this->myModel->getOne('t_device', array('id'=>$id));
		if($device==null){
			redirect('device');
		}
		$pesan = "";

		if(isset($_POST['nama'])){
			$device->nama = $this->input->post('nama');
			$device->host = $this->input->post('host');
			$device->port = $this->input->post('port');
			$device->username = $this->input->post('username');
			$device->password = $this->input->post('password');

			if($device->nama=="") $pesan = "Masukkan nama";
			else if($device->host=="") $pesan = "Masukkan ip host";
			else if($device->port=="") $pesan = "Masukkan port";
			else if($device->username=="") $pesan = "Masukkan username";
			else if($device->password=="") $pesan = "Masukkan password";
			else{
				if($this->myModel->update('t_device', $device, "id", $id)){
					redirect('device/view/'.$id);
				}else{
					$pesan = "Gagal simpan data";
				}
			}
		}

		$data = array(
			'view' => 'device_form',
			'data' => array(
					'device' => $device,
					'pesan' => $pesan
				)
		);

		$this->load->view('lte/main', $data);
	}

	function view($id=null)
	{
		$device = $this->myModel->getOneQuery("SELECT * FROM t_device WHERE id='$id'");
		if($device==null){
			redirect('device');
		}

		$data = array(
			'view' => 'device_view',
			'data' => $device
		);

		$this->load->view('lte/main', $data);
	}

	function delete($id=null){
		if($id!=null){
			$this->myModel->delete("t_device", "id", $id);
		}
		redirect('device');
	}

	function iface($id=null)
	{
		$device = $this->myModel->getOneQuery("SELECT * FROM t_device WHERE id='$id'");
		if($device==null){
			redirect('device');
		}

		$ifaces = array();

		$ifacess = $this->myModel->getAllQuery("SELECT * FROM t_interface WHERE device=$id");
		foreach($ifacess as $if){
			$iface = array();
			$iface['id'] = $if->iface_id;
			$iface['name'] = $if->iface_name;
			$iface['disabled'] = $if->disabel;

			$ifaces[] = $iface;
		}

		$monitor = array();

		if(isset($_GET['monitor'])){
			$iface_name = $_GET['monitor'];

			$monitor['iface'] = $iface_name;
		}

		$data = array(
			'view' => 'device_iface',
			'ifaces' => $ifaces,
			'monitor' => $monitor,
			'data' => $device
		);

		$this->load->view('lte/main', $data);
	}

	function monitor()
	{
		$device = $this->input->post('device');
		$iface = $this->input->post('iface');

		$rxpower = 0;
		$txpower = 0;
		$datamonitor = array();

		$monitors = $this->myModel->getAllQuery("SELECT * FROM (SELECT * FROM t_monitor WHERE device=$device AND iface='$iface' ORDER BY id DESC LIMIT 10) t ORDER BY id");
		foreach($monitors as $m){
			$dt = new stdClass();
			$dt->x = date("H:i", strtotime($m->waktu));
			$dt->y = $m->rx;
			$dt->z = $m->tx;
			$datamonitor[] = $dt;

			$rxpower = $m->rx_p;
			$txpower = $m->tx_p;
		}

		$data = array();
		$data['rxpower'] = $rxpower;
		$data['txpower'] = $txpower;
		$data['datamonitor'] = $datamonitor;

		echo json_encode($data);
	}
}
