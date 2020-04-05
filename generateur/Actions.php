<?php
/**
 * Created by PhpStorm.
 * User: username
 * Date: 13/12/2018
 * Time: 10:05
 */

namespace generateur;
use configgen\TemplateMap;

class Actions extends MetaGenerateur
{
    public function __construct($Template="")
    {
        parent::__construct($Template);
    }

    public function Edit($Table,$form){
        if(file_exists(TemplateMap::$map['Controller']['edit'])){
            $ActionTemplate=file_get_contents(TemplateMap::$map['Controller']['edit']);
            $strElt=$ActionTemplate;
            $strElt=str_ireplace("{Table}",$Table['Table'],$strElt);
            $ids=$this->TablesIds($Table);
            $strElt=str_ireplace("{ids}",$ids,$strElt);

            $Cnd=$this->TablesCondEditIds($Table);
            if(!empty($Cnd)){
              $strElt=str_ireplace("{cnd}",$Cnd,$strElt);
            }

            $idsLink=$this->TablesEditUpdateLink($Table);
            $strElt=str_ireplace("{prams}",$idsLink,$strElt);

            $idsWhere=$this->TablesWhereIds($Table);
            $strElt=str_ireplace("{where}",$idsWhere,$strElt);




            return $strElt;
        }else{
            throw new \Exception("Erreur de Fichier d'action Template Edit : ".TemplateMap::$map['Controller']['edit']);
        }

    }

    public function Save($Table){
        if(file_exists(TemplateMap::$map['Controller']['edit'])){
            $ActionTemplate=file_get_contents(TemplateMap::$map['Controller']['save']);
            $strElt=$ActionTemplate;
            $strElt=str_ireplace("{Table}",$Table['Table'],$strElt);
            $Attrib=$this->SaveAttrib($Table);
            $WhereIds=$this->SaveWhereIds($Table);
            $strElt=str_ireplace("{ZONE_ATTRIB_VALUE}",$Attrib,$strElt);
            $strElt=str_ireplace("{ZONE_ATTRIB_WHERE}",$WhereIds,$strElt);
             return $strElt;
        }else{
            throw new \Exception("Erreur de Fichier d'action Template Edit : ".TemplateMap::$map['Controller']['edit']);
        }
    }

    public function Delete($Table){
        if(file_exists(TemplateMap::$map['Controller']['delete'])){
            $ActionTemplate=file_get_contents(TemplateMap::$map['Controller']['delete']);
            $strElt=$ActionTemplate;
            $strElt=str_ireplace("{Table}",$Table['Table'],$strElt);
             $WhereIds=$this->SaveWhereIds($Table);
             $strElt=str_ireplace("{ZONE_ATTRIB_WHERE}",$WhereIds,$strElt);
            return $strElt;
        }else{
            throw new \Exception("Erreur de Fichier d'action Template Edit : ".TemplateMap::$map['Controller']['delete']);
        }
    }

    public function Lister($Table){
        if(file_exists(TemplateMap::$map['Controller']['lister'])){
            $ActionTemplate=file_get_contents(TemplateMap::$map['Controller']['lister']);
            $strElt=$ActionTemplate;
            $strElt=str_ireplace("{Table}",$Table['Table'],$strElt);
            $Cols=$this->ListerCols($Table);
            $strElt=str_ireplace("{header_cols}",$Cols,$strElt);

            $ColsLinked=$this->generateLinkedIds($Table);
            $strElt=str_ireplace("{linked_Cols}",$ColsLinked,$strElt);

            return $strElt;
        }else{
            throw new \Exception("Erreur de Fichier d'action Template Edit : ".TemplateMap::$map['Controller']['lister']);
        }
    }

    public function Consulter($Table){
        if(file_exists(TemplateMap::$map['Controller']['consulter'])){
            $ActionTemplate=file_get_contents(TemplateMap::$map['Controller']['consulter']);
            $strElt=$ActionTemplate;

//debut cndeditIds
 $ids=$this->TablesIds($Table);
$strElt=str_ireplace("{ids}",$ids,$strElt);

$Cnd=$this->TablesCondEditIds($Table);
if(!empty($Cnd)){
  $strElt=str_ireplace("{cnd}",$Cnd,$strElt);
}

$idsLink=$this->TablesEditUpdateLink($Table);
$strElt=str_ireplace("{prams}",$idsLink,$strElt);

$idsWhere=$this->TablesWhereIds($Table);
$strElt=str_ireplace("{where}",$idsWhere,$strElt);
//fin cnd


            $strElt=str_ireplace("{Table}",$Table['Table'],$strElt);
            $Datas=$this->ConsulterData($Table);
            $strElt=str_ireplace("{datas}",$Datas,$strElt);

            $DataLinked=$this->generateLinkedIds($Table);
            $strElt=str_ireplace("{linked_Datas}",$DataLinked,$strElt);

            return $strElt;
        }else{
            throw new \Exception("Erreur de Fichier d'action Template Consulter : ".TemplateMap::$map['Controller']['consulter']);
        }
    }

    public function Gestion($Table){
      if(file_exists(TemplateMap::$map['Controller']['gestion'])){
          $ActionTemplate=file_get_contents(TemplateMap::$map['Controller']['gestion']);
          $strElt=$ActionTemplate;
          $strElt=str_ireplace("{Table}",$Table['Table'],$strElt);

          return $strElt;
      }else{
          throw new \Exception("Erreur de Fichier d'action Template gestion : ".TemplateMap::$map['Controller']['gestion']);
      }
    }

    public function ComplexInterface($Table){

    }

    /**
     * @param $Table
     * @return bool|mixed|string
     * @throws \Exception
     */
    public function TablesIds($Table){
        if(file_exists(TemplateMap::$map['Controller']['editIds'])){
            $ActionTemplate=file_get_contents(TemplateMap::$map['Controller']['editIds']);
            $res="";
            foreach ($Table["ids"] as $id){
                $strElt=$ActionTemplate;
                $res.=str_ireplace("{id}",$id['Field'],$strElt);
                $res.="\n";
            }

            return $res;
        }else{
            throw new \Exception("Erreur de Fichier d'action Template Edit : ".TemplateMap::$map['Controller']['editIds']);
        }
    }

    public function TablesCondEditIds($Table){
         if(file_exists(TemplateMap::$map['Controller']['cndeditIds'])){
            $ActionTemplate=file_get_contents(TemplateMap::$map['Controller']['cndeditIds']);
            $res="";
            foreach ($Table["ids"] as $id){
              $strElt=$ActionTemplate;
              $strElt=str_ireplace("{id}",$id['Field'],$strElt);
              $res.=!empty($res) ? " && $strElt" : $strElt;
            }

            return $res;
        }else{
            throw new \Exception("Erreur de Fichier d'action Template Edit : ".TemplateMap::$map['Controller']['editIds']);
        }
    }
    public function TablesWhereIds($Table){
        if(file_exists(TemplateMap::$map['Controller']['editwhere'])){
            $ActionTemplate=file_get_contents(TemplateMap::$map['Controller']['editwhere']);
            $res="";
            foreach ($Table["ids"] as $id){
                $strElt=$ActionTemplate;
                $res.=str_ireplace("{id}",$id['Field'],$strElt);
                $res.="\n";
            }

            return $res;


        }else{
            throw new \Exception("Erreur de Fichier d'action Template Edit : ".TemplateMap::$map['Controller']['editwhere']);
        }
    }

    public function TablesEditUpdateLink($Table){
        if(file_exists(TemplateMap::$map['Controller']['editUpdateLink'])){
            $ActionTemplate=file_get_contents(TemplateMap::$map['Controller']['editUpdateLink']);

            $res="";
            foreach ($Table["ids"] as $id){
                $strElt=$ActionTemplate;
                $res.=str_ireplace("{id}",$id['Field'],$strElt);
                $res.="\n";
            }

            return $res;
        }else{
             throw new \Exception("Erreur de Fichier d'action Template Edit : ".TemplateMap::$map['Controller']['editUpdateLink']);
        }
    }

    /**
     * Save elements
     */
    public function SaveAttrib($Table){
        if(file_exists(TemplateMap::$map['Controller']['saveAttrib'])){
            $ActionTemplate=file_get_contents(TemplateMap::$map['Controller']['saveAttrib']);
            $ActionTemplate=str_ireplace("{Table}",$Table['Table'],$ActionTemplate);

            $res="";
            foreach ($Table["fields"] as $id){

                if($id['Extra'] != 'auto_increment'){
                    $strElt=$ActionTemplate;
                    $res.=str_ireplace("{atrib}",$id['Field'],$strElt);
                    $res.="\n";
                }
            }

            return $res;
        }else{
            throw new \Exception("Erreur de Fichier d'action Template Edit : ".TemplateMap::$map['Controller']['saveAttrib']);
        }
    }
    public function SaveWhereIds($Table){
        if(file_exists(TemplateMap::$map['Controller']['savewhere'])){
            $ActionTemplate=file_get_contents(TemplateMap::$map['Controller']['savewhere']);
            $ActionTemplate=str_ireplace("{Table}",$Table['Table'],$ActionTemplate);

            $res="";
            foreach ($Table["ids"] as $id){
                $strElt=$ActionTemplate;
                $res.=str_ireplace("{id}",$id['Field'],$strElt);
                $res.="\n";
            }

            return $res;


        }else{
            throw new \Exception("Erreur de Fichier d'action Template Edit : ".TemplateMap::$map['Controller']['savewhere']);
        }
    }


    public function ListerCols($Table){
        if(file_exists(TemplateMap::$map['Controller']['colsListe'])){
            $ActionTemplate=file_get_contents(TemplateMap::$map['Controller']['colsListe']);
            $ActionTemplate=str_ireplace("{Table}",$Table['Table'],$ActionTemplate);

            $res=array();
            foreach ($Table["fields"] as $id){
                    $strElt=$ActionTemplate;
                    $res[]=str_ireplace("{attrib}",$id['Field'],$strElt);
                    Langues::$Index["Col_".$id['Field']]="Col_".$id['Field'];
            }
            $res= implode(",\n",$res);

            return $res;
        }else{
            throw new \Exception("Erreur de Fichier d'action Template Edit : ".TemplateMap::$map['Controller']['colsListe']);
        }
    }

    public function ConsulterData($Table){
        if(file_exists(TemplateMap::$map['Controller']['consultdata'])){
            $ActionTemplate=file_get_contents(TemplateMap::$map['Controller']['consultdata']);
            $ActionTemplate=str_ireplace("{Table}",$Table['Table'],$ActionTemplate);

            $res=array();
            foreach ($Table["fields"] as $id){
                    $strElt=$ActionTemplate;
                    $res[]=str_ireplace("{attrib}",$id['Field'],$strElt);
                  //  Langues::$Index[$id['Field']]=$id['Field'];
            }
            $res= implode(",\n",$res);

            return $res;
        }else{
            throw new \Exception("Erreur de Fichier d'action Template consulter data : ".TemplateMap::$map['Controller']['consultdata']);
        }
    }

    public function detectLinked($id,$link){
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
    public function generateLinkedIds($Table){
      echo"<pre style='color:blue;'>";print_r($Table);echo"</pre>";
      $liste=[];
      foreach ($Table['fields'] as $keyField=>$field ){
          if($field['Extra']!="auto_increment"){
              $value="";
              $is_lINKED=$this->detectLinked($field["Field"],$Table['Links']);
              if($is_lINKED){
                  $liste[]=$this->ListerLinkedIds($is_lINKED);
              }
            }
          }
          $strElt="";
          if(file_exists(TemplateMap::$map['views']['LinkedListe'])){
              $EltsTemp=file_get_contents(TemplateMap::$map['views']['LinkedListe']);
              $strElt=$EltsTemp;
              $linkdliste=implode(",\n",$liste);
              $strElt=str_ireplace("{IdsLink}",$linkdliste,$strElt);

          }else{
              throw new \Exception("Erreur de Fichier d'action Template Edit : ".TemplateMap::$map['views']['LinkedListe']);
          }

          return $strElt;
    }
    public function ListerLinkedIds($Table){
        if(file_exists(TemplateMap::$map['views']['LinkedIds'])){
            $SelectFunctionTemplate=file_get_contents(TemplateMap::$map['views']['LinkedIds']);
            $strElt=$SelectFunctionTemplate;
            $strElt=str_ireplace("{Table}",$Table["TableRef"],$strElt);
            $strElt=str_ireplace("{id}",$Table["IdRef"],$strElt);
            $strElt=str_ireplace("{label}",'1',$strElt);
            return $strElt;
        }else{
            throw new \Exception("Erreur de Fichier d'action Template Edit : ".TemplateMap::$map['views']['LinkedIds']);
        }
        return "";
    }
}
