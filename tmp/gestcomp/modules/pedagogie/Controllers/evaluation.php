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
use blocapp\modules\pedagogie\Forms\formepreuves;
use blocapp\modules\pedagogie\Forms\formquestions;
use blocapp\modules\pedagogie\Forms\formactiviterressources;
use blocapp\modules\pedagogie\Forms\formquestioncomp;
class evaluation extends Controller
{
            /**
        * editepreuves
        **/
        public function editepreuves(){
                $Vue=new View();

                $Vue->disablelayout();
                            $idepreuves = $this->_getRequest("idepreuves","" );


                $form = new formepreuves("epreuves");

                if(!empty($idepreuves)
){
                    $Vue->mode="Update";
                    $where=$params="";
                            $where.=empty($where) ? "idepreuves='".$idepreuves."'" : " AND idepreuves='".$idepreuves."'";

                    $Recepreuves=dbadapter::Select("epreuves",$where);
                    $Recepreuves_Row= $Recepreuves ? $Recepreuves[0] : array();
                    $form->initValues($Recepreuves_Row);
                                $params.=empty($params) ? "idepreuves=$idepreuves&mode=Update" : "&idepreuves=$idepreuves&mode=Update" ;


                    $form->setAction("?activity=saveepreuves&mode=Update&".$params);
                }else{
                    $form->setAction("?activity=saveepreuves&mode=New");
                    $Vue->mode="New";
                }
                $Vue->form=$form;
                $Vue->titre = "epreuves_Edit_Titre";
                $Vue->generate();
        }

            /**
            * listeepreuves
            **/
            public function listerepreuves(){
                $Vue=new View();
                $Vue->disablelayout();
                $epreuvesRecs=dbadapter::SelectSQL("SELECT * FROM epreuves");
                $Vue->liste= $epreuvesRecs ? $epreuvesRecs : array();
                $Header=array(
                                "idepreuves"=>\lib\Langue::getString("Col_idepreuves") 
,
            "titreexam"=>\lib\Langue::getString("Col_titreexam") 
,
            "classscool"=>\lib\Langue::getString("Col_classscool") 
,
            "idmatiere"=>\lib\Langue::getString("Col_idmatiere") 
,
            "idpersonnes"=>\lib\Langue::getString("Col_idpersonnes") 
,
            "descexam"=>\lib\Langue::getString("Col_descexam") 
,
            "datepassage"=>\lib\Langue::getString("Col_datepassage") 
,
            "periode"=>\lib\Langue::getString("Col_periode") 
,
            "baremexam"=>\lib\Langue::getString("Col_baremexam") 

                );
                        $Vue->LinkedId=array(        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'),
        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'),
        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'));
            $Vue->Header =$Header;
                $Vue->titre = "Lister_Titre_epreuves";
                $Vue->generate();
            }

/**
* editepreuves
**/
public function consulterepreuves(){
        $Vue=new View();

        $Vue->disablelayout();
                    $idepreuves = $this->_getRequest("idepreuves","" );



        if(!empty($idepreuves)
){
            $Vue->mode="Update";
            $where=$params="";
                    $where.=empty($where) ? "idepreuves='".$idepreuves."'" : " AND idepreuves='".$idepreuves."'";

            $Recepreuves=dbadapter::Select("epreuves",$where);
            $Recepreuves_Row= $Recepreuves ? $Recepreuves[0] : array();

            $Vue->liste= $Recepreuves_Row ? $Recepreuves_Row : array();
            $datas=array(
                            "idepreuves"=>\lib\Langue::getString("idepreuves") 
,
            "titreexam"=>\lib\Langue::getString("titreexam") 
,
            "classscool"=>\lib\Langue::getString("classscool") 
,
            "idmatiere"=>\lib\Langue::getString("idmatiere") 
,
            "idpersonnes"=>\lib\Langue::getString("idpersonnes") 
,
            "descexam"=>\lib\Langue::getString("descexam") 
,
            "datepassage"=>\lib\Langue::getString("datepassage") 
,
            "periode"=>\lib\Langue::getString("periode") 
,
            "baremexam"=>\lib\Langue::getString("baremexam") 

            );
                        $Vue->LinkedId=array(        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'),
        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'),
        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'));
            $Vue->datas= $datas;
        }

        $Vue->titre = "epreuves_Edit_Titre";
        $Vue->generate();
}

public function gestionepreuves(){
$Vue=new View();
$Vue->generate();
}

   /**
   * deleteepreuves
   */
    public function deleteepreuves(){
        try{

            dbadapter::beginTransaction();

            $epreuvesWhere = new \stdClass();
                        $epreuvesWhere->idepreuves = $this->_getRequest("idepreuves") ;


            dbadapter::delete("epreuves",$epreuvesWhere);


            dbadapter::Commit();

            echo json_encode(array("status"=>"success","message"=>"epreuves Supprimer"));

        }catch (Exception $e){
            echo json_encode(array("status"=>"erreur","message"=>$e->getMessage()));
            dbadapter::Rolback();

        }
    }
    /**
    * saveepreuves
    **/
    public function saveepreuves(){
        try{

            dbadapter::beginTransaction();

            $mode = $this->_getRequest("mode","New");

            $epreuvesNewRec = new \stdClass();
                        $epreuvesNewRec->titreexam = $this->_getRequest("titreexam");
            $epreuvesNewRec->classscool = $this->_getRequest("classscool");
            $epreuvesNewRec->idmatiere = $this->_getRequest("idmatiere");
            $epreuvesNewRec->idpersonnes = $this->_getRequest("idpersonnes");
            $epreuvesNewRec->descexam = $this->_getRequest("descexam");
            $epreuvesNewRec->datepassage = $this->_getRequest("datepassage");
            $epreuvesNewRec->periode = $this->_getRequest("periode");
            $epreuvesNewRec->baremexam = $this->_getRequest("baremexam");


            if($mode=="New"){
               $id=dbadapter::Insert("epreuves",$epreuvesNewRec);
            }elseif($mode="Update"){
                $epreuvesWhere = new \stdClass();
                            $epreuvesWhere->idepreuves = $this->_getRequest("idepreuves") ;


                $id=dbadapter::Update("epreuves",$epreuvesNewRec,$epreuvesWhere);
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
        * editquestions
        **/
        public function editquestions(){
                $Vue=new View();

                $Vue->disablelayout();
                            $idquestions = $this->_getRequest("idquestions","" );


                $form = new formquestions("questions");

                if(!empty($idquestions)
){
                    $Vue->mode="Update";
                    $where=$params="";
                            $where.=empty($where) ? "idquestions='".$idquestions."'" : " AND idquestions='".$idquestions."'";

                    $Recquestions=dbadapter::Select("questions",$where);
                    $Recquestions_Row= $Recquestions ? $Recquestions[0] : array();
                    $form->initValues($Recquestions_Row);
                                $params.=empty($params) ? "idquestions=$idquestions&mode=Update" : "&idquestions=$idquestions&mode=Update" ;


                    $form->setAction("?activity=savequestions&mode=Update&".$params);
                }else{
                    $form->setAction("?activity=savequestions&mode=New");
                    $Vue->mode="New";
                }
                $Vue->form=$form;
                $Vue->titre = "questions_Edit_Titre";
                $Vue->generate();
        }

            /**
            * listequestions
            **/
            public function listerquestions(){
                $Vue=new View();
                $Vue->disablelayout();
                $questionsRecs=dbadapter::SelectSQL("SELECT * FROM questions");
                $Vue->liste= $questionsRecs ? $questionsRecs : array();
                $Header=array(
                                "idquestions"=>\lib\Langue::getString("Col_idquestions") 
,
            "labelquestions"=>\lib\Langue::getString("Col_labelquestions") 
,
            "idepreuves"=>\lib\Langue::getString("Col_idepreuves") 
,
            "contextquestion"=>\lib\Langue::getString("Col_contextquestion") 
,
            "barem"=>\lib\Langue::getString("Col_barem") 
,
            "descquestion"=>\lib\Langue::getString("Col_descquestion") 

                );
                        $Vue->LinkedId=array(        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'));
            $Vue->Header =$Header;
                $Vue->titre = "Lister_Titre_questions";
                $Vue->generate();
            }

/**
* editquestions
**/
public function consulterquestions(){
        $Vue=new View();

        $Vue->disablelayout();
                    $idquestions = $this->_getRequest("idquestions","" );



        if(!empty($idquestions)
){
            $Vue->mode="Update";
            $where=$params="";
                    $where.=empty($where) ? "idquestions='".$idquestions."'" : " AND idquestions='".$idquestions."'";

            $Recquestions=dbadapter::Select("questions",$where);
            $Recquestions_Row= $Recquestions ? $Recquestions[0] : array();

            $Vue->liste= $Recquestions_Row ? $Recquestions_Row : array();
            $datas=array(
                            "idquestions"=>\lib\Langue::getString("idquestions") 
,
            "labelquestions"=>\lib\Langue::getString("labelquestions") 
,
            "idepreuves"=>\lib\Langue::getString("idepreuves") 
,
            "contextquestion"=>\lib\Langue::getString("contextquestion") 
,
            "barem"=>\lib\Langue::getString("barem") 
,
            "descquestion"=>\lib\Langue::getString("descquestion") 

            );
                        $Vue->LinkedId=array(        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'));
            $Vue->datas= $datas;
        }

        $Vue->titre = "questions_Edit_Titre";
        $Vue->generate();
}

public function gestionquestions(){
$Vue=new View();
$Vue->generate();
}

   /**
   * deletequestions
   */
    public function deletequestions(){
        try{

            dbadapter::beginTransaction();

            $questionsWhere = new \stdClass();
                        $questionsWhere->idquestions = $this->_getRequest("idquestions") ;


            dbadapter::delete("questions",$questionsWhere);


            dbadapter::Commit();

            echo json_encode(array("status"=>"success","message"=>"questions Supprimer"));

        }catch (Exception $e){
            echo json_encode(array("status"=>"erreur","message"=>$e->getMessage()));
            dbadapter::Rolback();

        }
    }
    /**
    * savequestions
    **/
    public function savequestions(){
        try{

            dbadapter::beginTransaction();

            $mode = $this->_getRequest("mode","New");

            $questionsNewRec = new \stdClass();
                        $questionsNewRec->labelquestions = $this->_getRequest("labelquestions");
            $questionsNewRec->idepreuves = $this->_getRequest("idepreuves");
            $questionsNewRec->contextquestion = $this->_getRequest("contextquestion");
            $questionsNewRec->barem = $this->_getRequest("barem");
            $questionsNewRec->descquestion = $this->_getRequest("descquestion");


            if($mode=="New"){
               $id=dbadapter::Insert("questions",$questionsNewRec);
            }elseif($mode="Update"){
                $questionsWhere = new \stdClass();
                            $questionsWhere->idquestions = $this->_getRequest("idquestions") ;


                $id=dbadapter::Update("questions",$questionsNewRec,$questionsWhere);
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
        * editactiviterressources
        **/
        public function editactiviterressources(){
                $Vue=new View();

                $Vue->disablelayout();
                            $idactiviter = $this->_getRequest("idactiviter","" );

            $idressources = $this->_getRequest("idressources","" );


                $form = new formactiviterressources("activiterressources");

                if(!empty($idactiviter)
 && !empty($idressources)
){
                    $Vue->mode="Update";
                    $where=$params="";
                            $where.=empty($where) ? "idactiviter='".$idactiviter."'" : " AND idactiviter='".$idactiviter."'";
        $where.=empty($where) ? "idressources='".$idressources."'" : " AND idressources='".$idressources."'";

                    $Recactiviterressources=dbadapter::Select("activiterressources",$where);
                    $Recactiviterressources_Row= $Recactiviterressources ? $Recactiviterressources[0] : array();
                    $form->initValues($Recactiviterressources_Row);
                                $params.=empty($params) ? "idactiviter=$idactiviter&mode=Update" : "&idactiviter=$idactiviter&mode=Update" ;

            $params.=empty($params) ? "idressources=$idressources&mode=Update" : "&idressources=$idressources&mode=Update" ;


                    $form->setAction("?activity=saveactiviterressources&mode=Update&".$params);
                }else{
                    $form->setAction("?activity=saveactiviterressources&mode=New");
                    $Vue->mode="New";
                }
                $Vue->form=$form;
                $Vue->titre = "activiterressources_Edit_Titre";
                $Vue->generate();
        }

            /**
            * listeactiviterressources
            **/
            public function listeractiviterressources(){
                $Vue=new View();
                $Vue->disablelayout();
                $activiterressourcesRecs=dbadapter::SelectSQL("SELECT * FROM activiterressources");
                $Vue->liste= $activiterressourcesRecs ? $activiterressourcesRecs : array();
                $Header=array(
                                "idactiviter"=>\lib\Langue::getString("Col_idactiviter") 
,
            "idressources"=>\lib\Langue::getString("Col_idressources") 

                );
                        $Vue->LinkedId=array(        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'),
        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'));
            $Vue->Header =$Header;
                $Vue->titre = "Lister_Titre_activiterressources";
                $Vue->generate();
            }

/**
* editactiviterressources
**/
public function consulteractiviterressources(){
        $Vue=new View();

        $Vue->disablelayout();
                    $idactiviter = $this->_getRequest("idactiviter","" );

            $idressources = $this->_getRequest("idressources","" );



        if(!empty($idactiviter)
 && !empty($idressources)
){
            $Vue->mode="Update";
            $where=$params="";
                    $where.=empty($where) ? "idactiviter='".$idactiviter."'" : " AND idactiviter='".$idactiviter."'";
        $where.=empty($where) ? "idressources='".$idressources."'" : " AND idressources='".$idressources."'";

            $Recactiviterressources=dbadapter::Select("activiterressources",$where);
            $Recactiviterressources_Row= $Recactiviterressources ? $Recactiviterressources[0] : array();

            $Vue->liste= $Recactiviterressources_Row ? $Recactiviterressources_Row : array();
            $datas=array(
                            "idactiviter"=>\lib\Langue::getString("idactiviter") 
,
            "idressources"=>\lib\Langue::getString("idressources") 

            );
                        $Vue->LinkedId=array(        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'),
        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'));
            $Vue->datas= $datas;
        }

        $Vue->titre = "activiterressources_Edit_Titre";
        $Vue->generate();
}

public function gestionactiviterressources(){
$Vue=new View();
$Vue->generate();
}

   /**
   * deleteactiviterressources
   */
    public function deleteactiviterressources(){
        try{

            dbadapter::beginTransaction();

            $activiterressourcesWhere = new \stdClass();
                        $activiterressourcesWhere->idactiviter = $this->_getRequest("idactiviter") ;

            $activiterressourcesWhere->idressources = $this->_getRequest("idressources") ;


            dbadapter::delete("activiterressources",$activiterressourcesWhere);


            dbadapter::Commit();

            echo json_encode(array("status"=>"success","message"=>"activiterressources Supprimer"));

        }catch (Exception $e){
            echo json_encode(array("status"=>"erreur","message"=>$e->getMessage()));
            dbadapter::Rolback();

        }
    }
    /**
    * saveactiviterressources
    **/
    public function saveactiviterressources(){
        try{

            dbadapter::beginTransaction();

            $mode = $this->_getRequest("mode","New");

            $activiterressourcesNewRec = new \stdClass();
                        $activiterressourcesNewRec->idactiviter = $this->_getRequest("idactiviter");
            $activiterressourcesNewRec->idressources = $this->_getRequest("idressources");


            if($mode=="New"){
               $id=dbadapter::Insert("activiterressources",$activiterressourcesNewRec);
            }elseif($mode="Update"){
                $activiterressourcesWhere = new \stdClass();
                            $activiterressourcesWhere->idactiviter = $this->_getRequest("idactiviter") ;

            $activiterressourcesWhere->idressources = $this->_getRequest("idressources") ;


                $id=dbadapter::Update("activiterressources",$activiterressourcesNewRec,$activiterressourcesWhere);
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
        * editquestioncomp
        **/
        public function editquestioncomp(){
                $Vue=new View();

                $Vue->disablelayout();
                            $idquestioncomp = $this->_getRequest("idquestioncomp","" );


                $form = new formquestioncomp("questioncomp");

                if(!empty($idquestioncomp)
){
                    $Vue->mode="Update";
                    $where=$params="";
                            $where.=empty($where) ? "idquestioncomp='".$idquestioncomp."'" : " AND idquestioncomp='".$idquestioncomp."'";

                    $Recquestioncomp=dbadapter::Select("questioncomp",$where);
                    $Recquestioncomp_Row= $Recquestioncomp ? $Recquestioncomp[0] : array();
                    $form->initValues($Recquestioncomp_Row);
                                $params.=empty($params) ? "idquestioncomp=$idquestioncomp&mode=Update" : "&idquestioncomp=$idquestioncomp&mode=Update" ;


                    $form->setAction("?activity=savequestioncomp&mode=Update&".$params);
                }else{
                    $form->setAction("?activity=savequestioncomp&mode=New");
                    $Vue->mode="New";
                }
                $Vue->form=$form;
                $Vue->titre = "questioncomp_Edit_Titre";
                $Vue->generate();
        }

            /**
            * listequestioncomp
            **/
            public function listerquestioncomp(){
                $Vue=new View();
                $Vue->disablelayout();
                $questioncompRecs=dbadapter::SelectSQL("SELECT * FROM questioncomp");
                $Vue->liste= $questioncompRecs ? $questioncompRecs : array();
                $Header=array(
                                "idquestioncomp"=>\lib\Langue::getString("Col_idquestioncomp") 
,
            "idquestions"=>\lib\Langue::getString("Col_idquestions") 
,
            "idcontenucours"=>\lib\Langue::getString("Col_idcontenucours") 
,
            "idcompetences"=>\lib\Langue::getString("Col_idcompetences") 

                );
                        $Vue->LinkedId=array();
            $Vue->Header =$Header;
                $Vue->titre = "Lister_Titre_questioncomp";
                $Vue->generate();
            }

/**
* editquestioncomp
**/
public function consulterquestioncomp(){
        $Vue=new View();

        $Vue->disablelayout();
                    $idquestioncomp = $this->_getRequest("idquestioncomp","" );



        if(!empty($idquestioncomp)
){
            $Vue->mode="Update";
            $where=$params="";
                    $where.=empty($where) ? "idquestioncomp='".$idquestioncomp."'" : " AND idquestioncomp='".$idquestioncomp."'";

            $Recquestioncomp=dbadapter::Select("questioncomp",$where);
            $Recquestioncomp_Row= $Recquestioncomp ? $Recquestioncomp[0] : array();

            $Vue->liste= $Recquestioncomp_Row ? $Recquestioncomp_Row : array();
            $datas=array(
                            "idquestioncomp"=>\lib\Langue::getString("idquestioncomp") 
,
            "idquestions"=>\lib\Langue::getString("idquestions") 
,
            "idcontenucours"=>\lib\Langue::getString("idcontenucours") 
,
            "idcompetences"=>\lib\Langue::getString("idcompetences") 

            );
                        $Vue->LinkedId=array();
            $Vue->datas= $datas;
        }

        $Vue->titre = "questioncomp_Edit_Titre";
        $Vue->generate();
}

public function gestionquestioncomp(){
$Vue=new View();
$Vue->generate();
}

   /**
   * deletequestioncomp
   */
    public function deletequestioncomp(){
        try{

            dbadapter::beginTransaction();

            $questioncompWhere = new \stdClass();
                        $questioncompWhere->idquestioncomp = $this->_getRequest("idquestioncomp") ;


            dbadapter::delete("questioncomp",$questioncompWhere);


            dbadapter::Commit();

            echo json_encode(array("status"=>"success","message"=>"questioncomp Supprimer"));

        }catch (Exception $e){
            echo json_encode(array("status"=>"erreur","message"=>$e->getMessage()));
            dbadapter::Rolback();

        }
    }
    /**
    * savequestioncomp
    **/
    public function savequestioncomp(){
        try{

            dbadapter::beginTransaction();

            $mode = $this->_getRequest("mode","New");

            $questioncompNewRec = new \stdClass();
                        $questioncompNewRec->idquestions = $this->_getRequest("idquestions");
            $questioncompNewRec->idcontenucours = $this->_getRequest("idcontenucours");
            $questioncompNewRec->idcompetences = $this->_getRequest("idcompetences");


            if($mode=="New"){
               $id=dbadapter::Insert("questioncomp",$questioncompNewRec);
            }elseif($mode="Update"){
                $questioncompWhere = new \stdClass();
                            $questioncompWhere->idquestioncomp = $this->_getRequest("idquestioncomp") ;


                $id=dbadapter::Update("questioncomp",$questioncompNewRec,$questioncompWhere);
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