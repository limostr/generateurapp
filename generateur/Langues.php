<?php
/**
 * Created by PhpStorm.
 * User: username
 * Date: 29/12/2018
 * Time: 19:37
 */

namespace generateur;
use configgen\TemplateMap;

abstract class Langues
{
  public static $Index= [];
  public static $Lang="fr";

  public static function saveLang($pathFile){
      if(file_exists(TemplateMap::$map['Lang']['Lang'])){
        $ClassTemp=file_get_contents(TemplateMap::$map['Lang']['Lang']);
        $Langue=[];
        foreach (self::$Index as $key => $value) {
             $tmp=$ClassTemp;
             $tmp=str_ireplace("{Index}",$key,$tmp);
             $tmp=str_ireplace("{Text}",$value,$tmp);
             $Langue[]=$tmp;
        }

        $TextArray=implode("",$Langue);
        $LangTemplate=file_get_contents(TemplateMap::$map['Lang']['LangArray']);
        $LangTemplate=str_ireplace("{Langs}",$TextArray,$LangTemplate);



          $file=$pathFile."/".self::$Lang.".php";
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
