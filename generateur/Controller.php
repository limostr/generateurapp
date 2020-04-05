<?php
/**
 * Created by PhpStorm.
 * User: username
 * Date: 12/12/2018
 * Time: 13:39
 */

namespace generateur;
use generateur\Actions;
use generateur\Forms;

use configgen\TemplateMap;

class Controller extends MetaGenerateur
{
    public $name="";
    public $Ctrl="";
    public $model="";
    public $moduleName;
    public function __construct($_Controller,$_module,$_model,$_modulename,$Template="")
    {
        parent::__construct($Template);

       // echo "<pre>";print_r($_Controller);echo "</pre>";

        $this->name=$_Controller['name'];
        $this->Ctrl=$_Controller;
        $this->pathFile=$_module;
        $this->model=$_model;
        $this->moduleName=$_modulename;
        $this->Actions();
    }
    //generation de validator coté clas forms

    public function forms(){

    }

    public function views($view){

    }

    public function Actions(){
        $Actions=new Actions();
        echo "<pre>";print_r($this->Ctrl);echo "</pre>";

        if(file_exists(TemplateMap::$map['global']['route'])){
            $RoutesTemplate=file_get_contents(TemplateMap::$map['global']['route']);

        }else{
            throw new \Exception("Erreur de Fichier Route Template Edit : ".TemplateMap::$map['global']['route']);
        }


        foreach ($this->Ctrl['actions'] as $nameCtrl => $_Ctrl){
            $routes=$RoutesTemplate;
            $routes=str_ireplace("{module}",$this->moduleName,$routes);
            $routes=str_ireplace("{Controller}",$this->name,$routes);
            $routes=str_ireplace("{Action}",$nameCtrl,$routes);
            $routes=str_ireplace("{activity}",$nameCtrl,$routes);

            \generateur::$Routes[]=$routes;
            $Table=array();
            if(isset($_Ctrl['model']['table'])){
                $Table=$this->model[$_Ctrl['model']['table']];
            }
            switch ($_Ctrl['Role']){
                case "edit":

                    $withform=isset($_Ctrl['form']) ? $_Ctrl['form'] : false;
                    $withView=isset($_Ctrl['view']['view']) ? $_Ctrl['view']['view'] : false;
                   //generation de formulaire
                    if($withform){
                        $this->code["uses"][]="use blocapp\\modules\\".$this->moduleName."\\Forms\\$withform;";
                        $Forms= new Forms($_Ctrl['model']['table'],$this->moduleName);
                        $Forms->pathFile=$this->pathFile."/Forms";
                        $Forms->generate($Table);
                    }
                    ///génération de vue
                    if($withView){
                        $Views= new Views('edit'.$_Ctrl['model']['table'],$this->Ctrl['name'],$this->moduleName,'Edit'.$_Ctrl['model']['table'].'_Titre',$_Ctrl['view']);
                        $Views->pathFile=$this->pathFile."/Views/".$this->Ctrl['name'];
                        $Views->TableName=$_Ctrl['model']['table'];
                        $Views->editView();
                        $Views->saveView();
                    }
                    $this->code['actions'][]=$Actions->Edit($Table,$withform);

                    break;
                case "save":
                    $this->code['actions'][]=$Actions->Save($Table);
                    break;
                case "delete":
                    $this->code['actions'][]=$Actions->Delete($Table);
                    break;
                case "lister":
                    $this->code['actions'][]=$Actions->Lister($Table);
                    $withView=isset($_Ctrl['view']['view']) ? $_Ctrl['view']['view'] : false;
                    if($withView){
                        $Views= new Views('lister'.$_Ctrl['model']['table'],$this->Ctrl['name'],$this->moduleName,'Liste'.$_Ctrl['model']['table'].'_Titre',$_Ctrl['view']);
                        $Views->pathFile=$this->pathFile."/Views/".$this->Ctrl['name'];
                        $Views->TableName=$_Ctrl['model']['table'];
                        $Views->listerView();
                        $Views->saveView();
                    }
                    break;
                  case "consulter":
                        $this->code['actions'][]=$Actions->consulter($Table);
                        $withView=isset($_Ctrl['view']['view']) ? $_Ctrl['view']['view'] : false;
                        if($withView){
                            $Views= new Views('consulter'.$_Ctrl['model']['table'],$this->Ctrl['name'],$this->moduleName,'Consulter'.$_Ctrl['model']['table'].'_Titre',$_Ctrl['view']);
                            $Views->pathFile=$this->pathFile."/Views/".$this->Ctrl['name'];
                            $Views->TableName=$_Ctrl['model']['table'];
                            $Views->consulterView();
                            $Views->saveView();
                        }
                        break;
                case "gestion":
                    $this->code['actions'][]=$Actions->Gestion($Table);
                      $withView=isset($_Ctrl['view']['view']) ? $_Ctrl['view']['view'] : false;
                    if($withView){

                        $Views= new Views('gestion'.$_Ctrl['model']['table'],$this->Ctrl['name'],$this->moduleName,'gestion'.$_Ctrl['model']['table'].'_Titre',$_Ctrl['view']);
                        $Views->pathFile=$this->pathFile."/Views/".$this->Ctrl['name'];
                        $Views->TableName=$_Ctrl['model']['table'];
                        $Views->gestionView();
                        $Views->saveView();
                    }
                    break;
            }
        }


    }
    public function saveController(){
        if(file_exists(TemplateMap::$map['Controller']['Controller'])){
            $ClassTemp=file_get_contents(TemplateMap::$map['Controller']['Controller']);
            $ClassTemp=str_ireplace("{titre}",$this->titre,$ClassTemp);
            $ClassTemp=str_ireplace("{CONTROLE_NAME}",$this->name,$ClassTemp);
            $ClassTemp=str_ireplace("{module}",$this->moduleName,$ClassTemp);

            $actions=$uses="";
            if(!empty($this->code['actions'])){
                $actions=implode("\n",$this->code['actions']);
            }
            if(!empty($this->code['uses'])){
                $uses=implode("\n",$this->code['uses']);
            }

            $ClassTemp=str_ireplace("{use_forms}",$uses,$ClassTemp);
            $ClassTemp=str_ireplace("{actions}",$actions,$ClassTemp);
            $file=$this->pathFile."/Controllers/".$this->name.".php";
            if(file_put_contents($file,$ClassTemp)){
                echo "$file<br>";
            }else{
                throw new \Exception("Erreur d'enregistrement de fichier : ".$file);

            }
        }else{
            throw new \Exception("Erreur de Fichier d'action Template Edit : ".TemplateMap::$map['Controller']['Controller']);
        }
    }
}
