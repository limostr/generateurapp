<?php
use generateur\Controller;

 
use configgen\TemplateMap;

use generateur\Langues;


define('MYSQL_SERVER', 'localhost:3308');
define('MYSQL_DATABASE_NAME', 'compeleve');
define('MYSQL_USERNAME', 'root');
define('MYSQL_PASSWORD', '');


class generateur {


    public $DBTable;
    public $pdo;

    public static $Lang;
    public static $Routes;
	public function __construct()
    {
       $this->pdo = new PDO(
			'mysql:host=' . MYSQL_SERVER . ';dbname=' . MYSQL_DATABASE_NAME,
			MYSQL_USERNAME,
			MYSQL_PASSWORD
		);
       $this->descDB();
    }

    public function descDB(){

        try {
            $tableList = array();
            $result = $this->pdo->query("SHOW TABLES");

            while ($row = $result->fetch(PDO::FETCH_NUM)) {
                $tableList[] = $row[0];


                $statement = $this->pdo->prepare('DESCRIBE ' . $row[0]);
                $statement->execute();
                //Fetch our result.
                $result2 = $statement->fetchAll(PDO::FETCH_ASSOC);

                $Tables[$row[0]]['fields']=$result2;
                $Tables[$row[0]]['Table']=$row[0];
                foreach ($result2 as $field){
                    if($field['Key']=='PRI'){
                        $Tables[$row[0]]['ids'][]= $field;
                    }

                }
                $sql="
            			SELECT
            				concat(table_name, '.', column_name) as 'foreign key',
            				concat(referenced_table_name, '.', referenced_column_name) as 'references',
            				referenced_table_name
            			FROM
            				information_schema.key_column_usage
            			WHERE
            				referenced_table_name is not null
            				AND
            				table_schema='".MYSQL_DATABASE_NAME."'
            				AND
            				table_name='".$row[0]."'

            		";
                $statement = $this->pdo->prepare($sql);
                $statement->execute();
                //Fetch our result.
                $result3 = $statement->fetchAll(PDO::FETCH_ASSOC);
                $Tables[$row[0]]['Links']=$result3;

            }

         }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
        $this->DBTable=$Tables;
        echo "<pre>";print_r($Tables);  echo "</pre>";
    }
    public function Select($Table,$Id){
	    $Sql="SELECT * FROM $Table  ";


    }

    public function Controllers($Controllers,$path,$modulename){

	    foreach ($Controllers as $controller){
            //echo "<pre>";print_r($Controllers);echo "</pre>";
            $ControllerGen=new Controller($controller,$path,$this->DBTable,$modulename);

            $ControllerGen->saveController();
        }

    }

    public function Modules(){
        include dirname(__FILE__)."/configgen/TemplateMap.php";
        include dirname(__FILE__)."/configgen/module.php";

        $path_app=dirname(__FILE__)."/tmp/".$_APP_CONF["APPNAME"];

        if (!file_exists($path_app)) {
            mkdir($path_app, 0777);
            echo "The directory $path_app was successfully created.<br>";

        } else {
            echo "The directory $path_app exists.<br>";
        }
        $config=dirname(__FILE__)."/tmp/".$_APP_CONF["APPNAME"]."/config";
        if (!file_exists($config)) {
            mkdir( $config, 0777);
            echo "The directory $config was successfully created.<br>";

        } else {
            echo "The directory $config exists.<br>";
        }

        $path_modules=$path_app."/modules";
        if (!file_exists( $path_modules)) {
            mkdir( $path_modules, 0777);
        }

        foreach ($_Config["modules"] as $key => $conf){
            //Module
            $new_module=$path_modules."/".$conf['name'];
            //Controller
            $new_Controllers =$new_module."/Controllers";
            $new_Forms=$new_module."/Forms";
            $new_Validators=$new_module."/Validators";
            $new_Views=$new_module."/Views";
            $new_Langue=$new_module."/Lang";
            if (!file_exists( $new_module)) {
                mkdir( $new_module, 0777);
                mkdir( $new_Controllers, 0777);
                mkdir( $new_Forms, 0777);
                mkdir( $new_Validators, 0777);
                mkdir( $new_Views, 0777);
                mkdir( $new_Langue, 0777);

                echo "The directory <b style='color: green;'>$new_module</b> was successfully created.<br>";
                echo "The directory <b style='color: green;'>$new_Controllers</b> was successfully created.<br>";
                echo "The directory <b style='color: green;'>$new_Forms</b> was successfully created.<br>";
                echo "The directory <b style='color: green;'>$new_Validators</b> was successfully created.<br>";
                echo "The directory <b style='color: green;'>$new_Views</b> was successfully created.<br>";
                echo "The directory <b style='color: green;'>$new_Langue</b> was successfully created.<br>";

            } else {
                echo "The directory  <b style='color: orangered;'>$new_module</b> exists.";
            }


            foreach ($conf["Controller"] as $keyController => $Controller){
                $new_Controller=$new_Views."/".$Controller['name'];
                if (!file_exists($new_Controller)) {
                    mkdir($new_Controller, 0777);
                    echo "The directory <b style='color: green;'>$new_Controller</b> was successfully created.<br>";

                }

            }
            $this->Controllers($conf["Controller"],$new_module,$conf['name']);



        }
        Langues::saveLang($new_Langue);
        $this->Routes($config);


    }

    public function Forms(){
        $Forms= new \generateur\Forms("soutenance");
        $Forms->pathFile="../../lib/generateurapp/tmp/gestcomp/modules/referentiel/Forms";

        $Forms->generate($this->DBTable['soutenance']);



    }

    public function Models(){

    }

    public function Routes($Path){


        if(file_exists(TemplateMap::$map['global']['routes'])){
            $file=$Path."/routes.php";
            $routes=implode(",\n",self::$Routes);

            $ActionTemplate=file_get_contents(TemplateMap::$map['global']['routes']);
            $strElt=$ActionTemplate;
            $strElt=str_ireplace("{Routes}",$routes,$strElt);

            if(file_put_contents($file,$strElt)){
                echo "$file<br>";
            }else{
                throw new \Exception("Erreur d'enregistrement de fichier : ".$file);

            }

        }else{
            throw new \Exception("Erreur de Fichier d'action Template Edit : ".TemplateMap::$map['global']['routes']);
        }
    }


}
