<?php
/**
 * Created by PhpStorm.
 * User: username
 * Date: 30/12/2018
 * Time: 02:23
 */

namespace generateur;


class Routes
{
  public static $Index= [];
  public static $Lang="fr";

  public static function saveRoutes($pathFile){
      if(file_exists(TemplateMap::$map['Lang']['Lang'])){
        $ClassTemp=file_get_contents(TemplateMap::$map['Lang']['Lang']);
        $Langue=[];
        foreach (self::$Index as $key => $value) {
             $tmp=$ClassTemp;
             $tmp=str_ireplace("{Index}",$key,$tmp);
             $tmp=str_ireplace("{Text}",$value,$tmp);
             $Langue[]=$tmp;
        }

        $TextArray=implode(";\n",self::$Langue);
        $LangTemplate=file_get_contents(TemplateMap::$map['Lang']['LangArray']);
        $LangTemplate=str_ireplace("{Langs}",$TextArray,$LangTemplate);



          $file=$pathFile."/lang/".self::$Lang.".php";
          if(file_put_contents($file,$LangTemplate)){
              echo "$file<br>";
          }else{
              throw new \Exception("Erreur d'enregistrement de fichier : ".$file);

          }
      }else{
          throw new \Exception("Erreur de Fichier de langue Template Edit : ".TemplateMap::$map['Form']['formClass']);
      }


  }
}
