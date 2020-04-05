<?php
include "../autoload.php";

//include dirname(__FILE__) . "/../mvc/Configuration.php";
//include_once dirname(__FILE__) . "/../dbadapter.php";





//include dirname(__FILE__) . "/generateur.php";




//$_Config_Generateur=array("AppName"=>"AppName","Path"=>dirname(__FILE__)."/tmp/");

//Configuration::config();

//dbadapter::connect();

$NewGen=new generateur();

//$NewGen->descDB();
$NewGen->Modules();
