<?php
namespace blocapp\modules\pedagogie\Forms;
use lib\Form\Form;
use lib\dbadapter;
class formactiviterressources extends Form
{

    public function __construct($nameform, \lib\Form\Elements $ElementForm = null, \lib\Form\FormStructer $FormData = Null)
    {
        parent::__construct($nameform, $ElementForm, $FormData);
        $this->setDecorator_Template();
        $this->FormAttrib->setTitle("activiterressources");
          $this->FormAttrib->setId("activiterressources");

        
$optionsidactiviter=$this->Selectactiviter();
$this->addElement("idactiviter",array(
            "type"=>"select"
            ,"list"=>$optionsidactiviter
            ,"options"=>array(
            "other"=>array(
                "placeholder"=>"idactiviter"
                ,"required"=>"required"
                ,"title"=>"idactiviter"
         )
        )
,"name"=>"idactiviter"
,"label"=>"idactiviter"
 ));


$optionsidressources=$this->Selectressources();
$this->addElement("idressources",array(
            "type"=>"select"
            ,"list"=>$optionsidressources
            ,"options"=>array(
            "other"=>array(
                "placeholder"=>"idressources"
                ,"required"=>"required"
                ,"title"=>"idressources"
         )
        )
,"name"=>"idressources"
,"label"=>"idressources"
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
    
public function Selectactiviter(){
    $options[""]="Selectionner";
    $Recactiviter=dbadapter::SelectSQL("SELECT * FROM activiter");
    foreach ($Recactiviter as $r){
        $options[$r['idactiviter']]=$r[1];

    }
    return $options;
}

public function Selectressources(){
    $options[""]="Selectionner";
    $Recressources=dbadapter::SelectSQL("SELECT * FROM ressources");
    foreach ($Recressources as $r){
        $options[$r['idressources']]=$r[1];

    }
    return $options;
}

}
