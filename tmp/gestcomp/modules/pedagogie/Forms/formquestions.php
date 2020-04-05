<?php
namespace blocapp\modules\pedagogie\Forms;
use lib\Form\Form;
use lib\dbadapter;
class formquestions extends Form
{

    public function __construct($nameform, \lib\Form\Elements $ElementForm = null, \lib\Form\FormStructer $FormData = Null)
    {
        parent::__construct($nameform, $ElementForm, $FormData);
        $this->setDecorator_Template();
        $this->FormAttrib->setTitle("questions");
          $this->FormAttrib->setId("questions");

        $this->addElement("labelquestions",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"labelquestions"
        )
    )
    ,"name"=>"labelquestions"
    ,"label"=>"labelquestions"
));

$optionsidepreuves=$this->Selectepreuves();
$this->addElement("idepreuves",array(
            "type"=>"select"
            ,"list"=>$optionsidepreuves
            ,"options"=>array(
            "other"=>array(
                "placeholder"=>"idepreuves"
                ,"required"=>"required"
                ,"title"=>"idepreuves"
         )
        )
,"name"=>"idepreuves"
,"label"=>"idepreuves"
 ));

$this->addElement("contextquestion",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"contextquestion"
        )
    )
    ,"name"=>"contextquestion"
    ,"label"=>"contextquestion"
));
$this->addElement("barem",array(
            "type"=>"text"
            ,"options"=>array(
            "other"=>array(
            "min"=>0
            ,"max"=>""
            ,"placeholder"=>"barem"
            ,"required"=>""
            ,"title"=>"barem"
        )
    )
    ,"name"=>"barem"
    ,"label"=>"barem"
 ));


$this->addElement("descquestion",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"descquestion"
        )
    )
    ,"name"=>"descquestion"
    ,"label"=>"descquestion"
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
    
public function Selectepreuves(){
    $options[""]="Selectionner";
    $Recepreuves=dbadapter::SelectSQL("SELECT * FROM epreuves");
    foreach ($Recepreuves as $r){
        $options[$r['idepreuves']]=$r[1];

    }
    return $options;
}

}
