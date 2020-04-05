<?php
namespace blocapp\modules\pedagogie\Forms;
use lib\Form\Form;
use lib\dbadapter;
class formcontenucours extends Form
{

    public function __construct($nameform, \lib\Form\Elements $ElementForm = null, \lib\Form\FormStructer $FormData = Null)
    {
        parent::__construct($nameform, $ElementForm, $FormData);
        $this->setDecorator_Template();
        $this->FormAttrib->setTitle("contenucours");
          $this->FormAttrib->setId("contenucours");

        $this->addElement("nomarcontenucours",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"nomarcontenucours"
        )
    )
    ,"name"=>"nomarcontenucours"
    ,"label"=>"nomarcontenucours"
));

$optionsidmatiere=$this->Selectmatiere();
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

$this->addElement("idperecontenucours",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"idperecontenucours"
        )
    )
    ,"name"=>"idperecontenucours"
    ,"label"=>"idperecontenucours"
));
$this->addElement("nomfrcontenucours",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"nomfrcontenucours"
        )
    )
    ,"name"=>"nomfrcontenucours"
    ,"label"=>"nomfrcontenucours"
));
$this->addElement("descarcontenue",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"descarcontenue"
        )
    )
    ,"name"=>"descarcontenue"
    ,"label"=>"descarcontenue"
));
$this->addElement("descfrcontenue",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"descfrcontenue"
        )
    )
    ,"name"=>"descfrcontenue"
    ,"label"=>"descfrcontenue"
));
$this->addElement("remarquear",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"remarquear"
        )
    )
    ,"name"=>"remarquear"
    ,"label"=>"remarquear"
));
$this->addElement("remarquefr",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"remarquefr"
        )
    )
    ,"name"=>"remarquefr"
    ,"label"=>"remarquefr"
));
$this->addElement("archiver",array(
            "type"=>"text"
            ,"options"=>array(
            "other"=>array(
            "min"=>0
            ,"max"=>"4"
            ,"placeholder"=>"archiver"
            ,"required"=>""
            ,"title"=>"archiver"
        )
    )
    ,"name"=>"archiver"
    ,"label"=>"archiver"
 ));


$this->addElement("datearchiver",array(
            "type"=>"date"
            ,"options"=>array(
            "other"=>array(
              "required"=>""
            ,"title"=>"datearchiver"
        )
    )
    ,"name"=>"datearchiver"
    ,"label"=>"datearchiver"
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
    
public function Selectmatiere(){
    $options[""]="Selectionner";
    $Recmatiere=dbadapter::SelectSQL("SELECT * FROM matiere");
    foreach ($Recmatiere as $r){
        $options[$r['idmatiere']]=$r[1];

    }
    return $options;
}

}
