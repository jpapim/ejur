<?php

namespace Nivel\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class NivelForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('nivelform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('nivelform',$this,$this->inputFilter);
        $objForm->hidden("id")->required(false)->label("Id");  
        $objForm->text("nm_nivel_dificuldade")->required(false)->label("Nivel");  
      
       


        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}