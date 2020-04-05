<?php
namespace blocapp\modules\admin\Forms;
use lib\Form\Form;
use lib\dbadapter;
class formcentraleregional extends Form
{

    public function __construct($nameform, \lib\Form\Elements $ElementForm = null, \lib\Form\FormStructer $FormData = Null)
    {
        parent::__construct($nameform, $ElementForm, $FormData);
        $this->setDecorator_Template();
        $this->FormAttrib->setTitle("centraleregional");
          $this->FormAttrib->setId("centraleregional");

        $this->addElement("nomar",array(
            "type"=>"text"
            ,"options"=>array(
            "other"=>array(
            "min"=>0
            ,"max"=>"512"
            ,"placeholder"=>"nomar"
            ,"required"=>""
            ,"title"=>"nomar"
        )
    )
    ,"name"=>"nomar"
    ,"label"=>"nomar"
 ));


$this->addElement("nomfr",array(
            "type"=>"text"
            ,"options"=>array(
            "other"=>array(
            "min"=>0
            ,"max"=>"512"
            ,"placeholder"=>"nomfr"
            ,"required"=>""
            ,"title"=>"nomfr"
        )
    )
    ,"name"=>"nomfr"
    ,"label"=>"nomfr"
 ));


$this->addElement("adress",array(
            "type"=>"text"
            ,"options"=>array(
            "other"=>array(
            "min"=>0
            ,"max"=>"512"
            ,"placeholder"=>"adress"
            ,"required"=>""
            ,"title"=>"adress"
        )
    )
    ,"name"=>"adress"
    ,"label"=>"adress"
 ));


$this->addElement("autreinforegional",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"autreinforegional"
        )
    )
    ,"name"=>"autreinforegional"
    ,"label"=>"autreinforegional"
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
