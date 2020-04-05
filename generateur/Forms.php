<?php
/**
 * Created by PhpStorm.
 * User: username
 * Date: 22/12/2018
 * Time: 14:41
 */

namespace generateur;
use configgen\TemplateMap;
use generateur\MetaGenerateur;

class Forms extends MetaGenerateur
{

    public $FormName="";
public $moduleName;

    public function __construct($formName,$moduleName,$Template="")
    {
        parent::__construct($Template);
        $this->titre=$formName;
        $this->FormName=$formName;
        $this->moduleName=$moduleName;
    }

    public function generate($Table){
        $elts=array();


        foreach ($Table['fields'] as $keyField=>$field ){
            if($field['Extra']!="auto_increment"){
                $value="";
                $is_Select=$this->detectSelect($field["Field"],$Table['Links']);
                if($is_Select){
                    $this->code["functions"][]=$this->genselectfunction($is_Select);
                    if(file_exists(TemplateMap::$map['Form']['SelectFunction'])){
                        $EltsTemp=file_get_contents(TemplateMap::$map['Form']['select']);
                        $strElt=$EltsTemp;
                        $strElt=str_ireplace("{Table}",$is_Select["TableRef"],$strElt);
                        $strElt=str_ireplace("{Field}",$field["Field"],$strElt);
                        $required=isset($field["Null"]) && $field["Null"]=="NO"? "required" : "";
                        $strElt=str_ireplace("{required}",$required,$strElt);
                        $this->code["elts"][]=$strElt ;


                        Langues::$Index[$field["Field"]]=$field["Field"];

                    }else{
                        throw new \Exception("Erreur de Fichier d'action Template Edit : ".TemplateMap::$map['Form']['SelectFunction']);
                    }
                }else {
                    $test = preg_match("/(\w+)\s*\((\d*)\)/", $field["Type"], $match);
                    $max = "";
                    if ($test) {
                        $Type = $this->detectType($match[1]);
                        $max = $match[2];
                    } else {
                        $Type = $this->detectType($field["Type"]);

                    }

                    if (isset(TemplateMap::$map['Form'][$Type]) && file_exists(TemplateMap::$map['Form'][$Type])) {
                        $EltsTemp = file_get_contents(TemplateMap::$map['Form'][$Type]);

                        $strElt = $EltsTemp;
                        $strElt = str_ireplace("{Type}", $Type, $strElt);
                        $strElt = str_ireplace("{Field}", $field["Field"], $strElt);
                        $strElt = str_ireplace("{max}", $max, $strElt);
                        $required = isset($field["Null"]) && $field["Null"] == "NO" ? "required" : "";
                        $strElt = str_ireplace("{required}", $required, $strElt);
                        $this->code["elts"][] = $strElt;
                        Langues::$Index[$field["Field"]]=$field["Field"];
                    } else {
                      echo "<pre>";print_r(TemplateMap::$map['Form']);echo "</pre>";
                        throw new \Exception("Erreur de Fichier d'action Template Edit : " . $Type);
                    }
                }
            }



            /*  [Field] => idannueeuniv
            [Type] => varchar(25)
            [Null] => NO
            [Key] => PRI
            [Default] =>
            [Extra] =>auto_increment*/



        }

        $this->saveforms();
    }

    public function detectType($type){
        $typeLow=strtolower($type);

        switch ($typeLow){
            case "varchar":
                return "text";
            break;
            case "longtext":
            case "text":
                return "textarea";
            break;
            case "int":
            case "bigint":
                return "textarea";
            break;
            case "date":
            case "datetime":
                return "date";
            break;


        }
        return "text";
    }

    public function detectSelect($id,$link){
        $res=false;
        foreach ($link as  $l){
            $TablePrincipal=explode(".",$l['foreign key']);
            if($id==$TablePrincipal[1]){
                $Tablereferences=explode(".",$l['references']);
                $res["IdRef"]=$Tablereferences[1];
                $res["TableRef"]=$l['referenced_table_name'];
                return $res;
            }
        }
        return false;
    }

    public function genselectfunction($Table){
        if(file_exists(TemplateMap::$map['Form']['SelectFunction'])){
            $SelectFunctionTemplate=file_get_contents(TemplateMap::$map['Form']['SelectFunction']);
            $strElt=$SelectFunctionTemplate;

            $strElt=str_ireplace("{Table}",$Table["TableRef"],$strElt);
            $strElt=str_ireplace("{id}",$Table["IdRef"],$strElt);

            return $strElt;
        }else{
            throw new \Exception("Erreur de Fichier d'action Template Edit : ".TemplateMap::$map['Form']['SelectFunction']);
        }
        return "";
    }

    public function saveforms(){
        if(file_exists(TemplateMap::$map['Form']['formClass'])){
            $ClassTemp=file_get_contents(TemplateMap::$map['Form']['formClass']);
            $ClassTemp=str_ireplace("{titre}",$this->titre,$ClassTemp);
            $ClassTemp=str_ireplace("{formname}",$this->FormName,$ClassTemp);
            $ClassTemp=str_ireplace("{IDForm}",$this->FormName,$ClassTemp);

            $ClassTemp=str_ireplace("{Module}",$this->moduleName,$ClassTemp);

            $Function=$elts="";
            if(!empty($this->code['functions'])){
                $Function=implode("\n",$this->code['functions']);
            }
            if(!empty($this->code['elts'])){
                $elts=implode("\n",$this->code['elts']);
            }

            $ClassTemp=str_ireplace("{elementforms}",$elts,$ClassTemp);
            $ClassTemp=str_ireplace("{fonctions_select}",$Function,$ClassTemp);
            $file=$this->pathFile."/form".$this->FormName.".php";
            if(file_put_contents($file,$ClassTemp)){
                echo "$file<br>";
            }else{
                throw new \Exception("Erreur d'enregistrement de fichier : ".$file);

            }
        }else{
            throw new \Exception("Erreur de Fichier d'action Template Edit : ".TemplateMap::$map['Form']['formClass']);
        }


    }
}
