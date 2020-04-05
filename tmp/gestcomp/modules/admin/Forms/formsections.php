<?php
namespace blocapp\modules\admin\Forms;
use lib\Form\Form;
use lib\dbadapter;
class formsections extends Form
{

    public function __construct($nameform, \lib\Form\Elements $ElementForm = null, \lib\Form\FormStructer $FormData = Null)
    {
        parent::__construct($nameform, $ElementForm, $FormData);
        $this->setDecorator_Template();
        $this->FormAttrib->setTitle("sections");
          $this->FormAttrib->setId("sections");

        $this->addElement("nomsectionar",array(
            "type"=>"text"
            ,"options"=>array(
            "other"=>array(
            "min"=>0
            ,"max"=>"512"
            ,"placeholder"=>"nomsectionar"
            ,"required"=>""
            ,"title"=>"nomsectionar"
        )
    )
    ,"name"=>"nomsectionar"
    ,"label"=>"nomsectionar"
 ));


$this->addElement("nomsectionfr",array(
            "type"=>"text"
            ,"options"=>array(
            "other"=>array(
            "min"=>0
            ,"max"=>"512"
            ,"placeholder"=>"nomsectionfr"
            ,"required"=>""
            ,"title"=>"nomsectionfr"
        )
    )
    ,"name"=>"nomsectionfr"
    ,"label"=>"nomsectionfr"
 ));


$this->addElement("descsection",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"descsection"
        )
    )
    ,"name"=>"descsection"
    ,"label"=>"descsection"
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
