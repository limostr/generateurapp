<?php
namespace blocapp\modules\admin\Forms;
use lib\Form\Form;
use lib\dbadapter;
class formeleves extends Form
{

    public function __construct($nameform, \lib\Form\Elements $ElementForm = null, \lib\Form\FormStructer $FormData = Null)
    {
        parent::__construct($nameform, $ElementForm, $FormData);
        $this->setDecorator_Template();
        $this->FormAttrib->setTitle("eleves");
          $this->FormAttrib->setId("eleves");

        
$optionsidpersonnes=$this->Selectpersonnes();
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

$this->addElement("iduniqueeleve",array(
            "type"=>"text"
            ,"options"=>array(
            "other"=>array(
            "min"=>0
            ,"max"=>"45"
            ,"placeholder"=>"iduniqueeleve"
            ,"required"=>""
            ,"title"=>"iduniqueeleve"
        )
    )
    ,"name"=>"iduniqueeleve"
    ,"label"=>"iduniqueeleve"
 ));


$this->addElement("remarqueeleve",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"remarqueeleve"
        )
    )
    ,"name"=>"remarqueeleve"
    ,"label"=>"remarqueeleve"
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
    
public function Selectpersonnes(){
    $options[""]="Selectionner";
    $Recpersonnes=dbadapter::SelectSQL("SELECT * FROM personnes");
    foreach ($Recpersonnes as $r){
        $options[$r['idpersonnes']]=$r[1];

    }
    return $options;
}

}
