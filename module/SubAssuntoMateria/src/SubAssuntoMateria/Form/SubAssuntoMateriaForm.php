<?php
/**
 * Created by PhpStorm.
 * User: EduFerr
 * Date: 27/09/2017
 * Time: 09:35
 */

namespace SubAssuntoMateria\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class SubAssuntoMateriaForm extends AbstractForm{

    public function __construct($options=[]){
        parent::__construct('subassuntomateriaform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('subassuntomateriaform',$this,$this->inputFilter);
        $objForm->hidden("id")->required(false)->label("Id");
        $objForm->combo("id_assunto_materia", '\AssuntoMateria\Service\AssuntoMateriaService', 'id', 'nm_assunto_materia')->required(true)->label("Tema");
        $objForm->text("nm_sub_assunto_materia")->required(true)->label("SubTema");

        $this->formObject = $objForm;    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }


}