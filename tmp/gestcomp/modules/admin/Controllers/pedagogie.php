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
use blocapp\modules\admin\Forms\formmatiere;
class pedagogie extends Controller
{
            /**
        * editmatiere
        **/
        public function editmatiere(){
                $Vue=new View();

                $Vue->disablelayout();
                            $idmatiere = $this->_getRequest("idmatiere","" );


                $form = new formmatiere("matiere");

                if(!empty($idmatiere)
){
                    $Vue->mode="Update";
                    $where=$params="";
                            $where.=empty($where) ? "idmatiere='".$idmatiere."'" : " AND idmatiere='".$idmatiere."'";

                    $Recmatiere=dbadapter::Select("matiere",$where);
                    $Recmatiere_Row= $Recmatiere ? $Recmatiere[0] : array();
                    $form->initValues($Recmatiere_Row);
                                $params.=empty($params) ? "idmatiere=$idmatiere&mode=Update" : "&idmatiere=$idmatiere&mode=Update" ;


                    $form->setAction("?activity=savematiere&mode=Update&".$params);
                }else{
                    $form->setAction("?activity=savematiere&mode=New");
                    $Vue->mode="New";
                }
                $Vue->form=$form;
                $Vue->titre = "matiere_Edit_Titre";
                $Vue->generate();
        }

            /**
            * listematiere
            **/
            public function listermatiere(){
                $Vue=new View();
                $Vue->disablelayout();
                $matiereRecs=dbadapter::SelectSQL("SELECT * FROM matiere");
                $Vue->liste= $matiereRecs ? $matiereRecs : array();
                $Header=array(
                                "idmatiere"=>\lib\Langue::getString("Col_idmatiere") 
,
            "idperiode"=>\lib\Langue::getString("Col_idperiode") 
,
            "idniveaux"=>\lib\Langue::getString("Col_idniveaux") 
,
            "titrearmatiere"=>\lib\Langue::getString("Col_titrearmatiere") 
,
            "descriptionar"=>\lib\Langue::getString("Col_descriptionar") 
,
            "descriptionfr"=>\lib\Langue::getString("Col_descriptionfr") 

                );
                        $Vue->LinkedId=array(        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'),
        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'));
            $Vue->Header =$Header;
                $Vue->titre = "Lister_Titre_matiere";
                $Vue->generate();
            }

/**
* editmatiere
**/
public function consultermatiere(){
        $Vue=new View();

        $Vue->disablelayout();
                    $idmatiere = $this->_getRequest("idmatiere","" );



        if(!empty($idmatiere)
){
            $Vue->mode="Update";
            $where=$params="";
                    $where.=empty($where) ? "idmatiere='".$idmatiere."'" : " AND idmatiere='".$idmatiere."'";

            $Recmatiere=dbadapter::Select("matiere",$where);
            $Recmatiere_Row= $Recmatiere ? $Recmatiere[0] : array();

            $Vue->liste= $Recmatiere_Row ? $Recmatiere_Row : array();
            $datas=array(
                            "idmatiere"=>\lib\Langue::getString("idmatiere") 
,
            "idperiode"=>\lib\Langue::getString("idperiode") 
,
            "idniveaux"=>\lib\Langue::getString("idniveaux") 
,
            "titrearmatiere"=>\lib\Langue::getString("titrearmatiere") 
,
            "descriptionar"=>\lib\Langue::getString("descriptionar") 
,
            "descriptionfr"=>\lib\Langue::getString("descriptionfr") 

            );
                        $Vue->LinkedId=array(        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'),
        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'));
            $Vue->datas= $datas;
        }

        $Vue->titre = "matiere_Edit_Titre";
        $Vue->generate();
}

public function gestionmatiere(){
$Vue=new View();
$Vue->generate();
}

   /**
   * deletematiere
   */
    public function deletematiere(){
        try{

            dbadapter::beginTransaction();

            $matiereWhere = new \stdClass();
                        $matiereWhere->idmatiere = $this->_getRequest("idmatiere") ;


            dbadapter::delete("matiere",$matiereWhere);


            dbadapter::Commit();

            echo json_encode(array("status"=>"success","message"=>"matiere Supprimer"));

        }catch (Exception $e){
            echo json_encode(array("status"=>"erreur","message"=>$e->getMessage()));
            dbadapter::Rolback();

        }
    }
    /**
    * savematiere
    **/
    public function savematiere(){
        try{

            dbadapter::beginTransaction();

            $mode = $this->_getRequest("mode","New");

            $matiereNewRec = new \stdClass();
                        $matiereNewRec->idperiode = $this->_getRequest("idperiode");
            $matiereNewRec->idniveaux = $this->_getRequest("idniveaux");
            $matiereNewRec->titrearmatiere = $this->_getRequest("titrearmatiere");
            $matiereNewRec->descriptionar = $this->_getRequest("descriptionar");
            $matiereNewRec->descriptionfr = $this->_getRequest("descriptionfr");


            if($mode=="New"){
               $id=dbadapter::Insert("matiere",$matiereNewRec);
            }elseif($mode="Update"){
                $matiereWhere = new \stdClass();
                            $matiereWhere->idmatiere = $this->_getRequest("idmatiere") ;


                $id=dbadapter::Update("matiere",$matiereNewRec,$matiereWhere);
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