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
use blocapp\modules\admin\Forms\formpersonnes;
use blocapp\modules\admin\Forms\formeleves;
use blocapp\modules\admin\Forms\forminstituteur;
use blocapp\modules\admin\Forms\formadministrateur;
class personnes extends Controller
{
            /**
        * editpersonnes
        **/
        public function editpersonnes(){
                $Vue=new View();

                $Vue->disablelayout();
                            $idpersonnes = $this->_getRequest("idpersonnes","" );


                $form = new formpersonnes("personnes");

                if(!empty($idpersonnes)
){
                    $Vue->mode="Update";
                    $where=$params="";
                            $where.=empty($where) ? "idpersonnes='".$idpersonnes."'" : " AND idpersonnes='".$idpersonnes."'";

                    $Recpersonnes=dbadapter::Select("personnes",$where);
                    $Recpersonnes_Row= $Recpersonnes ? $Recpersonnes[0] : array();
                    $form->initValues($Recpersonnes_Row);
                                $params.=empty($params) ? "idpersonnes=$idpersonnes&mode=Update" : "&idpersonnes=$idpersonnes&mode=Update" ;


                    $form->setAction("?activity=savepersonnes&mode=Update&".$params);
                }else{
                    $form->setAction("?activity=savepersonnes&mode=New");
                    $Vue->mode="New";
                }
                $Vue->form=$form;
                $Vue->titre = "personnes_Edit_Titre";
                $Vue->generate();
        }

            /**
            * listepersonnes
            **/
            public function listerpersonnes(){
                $Vue=new View();
                $Vue->disablelayout();
                $personnesRecs=dbadapter::SelectSQL("SELECT * FROM personnes");
                $Vue->liste= $personnesRecs ? $personnesRecs : array();
                $Header=array(
                                "idpersonnes"=>\lib\Langue::getString("Col_idpersonnes") 
,
            "nomar"=>\lib\Langue::getString("Col_nomar") 
,
            "prenomar"=>\lib\Langue::getString("Col_prenomar") 
,
            "nomfr"=>\lib\Langue::getString("Col_nomfr") 
,
            "prenomfr"=>\lib\Langue::getString("Col_prenomfr") 
,
            "datenaissance"=>\lib\Langue::getString("Col_datenaissance") 
,
            "lieunaissance"=>\lib\Langue::getString("Col_lieunaissance") 
,
            "lieunaissancear"=>\lib\Langue::getString("Col_lieunaissancear") 
,
            "adressar"=>\lib\Langue::getString("Col_adressar") 
,
            "adressfr"=>\lib\Langue::getString("Col_adressfr") 
,
            "telephone"=>\lib\Langue::getString("Col_telephone") 
,
            "pwd"=>\lib\Langue::getString("Col_pwd") 
,
            "login"=>\lib\Langue::getString("Col_login") 

                );
                        $Vue->LinkedId=array();
            $Vue->Header =$Header;
                $Vue->titre = "Lister_Titre_personnes";
                $Vue->generate();
            }

/**
* editpersonnes
**/
public function consulterpersonnes(){
        $Vue=new View();

        $Vue->disablelayout();
                    $idpersonnes = $this->_getRequest("idpersonnes","" );



        if(!empty($idpersonnes)
){
            $Vue->mode="Update";
            $where=$params="";
                    $where.=empty($where) ? "idpersonnes='".$idpersonnes."'" : " AND idpersonnes='".$idpersonnes."'";

            $Recpersonnes=dbadapter::Select("personnes",$where);
            $Recpersonnes_Row= $Recpersonnes ? $Recpersonnes[0] : array();

            $Vue->liste= $Recpersonnes_Row ? $Recpersonnes_Row : array();
            $datas=array(
                            "idpersonnes"=>\lib\Langue::getString("idpersonnes") 
,
            "nomar"=>\lib\Langue::getString("nomar") 
,
            "prenomar"=>\lib\Langue::getString("prenomar") 
,
            "nomfr"=>\lib\Langue::getString("nomfr") 
,
            "prenomfr"=>\lib\Langue::getString("prenomfr") 
,
            "datenaissance"=>\lib\Langue::getString("datenaissance") 
,
            "lieunaissance"=>\lib\Langue::getString("lieunaissance") 
,
            "lieunaissancear"=>\lib\Langue::getString("lieunaissancear") 
,
            "adressar"=>\lib\Langue::getString("adressar") 
,
            "adressfr"=>\lib\Langue::getString("adressfr") 
,
            "telephone"=>\lib\Langue::getString("telephone") 
,
            "pwd"=>\lib\Langue::getString("pwd") 
,
            "login"=>\lib\Langue::getString("login") 

            );
                        $Vue->LinkedId=array();
            $Vue->datas= $datas;
        }

        $Vue->titre = "personnes_Edit_Titre";
        $Vue->generate();
}

public function gestionpersonnes(){
$Vue=new View();
$Vue->generate();
}

   /**
   * deletepersonnes
   */
    public function deletepersonnes(){
        try{

            dbadapter::beginTransaction();

            $personnesWhere = new \stdClass();
                        $personnesWhere->idpersonnes = $this->_getRequest("idpersonnes") ;


            dbadapter::delete("personnes",$personnesWhere);


            dbadapter::Commit();

            echo json_encode(array("status"=>"success","message"=>"personnes Supprimer"));

        }catch (Exception $e){
            echo json_encode(array("status"=>"erreur","message"=>$e->getMessage()));
            dbadapter::Rolback();

        }
    }
    /**
    * savepersonnes
    **/
    public function savepersonnes(){
        try{

            dbadapter::beginTransaction();

            $mode = $this->_getRequest("mode","New");

            $personnesNewRec = new \stdClass();
                        $personnesNewRec->nomar = $this->_getRequest("nomar");
            $personnesNewRec->prenomar = $this->_getRequest("prenomar");
            $personnesNewRec->nomfr = $this->_getRequest("nomfr");
            $personnesNewRec->prenomfr = $this->_getRequest("prenomfr");
            $personnesNewRec->datenaissance = $this->_getRequest("datenaissance");
            $personnesNewRec->lieunaissance = $this->_getRequest("lieunaissance");
            $personnesNewRec->lieunaissancear = $this->_getRequest("lieunaissancear");
            $personnesNewRec->adressar = $this->_getRequest("adressar");
            $personnesNewRec->adressfr = $this->_getRequest("adressfr");
            $personnesNewRec->telephone = $this->_getRequest("telephone");
            $personnesNewRec->pwd = $this->_getRequest("pwd");
            $personnesNewRec->login = $this->_getRequest("login");


            if($mode=="New"){
               $id=dbadapter::Insert("personnes",$personnesNewRec);
            }elseif($mode="Update"){
                $personnesWhere = new \stdClass();
                            $personnesWhere->idpersonnes = $this->_getRequest("idpersonnes") ;


                $id=dbadapter::Update("personnes",$personnesNewRec,$personnesWhere);
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
        * editeleves
        **/
        public function editeleves(){
                $Vue=new View();

                $Vue->disablelayout();
                            $idpersonnes = $this->_getRequest("idpersonnes","" );


                $form = new formeleves("eleves");

                if(!empty($idpersonnes)
){
                    $Vue->mode="Update";
                    $where=$params="";
                            $where.=empty($where) ? "idpersonnes='".$idpersonnes."'" : " AND idpersonnes='".$idpersonnes."'";

                    $Receleves=dbadapter::Select("eleves",$where);
                    $Receleves_Row= $Receleves ? $Receleves[0] : array();
                    $form->initValues($Receleves_Row);
                                $params.=empty($params) ? "idpersonnes=$idpersonnes&mode=Update" : "&idpersonnes=$idpersonnes&mode=Update" ;


                    $form->setAction("?activity=saveeleves&mode=Update&".$params);
                }else{
                    $form->setAction("?activity=saveeleves&mode=New");
                    $Vue->mode="New";
                }
                $Vue->form=$form;
                $Vue->titre = "eleves_Edit_Titre";
                $Vue->generate();
        }

            /**
            * listeeleves
            **/
            public function listereleves(){
                $Vue=new View();
                $Vue->disablelayout();
                $elevesRecs=dbadapter::SelectSQL("SELECT * FROM eleves");
                $Vue->liste= $elevesRecs ? $elevesRecs : array();
                $Header=array(
                                "idpersonnes"=>\lib\Langue::getString("Col_idpersonnes") 
,
            "iduniqueeleve"=>\lib\Langue::getString("Col_iduniqueeleve") 
,
            "remarqueeleve"=>\lib\Langue::getString("Col_remarqueeleve") 

                );
                        $Vue->LinkedId=array(        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'));
            $Vue->Header =$Header;
                $Vue->titre = "Lister_Titre_eleves";
                $Vue->generate();
            }

/**
* editeleves
**/
public function consultereleves(){
        $Vue=new View();

        $Vue->disablelayout();
                    $idpersonnes = $this->_getRequest("idpersonnes","" );



        if(!empty($idpersonnes)
){
            $Vue->mode="Update";
            $where=$params="";
                    $where.=empty($where) ? "idpersonnes='".$idpersonnes."'" : " AND idpersonnes='".$idpersonnes."'";

            $Receleves=dbadapter::Select("eleves",$where);
            $Receleves_Row= $Receleves ? $Receleves[0] : array();

            $Vue->liste= $Receleves_Row ? $Receleves_Row : array();
            $datas=array(
                            "idpersonnes"=>\lib\Langue::getString("idpersonnes") 
,
            "iduniqueeleve"=>\lib\Langue::getString("iduniqueeleve") 
,
            "remarqueeleve"=>\lib\Langue::getString("remarqueeleve") 

            );
                        $Vue->LinkedId=array(        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'));
            $Vue->datas= $datas;
        }

        $Vue->titre = "eleves_Edit_Titre";
        $Vue->generate();
}

public function gestioneleves(){
$Vue=new View();
$Vue->generate();
}

   /**
   * deleteeleves
   */
    public function deleteeleves(){
        try{

            dbadapter::beginTransaction();

            $elevesWhere = new \stdClass();
                        $elevesWhere->idpersonnes = $this->_getRequest("idpersonnes") ;


            dbadapter::delete("eleves",$elevesWhere);


            dbadapter::Commit();

            echo json_encode(array("status"=>"success","message"=>"eleves Supprimer"));

        }catch (Exception $e){
            echo json_encode(array("status"=>"erreur","message"=>$e->getMessage()));
            dbadapter::Rolback();

        }
    }
    /**
    * saveeleves
    **/
    public function saveeleves(){
        try{

            dbadapter::beginTransaction();

            $mode = $this->_getRequest("mode","New");

            $elevesNewRec = new \stdClass();
                        $elevesNewRec->idpersonnes = $this->_getRequest("idpersonnes");
            $elevesNewRec->iduniqueeleve = $this->_getRequest("iduniqueeleve");
            $elevesNewRec->remarqueeleve = $this->_getRequest("remarqueeleve");


            if($mode=="New"){
               $id=dbadapter::Insert("eleves",$elevesNewRec);
            }elseif($mode="Update"){
                $elevesWhere = new \stdClass();
                            $elevesWhere->idpersonnes = $this->_getRequest("idpersonnes") ;


                $id=dbadapter::Update("eleves",$elevesNewRec,$elevesWhere);
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
        * editinstituteur
        **/
        public function editinstituteur(){
                $Vue=new View();

                $Vue->disablelayout();
                            $idpersonnes = $this->_getRequest("idpersonnes","" );


                $form = new forminstituteur("instituteur");

                if(!empty($idpersonnes)
){
                    $Vue->mode="Update";
                    $where=$params="";
                            $where.=empty($where) ? "idpersonnes='".$idpersonnes."'" : " AND idpersonnes='".$idpersonnes."'";

                    $Recinstituteur=dbadapter::Select("instituteur",$where);
                    $Recinstituteur_Row= $Recinstituteur ? $Recinstituteur[0] : array();
                    $form->initValues($Recinstituteur_Row);
                                $params.=empty($params) ? "idpersonnes=$idpersonnes&mode=Update" : "&idpersonnes=$idpersonnes&mode=Update" ;


                    $form->setAction("?activity=saveinstituteur&mode=Update&".$params);
                }else{
                    $form->setAction("?activity=saveinstituteur&mode=New");
                    $Vue->mode="New";
                }
                $Vue->form=$form;
                $Vue->titre = "instituteur_Edit_Titre";
                $Vue->generate();
        }

            /**
            * listeinstituteur
            **/
            public function listerinstituteur(){
                $Vue=new View();
                $Vue->disablelayout();
                $instituteurRecs=dbadapter::SelectSQL("SELECT * FROM instituteur");
                $Vue->liste= $instituteurRecs ? $instituteurRecs : array();
                $Header=array(
                                "idpersonnes"=>\lib\Langue::getString("Col_idpersonnes") 
,
            "cin"=>\lib\Langue::getString("Col_cin") 
,
            "specilaiter"=>\lib\Langue::getString("Col_specilaiter") 
,
            "daterecrutement"=>\lib\Langue::getString("Col_daterecrutement") 
,
            "diplome"=>\lib\Langue::getString("Col_diplome") 

                );
                        $Vue->LinkedId=array(        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'));
            $Vue->Header =$Header;
                $Vue->titre = "Lister_Titre_instituteur";
                $Vue->generate();
            }

/**
* editinstituteur
**/
public function consulterinstituteur(){
        $Vue=new View();

        $Vue->disablelayout();
                    $idpersonnes = $this->_getRequest("idpersonnes","" );



        if(!empty($idpersonnes)
){
            $Vue->mode="Update";
            $where=$params="";
                    $where.=empty($where) ? "idpersonnes='".$idpersonnes."'" : " AND idpersonnes='".$idpersonnes."'";

            $Recinstituteur=dbadapter::Select("instituteur",$where);
            $Recinstituteur_Row= $Recinstituteur ? $Recinstituteur[0] : array();

            $Vue->liste= $Recinstituteur_Row ? $Recinstituteur_Row : array();
            $datas=array(
                            "idpersonnes"=>\lib\Langue::getString("idpersonnes") 
,
            "cin"=>\lib\Langue::getString("cin") 
,
            "specilaiter"=>\lib\Langue::getString("specilaiter") 
,
            "daterecrutement"=>\lib\Langue::getString("daterecrutement") 
,
            "diplome"=>\lib\Langue::getString("diplome") 

            );
                        $Vue->LinkedId=array(        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'));
            $Vue->datas= $datas;
        }

        $Vue->titre = "instituteur_Edit_Titre";
        $Vue->generate();
}

public function gestioninstituteur(){
$Vue=new View();
$Vue->generate();
}

   /**
   * deleteinstituteur
   */
    public function deleteinstituteur(){
        try{

            dbadapter::beginTransaction();

            $instituteurWhere = new \stdClass();
                        $instituteurWhere->idpersonnes = $this->_getRequest("idpersonnes") ;


            dbadapter::delete("instituteur",$instituteurWhere);


            dbadapter::Commit();

            echo json_encode(array("status"=>"success","message"=>"instituteur Supprimer"));

        }catch (Exception $e){
            echo json_encode(array("status"=>"erreur","message"=>$e->getMessage()));
            dbadapter::Rolback();

        }
    }
    /**
    * saveinstituteur
    **/
    public function saveinstituteur(){
        try{

            dbadapter::beginTransaction();

            $mode = $this->_getRequest("mode","New");

            $instituteurNewRec = new \stdClass();
                        $instituteurNewRec->idpersonnes = $this->_getRequest("idpersonnes");
            $instituteurNewRec->cin = $this->_getRequest("cin");
            $instituteurNewRec->specilaiter = $this->_getRequest("specilaiter");
            $instituteurNewRec->daterecrutement = $this->_getRequest("daterecrutement");
            $instituteurNewRec->diplome = $this->_getRequest("diplome");


            if($mode=="New"){
               $id=dbadapter::Insert("instituteur",$instituteurNewRec);
            }elseif($mode="Update"){
                $instituteurWhere = new \stdClass();
                            $instituteurWhere->idpersonnes = $this->_getRequest("idpersonnes") ;


                $id=dbadapter::Update("instituteur",$instituteurNewRec,$instituteurWhere);
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
        * editadministrateur
        **/
        public function editadministrateur(){
                $Vue=new View();

                $Vue->disablelayout();
                            $idpersonnes = $this->_getRequest("idpersonnes","" );


                $form = new formadministrateur("administrateur");

                if(!empty($idpersonnes)
){
                    $Vue->mode="Update";
                    $where=$params="";
                            $where.=empty($where) ? "idpersonnes='".$idpersonnes."'" : " AND idpersonnes='".$idpersonnes."'";

                    $Recadministrateur=dbadapter::Select("administrateur",$where);
                    $Recadministrateur_Row= $Recadministrateur ? $Recadministrateur[0] : array();
                    $form->initValues($Recadministrateur_Row);
                                $params.=empty($params) ? "idpersonnes=$idpersonnes&mode=Update" : "&idpersonnes=$idpersonnes&mode=Update" ;


                    $form->setAction("?activity=saveadministrateur&mode=Update&".$params);
                }else{
                    $form->setAction("?activity=saveadministrateur&mode=New");
                    $Vue->mode="New";
                }
                $Vue->form=$form;
                $Vue->titre = "administrateur_Edit_Titre";
                $Vue->generate();
        }

            /**
            * listeadministrateur
            **/
            public function listeradministrateur(){
                $Vue=new View();
                $Vue->disablelayout();
                $administrateurRecs=dbadapter::SelectSQL("SELECT * FROM administrateur");
                $Vue->liste= $administrateurRecs ? $administrateurRecs : array();
                $Header=array(
                                "idpersonnes"=>\lib\Langue::getString("Col_idpersonnes") 
,
            "matricule"=>\lib\Langue::getString("Col_matricule") 
,
            "fonction"=>\lib\Langue::getString("Col_fonction") 

                );
                        $Vue->LinkedId=array(        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'));
            $Vue->Header =$Header;
                $Vue->titre = "Lister_Titre_administrateur";
                $Vue->generate();
            }

/**
* editadministrateur
**/
public function consulteradministrateur(){
        $Vue=new View();

        $Vue->disablelayout();
                    $idpersonnes = $this->_getRequest("idpersonnes","" );



        if(!empty($idpersonnes)
){
            $Vue->mode="Update";
            $where=$params="";
                    $where.=empty($where) ? "idpersonnes='".$idpersonnes."'" : " AND idpersonnes='".$idpersonnes."'";

            $Recadministrateur=dbadapter::Select("administrateur",$where);
            $Recadministrateur_Row= $Recadministrateur ? $Recadministrateur[0] : array();

            $Vue->liste= $Recadministrateur_Row ? $Recadministrateur_Row : array();
            $datas=array(
                            "idpersonnes"=>\lib\Langue::getString("idpersonnes") 
,
            "matricule"=>\lib\Langue::getString("matricule") 
,
            "fonction"=>\lib\Langue::getString("fonction") 

            );
                        $Vue->LinkedId=array(        '{ids}'=>array('Table'=>'{TableRef}','Label'=>'1'));
            $Vue->datas= $datas;
        }

        $Vue->titre = "administrateur_Edit_Titre";
        $Vue->generate();
}

public function gestionadministrateur(){
$Vue=new View();
$Vue->generate();
}

   /**
   * deleteadministrateur
   */
    public function deleteadministrateur(){
        try{

            dbadapter::beginTransaction();

            $administrateurWhere = new \stdClass();
                        $administrateurWhere->idpersonnes = $this->_getRequest("idpersonnes") ;


            dbadapter::delete("administrateur",$administrateurWhere);


            dbadapter::Commit();

            echo json_encode(array("status"=>"success","message"=>"administrateur Supprimer"));

        }catch (Exception $e){
            echo json_encode(array("status"=>"erreur","message"=>$e->getMessage()));
            dbadapter::Rolback();

        }
    }
    /**
    * saveadministrateur
    **/
    public function saveadministrateur(){
        try{

            dbadapter::beginTransaction();

            $mode = $this->_getRequest("mode","New");

            $administrateurNewRec = new \stdClass();
                        $administrateurNewRec->idpersonnes = $this->_getRequest("idpersonnes");
            $administrateurNewRec->matricule = $this->_getRequest("matricule");
            $administrateurNewRec->fonction = $this->_getRequest("fonction");


            if($mode=="New"){
               $id=dbadapter::Insert("administrateur",$administrateurNewRec);
            }elseif($mode="Update"){
                $administrateurWhere = new \stdClass();
                            $administrateurWhere->idpersonnes = $this->_getRequest("idpersonnes") ;


                $id=dbadapter::Update("administrateur",$administrateurNewRec,$administrateurWhere);
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