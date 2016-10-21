<?php

namespace Prova\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class QuestaoAleatoriaForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('questaoprovaaleatoriaform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('questaoprovaaleatoriaform',$this,$this->inputFilter);
        $objForm->hidden("id")->required(false)->label("Id");  
        $objForm->hidden("id_usuario")->required(false)->label("Id Usuario");

        $objForm->combo("id_tipo_questao", '\TipoQuestao\Service\TipoQuestaoService','id','nm_tipo_questao')->required(true)->label("Tipo");
        $objForm->combo("id_fonte_questao", '\Fonte\Service\FonteService','id','nm_fonte_questao')->required(false)->label("Fonte da Questão");
        $objForm->select("id_materia", array(''=>'Selecione um Semestre...'))->required(false)->label("Materia");
        $objForm->select("id_assunto_materia", array(''=>'Selecione uma Matéria...'))->required(false)->label("Assunto");
        $objForm->combo("id_nivel_dificuldade", '\NivelDificuldade\Service\NivelDificuldadeService','id','nm_nivel_dificuldade')->required(false)->label("Nivel de Dificuldade");
        $objForm->combo("id_classificacao_semestre", '\Classificacao\Service\ClassificacaoService','id','nm_classificacao_semestre')->required(false)->label("Semestre");
        $objForm->integer("nr_questoes")->required(false)->label("Quantidade de Questoes");

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}