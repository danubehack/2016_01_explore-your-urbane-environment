<?php
error_reporting(E_ALL); 

ini_set("display_errors", 1);

require_once (dirname(__DIR__) . '/classes/hunt/repository.php');

			$hunt = new huntMgmt();
			$success = $hunt -> makeHunt($_POST["radius"],$_POST["lat"],$_POST["lng"],$_POST["hunter"],$_POST["no_items"]);
			print_r($success);
			exit;		
?>