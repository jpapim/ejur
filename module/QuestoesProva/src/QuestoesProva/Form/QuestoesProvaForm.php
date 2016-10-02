<?php

namespace QuestoesProva\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class QuestoesProvaForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('questoesprovaform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('questoesprovaform',$this,$this->inputFilter);

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}