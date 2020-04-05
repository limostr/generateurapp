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
use blocapp\modules\admin\Forms\forminscripts;
class eleves extends Controller
{
            /**
        * editinscripts
        **/
        public function editinscripts(){
                $Vue=new View();

                $Vue->disablelayout();
                            $idinscripts = $this->_getRequest("idinscripts","" );


                $form = new forminscripts("inscripts");

                if(!empty($idinscripts)
){
                    $Vue->mode="Update";
                    $where=$params="";
                            $where.=empty($where) ? "idinscripts='".$idinscripts."'" : " AND idinscripts='".$idinscripts."'";

                    $Recinscripts=dbadapter::Select("inscripts",$where);
                    $Recinscripts_Row= $Recinscripts ? $Recinscripts[0] : array();
                    $form->initValues($Recinscripts_Row);
                                $params.=empty($params) ? "idinscripts=$idinscripts&mode=Update" : "&idinscripts=$idinscripts&mode=Update" ;


                    $form->setAction("?activity=saveinscripts&mode=Update&".$params);
                }else{
                    $form->setAction("?activity=saveinscripts&mode=New");
                    $Vue->mode="New";
                }
                $Vue->form=$form;
                $Vue->titre = "inscripts_Edit_Titre";
                $Vue->generate();
        }

            /**
            * listeinscripts
            **/
            public function listerinscripts(){
                $Vue=new View();
                $Vue->disablelayout();
                $inscriptsRecs=dbadapter::SelectSQL("SELECT * FROM inscripts");
                $Vue->liste= $inscriptsRecs ? $inscriptsRecs : array();
                $Header=array(
                                "idinscripts"=>\lib\Langue::getString("Col_idinscripts") 
,
            "idclassscool"=>\lib\Langue::getString("Col_idclassscool") 
,
            "idpersonnes"=>\lib\Langue::getString("Col_idpersonnes") 
,
            "codeinscription"=>\lib\Langue::getString("Col_codeinscription") 
,
            "anciens"=>\lib\Langue::getString("Col_anciens") 
,
            "datechangementclass"=>\lib\Langue::getString("Col_datechangementclass") 

                );
                        $Vue->LinkedId=array(        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'),
        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'));
            $Vue->Header =$Header;
                $Vue->titre = "Lister_Titre_inscripts";
                $Vue->generate();
            }

/**
* editinscripts
**/
public function consulterinscripts(){
        $Vue=new View();

        $Vue->disablelayout();
                    $idinscripts = $this->_getRequest("idinscripts","" );



        if(!empty($idinscripts)
){
            $Vue->mode="Update";
            $where=$params="";
                    $where.=empty($where) ? "idinscripts='".$idinscripts."'" : " AND idinscripts='".$idinscripts."'";

            $Recinscripts=dbadapter::Select("inscripts",$where);
            $Recinscripts_Row= $Recinscripts ? $Recinscripts[0] : array();

            $Vue->liste= $Recinscripts_Row ? $Recinscripts_Row : array();
            $datas=array(
                            "idinscripts"=>\lib\Langue::getString("idinscripts") 
,
            "idclassscool"=>\lib\Langue::getString("idclassscool") 
,
            "idpersonnes"=>\lib\Langue::getString("idpersonnes") 
,
            "codeinscription"=>\lib\Langue::getString("codeinscription") 
,
            "anciens"=>\lib\Langue::getString("anciens") 
,
            "datechangementclass"=>\lib\Langue::getString("datechangementclass") 

            );
                        $Vue->LinkedId=array(        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'),
        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'));
            $Vue->datas= $datas;
        }

        $Vue->titre = "inscripts_Edit_Titre";
        $Vue->generate();
}

public function gestioninscripts(){
$Vue=new View();
$Vue->generate();
}

   /**
   * deleteinscripts
   */
    public function deleteinscripts(){
        try{

            dbadapter::beginTransaction();

            $inscriptsWhere = new \stdClass();
                        $inscriptsWhere->idinscripts = $this->_getRequest("idinscripts") ;


            dbadapter::delete("inscripts",$inscriptsWhere);


            dbadapter::Commit();

            echo json_encode(array("status"=>"success","message"=>"inscripts Supprimer"));

        }catch (Exception $e){
            echo json_encode(array("status"=>"erreur","message"=>$e->getMessage()));
            dbadapter::Rolback();

        }
    }
    /**
    * saveinscripts
    **/
    public function saveinscripts(){
        try{

            dbadapter::beginTransaction();

            $mode = $this->_getRequest("mode","New");

            $inscriptsNewRec = new \stdClass();
                        $inscriptsNewRec->idclassscool = $this->_getRequest("idclassscool");
            $inscriptsNewRec->idpersonnes = $this->_getRequest("idpersonnes");
            $inscriptsNewRec->codeinscription = $this->_getRequest("codeinscription");
            $inscriptsNewRec->anciens = $this->_getRequest("anciens");
            $inscriptsNewRec->datechangementclass = $this->_getRequest("datechangementclass");


            if($mode=="New"){
               $id=dbadapter::Insert("inscripts",$inscriptsNewRec);
            }elseif($mode="Update"){
                $inscriptsWhere = new \stdClass();
                            $inscriptsWhere->idinscripts = $this->_getRequest("idinscripts") ;


                $id=dbadapter::Update("inscripts",$inscriptsNewRec,$inscriptsWhere);
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