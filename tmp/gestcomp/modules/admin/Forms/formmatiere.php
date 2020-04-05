<?php
namespace blocapp\modules\admin\Forms;
use lib\Form\Form;
use lib\dbadapter;
class formmatiere extends Form
{

    public function __construct($nameform, \lib\Form\Elements $ElementForm = null, \lib\Form\FormStructer $FormData = Null)
    {
        parent::__construct($nameform, $ElementForm, $FormData);
        $this->setDecorator_Template();
        $this->FormAttrib->setTitle("matiere");
          $this->FormAttrib->setId("matiere");

        
$optionsidperiode=$this->Selectperiode();
$this->addElement("idperiode",array(
            "type"=>"select"
            ,"list"=>$optionsidperiode
            ,"options"=>array(
            "other"=>array(
                "placeholder"=>"idperiode"
                ,"required"=>"required"
                ,"title"=>"idperiode"
         )
        )
,"name"=>"idperiode"
,"label"=>"idperiode"
 ));


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

$this->addElement("titrearmatiere",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"titrearmatiere"
        )
    )
    ,"name"=>"titrearmatiere"
    ,"label"=>"titrearmatiere"
));
$this->addElement("descriptionar",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"descriptionar"
        )
    )
    ,"name"=>"descriptionar"
    ,"label"=>"descriptionar"
));
$this->addElement("descriptionfr",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"descriptionfr"
        )
    )
    ,"name"=>"descriptionfr"
    ,"label"=>"descriptionfr"
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
    
public function Selectperiode(){
    $options[""]="Selectionner";
    $Recperiode=dbadapter::SelectSQL("SELECT * FROM periode");
    foreach ($Recperiode as $r){
        $options[$r['idperiode']]=$r[1];

    }
    return $options;
}

public function Selectniveaux(){
    $options[""]="Selectionner";
    $Recniveaux=dbadapter::SelectSQL("SELECT * FROM niveaux");
    foreach ($Recniveaux as $r){
        $options[$r['idniveaux']]=$r[1];

    }
    return $options;
}

}
