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
use blocapp\modules\admin\Forms\formecole;
use blocapp\modules\admin\Forms\formniveaux;
use blocapp\modules\admin\Forms\formsection;
class ecole extends Controller
{
            /**
        * editecole
        **/
        public function editecole(){
                $Vue=new View();

                $Vue->disablelayout();
                            $idecole = $this->_getRequest("idecole","" );


                $form = new formecole("ecole");

                if(!empty($idecole)
){
                    $Vue->mode="Update";
                    $where=$params="";
                            $where.=empty($where) ? "idecole='".$idecole."'" : " AND idecole='".$idecole."'";

                    $Rececole=dbadapter::Select("ecole",$where);
                    $Rececole_Row= $Rececole ? $Rececole[0] : array();
                    $form->initValues($Rececole_Row);
                                $params.=empty($params) ? "idecole=$idecole&mode=Update" : "&idecole=$idecole&mode=Update" ;


                    $form->setAction("?activity=saveecole&mode=Update&".$params);
                }else{
                    $form->setAction("?activity=saveecole&mode=New");
                    $Vue->mode="New";
                }
                $Vue->form=$form;
                $Vue->titre = "ecole_Edit_Titre";
                $Vue->generate();
        }

            /**
            * listeecole
            **/
            public function listerecole(){
                $Vue=new View();
                $Vue->disablelayout();
                $ecoleRecs=dbadapter::SelectSQL("SELECT * FROM ecole");
                $Vue->liste= $ecoleRecs ? $ecoleRecs : array();
                $Header=array(
                                "idecole"=>\lib\Langue::getString("Col_idecole") 
,
            "nomecolear"=>\lib\Langue::getString("Col_nomecolear") 
,
            "idcentraleregional"=>\lib\Langue::getString("Col_idcentraleregional") 
,
            "nomecolefr"=>\lib\Langue::getString("Col_nomecolefr") 
,
            "adressecolear"=>\lib\Langue::getString("Col_adressecolear") 
,
            "adressecolefr"=>\lib\Langue::getString("Col_adressecolefr") 
,
            "autreinfo"=>\lib\Langue::getString("Col_autreinfo") 

                );
                        $Vue->LinkedId=array(        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'));
            $Vue->Header =$Header;
                $Vue->titre = "Lister_Titre_ecole";
                $Vue->generate();
            }

   /**
   * deleteecole
   */
    public function deleteecole(){
        try{

            dbadapter::beginTransaction();

            $ecoleWhere = new \stdClass();
                        $ecoleWhere->idecole = $this->_getRequest("idecole") ;


            dbadapter::delete("ecole",$ecoleWhere);


            dbadapter::Commit();

            echo json_encode(array("status"=>"success","message"=>"ecole Supprimer"));

        }catch (Exception $e){
            echo json_encode(array("status"=>"erreur","message"=>$e->getMessage()));
            dbadapter::Rolback();

        }
    }
    /**
    * saveecole
    **/
    public function saveecole(){
        try{

            dbadapter::beginTransaction();

            $mode = $this->_getRequest("mode","New");

            $ecoleNewRec = new \stdClass();
                        $ecoleNewRec->nomecolear = $this->_getRequest("nomecolear");
            $ecoleNewRec->idcentraleregional = $this->_getRequest("idcentraleregional");
            $ecoleNewRec->nomecolefr = $this->_getRequest("nomecolefr");
            $ecoleNewRec->adressecolear = $this->_getRequest("adressecolear");
            $ecoleNewRec->adressecolefr = $this->_getRequest("adressecolefr");
            $ecoleNewRec->autreinfo = $this->_getRequest("autreinfo");


            if($mode=="New"){
               $id=dbadapter::Insert("ecole",$ecoleNewRec);
            }elseif($mode="Update"){
                $ecoleWhere = new \stdClass();
                            $ecoleWhere->idecole = $this->_getRequest("idecole") ;


                $id=dbadapter::Update("ecole",$ecoleNewRec,$ecoleWhere);
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
        * editniveaux
        **/
        public function editniveaux(){
                $Vue=new View();

                $Vue->disablelayout();
                            $idniveaux = $this->_getRequest("idniveaux","" );


                $form = new formniveaux("niveaux");

                if(!empty($idniveaux)
){
                    $Vue->mode="Update";
                    $where=$params="";
                            $where.=empty($where) ? "idniveaux='".$idniveaux."'" : " AND idniveaux='".$idniveaux."'";

                    $Recniveaux=dbadapter::Select("niveaux",$where);
                    $Recniveaux_Row= $Recniveaux ? $Recniveaux[0] : array();
                    $form->initValues($Recniveaux_Row);
                                $params.=empty($params) ? "idniveaux=$idniveaux&mode=Update" : "&idniveaux=$idniveaux&mode=Update" ;


                    $form->setAction("?activity=saveniveaux&mode=Update&".$params);
                }else{
                    $form->setAction("?activity=saveniveaux&mode=New");
                    $Vue->mode="New";
                }
                $Vue->form=$form;
                $Vue->titre = "niveaux_Edit_Titre";
                $Vue->generate();
        }

            /**
            * listeniveaux
            **/
            public function listerniveaux(){
                $Vue=new View();
                $Vue->disablelayout();
                $niveauxRecs=dbadapter::SelectSQL("SELECT * FROM niveaux");
                $Vue->liste= $niveauxRecs ? $niveauxRecs : array();
                $Header=array(
                                "idniveaux"=>\lib\Langue::getString("Col_idniveaux") 
,
            "nomarniveau"=>\lib\Langue::getString("Col_nomarniveau") 
,
            "idsections"=>\lib\Langue::getString("Col_idsections") 
,
            "idecole"=>\lib\Langue::getString("Col_idecole") 
,
            "nomfrniveau"=>\lib\Langue::getString("Col_nomfrniveau") 
,
            "level"=>\lib\Langue::getString("Col_level") 
,
            "descniveau"=>\lib\Langue::getString("Col_descniveau") 

                );
                        $Vue->LinkedId=array(        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'),
        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'));
            $Vue->Header =$Header;
                $Vue->titre = "Lister_Titre_niveaux";
                $Vue->generate();
            }

   /**
   * deleteniveaux
   */
    public function deleteniveaux(){
        try{

            dbadapter::beginTransaction();

            $niveauxWhere = new \stdClass();
                        $niveauxWhere->idniveaux = $this->_getRequest("idniveaux") ;


            dbadapter::delete("niveaux",$niveauxWhere);


            dbadapter::Commit();

            echo json_encode(array("status"=>"success","message"=>"niveaux Supprimer"));

        }catch (Exception $e){
            echo json_encode(array("status"=>"erreur","message"=>$e->getMessage()));
            dbadapter::Rolback();

        }
    }
    /**
    * saveniveaux
    **/
    public function saveniveaux(){
        try{

            dbadapter::beginTransaction();

            $mode = $this->_getRequest("mode","New");

            $niveauxNewRec = new \stdClass();
                        $niveauxNewRec->nomarniveau = $this->_getRequest("nomarniveau");
            $niveauxNewRec->idsections = $this->_getRequest("idsections");
            $niveauxNewRec->idecole = $this->_getRequest("idecole");
            $niveauxNewRec->nomfrniveau = $this->_getRequest("nomfrniveau");
            $niveauxNewRec->level = $this->_getRequest("level");
            $niveauxNewRec->descniveau = $this->_getRequest("descniveau");


            if($mode=="New"){
               $id=dbadapter::Insert("niveaux",$niveauxNewRec);
            }elseif($mode="Update"){
                $niveauxWhere = new \stdClass();
                            $niveauxWhere->idniveaux = $this->_getRequest("idniveaux") ;


                $id=dbadapter::Update("niveaux",$niveauxNewRec,$niveauxWhere);
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
        * editsections
        **/
        public function editsections(){
                $Vue=new View();

                $Vue->disablelayout();
                            $idsections = $this->_getRequest("idsections","" );


                $form = new formsections("sections");

                if(!empty($idsections)
){
                    $Vue->mode="Update";
                    $where=$params="";
                            $where.=empty($where) ? "idsections='".$idsections."'" : " AND idsections='".$idsections."'";

                    $Recsections=dbadapter::Select("sections",$where);
                    $Recsections_Row= $Recsections ? $Recsections[0] : array();
                    $form->initValues($Recsections_Row);
                                $params.=empty($params) ? "idsections=$idsections&mode=Update" : "&idsections=$idsections&mode=Update" ;


                    $form->setAction("?activity=savesections&mode=Update&".$params);
                }else{
                    $form->setAction("?activity=savesections&mode=New");
                    $Vue->mode="New";
                }
                $Vue->form=$form;
                $Vue->titre = "sections_Edit_Titre";
                $Vue->generate();
        }

            /**
            * listesections
            **/
            public function listersections(){
                $Vue=new View();
                $Vue->disablelayout();
                $sectionsRecs=dbadapter::SelectSQL("SELECT * FROM sections");
                $Vue->liste= $sectionsRecs ? $sectionsRecs : array();
                $Header=array(
                                "idsections"=>\lib\Langue::getString("Col_idsections") 
,
            "nomsectionar"=>\lib\Langue::getString("Col_nomsectionar") 
,
            "nomsectionfr"=>\lib\Langue::getString("Col_nomsectionfr") 
,
            "descsection"=>\lib\Langue::getString("Col_descsection") 

                );
                        $Vue->LinkedId=array();
            $Vue->Header =$Header;
                $Vue->titre = "Lister_Titre_sections";
                $Vue->generate();
            }

   /**
   * deletesections
   */
    public function deletesections(){
        try{

            dbadapter::beginTransaction();

            $sectionsWhere = new \stdClass();
                        $sectionsWhere->idsections = $this->_getRequest("idsections") ;


            dbadapter::delete("sections",$sectionsWhere);


            dbadapter::Commit();

            echo json_encode(array("status"=>"success","message"=>"sections Supprimer"));

        }catch (Exception $e){
            echo json_encode(array("status"=>"erreur","message"=>$e->getMessage()));
            dbadapter::Rolback();

        }
    }
    /**
    * savesections
    **/
    public function savesections(){
        try{

            dbadapter::beginTransaction();

            $mode = $this->_getRequest("mode","New");

            $sectionsNewRec = new \stdClass();
                        $sectionsNewRec->nomsectionar = $this->_getRequest("nomsectionar");
            $sectionsNewRec->nomsectionfr = $this->_getRequest("nomsectionfr");
            $sectionsNewRec->descsection = $this->_getRequest("descsection");


            if($mode=="New"){
               $id=dbadapter::Insert("sections",$sectionsNewRec);
            }elseif($mode="Update"){
                $sectionsWhere = new \stdClass();
                            $sectionsWhere->idsections = $this->_getRequest("idsections") ;


                $id=dbadapter::Update("sections",$sectionsNewRec,$sectionsWhere);
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