<?php
require_once (dirname(__DIR__) . '/classes/hunt/repository.php');

			$hunt = new huntMgmt();
			$success = $hunt -> makeHuntPin($_POST["pin"],$_POST["hunter"]);
			if(!$success){
				echo false;
			}
			else{
			print_r($success);
			}
			exit;		
?>