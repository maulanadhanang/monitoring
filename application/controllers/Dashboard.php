<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();	
		$this->load->model('myModel');
	}

	public function index()
	{
		if(!user_logged_in()){
        	redirect('login');
        }

        $plg_total = 0;//$this->myModel->getOneQuery("SELECT COUNT(*) AS jml FROM t_pelanggan")->jml;
        $plgbaru_total = 0;//$this->myModel->getOneQuery("SELECT COUNT(*) AS jml FROM t_pelangganbaru WHERE status=0")->jml;
        $komplain_total = 0;//$this->myModel->getOneQuery("SELECT COUNT(*) AS jml FROM t_komplain WHERE status=0")->jml;
        $bayar_total = 0;//$this->myModel->getOneQuery("SELECT COUNT(distinct pelanggan) AS jml FROM t_pembayaran WHERE bulan='".date("Y-m")."'")->jml;
        $blmbayar_total = 0;//$plg_total - $bayar_total;

		$data = array(
			'view'  => 'dashboard',
			'data' => array(
				'plg_total' => $plg_total,
				'plg_link' => (user_logged_in()['user_level']<=3)?site_url(array('master', 'pelanggan')):"#",
				'plgbaru_total' => $plgbaru_total,
				'plgbaru_link' => (user_logged_in()['user_level']<=3 || user_logged_in()['user_level']==4)?site_url(array('aktivitas', 'pemasanganbaru')):"#",
				'komplain_total' => $komplain_total,
				'komplain_link' => (user_logged_in()['user_level']<=3 || user_logged_in()['user_level']==5)?site_url(array('aktivitas', 'komplain')):"#",
				'blmbayar_total' => $blmbayar_total,
				'blmbayar_link' => (user_logged_in()['user_level']<=3 || user_logged_in()['user_level']==6)?site_url(array('aktivitas', 'pembayaran')):"#",
			)
		);

		$this->load->view('lte/main', $data);
	}

	public function profile()
	{
		if(!user_logged_in()){
        	redirect('login');
        }
		$error = "";

		if(isset($_POST['password'])){
			$passlama = $this->input->post('password');
			$passbaru = $this->input->post('passwordbaru1');
			$passbaru2 = $this->input->post('passwordbaru2');

			if($passbaru==$passbaru2){
				if(MD5($this->config->config["PRE_PASS"].$passlama.$this->config->config["POST_PASS"])==user_logged_in()['user_password']){
					$passbaru = MD5($this->config->config["PRE_PASS"].$passbaru.$this->config->config["POST_PASS"]);
					$data = array(
						'password' => $passbaru
					);

					$result = $this->myModel->update('t_user', $data, "id", user_logged_in()['user_id']);

					if($result){
						redirect('logout');
					}else{
						$error = "Gagal ubah password";
					}
				}else{
					$error = "Password yang anda masukkan salah";
				}
			}else{
				$error = "Konfirmasi password baru salah";
			}
		}

		$data = array(
			'view'  => 'profile',
			'data' => array(
				'error' => $error
			)
		);

		$this->load->view('lte/main', $data);
	}

	public function login()
	{
		if(!user_logged_in()){
			//set form validation
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            //set message form validation
            $this->form_validation->set_message('required', '<div class="alert alert-danger">
                <div class="header"><b><i class="fa fa-exclamation-circle"></i> {field}</b> harus diisi</div></div>');

            //cek validasi
            if ($this->form_validation->run() == TRUE) {

                //get data dari FORM
                $username = $this->input->post("username", TRUE);
                $password = MD5($this->config->config["PRE_PASS"].$this->input->post('password', TRUE).$this->config->config["POST_PASS"]);

                //checking data via model
                $where = array(
					"username"=>$username,
					"password"=>$password,
				);
                $checking = $this->myModel->getOne("t_user", $where);

                //jika ditemukan, maka create session
                if ($checking) {
                    $session_data = array(
                        'user_id'   => $checking->id,
                        'user_nama' => $checking->nama,
                        'user_level' => $checking->level,
                        'user_username' => $checking->username,
                        'user_password' => $checking->password,
                    );

                    //set session userdata
                    $this->session->set_userdata(array("user_data"=>$session_data));

                    redirect('dashboard');
                }else{
                    $data['error'] = '<div class="alert alert-danger">
                        <div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> username atau password salah!</div></div>';
                    
                    $this->load->view('lte/header');
                    $this->load->view('login', $data);
					$this->load->view('lte/footer');
                }
            }else{
				$this->load->view('lte/header');
				$this->load->view('login');
				$this->load->view('lte/footer');
            }
		}else{
			redirect('dashboard');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}

    public function denied()
    {
        $data = array(
            'view'  => 'denied',
            'data' => array()
        );

        $this->load->view('lte/main', $data);
    }

    public function notfound()
    {
    	$data = array(
            'view'  => 'notfound',
            'data' => array()
        );

        $this->load->view('lte/main', $data);
    }

	public function monitor()
	{
		echo "<meta http-equiv=\"refresh\" content=\"15; URL=".site_url(array('monitor'))."\">";

		$api = new RouterosAPI();
		$api->debug = false;

		$devices = $this->myModel->getAllQuery("SELECT * FROM t_device");
		foreach($devices as $device){
			
			if ($api->connect($device->host.':'.$device->port, $device->username, $device->password)){
				
				$api->write('/interface/ethernet/print',true);
				// $api->write('?name=sfp-sfpplus2',true);//sfp-sfpplus2
				$READ = $api->read(false);
				$ARRAY = $api->parseResponse($READ);
				for($i=0; $i<count($ARRAY); $i++){
					$iface_id = $ARRAY[$i]['.id'];
					$iface_name = $ARRAY[$i]['name'];
					$iface_disabled = $ARRAY[$i]['disabled'];

					if($this->myModel->getOne('t_interface', array('device'=>$device->id, 'iface_id'=>$iface_id))==NULL){
						$_iface = new stdClass();
						$_iface->device = $device->id;
						$_iface->iface_id = $iface_id;
						$_iface->iface_name = $iface_name;
						$_iface->disabel = $iface_disabled;
	
						$this->myModel->insert('t_interface', $_iface);
					}

					// .id=*C
					// name=sfp-sfpplus2
					// default-name=ether7
					// mtu=1500
					// mac-address=00:0A:F7:0F:95:A2
					// orig-mac-address=00:0A:F7:0F:95:A2
					// arp=enabled
					// arp-timeout=auto
					// loop-protect=default
					// loop-protect-status=off
					// loop-protect-send-interval=5s
					// loop-protect-disable-time=5m
					// disable-running-check=false
					// auto-negotiation=true
					// advertise=10M-half,10M-full,100M-half,100M-full,1000M-half,1000M-full,2500M-full,5000M-full,10000M-full
					// full-duplex=true
					// tx-flow-control=off
					// rx-flow-control=off
					// cable-settings=default
					// speed=10Gbps
					// running=true
					// disabled=false
					// comment=OLT

					if($iface_disabled=="false"){
						$datamonitor = new stdClass();
						$datamonitor->device = $device->id;
						$datamonitor->iface = $iface_name;
						$datamonitor->waktu = date("Y-m-d H:i:s");
						
						$ARRAY2 = $api->comm('/interface/monitor-traffic', array(
							'interface'=>$iface_name,
							'once'=>'',
						));
						for($j=0; $j<count($ARRAY2); $j++){
							$rx = $ARRAY2[$j]['rx-bits-per-second'] / 1024;//kb
							$tx = $ARRAY2[$j]['tx-bits-per-second'] / 1024;//kb
							$rx_mb = $rx / 1024;//mb
							$tx_mb = $tx / 1024;//mb
							//rx-bits-per-second=108185616
							//fp-rx-packets-per-second=0
							//fp-rx-bits-per-second=0
							//rx-drops-per-second=0
							//rx-errors-per-second=0
							//tx-packets-per-second=113278
							//tx-bits-per-second=1114053440
							//fp-tx-packets-per-second=0
							//fp-tx-bits-per-second=0
							//tx-drops-per-second=0
							//tx-queue-drops-per-second=53
							//tx-errors-per-second=0

							
							$datamonitor->rx = round($rx_mb, 2);
							$datamonitor->tx = round($tx_mb, 2);
						}
						
						$ARRAY3 = $api->comm('/interface/ethernet/monitor', array(
							'.id'=>$iface_id,
							'once'=>'',
						));
						for($j=0; $j<count($ARRAY3); $j++){
							if( $ARRAY3[$j]['status']!='no-link'){
								$datamonitor->rx_p = 0; if(array_key_exists("sfp-rx-power",$ARRAY3[$j])) $datamonitor->rx_p = $ARRAY3[$j]['sfp-rx-power'];
								$datamonitor->tx_p = 0; if(array_key_exists("sfp-tx-power",$ARRAY3[$j])) $datamonitor->tx_p =  $ARRAY3[$j]['sfp-tx-power'];
							}
						}

						$this->myModel->insert('t_monitor', $datamonitor);
					}
				}
			}
		}
		$api->disconnect();
	}
}
