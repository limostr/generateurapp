<?php
/**
 * Created by PhpStorm.
 * User: username
 * Date: 29/12/2018
 * Time: 19:31
 */

namespace generateur;
use configgen\TemplateMap;

class Views extends MetaGenerateur
{
    public $name="";
    public $CtrlName;
    public $view;
    public $TableName="";
    public function __construct($name,$CtrlName,$path,$titre,$view,$Template="")
    {
        parent::__construct($Template);
        $this->titre=$titre;
        $this->pathFile=$path;
        $this->name=$name;
        $this->CtrlName=$CtrlName;
        $this->view=$view;

    }

    public function editView(){
        if(file_exists(TemplateMap::$map['views']['edit'])){
            $ClassTemp=file_get_contents(TemplateMap::$map['views']['edit']);
            $ClassTemp=str_ireplace("{ViewName}",$this->titre,$ClassTemp);
            $ClassTemp=str_ireplace("{Titre}",$this->titre,$ClassTemp);

            Langues::$Index["Edit_".$this->TableName]="Edition ".$this->TableName;

            $ClassTemp=str_ireplace("{FormName}",$this->TableName,$ClassTemp);

            $ClassTemp=str_ireplace("{IDForm}",$this->TableName,$ClassTemp);
            $ClassTemp=str_ireplace("{Table}",$this->TableName,$ClassTemp);
            Langues::$Index["Error_save_".$this->TableName]="Erreur Save ".$this->TableName;
            Langues::$Index["Success_save_".$this->TableName]="Success Save ".$this->TableName;




            if(isset($this->view['pages'])){
              foreach($this->view['pages'] as $keyp => $pages){
                    $ClassTemp=str_ireplace("{".$keyp."}", $pages ,$ClassTemp);
                  }
                }
            $this->code[]=$ClassTemp;

        }else{
            throw new \Exception("Erreur de Fichier d'action Template Edit : ".TemplateMap::$map['views']['edit']);
        }
    }

    public function consulterView(){
        if(file_exists(TemplateMap::$map['views']['consulter'])){
            $ClassTemp=file_get_contents(TemplateMap::$map['views']['consulter']);
            $ClassTemp=str_ireplace("{Table}",$this->TableName,$ClassTemp);
             Langues::$Index["consulter_".$this->TableName]="consulter ".$this->TableName;



            //insertion de script js
            $ClassTemp5=file_get_contents(TemplateMap::$map['views']['scriptlist']);

            Langues::$Index["Confirm_delete_".$this->TableName]="Confirmer delete ".$this->TableName;
            Langues::$Index["Problem_delete_".$this->TableName]="Problem delete ".$this->TableName;
            Langues::$Index["Problem_Consulter_".$this->TableName]="Problem Consulter ".$this->TableName;
            Langues::$Index["Annuler_delete_".$this->TableName]="Annuler delete ".$this->TableName;
            Langues::$Index["Problem_Edit_".$this->TableName]="Problem Edit ".$this->TableName;

            echo "<pre style='color:blue'>";print_r($this->view);echo "</pre>";
            if(isset($this->view['pages'])){
              foreach($this->view['pages'] as $keyp => $pages){
                      $ClassTemp5=str_ireplace("{".$keyp."}", $pages ,$ClassTemp5);
              }
              $ClassTemp5=str_ireplace("{idp}",$this->view['pages'] ['id'],$ClassTemp5);
              $ClassTemp=str_ireplace("{scriptjs}",$ClassTemp5,$ClassTemp);
              //actions


                $ClassTemp1=file_get_contents(TemplateMap::$map['views']['btn_delete']);
                $ClassTemp2=file_get_contents(TemplateMap::$map['views']['btn_edit']);
                $ClassTemp3=file_get_contents(TemplateMap::$map['views']['btn_consult']);
                $ClassTemp5=$ClassTemp1."\n".$ClassTemp2."\n".$ClassTemp3;
                $ClassTemp5=str_ireplace("{id}",$this->view['pages'] ['id'],$ClassTemp5);
                $ClassTemp=str_ireplace("{Table}",$this->TableName,$ClassTemp);
                $ClassTemp=str_ireplace("{ActionsBtn}",$ClassTemp5,$ClassTemp);
            }

              $this->code[]=$ClassTemp;

        }else{
            throw new \Exception("Erreur de Fichier d'action Template conulter : ".TemplateMap::$map['views']['consulter']);
        }
    }

    public function listerView(){
        if(file_exists(TemplateMap::$map['views']['lister'])){
            $ClassTemp=file_get_contents(TemplateMap::$map['views']['lister']);
            $ClassTemp=str_ireplace("{Table}",$this->TableName,$ClassTemp);
             Langues::$Index["Lister_".$this->TableName]="Lister ".$this->TableName;



            //insertion de script js
            $ClassTemp5=file_get_contents(TemplateMap::$map['views']['scriptlist']);

            Langues::$Index["Confirm_delete_".$this->TableName]="Confirmer delete ".$this->TableName;
            Langues::$Index["Problem_delete_".$this->TableName]="Problem delete ".$this->TableName;
            Langues::$Index["Problem_Consulter_".$this->TableName]="Problem Consulter ".$this->TableName;
            Langues::$Index["Annuler_delete_".$this->TableName]="Annuler delete ".$this->TableName;
            Langues::$Index["Problem_Edit_".$this->TableName]="Problem Edit ".$this->TableName;

            echo "<pre style='color:green'>";print_r($this->view);echo "</pre>";
            if(isset($this->view['pages'])){
              foreach($this->view['pages'] as $keyp => $pages){
                      $ClassTemp5=str_ireplace("{".$keyp."}", $pages ,$ClassTemp5);
              }
              $ClassTemp5=str_ireplace("{idp}",$this->view['pages'] ['id'],$ClassTemp5);
              $ClassTemp=str_ireplace("{scriptjs}",$ClassTemp5,$ClassTemp);
              //actions


                $ClassTemp1=file_get_contents(TemplateMap::$map['views']['btn_delete']);
                $ClassTemp2=file_get_contents(TemplateMap::$map['views']['btn_edit']);
                $ClassTemp3=file_get_contents(TemplateMap::$map['views']['btn_consult']);
                $ClassTemp5=$ClassTemp1."\n".$ClassTemp2."\n".$ClassTemp3;
                $ClassTemp5=str_ireplace("{id}",$this->view['pages'] ['id'],$ClassTemp5);
                $ClassTemp=str_ireplace("{Table}",$this->TableName,$ClassTemp);
                $ClassTemp=str_ireplace("{ActionsBtn}",$ClassTemp5,$ClassTemp);
            }

              $this->code[]=$ClassTemp;

        }else{
            throw new \Exception("Erreur de Fichier d'action Template Edit : ".TemplateMap::$map['views']['lister']);
        }
    }

    public function gestionView(){
        if(file_exists(TemplateMap::$map['views']['gest'])){
            $ClassTemp=file_get_contents(TemplateMap::$map['views']['gest']);
            $ClassTemp=str_ireplace("{ViewName}",$this->titre,$ClassTemp);

            foreach($this->view['pages'] as $keyp => $pages){
                    $ClassTemp=str_ireplace("{".$keyp."}", $pages ,$ClassTemp);
            }
            Langues::$Index["Chargement_".$this->TableName]="Chargement ".$this->TableName;

            $ClassTemp=str_ireplace("{Table}",$this->TableName,$ClassTemp);
            $this->code[]=$ClassTemp;



        }else{
            throw new \Exception("Erreur de Fichier d'action Template Edit : ".TemplateMap::$map['views']['gest']);
        }
    }

    public function menugestionView(){
        if(file_exists(TemplateMap::$map['views']['gestmenu'])){
            $ClassTemp=file_get_contents(TemplateMap::$map['views']['gestmenu']);
            $ClassTemp=str_ireplace("{ViewName}",$this->titre,$ClassTemp);
            $ClassTemp=str_ireplace("{Table}",$this->TableName,$ClassTemp);
            $this->code[]=$ClassTemp;

        }else{
            throw new \Exception("Erreur de Fichier d'action Template Edit : ".TemplateMap::$map['views']['gestmenu']);
        }
    }

    public function generate(){
        $this->saveView();
    }

    public function saveView(){

        $content=implode("\n",$this->code);

            $file=$this->pathFile."/".$this->name.".phtml";
            if(file_put_contents($file,$content)){
                echo "$file<br>";
            }else{
                throw new \Exception("Erreur d'enregistrement de fichier : ".$file);

            }

    }
}
