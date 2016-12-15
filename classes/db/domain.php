<?php

class Item
{
public $item_id;
public $item_geom;
public $item_fid;
public $item_objectid;
public $item_lat;
public $item_lng;
public $item_baum_id;
public $item_datenfuehr;
public $item_bezirk;
public $item_objekt_str;
public $item_gebietsgru;
public $item_gattung_ar;
public $item_scientific;
public $item_ger_name;
public $item_eng_name;
public $item_pflanzjahr;
public $item_pflanzja_1;
public $item_stammumfan;
public $item_stammumf_1;
public $item_baumhoehe;
public $item_baumhoehe_;
public $item_kronendurc;
public $item_kronendu_1;
public $item_baumnummer;
public $item_se_anno_ca;
}

class Hunt
{
public $hunt_id;
public $hunt_pin;
public $hunt_area;
public $hunt_no_items;
public $hunt_itemstring;
public $hunt_date;
}
class User
{
public $user_id;
public $user_hunt_pin;
public $user_name;
public $user_progress;
public $user_done;
public $user_itemstring;
}



?>