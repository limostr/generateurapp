<?php
namespace blocapp\modules\admin\Forms;
use lib\Form\Form;
use lib\dbadapter;
class formclassscool extends Form
{

    public function __construct($nameform, \lib\Form\Elements $ElementForm = null, \lib\Form\FormStructer $FormData = Null)
    {
        parent::__construct($nameform, $ElementForm, $FormData);
        $this->setDecorator_Template();
        $this->FormAttrib->setTitle("classscool");
          $this->FormAttrib->setId("classscool");

        
$optionsidniveaux=$this->Selectniveaux();
$this->addElement("idniveaux",array(
            "type"=>"select"
            ,"list"=>$optionsidniveaux
            ,"options"=>array(
            "other"=>array(
                "placeholder"=>"idniveaux"
                ,"required"=>"required"
                ,"title"=>"idniveaux"
         )
        )
,"name"=>"idniveaux"
,"label"=>"idniveaux"
 ));


$optionsidanneescoolaire=$this->Selectanneescoolaire();
$this->addElement("idanneescoolaire",array(
            "type"=>"select"
            ,"list"=>$optionsidanneescoolaire
            ,"options"=>array(
            "other"=>array(
                "placeholder"=>"idanneescoolaire"
                ,"required"=>"required"
                ,"title"=>"idanneescoolaire"
         )
        )
,"name"=>"idanneescoolaire"
,"label"=>"idanneescoolaire"
 ));

$this->addElement("nomarclasse",array(
            "type"=>"text"
            ,"options"=>array(
            "other"=>array(
            "min"=>0
            ,"max"=>"45"
            ,"placeholder"=>"nomarclasse"
            ,"required"=>""
            ,"title"=>"nomarclasse"
        )
    )
    ,"name"=>"nomarclasse"
    ,"label"=>"nomarclasse"
 ));


$this->addElement("nomfrclasse",array(
            "type"=>"text"
            ,"options"=>array(
            "other"=>array(
            "min"=>0
            ,"max"=>"45"
            ,"placeholder"=>"nomfrclasse"
            ,"required"=>""
            ,"title"=>"nomfrclasse"
        )
    )
    ,"name"=>"nomfrclasse"
    ,"label"=>"nomfrclasse"
 ));


$this->addElement("nbrmaxinscript",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"nbrmaxinscript"
        )
    )
    ,"name"=>"nbrmaxinscript"
    ,"label"=>"nbrmaxinscript"
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
    
public function Selectniveaux(){
    $options[""]="Selectionner";
    $Recniveaux=dbadapter::SelectSQL("SELECT * FROM niveaux");
    foreach ($Recniveaux as $r){
        $options[$r['idniveaux']]=$r[1];

    }
    return $options;
}

public function Selectanneescoolaire(){
    $options[""]="Selectionner";
    $Recanneescoolaire=dbadapter::SelectSQL("SELECT * FROM anneescoolaire");
    foreach ($Recanneescoolaire as $r){
        $options[$r['idanneescoolaire']]=$r[1];

    }
    return $options;
}

}
