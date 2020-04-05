<?php
namespace blocapp\modules\pedagogie\Forms;
use lib\Form\Form;
use lib\dbadapter;
class formactiviter extends Form
{

    public function __construct($nameform, \lib\Form\Elements $ElementForm = null, \lib\Form\FormStructer $FormData = Null)
    {
        parent::__construct($nameform, $ElementForm, $FormData);
        $this->setDecorator_Template();
        $this->FormAttrib->setTitle("activiter");
          $this->FormAttrib->setId("activiter");

        $this->addElement("idcompetences",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>"required"
        ,"title"=>"idcompetences"
        )
    )
    ,"name"=>"idcompetences"
    ,"label"=>"idcompetences"
));
$this->addElement("labelactiviter",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"labelactiviter"
        )
    )
    ,"name"=>"labelactiviter"
    ,"label"=>"labelactiviter"
));
$this->addElement("descactiviter",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"descactiviter"
        )
    )
    ,"name"=>"descactiviter"
    ,"label"=>"descactiviter"
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
