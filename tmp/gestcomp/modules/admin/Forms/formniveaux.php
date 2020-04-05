<?php
namespace blocapp\modules\admin\Forms;
use lib\Form\Form;
use lib\dbadapter;
class formniveaux extends Form
{

    public function __construct($nameform, \lib\Form\Elements $ElementForm = null, \lib\Form\FormStructer $FormData = Null)
    {
        parent::__construct($nameform, $ElementForm, $FormData);
        $this->setDecorator_Template();
        $this->FormAttrib->setTitle("niveaux");
          $this->FormAttrib->setId("niveaux");

        $this->addElement("nomarniveau",array(
            "type"=>"text"
            ,"options"=>array(
            "other"=>array(
            "min"=>0
            ,"max"=>"512"
            ,"placeholder"=>"nomarniveau"
            ,"required"=>""
            ,"title"=>"nomarniveau"
        )
    )
    ,"name"=>"nomarniveau"
    ,"label"=>"nomarniveau"
 ));



$optionsidsections=$this->Selectsections();
$this->addElement("idsections",array(
            "type"=>"select"
            ,"list"=>$optionsidsections
            ,"options"=>array(
            "other"=>array(
                "placeholder"=>"idsections"
                ,"required"=>"required"
                ,"title"=>"idsections"
         )
        )
,"name"=>"idsections"
,"label"=>"idsections"
 ));


$optionsidecole=$this->Selectecole();
$this->addElement("idecole",array(
            "type"=>"select"
            ,"list"=>$optionsidecole
            ,"options"=>array(
            "other"=>array(
                "placeholder"=>"idecole"
                ,"required"=>"required"
                ,"title"=>"idecole"
         )
        )
,"name"=>"idecole"
,"label"=>"idecole"
 ));

$this->addElement("nomfrniveau",array(
            "type"=>"text"
            ,"options"=>array(
            "other"=>array(
            "min"=>0
            ,"max"=>"512"
            ,"placeholder"=>"nomfrniveau"
            ,"required"=>""
            ,"title"=>"nomfrniveau"
        )
    )
    ,"name"=>"nomfrniveau"
    ,"label"=>"nomfrniveau"
 ));


$this->addElement("level",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"level"
        )
    )
    ,"name"=>"level"
    ,"label"=>"level"
));
$this->addElement("descniveau",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"descniveau"
        )
    )
    ,"name"=>"descniveau"
    ,"label"=>"descniveau"
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
    
public function Selectsections(){
    $options[""]="Selectionner";
    $Recsections=dbadapter::SelectSQL("SELECT * FROM sections");
    foreach ($Recsections as $r){
        $options[$r['idsections']]=$r[1];

    }
    return $options;
}

public function Selectecole(){
    $options[""]="Selectionner";
    $Rececole=dbadapter::SelectSQL("SELECT * FROM ecole");
    foreach ($Rececole as $r){
        $options[$r['idecole']]=$r[1];

    }
    return $options;
}

}
