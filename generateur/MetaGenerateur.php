<?php
/**
 * Created by PhpStorm.
 * User: username
 * Date: 12/12/2018
 * Time: 13:40
 */

namespace generateur;


class MetaGenerateur
{
    public $_Template;

    public $code="";
    public $titre="";

    public $pathFile="";

    public $Models="";

    public function __construct($Template)
    {
        $this->_Template=$Template;
        $this->LoadingTemplate();
    }

    public function LoadingTemplate(){
        $file=dirname(__FILE__)."/view/".$this->_Template;
        if(file_exists($file)){
            return file_get_contents($file);
        }else{
            return false;
        }

    }
}