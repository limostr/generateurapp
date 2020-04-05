<?php

function Report_Autoload($c)
{
    //include "config/routes.php";
    $dirpathclass='/../blocapp/controllers/';
       echo $c."<br>";
    if(file_exists( $c . ".php")){
        require_once   $c . ".php";
    }elseif(file_exists( dirname(__FILE__)."/../blocapp/controllers/".$c. ".php")){
        require_once   dirname(__FILE__)."/../blocapp/controllers/".$c. ".php";
    }elseif(file_exists( dirname(__FILE__)."/../lib/mvc/".$c. ".php")){
        require_once   dirname(__FILE__)."/../lib/mvc/".$c. ".php";
    }elseif(file_exists( dirname(__FILE__)."/../blocapp/models/".$c. ".php")){
        require_once   dirname(__FILE__)."/../blocapp/models/".$c. ".php";
    }elseif(file_exists( dirname(__FILE__)."/../blocapp/forms/".$c. ".php")){
        require_once   dirname(__FILE__)."/../lib/forms/".$c. ".php";
    }
    else{
        throw new Exception("Erreur de chargement de la class : $c");
    }

}

function autoload_Controllers($c){
$basicpath=dirname(__FILE__);
    if(file_exists( $c . ".php")){
        require_once   $c . ".php";
    }
}

//spl_autoload_register("Report_Autoload");
spl_autoload_register("autoload_Controllers");