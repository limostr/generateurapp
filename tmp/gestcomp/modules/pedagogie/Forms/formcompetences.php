<?php
namespace blocapp\modules\pedagogie\Forms;
use lib\Form\Form;
use lib\dbadapter;
class formcompetences extends Form
{

    public function __construct($nameform, \lib\Form\Elements $ElementForm = null, \lib\Form\FormStructer $FormData = Null)
    {
        parent::__construct($nameform, $ElementForm, $FormData);
        $this->setDecorator_Template();
        $this->FormAttrib->setTitle("competences");
          $this->FormAttrib->setId("competences");

        $this->addElement("idpercompetences",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"idpercompetences"
        )
    )
    ,"name"=>"idpercompetences"
    ,"label"=>"idpercompetences"
));
$this->addElement("idmatiere",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>"required"
        ,"title"=>"idmatiere"
        )
    )
    ,"name"=>"idmatiere"
    ,"label"=>"idmatiere"
));
$this->addElement("labelarcomp",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"labelarcomp"
        )
    )
    ,"name"=>"labelarcomp"
    ,"label"=>"labelarcomp"
));
$this->addElement("labelfrcomp",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"labelfrcomp"
        )
    )
    ,"name"=>"labelfrcomp"
    ,"label"=>"labelfrcomp"
));
$this->addElement("desccomp",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"desccomp"
        )
    )
    ,"name"=>"desccomp"
    ,"label"=>"desccomp"
));
$this->addElement("remarquecomp",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"remarquecomp"
        )
    )
    ,"name"=>"remarquecomp"
    ,"label"=>"remarquecomp"
));
$this->addElement("remarquearcomp",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"remarquearcomp"
        )
    )
    ,"name"=>"remarquearcomp"
    ,"label"=>"remarquearcomp"
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
