<?php
namespace blocapp\modules\pedagogie\Forms;
use lib\Form\Form;
use lib\dbadapter;
class formepreuves extends Form
{

    public function __construct($nameform, \lib\Form\Elements $ElementForm = null, \lib\Form\FormStructer $FormData = Null)
    {
        parent::__construct($nameform, $ElementForm, $FormData);
        $this->setDecorator_Template();
        $this->FormAttrib->setTitle("epreuves");
          $this->FormAttrib->setId("epreuves");

        $this->addElement("titreexam",array(
            "type"=>"text"
            ,"options"=>array(
            "other"=>array(
            "min"=>0
            ,"max"=>"45"
            ,"placeholder"=>"titreexam"
            ,"required"=>""
            ,"title"=>"titreexam"
        )
    )
    ,"name"=>"titreexam"
    ,"label"=>"titreexam"
 ));



$optionsclassscool=$this->Selectassurercours();
$this->addElement("classscool",array(
            "type"=>"select"
            ,"list"=>$optionsclassscool
            ,"options"=>array(
            "other"=>array(
                "placeholder"=>"classscool"
                ,"required"=>"required"
                ,"title"=>"classscool"
         )
        )
,"name"=>"classscool"
,"label"=>"classscool"
 ));


$optionsidmatiere=$this->Selectassurercours();
$this->addElement("idmatiere",array(
            "type"=>"select"
            ,"list"=>$optionsidmatiere
            ,"options"=>array(
            "other"=>array(
                "placeholder"=>"idmatiere"
                ,"required"=>"required"
                ,"title"=>"idmatiere"
         )
        )
,"name"=>"idmatiere"
,"label"=>"idmatiere"
 ));


$optionsidpersonnes=$this->Selectassurercours();
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

$this->addElement("descexam",array(
            "type"=>"text"
            ,"options"=>array(
            "other"=>array(
            "min"=>0
            ,"max"=>"45"
            ,"placeholder"=>"descexam"
            ,"required"=>""
            ,"title"=>"descexam"
        )
    )
    ,"name"=>"descexam"
    ,"label"=>"descexam"
 ));


$this->addElement("datepassage",array(
            "type"=>"date"
            ,"options"=>array(
            "other"=>array(
              "required"=>""
            ,"title"=>"datepassage"
        )
    )
    ,"name"=>"datepassage"
    ,"label"=>"datepassage"
 ));


$this->addElement("periode",array(
            "type"=>"text"
            ,"options"=>array(
            "other"=>array(
            "min"=>0
            ,"max"=>""
            ,"placeholder"=>"periode"
            ,"required"=>""
            ,"title"=>"periode"
        )
    )
    ,"name"=>"periode"
    ,"label"=>"periode"
 ));


$this->addElement("baremexam",array(
            "type"=>"text"
            ,"options"=>array(
            "other"=>array(
            "min"=>0
            ,"max"=>""
            ,"placeholder"=>"baremexam"
            ,"required"=>""
            ,"title"=>"baremexam"
        )
    )
    ,"name"=>"baremexam"
    ,"label"=>"baremexam"
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
    
public function Selectassurercours(){
    $options[""]="Selectionner";
    $Recassurercours=dbadapter::SelectSQL("SELECT * FROM assurercours");
    foreach ($Recassurercours as $r){
        $options[$r['idclassscool']]=$r[1];

    }
    return $options;
}

public function Selectassurercours(){
    $options[""]="Selectionner";
    $Recassurercours=dbadapter::SelectSQL("SELECT * FROM assurercours");
    foreach ($Recassurercours as $r){
        $options[$r['idmatiere']]=$r[1];

    }
    return $options;
}

public function Selectassurercours(){
    $options[""]="Selectionner";
    $Recassurercours=dbadapter::SelectSQL("SELECT * FROM assurercours");
    foreach ($Recassurercours as $r){
        $options[$r['idpersonnes']]=$r[1];

    }
    return $options;
}

}
