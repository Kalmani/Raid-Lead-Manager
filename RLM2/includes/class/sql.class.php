<?php
class sql{
	public function sql(){
		global $host;
		global $user;
		global $pass;
		global $db;
		
		$this->host = $host;
		$this->user = $user;
		$this->pass = $pass;
		$this->db = $db;
		$this->link = false;
		
		$this->connect();
		$this->select_db();
	}
	
	private function connect(){
		$this->link = mysql_connect($this->host, $this->user, $this->pass);
		return true;
	}
	
	private function select_db(){
		mysql_select_db($this->db, $this->link) or die (mysql_error());
		return true;
	}
	
	protected function request($r){
		return(mysql_query($r, $this->link));
	}
	
	protected function get_array($r){
		$return = array();
		$request = mysql_query($r, $this->link);
		while ($result = mysql_fetch_array($request)){
			$result_f = array();
			foreach ($result as $key=>$res)
				if ((int)$key !== $key)
					$result_f[$key] = $res;
			$return[] = $result_f;
		}
		return $return;
	}
	
	public function get_array_open($r){
		$return = array();
		$request = mysql_query($r, $this->link);
		while ($result = mysql_fetch_array($request)){
			$result_f = array();
			foreach ($result as $key=>$res)
				if ((int)$key !== $key)
					$result_f[$key] = $res;
			$return[] = $result_f;
		}
		return $return;
	}
}
?>