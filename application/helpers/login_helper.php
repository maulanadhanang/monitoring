<?php

function user_logged_in() {
	$CI =& get_instance();
    $user = $CI->session->userdata('user_data');
	if (!isset($user)) { 
		return false; 
	}else{ 
		return $user;
	}
}

function is_allow_access($menu) {
	$user = user_logged_in();
	if (!isset($user)) { 
		return false; 
	}else{
		$return = false;

		if($user['user_level']=="NOC"){
			$return = true;
		}else{
			for($i=0; $i<count(menus($user['user_level'])); $i++){
				if(menus($user['user_level'])[$i]==$menu){
					$return = true;
				}
			}
		}

		return $return;
	}
}

function menus($level){
	$menus = array();

	if($level=="ADMIN"){
		$menus[] = "device/iface";
    $menus[] = "device/monitor";
	}
	return $menus;	
}

function alldevice() {
	$CI =& get_instance();

	return $CI->myModel->getAllQuery("SELECT * FROM t_device");;
}
