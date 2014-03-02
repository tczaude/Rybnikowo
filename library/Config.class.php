<?php

/**
 * basic configuration for website
 *
 */
 
class Config {
	
	/**
	 * @var object DBManager
	 */
	var $DBM;

	function Config() {
		global $DBM;
	 	$this->DBM = $DBM;
	}

	/**
	 * get all config parameters 
	 */
	
	function getConfigTable ($base_path, $base_url) {
		
		$sql = "select * from config_table";
		$config_temp = $this->DBM->getTable($sql);
		$config_table = array();
		
		if (sizeof($config_temp)) {
			foreach ($config_temp as $parameter) {
				
				// select prefix
				if ($parameter['prefix'] == 1) $prefix = "$base_path";
				elseif ($parameter['prefix'] == 2) $prefix = "$base_url";
				else $prefix = "";
				
				$config_table[$parameter[name]] = $prefix.$parameter['content']; 
			}
		}
		
		return $config_table;
	}
	
	/**
	 * get changeable parameters
	 */
	
	function getParametersForChange () {
		
		$sql = "select * from config_table where changeable = 1";
		$config_table = $this->DBM->getTable($sql);
		
		return $config_table;
	}
	
	/**
	 * save changeable parameters
	 */
	
	function saveChangeableParameters ($config_form) {
		if (sizeof($config_form)) {
			foreach ($config_form as $name => $content) {
				$sql = "update config_table set content = '$content' where name = '$name'";
				$this->DBM->modifyTable($sql);
			}
		}
	}
	
	/**
	 * single import from config file (without descriptions and change option)
	 */
	
	function importParametersFromConfigFile () {
		
		global $__CFG;
		
		if (sizeof($__CFG)) {
			
			// first delete old parameters
			$sql = "delete from config_table";
			$this->DBM->modifyTable($sql);
			
			foreach ($__CFG as $name => $content) {
				$sql = "insert into config_table (name, content) values ('$name', '$content')";
				$this->DBM->modifyTable($sql);
			}
		}
	}
}
?>