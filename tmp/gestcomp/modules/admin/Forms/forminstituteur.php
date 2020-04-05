<?php
namespace blocapp\modules\admin\Forms;
use lib\Form\Form;
use lib\dbadapter;
class forminstituteur extends Form
{

    public function __construct($nameform, \lib\Form\Elements $ElementForm = null, \lib\Form\FormStructer $FormData = Null)
    {
        parent::__construct($nameform, $ElementForm, $FormData);
        $this->setDecorator_Template();
        $this->FormAttrib->setTitle("instituteur");
          $this->FormAttrib->setId("instituteur");

        
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

$this->addElement("cin",array(
            "type"=>"text"
            ,"options"=>array(
            "other"=>array(
            "min"=>0
            ,"max"=>"8"
            ,"placeholder"=>"cin"
            ,"required"=>""
            ,"title"=>"cin"
        )
    )
    ,"name"=>"cin"
    ,"label"=>"cin"
 ));


$this->addElement("specilaiter",array(
            "type"=>"text"
            ,"options"=>array(
            "other"=>array(
            "min"=>0
            ,"max"=>"512"
            ,"placeholder"=>"specilaiter"
            ,"required"=>""
            ,"title"=>"specilaiter"
        )
    )
    ,"name"=>"specilaiter"
    ,"label"=>"specilaiter"
 ));


$this->addElement("daterecrutement",array(
            "type"=>"date"
            ,"options"=>array(
            "other"=>array(
              "required"=>""
            ,"title"=>"daterecrutement"
        )
    )
    ,"name"=>"daterecrutement"
    ,"label"=>"daterecrutement"
 ));


$this->addElement("diplome",array(
            "type"=>"text"
            ,"options"=>array(
            "other"=>array(
            "min"=>0
            ,"max"=>"512"
            ,"placeholder"=>"diplome"
            ,"required"=>""
            ,"title"=>"diplome"
        )
    )
    ,"name"=>"diplome"
    ,"label"=>"diplome"
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
