<?php
namespace blocapp\modules\admin\Forms;
use lib\Form\Form;
use lib\dbadapter;
class forminscripts extends Form
{

    public function __construct($nameform, \lib\Form\Elements $ElementForm = null, \lib\Form\FormStructer $FormData = Null)
    {
        parent::__construct($nameform, $ElementForm, $FormData);
        $this->setDecorator_Template();
        $this->FormAttrib->setTitle("inscripts");
          $this->FormAttrib->setId("inscripts");

        
$optionsidclassscool=$this->Selectclassscool();
$this->addElement("idclassscool",array(
            "type"=>"select"
            ,"list"=>$optionsidclassscool
            ,"options"=>array(
            "other"=>array(
                "placeholder"=>"idclassscool"
                ,"required"=>"required"
                ,"title"=>"idclassscool"
         )
        )
,"name"=>"idclassscool"
,"label"=>"idclassscool"
 ));


$optionsidpersonnes=$this->Selecteleves();
$this->addElement("idpersonnes",array(
            "type"=>"select"
            ,"list"=>$optionsidpersonnes
            ,"options"=>array(
            "other"=>array(
                "placeholder"=>"idpersonnes"
                ,"required"=>"required"
                ,"title"=>"idpersonnes"
         )
        )
,"name"=>"idpersonnes"
,"label"=>"idpersonnes"
 ));

$this->addElement("codeinscription",array(
            "type"=>"text"
            ,"options"=>array(
            "other"=>array(
            "min"=>0
            ,"max"=>"45"
            ,"placeholder"=>"codeinscription"
            ,"required"=>""
            ,"title"=>"codeinscription"
        )
    )
    ,"name"=>"codeinscription"
    ,"label"=>"codeinscription"
 ));


$this->addElement("anciens",array(
            "type"=>"text"
            ,"options"=>array(
            "other"=>array(
            "min"=>0
            ,"max"=>"4"
            ,"placeholder"=>"anciens"
            ,"required"=>""
            ,"title"=>"anciens"
        )
    )
    ,"name"=>"anciens"
    ,"label"=>"anciens"
 ));


$this->addElement("datechangementclass",array(
            "type"=>"date"
            ,"options"=>array(
            "other"=>array(
              "required"=>""
            ,"title"=>"datechangementclass"
        )
    )
    ,"name"=>"datechangementclass"
    ,"label"=>"datechangementclass"
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
    
public function Selectclassscool(){
    $options[""]="Selectionner";
    $Recclassscool=dbadapter::SelectSQL("SELECT * FROM classscool");
    foreach ($Recclassscool as $r){
        $options[$r['idclassscool']]=$r[1];

    }
    return $options;
}

public function Selecteleves(){
    $options[""]="Selectionner";
    $Receleves=dbadapter::SelectSQL("SELECT * FROM eleves");
    foreach ($Receleves as $r){
        $options[$r['idpersonnes']]=$r[1];

    }
    return $options;
}

}
