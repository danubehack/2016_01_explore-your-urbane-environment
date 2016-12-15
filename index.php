<?php
session_start();
$_SESSION["token"]=md5((string)mt_rand(0,1000));

//error_reporting(E_ALL); 
//ini_set("display_errors", 1);

$page="home";

$page_path="home.php";


if(isset($_GET["page"]))
	{$page=strtolower($_GET["page"]); }

switch($page)
{
	case"home":
		$page_path="home.php";
		break;
	case"hunt":
		$page_path="hunt.php";
		break;	
	case"area":
		$page_path="area.php";
		break;	
	case"species":
		$page_path="species.php";
		break;		
	case"about":
		$page_path="about.php";
		break;			
	case"imprint":
		$page_path="imprint.php";
		break;							
	default:
		$page="404";
		$page_path="404.php"; break;
}


//GenerateTemplateData
$template=array();
$template["title"]="explore your urban environment &horbar; ($page)";
$template["desc"]="explore your urban environment!";
$template["motto"]="explore your urban environment!";
$template["copy"]="&copy; 2015 - Karin Wannemacher";
$template["project"]="Project in cooperation with<br />Austrian Federal Environment Agency<br />Danube Hack 2016";
$template["maplist_numb"]=8;
$template["content_path"]=$page_path; 
require_once(dirname(__FILE__) . '/tpl/index.php');
					

?>
