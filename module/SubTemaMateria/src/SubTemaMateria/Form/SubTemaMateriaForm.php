<?php
/**
 * Created by PhpStorm.
 * User: EduFerr
 * Date: 27/09/2017
 * Time: 09:35
 */

namespace SubTemaMateria\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class SubTemaMateriaForm extends AbstractForm{

    public function __construct($options=[]){
        parent::__construct('subtemamateriaform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('subtemamateriaform',$this,$this->inputFilter);
        $objForm->hidden("id")->required(false)->label("Id");
        $objForm->combo("id_assunto_materia", '\AssuntoMateria\Service\AssuntoMateriaService', 'id', 'nm_assunto_materia')->required(true)->label("Assunto");
        $objForm->text("nm_sub_tema_materia")->required(true)->label("SubTema");

        $this->formObject = $objForm;    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }


}