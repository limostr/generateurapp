<?php
/**
 * Created by {GENERATOR}.
 * User: {USER}
 * Date: {DATE}
 * Time: {DATE} {TIME}
 */
namespace blocapp\modules\admin\Controllers;

use lib\mvc\Controller;
use lib\mvc\View;
use lib\dbadapter;
use blocapp\modules\admin\Forms\formclassscool;
class classscool extends Controller
{
            /**
        * editclassscool
        **/
        public function editclassscool(){
                $Vue=new View();

                $Vue->disablelayout();
                            $idclassscool = $this->_getRequest("idclassscool","" );


                $form = new formclassscool("classscool");

                if(!empty($idclassscool)
){
                    $Vue->mode="Update";
                    $where=$params="";
                            $where.=empty($where) ? "idclassscool='".$idclassscool."'" : " AND idclassscool='".$idclassscool."'";

                    $Recclassscool=dbadapter::Select("classscool",$where);
                    $Recclassscool_Row= $Recclassscool ? $Recclassscool[0] : array();
                    $form->initValues($Recclassscool_Row);
                                $params.=empty($params) ? "idclassscool=$idclassscool&mode=Update" : "&idclassscool=$idclassscool&mode=Update" ;


                    $form->setAction("?activity=saveclassscool&mode=Update&".$params);
                }else{
                    $form->setAction("?activity=saveclassscool&mode=New");
                    $Vue->mode="New";
                }
                $Vue->form=$form;
                $Vue->titre = "classscool_Edit_Titre";
                $Vue->generate();
        }

            /**
            * listeclassscool
            **/
            public function listerclassscool(){
                $Vue=new View();
                $Vue->disablelayout();
                $classscoolRecs=dbadapter::SelectSQL("SELECT * FROM classscool");
                $Vue->liste= $classscoolRecs ? $classscoolRecs : array();
                $Header=array(
                                "idclassscool"=>\lib\Langue::getString("Col_idclassscool") 
,
            "idniveaux"=>\lib\Langue::getString("Col_idniveaux") 
,
            "idanneescoolaire"=>\lib\Langue::getString("Col_idanneescoolaire") 
,
            "nomarclasse"=>\lib\Langue::getString("Col_nomarclasse") 
,
            "nomfrclasse"=>\lib\Langue::getString("Col_nomfrclasse") 
,
            "nbrmaxinscript"=>\lib\Langue::getString("Col_nbrmaxinscript") 

                );
                        $Vue->LinkedId=array(        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'),
        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'));
            $Vue->Header =$Header;
                $Vue->titre = "Lister_Titre_classscool";
                $Vue->generate();
            }

/**
* editclassscool
**/
public function consulterclassscool(){
        $Vue=new View();

        $Vue->disablelayout();
                    $idclassscool = $this->_getRequest("idclassscool","" );



        if(!empty($idclassscool)
){
            $Vue->mode="Update";
            $where=$params="";
                    $where.=empty($where) ? "idclassscool='".$idclassscool."'" : " AND idclassscool='".$idclassscool."'";

            $Recclassscool=dbadapter::Select("classscool",$where);
            $Recclassscool_Row= $Recclassscool ? $Recclassscool[0] : array();

            $Vue->liste= $Recclassscool_Row ? $Recclassscool_Row : array();
            $datas=array(
                            "idclassscool"=>\lib\Langue::getString("idclassscool") 
,
            "idniveaux"=>\lib\Langue::getString("idniveaux") 
,
            "idanneescoolaire"=>\lib\Langue::getString("idanneescoolaire") 
,
            "nomarclasse"=>\lib\Langue::getString("nomarclasse") 
,
            "nomfrclasse"=>\lib\Langue::getString("nomfrclasse") 
,
            "nbrmaxinscript"=>\lib\Langue::getString("nbrmaxinscript") 

            );
                        $Vue->LinkedId=array(        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'),
        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'));
            $Vue->datas= $datas;
        }

        $Vue->titre = "classscool_Edit_Titre";
        $Vue->generate();
}

public function gestionclassscool(){
$Vue=new View();
$Vue->generate();
}

   /**
   * deleteclassscool
   */
    public function deleteclassscool(){
        try{

            dbadapter::beginTransaction();

            $classscoolWhere = new \stdClass();
                        $classscoolWhere->idclassscool = $this->_getRequest("idclassscool") ;


            dbadapter::delete("classscool",$classscoolWhere);


            dbadapter::Commit();

            echo json_encode(array("status"=>"success","message"=>"classscool Supprimer"));

        }catch (Exception $e){
            echo json_encode(array("status"=>"erreur","message"=>$e->getMessage()));
            dbadapter::Rolback();

        }
    }
    /**
    * saveclassscool
    **/
    public function saveclassscool(){
        try{

            dbadapter::beginTransaction();

            $mode = $this->_getRequest("mode","New");

            $classscoolNewRec = new \stdClass();
                        $classscoolNewRec->idniveaux = $this->_getRequest("idniveaux");
            $classscoolNewRec->idanneescoolaire = $this->_getRequest("idanneescoolaire");
            $classscoolNewRec->nomarclasse = $this->_getRequest("nomarclasse");
            $classscoolNewRec->nomfrclasse = $this->_getRequest("nomfrclasse");
            $classscoolNewRec->nbrmaxinscript = $this->_getRequest("nbrmaxinscript");


            if($mode=="New"){
               $id=dbadapter::Insert("classscool",$classscoolNewRec);
            }elseif($mode="Update"){
                $classscoolWhere = new \stdClass();
                            $classscoolWhere->idclassscool = $this->_getRequest("idclassscool") ;


                $id=dbadapter::Update("classscool",$classscoolNewRec,$classscoolWhere);
            }


            dbadapter::Commit();
            if($mode=="New"){
               echo json_encode(array("status"=>"success","message"=>"Personne ajouter"));
            }elseif($mode="Update"){
                echo json_encode(array("status"=>"success","message"=>"Personne Mis ajours"));
            }

        }catch (Exception $e){
            echo json_encode(array("status"=>"erreur","message"=>$e->getMessage()));
            dbadapter::Rolback();

        }
    }

}