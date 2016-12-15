<?php

error_reporting(E_ALL); 
ini_set("display_errors", 1);
require_once (dirname(__DIR__) . '/db/hunt_repository.php');

class huntMgmt {
	

public function makeHunt($radius,$lat,$lng,$user,$number) {

		$repository = new huntRepository();
		$items = $repository->getItemsRadius($radius,$lat,$lng);	

		$array = array();
		while (count($array)<$number) {
			$random = rand(0,count($items)-1);
			array_push($array, $items[$random]);	
			array_splice($items, $random, 1);
		}
		
		$geojson = array(
		   'type'      => 'FeatureCollection',
		   'features'  => array()
		);
		
		foreach ($array as &$item) {
			$feature = array(
				'id' => $item->item_id,
				'type' => 'Feature', 
				'geometry' => array(
					'type' => 'Point',
					'coordinates' => array($item->item_lng, $item->item_lat)
				),
				'properties' => array(
					'item_id' => $item->item_baum_id,
					'strasse' => $item->item_objekt_str,
					'bezirk' => $item->item_bezirk,
					'name' => $item->item_ger_name,
					'scientific' => $item->item_scientific,
					'jahr' => $item->item_pflanzja_1,
					'umfang' => $item->item_stammumf_1,
					'height' => $item->item_baumhoehe_,
					'area' => $item->item_gebietsgru,
					'done' => false
					)
				);
			array_push($geojson['features'], $feature);
		}		
		$huntstring = json_encode($geojson, JSON_NUMERIC_CHECK);

		$hunt = $repository->makeHunt($huntstring,$radius,$number);
		if($repository->readRegister($hunt->hunt_pin,$user) < 1 ) {
			$repository->addUserHunt($huntstring, $hunt->hunt_pin,$user);
			$userhunt = $this->getHuntUserData($hunt->hunt_pin,$user);
			return json_encode($userhunt, JSON_NUMERIC_CHECK);
			exit;
		}
		else{
			return "Username already taken for this hunt-ID";
			exit;
		}
		exit;
}

public function makeHuntPin($user_hunt_pin,$user_name) {

		$repository = new huntRepository();
		if($repository->readRegister($user_hunt_pin,$user_name)<1){
			
			$hunt = $repository->getHuntStringFromPin($user_hunt_pin);
			$repository->addUserHunt($hunt->hunt_itemstring, $hunt->hunt_pin,$user_name);
			$userhunt = $this->getHuntUserData($hunt->hunt_pin,$user_name);
			return json_encode($userhunt, JSON_NUMERIC_CHECK);
			exit;

		}
		else{
			return false;
		exit;}
}

public function putUserHunt($user_itemstring,$user_hunt_pin,$user_name) {

		$repository = new huntRepository();
		$repository->updateUserHunt($user_itemstring, $user_hunt_pin,$user_name);	
		return true;

}

public function getHuntUserData($user_hunt_pin,$user_name) {

		$repository = new huntRepository();
		$result = $repository->getHuntUserData($user_hunt_pin,$user_name);

		return $result;
}


public function getSpecies($lat,$lng,$species) {

		$repository = new huntRepository();
		$array = $repository->getItemsRadiusSpecies($lat,$lng,$species);
		
		$geojson = array(
		   'type'      => 'FeatureCollection',
		   'totalFeatures' => count($array),
		   'features'  => array()
		);
		foreach ($array as &$item) {
			$feature = array(
				'id' => $item->item_id,
				'type' => 'Feature', 
				'geometry' => array(
					'type' => 'Point',
					'coordinates' => array($item->item_lng, $item->item_lat)
				),
				'properties' => array(
					'item_id' => $item->item_baum_id,
					'strasse' => $item->item_objekt_str,
					'bezirk' => $item->item_bezirk,
					'name' => $item->item_ger_name,
					'scientific' => $item->item_scientific,
					'jahr' => $item->item_pflanzja_1,
					'umfang' => $item->item_stammumf_1,
					'height' => $item->item_baumhoehe_,
					'area' => $item->item_gebietsgru
					)
				);
			array_push($geojson['features'], $feature);
		}		
		$result = json_encode($geojson, JSON_NUMERIC_CHECK);

		return $result;
}


public function getArea($lat,$lng) {

		$repository = new huntRepository();
		$array = $repository->getItemsRadiusUser($lat,$lng);
		
		$geojson = array(
		   'type'      => 'FeatureCollection',
			'totalFeatures' => count($array),
		   'features'  => array()
		);
		foreach ($array as &$item) {
			$feature = array(
				'id' => $item->item_id,
				'type' => 'Feature', 
				'geometry' => array(
					'type' => 'Point',
					'coordinates' => array($item->item_lng, $item->item_lat)
				),
				'properties' => array(
					'item_id' => $item->item_baum_id,
					'strasse' => $item->item_objekt_str,
					'bezirk' => $item->item_bezirk,
					'name' => $item->item_ger_name,
					'scientific' => $item->item_scientific,
					'jahr' => $item->item_pflanzja_1,
					'umfang' => $item->item_stammumf_1,
					'height' => $item->item_baumhoehe_,
					'area' => $item->item_gebietsgru
					)
				);
			array_push($geojson['features'], $feature);
		}		
		$result = json_encode($geojson, JSON_NUMERIC_CHECK);

		return $result;
}

public function getUserData($user_hunt_pin,$user_name) {

		$repository = new huntRepository();
		$repository->updateUserHuntDone($user_hunt_pin,$user_name, true);
		$result = $this->getHuntUserData($user_hunt_pin,$user_name);

		return $result;
}

public function getAllSpecies() {

		$repository = new huntRepository();
		$result = $repository->getAllSpecies();
		return $result;
}



}
?>