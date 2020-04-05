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
use blocapp\modules\admin\Forms\formcentraleregional;
class centraleregional extends Controller
{
            /**
        * editcentraleregional
        **/
        public function editcentraleregional(){
                $Vue=new View();

                $Vue->disablelayout();
                            $idcentraleregional = $this->_getRequest("idcentraleregional","" );


                $form = new formcentraleregional("centraleregional");

                if(!empty($idcentraleregional)
){
                    $Vue->mode="Update";
                    $where=$params="";
                            $where.=empty($where) ? "idcentraleregional='".$idcentraleregional."'" : " AND idcentraleregional='".$idcentraleregional."'";

                    $Reccentraleregional=dbadapter::Select("centraleregional",$where);
                    $Reccentraleregional_Row= $Reccentraleregional ? $Reccentraleregional[0] : array();
                    $form->initValues($Reccentraleregional_Row);
                                $params.=empty($params) ? "idcentraleregional=$idcentraleregional&mode=Update" : "&idcentraleregional=$idcentraleregional&mode=Update" ;


                    $form->setAction("?activity=savecentraleregional&mode=Update&".$params);
                }else{
                    $form->setAction("?activity=savecentraleregional&mode=New");
                    $Vue->mode="New";
                }
                $Vue->form=$form;
                $Vue->titre = "centraleregional_Edit_Titre";
                $Vue->generate();
        }

            /**
            * listecentraleregional
            **/
            public function listercentraleregional(){
                $Vue=new View();
                $Vue->disablelayout();
                $centraleregionalRecs=dbadapter::SelectSQL("SELECT * FROM centraleregional");
                $Vue->liste= $centraleregionalRecs ? $centraleregionalRecs : array();
                $Header=array(
                                "idcentraleregional"=>\lib\Langue::getString("Col_idcentraleregional") 
,
            "nomar"=>\lib\Langue::getString("Col_nomar") 
,
            "nomfr"=>\lib\Langue::getString("Col_nomfr") 
,
            "adress"=>\lib\Langue::getString("Col_adress") 
,
            "autreinforegional"=>\lib\Langue::getString("Col_autreinforegional") 

                );
                        $Vue->LinkedId=array();
            $Vue->Header =$Header;
                $Vue->titre = "Lister_Titre_centraleregional";
                $Vue->generate();
            }

/**
* editcentraleregional
**/
public function consultercentraleregional(){
        $Vue=new View();

        $Vue->disablelayout();
                    $idcentraleregional = $this->_getRequest("idcentraleregional","" );



        if(!empty($idcentraleregional)
){
            $Vue->mode="Update";
            $where=$params="";
                    $where.=empty($where) ? "idcentraleregional='".$idcentraleregional."'" : " AND idcentraleregional='".$idcentraleregional."'";

            $Reccentraleregional=dbadapter::Select("centraleregional",$where);
            $Reccentraleregional_Row= $Reccentraleregional ? $Reccentraleregional[0] : array();

            $Vue->liste= $centraleregionalRecs ? $centraleregionalRecs : array();
            $datas=array(
                            "idcentraleregional"=>\lib\Langue::getString("idcentraleregional") 
,
            "nomar"=>\lib\Langue::getString("nomar") 
,
            "nomfr"=>\lib\Langue::getString("nomfr") 
,
            "adress"=>\lib\Langue::getString("adress") 
,
            "autreinforegional"=>\lib\Langue::getString("autreinforegional") 

            );
                        $Vue->LinkedId=array();
            $Vue->datas= $datas;
        }

        $Vue->titre = "centraleregional_Edit_Titre";
        $Vue->generate();
}

public function gestioncentraleregional(){
$Vue=new View();
$Vue->generate();
}

   /**
   * deletecentraleregional
   */
    public function deletecentraleregional(){
        try{

            dbadapter::beginTransaction();

            $centraleregionalWhere = new \stdClass();
                        $centraleregionalWhere->idcentraleregional = $this->_getRequest("idcentraleregional") ;


            dbadapter::delete("centraleregional",$centraleregionalWhere);


            dbadapter::Commit();

            echo json_encode(array("status"=>"success","message"=>"centraleregional Supprimer"));

        }catch (Exception $e){
            echo json_encode(array("status"=>"erreur","message"=>$e->getMessage()));
            dbadapter::Rolback();

        }
    }
    /**
    * savecentraleregional
    **/
    public function savecentraleregional(){
        try{

            dbadapter::beginTransaction();

            $mode = $this->_getRequest("mode","New");

            $centraleregionalNewRec = new \stdClass();
                        $centraleregionalNewRec->nomar = $this->_getRequest("nomar");
            $centraleregionalNewRec->nomfr = $this->_getRequest("nomfr");
            $centraleregionalNewRec->adress = $this->_getRequest("adress");
            $centraleregionalNewRec->autreinforegional = $this->_getRequest("autreinforegional");


            if($mode=="New"){
               $id=dbadapter::Insert("centraleregional",$centraleregionalNewRec);
            }elseif($mode="Update"){
                $centraleregionalWhere = new \stdClass();
                            $centraleregionalWhere->idcentraleregional = $this->_getRequest("idcentraleregional") ;


                $id=dbadapter::Update("centraleregional",$centraleregionalNewRec,$centraleregionalWhere);
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