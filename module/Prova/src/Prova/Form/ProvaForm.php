<?php

namespace Prova\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class ProvaForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('provaform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('provaform',$this,$this->inputFilter);
        $objForm->hidden("id")->required(false)->label("Id");  
        $objForm->hidden("id_usuario")->required(false)->label("Id Usuario");  
        $objForm->text("nm_prova")->required(false)->label("Prova");  
        $objForm->text("ds_prova")->required(false)->label("descrição");
        $objForm->date("dt_geracao_prova")->required(true)->setAttribute('class', 'data')->label("Data de geraçao da prova");
        $objForm->date("dt_aplicacao_prova")->required(true)->setAttribute('class', 'data')->label("Data de aplicação da prova");
       


        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}