<?php
error_reporting(E_ALL); 
ini_set("display_errors", 1);
require_once(dirname(__FILE__) . '/db.php');
require_once(dirname(__FILE__) . '/domain.php');


class huntRepository
{

private $database;

function __construct()
{
	$this->database = new DB();
	$this->database->connect();
}


public function getItemsRadius($radius,$lat,$lng){
		$radius = $radius*1000;
		$statement = $this->database->prepare("SELECT * from public.baumkataster_targets WHERE ST_Intersects(ST_Buffer(ST_Transform(ST_SetSRID(ST_Point($lng,$lat),4326),900913),:radius),ST_Transform(geom,900913)) = true ORDER BY baumhoehe_ ASC LIMIT 30");
		$statement->bindValue(":radius", $radius);
		
		$statement->execute();
		
		$array = array();
		
		while ($result= $statement->fetch(PDO::FETCH_ASSOC)) {

		$item = new Item();
		$item->item_id = $result["gid"];
		$item->item_fid = $result["fid"];
		$item->item_objectid = $result["objectid"];
		$item->item_lat = $result["lat"];
		$item->item_lng = $result["lng"];
		$item->item_baum_id = $result["baum_id"];
		$item->item_datenfuehr = $result["datenfuehr"];
		$item->item_bezirk = $result["bezirk"];
		$item->item_objekt_str = $result["objekt_str"];
		$item->item_gebietsgru = $result["gebietsgru"];
		$item->item_gattung_ar = $result["gattung_ar"];
		$item->item_scientific = $result["scientific"];
		$item->item_ger_name = $result["ger_name"];
		$item->item_eng_name = $result["eng_name"];
		$item->item_pflanzjahr = $result["pflanzjahr"];
		$item->item_pflanzja_1 = $result["pflanzja_1"];
		$item->item_stammumfan = $result["stammumfan"];
		$item->item_stammumf_1 = $result["stammumf_1"];
		$item->item_baumhoehe = $result["baumhoehe"];
		$item->item_baumhoehe_ = $result["baumhoehe_"];
		$item->item_kronendurc = $result["kronendurc"];
		$item->item_kronendu_1 = $result["kronendu_1"];
		$item->item_baumnummer = $result["baumnummer"];
		$item->item_se_anno_ca = $result["se_anno_ca"];

		array_push($array, $item);
		
		}

		return $array;


}


public function getItemsRadiusSpecies($lat,$lng,$species){
		$statement = $this->database->prepare("SELECT * from public.baumkataster_targets WHERE ST_Intersects(ST_Buffer(ST_Transform(ST_SetSRID(ST_Point($lng,$lat),4326),900913),5000),ST_Transform(geom,900913)) = true  AND scientific = :species ORDER BY id ASC LIMIT 50");
		$statement->bindValue(":species", $species);
		
		$statement->execute();
		
		$array = array();
		
		while ($result= $statement->fetch(PDO::FETCH_ASSOC)) {

		$item = new Item();
		$item->item_id = $result["gid"];
		$item->item_fid = $result["fid"];
		$item->item_objectid = $result["objectid"];
		$item->item_lat = $result["lat"];
		$item->item_lng = $result["lng"];
		$item->item_baum_id = $result["baum_id"];
		$item->item_datenfuehr = $result["datenfuehr"];
		$item->item_bezirk = $result["bezirk"];
		$item->item_objekt_str = $result["objekt_str"];
		$item->item_gebietsgru = $result["gebietsgru"];
		$item->item_gattung_ar = $result["gattung_ar"];
		$item->item_scientific = $result["scientific"];
		$item->item_ger_name = $result["ger_name"];
		$item->item_eng_name = $result["eng_name"];
		$item->item_pflanzjahr = $result["pflanzjahr"];
		$item->item_pflanzja_1 = $result["pflanzja_1"];
		$item->item_stammumfan = $result["stammumfan"];
		$item->item_stammumf_1 = $result["stammumf_1"];
		$item->item_baumhoehe = $result["baumhoehe"];
		$item->item_baumhoehe_ = $result["baumhoehe_"];
		$item->item_kronendurc = $result["kronendurc"];
		$item->item_kronendu_1 = $result["kronendu_1"];
		$item->item_baumnummer = $result["baumnummer"];
		$item->item_se_anno_ca = $result["se_anno_ca"];

		array_push($array, $item);	
		}
		return $array;
}


public function getItemsRadiusUser($lat,$lng){
		$statement = $this->database->prepare("SELECT * from public.baumkataster_targets WHERE ST_Intersects(ST_Buffer(ST_Transform(ST_SetSRID(ST_Point($lng,$lat),4326),900913),300),ST_Transform(geom,900913)) = true ORDER BY id ASC LIMIT 50");
		
		$statement->execute();
		
		$array = array();
		
		while ($result= $statement->fetch(PDO::FETCH_ASSOC)) {

		$item = new Item();
		$item->item_id = $result["gid"];
		$item->item_fid = $result["fid"];
		$item->item_objectid = $result["objectid"];
		$item->item_lat = $result["lat"];
		$item->item_lng = $result["lng"];
		$item->item_baum_id = $result["baum_id"];
		$item->item_datenfuehr = $result["datenfuehr"];
		$item->item_bezirk = $result["bezirk"];
		$item->item_objekt_str = $result["objekt_str"];
		$item->item_gebietsgru = $result["gebietsgru"];
		$item->item_gattung_ar = $result["gattung_ar"];
		$item->item_scientific = $result["scientific"];
		$item->item_ger_name = $result["ger_name"];
		$item->item_eng_name = $result["eng_name"];
		$item->item_pflanzjahr = $result["pflanzjahr"];
		$item->item_pflanzja_1 = $result["pflanzja_1"];
		$item->item_stammumfan = $result["stammumfan"];
		$item->item_stammumf_1 = $result["stammumf_1"];
		$item->item_baumhoehe = $result["baumhoehe"];
		$item->item_baumhoehe_ = $result["baumhoehe_"];
		$item->item_kronendurc = $result["kronendurc"];
		$item->item_kronendu_1 = $result["kronendu_1"];
		$item->item_baumnummer = $result["baumnummer"];
		$item->item_se_anno_ca = $result["se_anno_ca"];

		array_push($array, $item);	
		}
		return $array;
}


public function getAllSpecies(){
		$statement = $this->database->prepare("SELECT scientific, ger_name, eng_name from public.baumkataster_targets GROUP BY  scientific, ger_name, eng_name ORDER BY scientific ASC");
		
		$statement->execute();
		
		$array = array();
		
		while ($result= $statement->fetch(PDO::FETCH_ASSOC)) {

		$item = new Item();
		$item->item_scientific = $result["scientific"];
		$item->item_ger_name = $result["ger_name"];
		$item->item_eng_name = $result["eng_name"];

		array_push($array, $item);
		
		}

		return $array;


}


public function makeHunt($hunt_itemstring,$hunt_area,$hunt_no_items){
	
	$statement = $this->database->prepare("INSERT INTO public.baumkataster_hunt  (
												hunt_area ,
												hunt_no_items ,
												hunt_itemstring												
												)
												VALUES (
												:hunt_area, :hunt_no_items, :hunt_itemstring
												);");
		$statement->bindValue(":hunt_itemstring", $hunt_itemstring);
		$statement->bindValue(":hunt_area", $hunt_area);
		$statement->bindValue(":hunt_no_items", $hunt_no_items);

		$statement->execute();
		
		$statement = $this->database->prepare("SELECT * from public.baumkataster_hunt WHERE hunt_area = :hunt_area ORDER BY hunt_id DESC LIMIT 1");
		$statement->bindValue(":hunt_area", $hunt_area);
		
		$statement->execute();
		$result= $statement->fetch();
		
		$hunt = new Hunt();
		$hunt->hunt_itemstring = $result["hunt_itemstring"];
		$hunt->hunt_pin = $result["hunt_pin"];
		
		return $hunt;

}


public function getHuntStringFromPin($hunt_pin){
			
		$statement = $this->database->prepare("SELECT * from public.baumkataster_hunt WHERE hunt_pin = :hunt_pin ORDER BY hunt_id DESC LIMIT 1");
		$statement->bindValue(":hunt_pin", $hunt_pin);
		
		$statement->execute();
		$result= $statement->fetch();
		
		$hunt = new Hunt();
		$hunt->hunt_itemstring = $result["hunt_itemstring"];
		$hunt->hunt_pin = $result["hunt_pin"];
		
		return $hunt;

}


public function addUserHunt($user_itemstring, $user_hunt_pin,$user_name){
				
		$statement = $this->database->prepare("INSERT INTO public.baumkataster_user  (
												user_hunt_pin ,
												user_name	,
												user_progress ,
												user_done	 ,
												user_itemstring										
												)
												VALUES (
												:user_hunt_pin, :user_name, :user_progress, :user_done, :user_itemstring
												);");
		$statement->bindValue(":user_hunt_pin", $user_hunt_pin);
		$statement->bindValue(":user_name", $user_name);
		$statement->bindValue(":user_progress", "0");
		$statement->bindValue(":user_done", 0);
		$statement->bindValue(":user_itemstring", $user_itemstring);
		
		$statement->execute();

}

public function updateUserHunt($user_itemstring, $user_hunt_pin,$user_name){
		$statement = $this->database->prepare("UPDATE public.baumkataster_user SET user_itemstring = :user_itemstring WHERE user_hunt_pin = :user_hunt_pin AND user_name = :user_name");
		$statement->bindValue(":user_itemstring", $user_itemstring);
		$statement->bindValue(":user_hunt_pin", $user_hunt_pin);
		$statement->bindValue(":user_name", $user_name);
		$statement->execute();

}


public function readRegister($user_hunt_pin,$user_name){
		$statement = $this->database->prepare("SELECT user_name from public.baumkataster_user WHERE user_hunt_pin = :user_hunt_pin AND user_name = :user_name");
		$statement->bindValue(":user_hunt_pin", $user_hunt_pin);
		$statement->bindValue(":user_name", $user_name);

		$statement->execute();		
		$count=$statement->rowCount();
		return $count;
}


public function getHuntUserData($user_hunt_pin,$user_name){
		$statement = $this->database->prepare("SELECT * from public.baumkataster_user WHERE user_hunt_pin = :user_hunt_pin AND user_name = :user_name");
		$statement->bindValue(":user_hunt_pin", $user_hunt_pin);
		$statement->bindValue(":user_name", $user_name);

		$statement->execute();
		$result= $statement->fetch();
	
		$hunt = new Hunt();
		$hunt->hunt_itemstring = $result["user_itemstring"];
		$hunt->hunt_pin = $result["user_hunt_pin"];
		$hunt->user_name = $result["user_name"];
		$hunt->user_done = $result["user_done"];

		return $hunt;

}

public function updateUserHuntDone($user_hunt_pin,$user_name, $user_done){
		$statement = $this->database->prepare("UPDATE public.baumkataster_user SET user_done = :user_done WHERE user_hunt_pin = :user_hunt_pin AND user_name = :user_name");
		$statement->bindValue(":user_done", $user_done);
		$statement->bindValue(":user_hunt_pin", $user_hunt_pin);
		$statement->bindValue(":user_name", $user_name);
		$statement->execute();

}


}


?>