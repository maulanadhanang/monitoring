<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent::__construct();		
		$this->load->model('myModel');
		if(!user_logged_in()){
        	redirect('login');
        }

        $this->user_access();
	}

	function user_access(){
		if(!is_allow_access($this->uri->segment('2'))){
        	redirect('denied');
        }else{
        	return true;
        }
	}

	function index()
	{
		$users = $this->myModel->getAllQuery("SELECT * FROM t_user");

		$data = array(
			'view'  => 'user',
			'data' => $users
		);

		$this->load->view('lte/main', $data);
	}

	function create()
	{
		$user = new stdClass();
		$pesan = "";

		if(isset($_POST['nama'])){
			$user->nama = $this->input->post('nama');
			$user->username = $this->input->post('username');
			$user->password = $this->input->post('password');
			$user->level = $this->input->post('level');

			if($user->nama=="") $pesan = "Masukkan nama";
			else if($user->username=="") $pesan = "Masukkan username";
			else if($user->password=="") $pesan = "Masukkan password";
			else{

				$user->password = md5($this->config->config["PRE_PASS"].$user->password.$this->config->config["POST_PASS"]);

				$id = $this->myModel->insert('t_user', $user);
				if($id!=null){
					redirect('user/view/'.$id);
				}else{
					$pesan = "Gagal simpan data";
				}
			}
		}

		$data = array(
			'view' => 'user_form',
			'data' => array(
					'user' => $user,
					'pesan' => $pesan
				)
		);

		$this->load->view('lte/main', $data);
	}

	function update($id=null)
	{
		$user = $this->myModel->getOne('t_user', array('id'=>$id));
		if($user==null){
			redirect('user');
		}
		$pesan = "";

		if(isset($_POST['nama'])){
			$user->nama = $this->input->post('nama');
			$user->username = $this->input->post('username');
			$user->level = $this->input->post('level');

			if($user->password!=$this->input->post('password')){
				$user->password = md5($this->config->config["PRE_PASS"].$this->input->post('password').$this->config->config["POST_PASS"]);
			}

			if($user->nama=="") $pesan = "Masukkan nama";
			else if($user->username=="") $pesan = "Masukkan username";
			else if($user->password=="") $pesan = "Masukkan password";
			else{
				if($this->myModel->update('t_user', $user, "id", $id)){
					redirect('user/view/'.$id);
				}else{
					$pesan = "Gagal simpan data";
				}
			}
		}

		$data = array(
			'view' => 'user_form',
			'data' => array(
					'user' => $user,
					'pesan' => $pesan
				)
		);

		$this->load->view('lte/main', $data);
	}

	function view($id=null)
	{
		$user = $this->myModel->getOneQuery("SELECT * FROM t_user WHERE id='$id'");
		if($user==null){
			redirect('user');
		}

		$data = array(
			'view' => 'user_view',
			'data' => $user
		);

		$this->load->view('lte/main', $data);
	}

	function delete($id=null){
		if($id!=null){
			$this->myModel->delete("t_user", "id", $id);
		}
		redirect('user');
	}
}
