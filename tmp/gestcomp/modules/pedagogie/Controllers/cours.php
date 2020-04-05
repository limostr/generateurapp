<?php
/**
 * Created by {GENERATOR}.
 * User: {USER}
 * Date: {DATE}
 * Time: {DATE} {TIME}
 */
namespace blocapp\modules\pedagogie\Controllers;

use lib\mvc\Controller;
use lib\mvc\View;
use lib\dbadapter;
use blocapp\modules\pedagogie\Forms\formcontenucours;
use blocapp\modules\pedagogie\Forms\formcompetences;
use blocapp\modules\pedagogie\Forms\formactiviter;
use blocapp\modules\pedagogie\Forms\formressources;
use blocapp\modules\pedagogie\Forms\formcompetencescontenue;
class cours extends Controller
{
            /**
        * editcontenucours
        **/
        public function editcontenucours(){
                $Vue=new View();

                $Vue->disablelayout();
                            $idcontenucours = $this->_getRequest("idcontenucours","" );


                $form = new formcontenucours("contenucours");

                if(!empty($idcontenucours)
){
                    $Vue->mode="Update";
                    $where=$params="";
                            $where.=empty($where) ? "idcontenucours='".$idcontenucours."'" : " AND idcontenucours='".$idcontenucours."'";

                    $Reccontenucours=dbadapter::Select("contenucours",$where);
                    $Reccontenucours_Row= $Reccontenucours ? $Reccontenucours[0] : array();
                    $form->initValues($Reccontenucours_Row);
                                $params.=empty($params) ? "idcontenucours=$idcontenucours&mode=Update" : "&idcontenucours=$idcontenucours&mode=Update" ;


                    $form->setAction("?activity=savecontenucours&mode=Update&".$params);
                }else{
                    $form->setAction("?activity=savecontenucours&mode=New");
                    $Vue->mode="New";
                }
                $Vue->form=$form;
                $Vue->titre = "contenucours_Edit_Titre";
                $Vue->generate();
        }

            /**
            * listecontenucours
            **/
            public function listercontenucours(){
                $Vue=new View();
                $Vue->disablelayout();
                $contenucoursRecs=dbadapter::SelectSQL("SELECT * FROM contenucours");
                $Vue->liste= $contenucoursRecs ? $contenucoursRecs : array();
                $Header=array(
                                "idcontenucours"=>\lib\Langue::getString("Col_idcontenucours") 
,
            "nomarcontenucours"=>\lib\Langue::getString("Col_nomarcontenucours") 
,
            "idmatiere"=>\lib\Langue::getString("Col_idmatiere") 
,
            "idperecontenucours"=>\lib\Langue::getString("Col_idperecontenucours") 
,
            "nomfrcontenucours"=>\lib\Langue::getString("Col_nomfrcontenucours") 
,
            "descarcontenue"=>\lib\Langue::getString("Col_descarcontenue") 
,
            "descfrcontenue"=>\lib\Langue::getString("Col_descfrcontenue") 
,
            "remarquear"=>\lib\Langue::getString("Col_remarquear") 
,
            "remarquefr"=>\lib\Langue::getString("Col_remarquefr") 
,
            "archiver"=>\lib\Langue::getString("Col_archiver") 
,
            "datearchiver"=>\lib\Langue::getString("Col_datearchiver") 

                );
                        $Vue->LinkedId=array(        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'));
            $Vue->Header =$Header;
                $Vue->titre = "Lister_Titre_contenucours";
                $Vue->generate();
            }

/**
* editcontenucours
**/
public function consultercontenucours(){
        $Vue=new View();

        $Vue->disablelayout();
                    $idcontenucours = $this->_getRequest("idcontenucours","" );



        if(!empty($idcontenucours)
){
            $Vue->mode="Update";
            $where=$params="";
                    $where.=empty($where) ? "idcontenucours='".$idcontenucours."'" : " AND idcontenucours='".$idcontenucours."'";

            $Reccontenucours=dbadapter::Select("contenucours",$where);
            $Reccontenucours_Row= $Reccontenucours ? $Reccontenucours[0] : array();

            $Vue->liste= $Reccontenucours_Row ? $Reccontenucours_Row : array();
            $datas=array(
                            "idcontenucours"=>\lib\Langue::getString("idcontenucours") 
,
            "nomarcontenucours"=>\lib\Langue::getString("nomarcontenucours") 
,
            "idmatiere"=>\lib\Langue::getString("idmatiere") 
,
            "idperecontenucours"=>\lib\Langue::getString("idperecontenucours") 
,
            "nomfrcontenucours"=>\lib\Langue::getString("nomfrcontenucours") 
,
            "descarcontenue"=>\lib\Langue::getString("descarcontenue") 
,
            "descfrcontenue"=>\lib\Langue::getString("descfrcontenue") 
,
            "remarquear"=>\lib\Langue::getString("remarquear") 
,
            "remarquefr"=>\lib\Langue::getString("remarquefr") 
,
            "archiver"=>\lib\Langue::getString("archiver") 
,
            "datearchiver"=>\lib\Langue::getString("datearchiver") 

            );
                        $Vue->LinkedId=array(        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'));
            $Vue->datas= $datas;
        }

        $Vue->titre = "contenucours_Edit_Titre";
        $Vue->generate();
}

public function gestioncontenucours(){
$Vue=new View();
$Vue->generate();
}

   /**
   * deletecontenucours
   */
    public function deletecontenucours(){
        try{

            dbadapter::beginTransaction();

            $contenucoursWhere = new \stdClass();
                        $contenucoursWhere->idcontenucours = $this->_getRequest("idcontenucours") ;


            dbadapter::delete("contenucours",$contenucoursWhere);


            dbadapter::Commit();

            echo json_encode(array("status"=>"success","message"=>"contenucours Supprimer"));

        }catch (Exception $e){
            echo json_encode(array("status"=>"erreur","message"=>$e->getMessage()));
            dbadapter::Rolback();

        }
    }
    /**
    * savecontenucours
    **/
    public function savecontenucours(){
        try{

            dbadapter::beginTransaction();

            $mode = $this->_getRequest("mode","New");

            $contenucoursNewRec = new \stdClass();
                        $contenucoursNewRec->nomarcontenucours = $this->_getRequest("nomarcontenucours");
            $contenucoursNewRec->idmatiere = $this->_getRequest("idmatiere");
            $contenucoursNewRec->idperecontenucours = $this->_getRequest("idperecontenucours");
            $contenucoursNewRec->nomfrcontenucours = $this->_getRequest("nomfrcontenucours");
            $contenucoursNewRec->descarcontenue = $this->_getRequest("descarcontenue");
            $contenucoursNewRec->descfrcontenue = $this->_getRequest("descfrcontenue");
            $contenucoursNewRec->remarquear = $this->_getRequest("remarquear");
            $contenucoursNewRec->remarquefr = $this->_getRequest("remarquefr");
            $contenucoursNewRec->archiver = $this->_getRequest("archiver");
            $contenucoursNewRec->datearchiver = $this->_getRequest("datearchiver");


            if($mode=="New"){
               $id=dbadapter::Insert("contenucours",$contenucoursNewRec);
            }elseif($mode="Update"){
                $contenucoursWhere = new \stdClass();
                            $contenucoursWhere->idcontenucours = $this->_getRequest("idcontenucours") ;


                $id=dbadapter::Update("contenucours",$contenucoursNewRec,$contenucoursWhere);
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
        * editcompetences
        **/
        public function editcompetences(){
                $Vue=new View();

                $Vue->disablelayout();
                            $idcompetences = $this->_getRequest("idcompetences","" );


                $form = new formcompetences("competences");

                if(!empty($idcompetences)
){
                    $Vue->mode="Update";
                    $where=$params="";
                            $where.=empty($where) ? "idcompetences='".$idcompetences."'" : " AND idcompetences='".$idcompetences."'";

                    $Reccompetences=dbadapter::Select("competences",$where);
                    $Reccompetences_Row= $Reccompetences ? $Reccompetences[0] : array();
                    $form->initValues($Reccompetences_Row);
                                $params.=empty($params) ? "idcompetences=$idcompetences&mode=Update" : "&idcompetences=$idcompetences&mode=Update" ;


                    $form->setAction("?activity=savecompetences&mode=Update&".$params);
                }else{
                    $form->setAction("?activity=savecompetences&mode=New");
                    $Vue->mode="New";
                }
                $Vue->form=$form;
                $Vue->titre = "competences_Edit_Titre";
                $Vue->generate();
        }

            /**
            * listecompetences
            **/
            public function listercompetences(){
                $Vue=new View();
                $Vue->disablelayout();
                $competencesRecs=dbadapter::SelectSQL("SELECT * FROM competences");
                $Vue->liste= $competencesRecs ? $competencesRecs : array();
                $Header=array(
                                "idcompetences"=>\lib\Langue::getString("Col_idcompetences") 
,
            "idpercompetences"=>\lib\Langue::getString("Col_idpercompetences") 
,
            "idmatiere"=>\lib\Langue::getString("Col_idmatiere") 
,
            "labelarcomp"=>\lib\Langue::getString("Col_labelarcomp") 
,
            "labelfrcomp"=>\lib\Langue::getString("Col_labelfrcomp") 
,
            "desccomp"=>\lib\Langue::getString("Col_desccomp") 
,
            "remarquecomp"=>\lib\Langue::getString("Col_remarquecomp") 
,
            "remarquearcomp"=>\lib\Langue::getString("Col_remarquearcomp") 

                );
                        $Vue->LinkedId=array();
            $Vue->Header =$Header;
                $Vue->titre = "Lister_Titre_competences";
                $Vue->generate();
            }

/**
* editcompetences
**/
public function consultercompetences(){
        $Vue=new View();

        $Vue->disablelayout();
                    $idcompetences = $this->_getRequest("idcompetences","" );



        if(!empty($idcompetences)
){
            $Vue->mode="Update";
            $where=$params="";
                    $where.=empty($where) ? "idcompetences='".$idcompetences."'" : " AND idcompetences='".$idcompetences."'";

            $Reccompetences=dbadapter::Select("competences",$where);
            $Reccompetences_Row= $Reccompetences ? $Reccompetences[0] : array();

            $Vue->liste= $Reccompetences_Row ? $Reccompetences_Row : array();
            $datas=array(
                            "idcompetences"=>\lib\Langue::getString("idcompetences") 
,
            "idpercompetences"=>\lib\Langue::getString("idpercompetences") 
,
            "idmatiere"=>\lib\Langue::getString("idmatiere") 
,
            "labelarcomp"=>\lib\Langue::getString("labelarcomp") 
,
            "labelfrcomp"=>\lib\Langue::getString("labelfrcomp") 
,
            "desccomp"=>\lib\Langue::getString("desccomp") 
,
            "remarquecomp"=>\lib\Langue::getString("remarquecomp") 
,
            "remarquearcomp"=>\lib\Langue::getString("remarquearcomp") 

            );
                        $Vue->LinkedId=array();
            $Vue->datas= $datas;
        }

        $Vue->titre = "competences_Edit_Titre";
        $Vue->generate();
}

public function gestioncompetences(){
$Vue=new View();
$Vue->generate();
}

   /**
   * deletecompetences
   */
    public function deletecompetences(){
        try{

            dbadapter::beginTransaction();

            $competencesWhere = new \stdClass();
                        $competencesWhere->idcompetences = $this->_getRequest("idcompetences") ;


            dbadapter::delete("competences",$competencesWhere);


            dbadapter::Commit();

            echo json_encode(array("status"=>"success","message"=>"competences Supprimer"));

        }catch (Exception $e){
            echo json_encode(array("status"=>"erreur","message"=>$e->getMessage()));
            dbadapter::Rolback();

        }
    }
    /**
    * savecompetences
    **/
    public function savecompetences(){
        try{

            dbadapter::beginTransaction();

            $mode = $this->_getRequest("mode","New");

            $competencesNewRec = new \stdClass();
                        $competencesNewRec->idpercompetences = $this->_getRequest("idpercompetences");
            $competencesNewRec->idmatiere = $this->_getRequest("idmatiere");
            $competencesNewRec->labelarcomp = $this->_getRequest("labelarcomp");
            $competencesNewRec->labelfrcomp = $this->_getRequest("labelfrcomp");
            $competencesNewRec->desccomp = $this->_getRequest("desccomp");
            $competencesNewRec->remarquecomp = $this->_getRequest("remarquecomp");
            $competencesNewRec->remarquearcomp = $this->_getRequest("remarquearcomp");


            if($mode=="New"){
               $id=dbadapter::Insert("competences",$competencesNewRec);
            }elseif($mode="Update"){
                $competencesWhere = new \stdClass();
                            $competencesWhere->idcompetences = $this->_getRequest("idcompetences") ;


                $id=dbadapter::Update("competences",$competencesNewRec,$competencesWhere);
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
        * editactiviter
        **/
        public function editactiviter(){
                $Vue=new View();

                $Vue->disablelayout();
                            $idactiviter = $this->_getRequest("idactiviter","" );


                $form = new formactiviter("activiter");

                if(!empty($idactiviter)
){
                    $Vue->mode="Update";
                    $where=$params="";
                            $where.=empty($where) ? "idactiviter='".$idactiviter."'" : " AND idactiviter='".$idactiviter."'";

                    $Recactiviter=dbadapter::Select("activiter",$where);
                    $Recactiviter_Row= $Recactiviter ? $Recactiviter[0] : array();
                    $form->initValues($Recactiviter_Row);
                                $params.=empty($params) ? "idactiviter=$idactiviter&mode=Update" : "&idactiviter=$idactiviter&mode=Update" ;


                    $form->setAction("?activity=saveactiviter&mode=Update&".$params);
                }else{
                    $form->setAction("?activity=saveactiviter&mode=New");
                    $Vue->mode="New";
                }
                $Vue->form=$form;
                $Vue->titre = "activiter_Edit_Titre";
                $Vue->generate();
        }

            /**
            * listeactiviter
            **/
            public function listeractiviter(){
                $Vue=new View();
                $Vue->disablelayout();
                $activiterRecs=dbadapter::SelectSQL("SELECT * FROM activiter");
                $Vue->liste= $activiterRecs ? $activiterRecs : array();
                $Header=array(
                                "idactiviter"=>\lib\Langue::getString("Col_idactiviter") 
,
            "idcompetences"=>\lib\Langue::getString("Col_idcompetences") 
,
            "labelactiviter"=>\lib\Langue::getString("Col_labelactiviter") 
,
            "descactiviter"=>\lib\Langue::getString("Col_descactiviter") 

                );
                        $Vue->LinkedId=array();
            $Vue->Header =$Header;
                $Vue->titre = "Lister_Titre_activiter";
                $Vue->generate();
            }

/**
* editactiviter
**/
public function consulteractiviter(){
        $Vue=new View();

        $Vue->disablelayout();
                    $idactiviter = $this->_getRequest("idactiviter","" );



        if(!empty($idactiviter)
){
            $Vue->mode="Update";
            $where=$params="";
                    $where.=empty($where) ? "idactiviter='".$idactiviter."'" : " AND idactiviter='".$idactiviter."'";

            $Recactiviter=dbadapter::Select("activiter",$where);
            $Recactiviter_Row= $Recactiviter ? $Recactiviter[0] : array();

            $Vue->liste= $Recactiviter_Row ? $Recactiviter_Row : array();
            $datas=array(
                            "idactiviter"=>\lib\Langue::getString("idactiviter") 
,
            "idcompetences"=>\lib\Langue::getString("idcompetences") 
,
            "labelactiviter"=>\lib\Langue::getString("labelactiviter") 
,
            "descactiviter"=>\lib\Langue::getString("descactiviter") 

            );
                        $Vue->LinkedId=array();
            $Vue->datas= $datas;
        }

        $Vue->titre = "activiter_Edit_Titre";
        $Vue->generate();
}

public function gestionactiviter(){
$Vue=new View();
$Vue->generate();
}

   /**
   * deleteactiviter
   */
    public function deleteactiviter(){
        try{

            dbadapter::beginTransaction();

            $activiterWhere = new \stdClass();
                        $activiterWhere->idactiviter = $this->_getRequest("idactiviter") ;


            dbadapter::delete("activiter",$activiterWhere);


            dbadapter::Commit();

            echo json_encode(array("status"=>"success","message"=>"activiter Supprimer"));

        }catch (Exception $e){
            echo json_encode(array("status"=>"erreur","message"=>$e->getMessage()));
            dbadapter::Rolback();

        }
    }
    /**
    * saveactiviter
    **/
    public function saveactiviter(){
        try{

            dbadapter::beginTransaction();

            $mode = $this->_getRequest("mode","New");

            $activiterNewRec = new \stdClass();
                        $activiterNewRec->idcompetences = $this->_getRequest("idcompetences");
            $activiterNewRec->labelactiviter = $this->_getRequest("labelactiviter");
            $activiterNewRec->descactiviter = $this->_getRequest("descactiviter");


            if($mode=="New"){
               $id=dbadapter::Insert("activiter",$activiterNewRec);
            }elseif($mode="Update"){
                $activiterWhere = new \stdClass();
                            $activiterWhere->idactiviter = $this->_getRequest("idactiviter") ;


                $id=dbadapter::Update("activiter",$activiterNewRec,$activiterWhere);
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
        * editressources
        **/
        public function editressources(){
                $Vue=new View();

                $Vue->disablelayout();
                            $idressources = $this->_getRequest("idressources","" );


                $form = new formressources("ressources");

                if(!empty($idressources)
){
                    $Vue->mode="Update";
                    $where=$params="";
                            $where.=empty($where) ? "idressources='".$idressources."'" : " AND idressources='".$idressources."'";

                    $Recressources=dbadapter::Select("ressources",$where);
                    $Recressources_Row= $Recressources ? $Recressources[0] : array();
                    $form->initValues($Recressources_Row);
                                $params.=empty($params) ? "idressources=$idressources&mode=Update" : "&idressources=$idressources&mode=Update" ;


                    $form->setAction("?activity=saveressources&mode=Update&".$params);
                }else{
                    $form->setAction("?activity=saveressources&mode=New");
                    $Vue->mode="New";
                }
                $Vue->form=$form;
                $Vue->titre = "ressources_Edit_Titre";
                $Vue->generate();
        }

            /**
            * listeressources
            **/
            public function listerressources(){
                $Vue=new View();
                $Vue->disablelayout();
                $ressourcesRecs=dbadapter::SelectSQL("SELECT * FROM ressources");
                $Vue->liste= $ressourcesRecs ? $ressourcesRecs : array();
                $Header=array(
                                "idressources"=>\lib\Langue::getString("Col_idressources") 
,
            "labelressources"=>\lib\Langue::getString("Col_labelressources") 
,
            "descressources"=>\lib\Langue::getString("Col_descressources") 

                );
                        $Vue->LinkedId=array();
            $Vue->Header =$Header;
                $Vue->titre = "Lister_Titre_ressources";
                $Vue->generate();
            }

/**
* editressources
**/
public function consulterressources(){
        $Vue=new View();

        $Vue->disablelayout();
                    $idressources = $this->_getRequest("idressources","" );



        if(!empty($idressources)
){
            $Vue->mode="Update";
            $where=$params="";
                    $where.=empty($where) ? "idressources='".$idressources."'" : " AND idressources='".$idressources."'";

            $Recressources=dbadapter::Select("ressources",$where);
            $Recressources_Row= $Recressources ? $Recressources[0] : array();

            $Vue->liste= $Recressources_Row ? $Recressources_Row : array();
            $datas=array(
                            "idressources"=>\lib\Langue::getString("idressources") 
,
            "labelressources"=>\lib\Langue::getString("labelressources") 
,
            "descressources"=>\lib\Langue::getString("descressources") 

            );
                        $Vue->LinkedId=array();
            $Vue->datas= $datas;
        }

        $Vue->titre = "ressources_Edit_Titre";
        $Vue->generate();
}

public function gestionressources(){
$Vue=new View();
$Vue->generate();
}

   /**
   * deleteressources
   */
    public function deleteressources(){
        try{

            dbadapter::beginTransaction();

            $ressourcesWhere = new \stdClass();
                        $ressourcesWhere->idressources = $this->_getRequest("idressources") ;


            dbadapter::delete("ressources",$ressourcesWhere);


            dbadapter::Commit();

            echo json_encode(array("status"=>"success","message"=>"ressources Supprimer"));

        }catch (Exception $e){
            echo json_encode(array("status"=>"erreur","message"=>$e->getMessage()));
            dbadapter::Rolback();

        }
    }
    /**
    * saveressources
    **/
    public function saveressources(){
        try{

            dbadapter::beginTransaction();

            $mode = $this->_getRequest("mode","New");

            $ressourcesNewRec = new \stdClass();
                        $ressourcesNewRec->labelressources = $this->_getRequest("labelressources");
            $ressourcesNewRec->descressources = $this->_getRequest("descressources");


            if($mode=="New"){
               $id=dbadapter::Insert("ressources",$ressourcesNewRec);
            }elseif($mode="Update"){
                $ressourcesWhere = new \stdClass();
                            $ressourcesWhere->idressources = $this->_getRequest("idressources") ;


                $id=dbadapter::Update("ressources",$ressourcesNewRec,$ressourcesWhere);
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
        * editcompetencescontenue
        **/
        public function editcompetencescontenue(){
                $Vue=new View();

                $Vue->disablelayout();
                            $idcontenucours = $this->_getRequest("idcontenucours","" );

            $idcompetences = $this->_getRequest("idcompetences","" );


                $form = new formcompetencescontenue("competencescontenue");

                if(!empty($idcontenucours)
 && !empty($idcompetences)
){
                    $Vue->mode="Update";
                    $where=$params="";
                            $where.=empty($where) ? "idcontenucours='".$idcontenucours."'" : " AND idcontenucours='".$idcontenucours."'";
        $where.=empty($where) ? "idcompetences='".$idcompetences."'" : " AND idcompetences='".$idcompetences."'";

                    $Reccompetencescontenue=dbadapter::Select("competencescontenue",$where);
                    $Reccompetencescontenue_Row= $Reccompetencescontenue ? $Reccompetencescontenue[0] : array();
                    $form->initValues($Reccompetencescontenue_Row);
                                $params.=empty($params) ? "idcontenucours=$idcontenucours&mode=Update" : "&idcontenucours=$idcontenucours&mode=Update" ;

            $params.=empty($params) ? "idcompetences=$idcompetences&mode=Update" : "&idcompetences=$idcompetences&mode=Update" ;


                    $form->setAction("?activity=savecompetencescontenue&mode=Update&".$params);
                }else{
                    $form->setAction("?activity=savecompetencescontenue&mode=New");
                    $Vue->mode="New";
                }
                $Vue->form=$form;
                $Vue->titre = "competencescontenue_Edit_Titre";
                $Vue->generate();
        }

            /**
            * listecompetencescontenue
            **/
            public function listercompetencescontenue(){
                $Vue=new View();
                $Vue->disablelayout();
                $competencescontenueRecs=dbadapter::SelectSQL("SELECT * FROM competencescontenue");
                $Vue->liste= $competencescontenueRecs ? $competencescontenueRecs : array();
                $Header=array(
                                "idcontenucours"=>\lib\Langue::getString("Col_idcontenucours") 
,
            "idcompetences"=>\lib\Langue::getString("Col_idcompetences") 

                );
                        $Vue->LinkedId=array(        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'),
        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'));
            $Vue->Header =$Header;
                $Vue->titre = "Lister_Titre_competencescontenue";
                $Vue->generate();
            }

/**
* editcompetencescontenue
**/
public function consultercompetencescontenue(){
        $Vue=new View();

        $Vue->disablelayout();
                    $idcontenucours = $this->_getRequest("idcontenucours","" );

            $idcompetences = $this->_getRequest("idcompetences","" );



        if(!empty($idcontenucours)
 && !empty($idcompetences)
){
            $Vue->mode="Update";
            $where=$params="";
                    $where.=empty($where) ? "idcontenucours='".$idcontenucours."'" : " AND idcontenucours='".$idcontenucours."'";
        $where.=empty($where) ? "idcompetences='".$idcompetences."'" : " AND idcompetences='".$idcompetences."'";

            $Reccompetencescontenue=dbadapter::Select("competencescontenue",$where);
            $Reccompetencescontenue_Row= $Reccompetencescontenue ? $Reccompetencescontenue[0] : array();

            $Vue->liste= $Reccompetencescontenue_Row ? $Reccompetencescontenue_Row : array();
            $datas=array(
                            "idcontenucours"=>\lib\Langue::getString("idcontenucours") 
,
            "idcompetences"=>\lib\Langue::getString("idcompetences") 

            );
                        $Vue->LinkedId=array(        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'),
        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'));
            $Vue->datas= $datas;
        }

        $Vue->titre = "competencescontenue_Edit_Titre";
        $Vue->generate();
}

public function gestioncompetencescontenue(){
$Vue=new View();
$Vue->generate();
}

   /**
   * deletecompetencescontenue
   */
    public function deletecompetencescontenue(){
        try{

            dbadapter::beginTransaction();

            $competencescontenueWhere = new \stdClass();
                        $competencescontenueWhere->idcontenucours = $this->_getRequest("idcontenucours") ;

            $competencescontenueWhere->idcompetences = $this->_getRequest("idcompetences") ;


            dbadapter::delete("competencescontenue",$competencescontenueWhere);


            dbadapter::Commit();

            echo json_encode(array("status"=>"success","message"=>"competencescontenue Supprimer"));

        }catch (Exception $e){
            echo json_encode(array("status"=>"erreur","message"=>$e->getMessage()));
            dbadapter::Rolback();

        }
    }
    /**
    * savecompetencescontenue
    **/
    public function savecompetencescontenue(){
        try{

            dbadapter::beginTransaction();

            $mode = $this->_getRequest("mode","New");

            $competencescontenueNewRec = new \stdClass();
                        $competencescontenueNewRec->idcontenucours = $this->_getRequest("idcontenucours");
            $competencescontenueNewRec->idcompetences = $this->_getRequest("idcompetences");


            if($mode=="New"){
               $id=dbadapter::Insert("competencescontenue",$competencescontenueNewRec);
            }elseif($mode="Update"){
                $competencescontenueWhere = new \stdClass();
                            $competencescontenueWhere->idcontenucours = $this->_getRequest("idcontenucours") ;

            $competencescontenueWhere->idcompetences = $this->_getRequest("idcompetences") ;


                $id=dbadapter::Update("competencescontenue",$competencescontenueNewRec,$competencescontenueWhere);
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