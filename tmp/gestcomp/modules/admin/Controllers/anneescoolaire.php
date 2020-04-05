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
use blocapp\modules\admin\Forms\formanneescoolaire;
use blocapp\modules\admin\Forms\formperiode;
class anneescoolaire extends Controller
{
            /**
        * editanneescoolaire
        **/
        public function editanneescoolaire(){
                $Vue=new View();

                $Vue->disablelayout();
                            $idanneescoolaire = $this->_getRequest("idanneescoolaire","" );


                $form = new formanneescoolaire("anneescoolaire");

                if(!empty($idanneescoolaire)
){
                    $Vue->mode="Update";
                    $where=$params="";
                            $where.=empty($where) ? "idanneescoolaire='".$idanneescoolaire."'" : " AND idanneescoolaire='".$idanneescoolaire."'";

                    $Recanneescoolaire=dbadapter::Select("anneescoolaire",$where);
                    $Recanneescoolaire_Row= $Recanneescoolaire ? $Recanneescoolaire[0] : array();
                    $form->initValues($Recanneescoolaire_Row);
                                $params.=empty($params) ? "idanneescoolaire=$idanneescoolaire&mode=Update" : "&idanneescoolaire=$idanneescoolaire&mode=Update" ;


                    $form->setAction("?activity=saveanneescoolaire&mode=Update&".$params);
                }else{
                    $form->setAction("?activity=saveanneescoolaire&mode=New");
                    $Vue->mode="New";
                }
                $Vue->form=$form;
                $Vue->titre = "anneescoolaire_Edit_Titre";
                $Vue->generate();
        }

            /**
            * listeanneescoolaire
            **/
            public function listeranneescoolaire(){
                $Vue=new View();
                $Vue->disablelayout();
                $anneescoolaireRecs=dbadapter::SelectSQL("SELECT * FROM anneescoolaire");
                $Vue->liste= $anneescoolaireRecs ? $anneescoolaireRecs : array();
                $Header=array(
                                "idanneescoolaire"=>\lib\Langue::getString("Col_idanneescoolaire") 
,
            "anneescool"=>\lib\Langue::getString("Col_anneescool") 
,
            "remarqueanneescool"=>\lib\Langue::getString("Col_remarqueanneescool") 
,
            "autreinfoannescool"=>\lib\Langue::getString("Col_autreinfoannescool") 

                );
                        $Vue->LinkedId=array();
            $Vue->Header =$Header;
                $Vue->titre = "Lister_Titre_anneescoolaire";
                $Vue->generate();
            }

/**
* editanneescoolaire
**/
public function consulteranneescoolaire(){
        $Vue=new View();

        $Vue->disablelayout();
                    $idanneescoolaire = $this->_getRequest("idanneescoolaire","" );



        if(!empty($idanneescoolaire)
){
            $Vue->mode="Update";
            $where=$params="";
                    $where.=empty($where) ? "idanneescoolaire='".$idanneescoolaire."'" : " AND idanneescoolaire='".$idanneescoolaire."'";

            $Recanneescoolaire=dbadapter::Select("anneescoolaire",$where);
            $Recanneescoolaire_Row= $Recanneescoolaire ? $Recanneescoolaire[0] : array();

            $Vue->liste= $Recanneescoolaire_Row ? $Recanneescoolaire_Row : array();
            $datas=array(
                            "idanneescoolaire"=>\lib\Langue::getString("idanneescoolaire") 
,
            "anneescool"=>\lib\Langue::getString("anneescool") 
,
            "remarqueanneescool"=>\lib\Langue::getString("remarqueanneescool") 
,
            "autreinfoannescool"=>\lib\Langue::getString("autreinfoannescool") 

            );
                        $Vue->LinkedId=array();
            $Vue->datas= $datas;
        }

        $Vue->titre = "anneescoolaire_Edit_Titre";
        $Vue->generate();
}

public function gestionanneescoolaire(){
$Vue=new View();
$Vue->generate();
}

   /**
   * deleteanneescoolaire
   */
    public function deleteanneescoolaire(){
        try{

            dbadapter::beginTransaction();

            $anneescoolaireWhere = new \stdClass();
                        $anneescoolaireWhere->idanneescoolaire = $this->_getRequest("idanneescoolaire") ;


            dbadapter::delete("anneescoolaire",$anneescoolaireWhere);


            dbadapter::Commit();

            echo json_encode(array("status"=>"success","message"=>"anneescoolaire Supprimer"));

        }catch (Exception $e){
            echo json_encode(array("status"=>"erreur","message"=>$e->getMessage()));
            dbadapter::Rolback();

        }
    }
    /**
    * saveanneescoolaire
    **/
    public function saveanneescoolaire(){
        try{

            dbadapter::beginTransaction();

            $mode = $this->_getRequest("mode","New");

            $anneescoolaireNewRec = new \stdClass();
                        $anneescoolaireNewRec->anneescool = $this->_getRequest("anneescool");
            $anneescoolaireNewRec->remarqueanneescool = $this->_getRequest("remarqueanneescool");
            $anneescoolaireNewRec->autreinfoannescool = $this->_getRequest("autreinfoannescool");


            if($mode=="New"){
               $id=dbadapter::Insert("anneescoolaire",$anneescoolaireNewRec);
            }elseif($mode="Update"){
                $anneescoolaireWhere = new \stdClass();
                            $anneescoolaireWhere->idanneescoolaire = $this->_getRequest("idanneescoolaire") ;


                $id=dbadapter::Update("anneescoolaire",$anneescoolaireNewRec,$anneescoolaireWhere);
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
        /**
        * editperiode
        **/
        public function editperiode(){
                $Vue=new View();

                $Vue->disablelayout();
                            $idperiode = $this->_getRequest("idperiode","" );


                $form = new formperiode("periode");

                if(!empty($idperiode)
){
                    $Vue->mode="Update";
                    $where=$params="";
                            $where.=empty($where) ? "idperiode='".$idperiode."'" : " AND idperiode='".$idperiode."'";

                    $Recperiode=dbadapter::Select("periode",$where);
                    $Recperiode_Row= $Recperiode ? $Recperiode[0] : array();
                    $form->initValues($Recperiode_Row);
                                $params.=empty($params) ? "idperiode=$idperiode&mode=Update" : "&idperiode=$idperiode&mode=Update" ;


                    $form->setAction("?activity=saveperiode&mode=Update&".$params);
                }else{
                    $form->setAction("?activity=saveperiode&mode=New");
                    $Vue->mode="New";
                }
                $Vue->form=$form;
                $Vue->titre = "periode_Edit_Titre";
                $Vue->generate();
        }

            /**
            * listeperiode
            **/
            public function listerperiode(){
                $Vue=new View();
                $Vue->disablelayout();
                $periodeRecs=dbadapter::SelectSQL("SELECT * FROM periode");
                $Vue->liste= $periodeRecs ? $periodeRecs : array();
                $Header=array(
                                "idperiode"=>\lib\Langue::getString("Col_idperiode") 
,
            "labelperiode"=>\lib\Langue::getString("Col_labelperiode") 
,
            "descperiode"=>\lib\Langue::getString("Col_descperiode") 

                );
                        $Vue->LinkedId=array();
            $Vue->Header =$Header;
                $Vue->titre = "Lister_Titre_periode";
                $Vue->generate();
            }

/**
* editperiode
**/
public function consulterperiode(){
        $Vue=new View();

        $Vue->disablelayout();
                    $idperiode = $this->_getRequest("idperiode","" );



        if(!empty($idperiode)
){
            $Vue->mode="Update";
            $where=$params="";
                    $where.=empty($where) ? "idperiode='".$idperiode."'" : " AND idperiode='".$idperiode."'";

            $Recperiode=dbadapter::Select("periode",$where);
            $Recperiode_Row= $Recperiode ? $Recperiode[0] : array();

            $Vue->liste= $Recperiode_Row ? $Recperiode_Row : array();
            $datas=array(
                            "idperiode"=>\lib\Langue::getString("idperiode") 
,
            "labelperiode"=>\lib\Langue::getString("labelperiode") 
,
            "descperiode"=>\lib\Langue::getString("descperiode") 

            );
                        $Vue->LinkedId=array();
            $Vue->datas= $datas;
        }

        $Vue->titre = "periode_Edit_Titre";
        $Vue->generate();
}

public function gestionperiode(){
$Vue=new View();
$Vue->generate();
}

   /**
   * deleteperiode
   */
    public function deleteperiode(){
        try{

            dbadapter::beginTransaction();

            $periodeWhere = new \stdClass();
                        $periodeWhere->idperiode = $this->_getRequest("idperiode") ;


            dbadapter::delete("periode",$periodeWhere);


            dbadapter::Commit();

            echo json_encode(array("status"=>"success","message"=>"periode Supprimer"));

        }catch (Exception $e){
            echo json_encode(array("status"=>"erreur","message"=>$e->getMessage()));
            dbadapter::Rolback();

        }
    }
    /**
    * saveperiode
    **/
    public function saveperiode(){
        try{

            dbadapter::beginTransaction();

            $mode = $this->_getRequest("mode","New");

            $periodeNewRec = new \stdClass();
                        $periodeNewRec->labelperiode = $this->_getRequest("labelperiode");
            $periodeNewRec->descperiode = $this->_getRequest("descperiode");


            if($mode=="New"){
               $id=dbadapter::Insert("periode",$periodeNewRec);
            }elseif($mode="Update"){
                $periodeWhere = new \stdClass();
                            $periodeWhere->idperiode = $this->_getRequest("idperiode") ;


                $id=dbadapter::Update("periode",$periodeNewRec,$periodeWhere);
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