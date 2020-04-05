<?php
namespace blocapp\modules\admin\Forms;
use lib\Form\Form;
use lib\dbadapter;
class formecole extends Form
{

    public function __construct($nameform, \lib\Form\Elements $ElementForm = null, \lib\Form\FormStructer $FormData = Null)
    {
        parent::__construct($nameform, $ElementForm, $FormData);
        $this->setDecorator_Template();
        $this->FormAttrib->setTitle("ecole");
          $this->FormAttrib->setId("ecole");

        $this->addElement("nomecolear",array(
            "type"=>"text"
            ,"options"=>array(
            "other"=>array(
            "min"=>0
            ,"max"=>"512"
            ,"placeholder"=>"nomecolear"
            ,"required"=>""
            ,"title"=>"nomecolear"
        )
    )
    ,"name"=>"nomecolear"
    ,"label"=>"nomecolear"
 ));



$optionsidcentraleregional=$this->Selectcentraleregional();
$this->addElement("idcentraleregional",array(
            "type"=>"select"
            ,"list"=>$optionsidcentraleregional
            ,"options"=>array(
            "other"=>array(
                "placeholder"=>"idcentraleregional"
                ,"required"=>"required"
                ,"title"=>"idcentraleregional"
         )
        )
,"name"=>"idcentraleregional"
,"label"=>"idcentraleregional"
 ));

$this->addElement("nomecolefr",array(
            "type"=>"text"
            ,"options"=>array(
            "other"=>array(
            "min"=>0
            ,"max"=>"512"
            ,"placeholder"=>"nomecolefr"
            ,"required"=>""
            ,"title"=>"nomecolefr"
        )
    )
    ,"name"=>"nomecolefr"
    ,"label"=>"nomecolefr"
 ));


$this->addElement("adressecolear",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"adressecolear"
        )
    )
    ,"name"=>"adressecolear"
    ,"label"=>"adressecolear"
));
$this->addElement("adressecolefr",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"adressecolefr"
        )
    )
    ,"name"=>"adressecolefr"
    ,"label"=>"adressecolefr"
));
$this->addElement("autreinfo",array(
    "type"=>"textarea"
    ,"options"=>array(
        "other"=>array(
        "rows"=>3
        ,"cols"=>50
        ,"required"=>""
        ,"title"=>"autreinfo"
        )
    )
    ,"name"=>"autreinfo"
    ,"label"=>"autreinfo"
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
    
public function Selectcentraleregional(){
    $options[""]="Selectionner";
    $Reccentraleregional=dbadapter::SelectSQL("SELECT * FROM centraleregional");
    foreach ($Reccentraleregional as $r){
        $options[$r['idcentraleregional']]=$r[1];

    }
    return $options;
}

}
