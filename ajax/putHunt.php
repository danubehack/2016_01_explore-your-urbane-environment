<?php
error_reporting(E_ALL); 
ini_set("display_errors", 1);

require_once (dirname(__DIR__) . '/classes/hunt/repository.php');

			$area = new huntMgmt();
			$success = $area -> putUserHunt($_POST["string"],$_POST["hunt_id"],$_POST["hunter"]);
			echo $success;
			exit;
?>