<?php
namespace blocapp\modules\pedagogie\Forms;
use lib\Form\Form;
use lib\dbadapter;
class formcompetencescontenue extends Form
{

    public function __construct($nameform, \lib\Form\Elements $ElementForm = null, \lib\Form\FormStructer $FormData = Null)
    {
        parent::__construct($nameform, $ElementForm, $FormData);
        $this->setDecorator_Template();
        $this->FormAttrib->setTitle("competencescontenue");
          $this->FormAttrib->setId("competencescontenue");

        
$optionsidcontenucours=$this->Selectcontenucours();
$this->addElement("idcontenucours",array(
            "type"=>"select"
            ,"list"=>$optionsidcontenucours
            ,"options"=>array(
            "other"=>array(
                "placeholder"=>"idcontenucours"
                ,"required"=>"required"
                ,"title"=>"idcontenucours"
         )
        )
,"name"=>"idcontenucours"
,"label"=>"idcontenucours"
 ));


$optionsidcompetences=$this->Selectcompetences();
$this->addElement("idcompetences",array(
            "type"=>"select"
            ,"list"=>$optionsidcompetences
            ,"options"=>array(
            "other"=>array(
                "placeholder"=>"idcompetences"
                ,"required"=>"required"
                ,"title"=>"idcompetences"
         )
        )
,"name"=>"idcompetences"
,"label"=>"idcompetences"
 ));


        $this->addElement("submit",array(

                "type"=>"submit"
                ,"options"=>array(
                        "other"=>array(
                            "class"=>"btn btn-success"
                        )
                    )
                ,"name"=>"Enregistrer"
                ,"label"=>"Enregistrer  "
                )
        );
        $this->addElement("reset",array(

                "type"=>"reset"
                ,"options"=>array(
                        "other"=>array(
                            "class"=>"btn btn-danger"
                        )
                    )
                ,"name"=>"Reset"
                ,"label"=>"Reset"
                )
        );
      

    }
    
public function Selectcontenucours(){
    $options[""]="Selectionner";
    $Reccontenucours=dbadapter::SelectSQL("SELECT * FROM contenucours");
    foreach ($Reccontenucours as $r){
        $options[$r['idcontenucours']]=$r[1];

    }
    return $options;
}

public function Selectcompetences(){
    $options[""]="Selectionner";
    $Reccompetences=dbadapter::SelectSQL("SELECT * FROM competences");
    foreach ($Reccompetences as $r){
        $options[$r['idcompetences']]=$r[1];

    }
    return $options;
}

}
