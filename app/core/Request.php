<?php

namespace app\core;

class Request {

    public $post;
    public $get;
	private static $instance = NULL;
	
    private  function __construct(){
		  foreach ($_POST as $key => $value) {
			$this->post[$key] = $this->clear_data($value);
		  }
		  foreach ($_GET as $key => $value) {
			$this->get[$key] = $this->clear_data($value);
		  }
    }
	private function __clone () {}
	public static function getInstance() {
		if (self::$instance == NULL) {
			self::$instance = new Request;
		}
		return self::$instance;
	}
	private function clear_data($data) {
		if (is_array($data)){
			$res = array();
			foreach($data as $key=>$value) {
				$key = addslashes(trim(strip_tags($key)));
				$value = addslashes(trim(strip_tags($value)));
				$res[$key] = $value;
			}
			return  $res;
		}
		return addslashes(trim(strip_tags($data)));
	}

	public function post($name) {
      if (isset($this->post[$name])) {
			  return $this->post[$name];
      }
      return null;
	}
    public function get($name) {
      if (isset($this->get[$name])){
			  return $this->get[$name];
      }
      return null;
	}
}
?>
