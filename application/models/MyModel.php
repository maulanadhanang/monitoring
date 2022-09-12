<?php

class MyModel extends CI_Model{

	function getAll($table){
		return $this->db->get($table)->result();
	}

	function getAllWhere($table, $where){
		foreach($where as $key=>$value){
			$this->db->where($key, $value);
		}
		return $this->db->get($table)->result();
	}

	function getAllQuery($query){
		return $this->db->query($query)->result();
	}

	function getOne($table, $where){
		foreach($where as $key=>$value){
			$this->db->where($key, $value);
		}
		$query = $this->db->get($table);
        if($query->num_rows()==0){
            return FALSE;
        }else{
            return $query->row();
        }
	}

	function getOneQuery($query){
		$query = $this->db->query($query);
        if($query->num_rows()==0){
            return FALSE;
        }else{
            return $query->row();
        }
	}
 
	function insert($table, $data){
		if($this->db->insert($table, $data)){
			return $this->db->insert_id();
		}else{
			return null;
		}
	}
 
	function update($table, $data, $key_id, $value_id){
		$this->db->where($key_id, $value_id);
		return $this->db->update($table, $data);
	}
 
	function delete($table, $key_id, $value_id){
		$this->db->where($key_id, $value_id);
		return $this->db->delete($table);
	}
	
	function getCount($query){
		$query = $this->db->query($query);

		return $query->num_rows();
	}

	function execute($query){
		return $this->db->simple_query($query);
	}
	
}
