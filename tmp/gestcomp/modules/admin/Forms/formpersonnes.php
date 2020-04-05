<?php
namespace blocapp\modules\admin\Forms;
use lib\Form\Form;
use lib\dbadapter;
class formpersonnes extends Form
{

    public function __construct($nameform, \lib\Form\Elements $ElementForm = null, \lib\Form\FormStructer $FormData = Null)
    {
        parent::__construct($nameform, $ElementForm, $FormData);
        $this->setDecorator_Template();
        $this->FormAttrib->setTitle("personnes");
          $this->FormAttrib->setId("personnes");

        $this->addElement("nomar",array(
            "type"=>"text"
            ,"options"=>array(
            "other"=>array(
            "min"=>0
            ,"max"=>"45"
            ,"placeholder"=>"nomar"
            ,"required"=>""
            ,"title"=>"nomar"
        )
    )
    ,"name"=>"nomar"
    ,"label"=>"nomar"
 ));


$this->addElement("prenomar",array(
            "type"=>"text"
            ,"options"=>array(
            "other"=>array(
            "min"=>0
            ,"max"=>"45"
            ,"placeholder"=>"prenomar"
            ,"required"=>""
            ,"title"=>"prenomar"
        )
    )
    ,"name"=>"prenomar"
    ,"label"=>"prenomar"
 ));


$this->addElement("nomfr",array(
            "type"=>"text"
            ,"options"=>array(
            "other"=>array(
            "min"=>0
            ,"max"=>"45"
            ,"placeholder"=>"nomfr"
            ,"required"=>""
            ,"title"=>"nomfr"
        )
    )
    ,"name"=>"nomfr"
    ,"label"=>"nomfr"
 ));


$this->addElement("prenomfr",array(
            "type"=>"text"
            ,"options"=>array(
            "other"=>array(
            "min"=>0
            ,"max"=>"45"
            ,"placeholder"=>"prenomfr"
            ,"required"=>""
            ,"title"=>"prenomfr"
        )
    )
    ,"name"=>"prenomfr"
    ,"label"=>"prenomfr"
 ));


$this->addElement("datenaissance",array(
            "type"=>"date"
            ,"options"=>array(
            "other"=>array(
              "required"=>""
            ,"title"=>"datenaissance"
        )
    )
    ,"name"=>"datenaissance"
    ,"label"=>"datenaissance"
 ));


$this->addElement("lieunaissance",array(
            "type"=>"text"
            ,"options"=>array(
            "other"=>array(
            "min"=>0
            ,"max"=>"45"
            ,"placeholder"=>"lieunaissance"
            ,"required"=>""
            ,"title"=>"lieunaissance"
        )
    )
    ,"name"=>"lieunaissance"
    ,"label"=>"lieunaissance"
 ));


$this->addElement("lieunaissancear",array(
            "type"=>"text"
            ,"options"=>array(
            "other"=>array(
            "min"=>0
            ,"max"=>"45"
            ,"placeholder"=>"lieunaissancear"
            ,"required"=>""
            ,"title"=>"lieunaissancear"
        )
    )
    ,"name"=>"lieunaissancear"
    ,"label"=>"lieunaissancear"
 ));


$this->addElement("adressar",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"adressar"
        )
    )
    ,"name"=>"adressar"
    ,"label"=>"adressar"
));
$this->addElement("adressfr",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"adressfr"
        )
    )
    ,"name"=>"adressfr"
    ,"label"=>"adressfr"
));
$this->addElement("telephone",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"telephone"
        )
    )
    ,"name"=>"telephone"
    ,"label"=>"telephone"
));
$this->addElement("pwd",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"pwd"
        )
    )
    ,"name"=>"pwd"
    ,"label"=>"pwd"
));
$this->addElement("login",array(
            "type"=>"text"
            ,"options"=>array(
            "other"=>array(
            "min"=>0
            ,"max"=>"512"
            ,"placeholder"=>"login"
            ,"required"=>""
            ,"title"=>"login"
        )
    )
    ,"name"=>"login"
    ,"label"=>"login"
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
    

}
