<?php

namespace CadastroQuestao\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class CadastroQuestaoForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('cadastroquestaoform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('cadastroquestaoform',$this,$this->inputFilter);
        $objForm->hidden("id")->required(false)->label("Id");
        $objForm->combo("id_fonte_questao", '\CadastroQuestao\Service\CadastroQuestaoService','id','nm_fonte_questao')->required(false)->label("Selecionar a fonte");
        $objForm->combo("id_classificacao_semestre", '\CadastroQuestao\Service\CadastroQuestaoService','id','nm_classificacao_semestre')->required(false)->label("Selecione o semestre");
        $objForm->combo("id_nivel_dificuldade", '\CadastroQuestao\Service\CadastroQuestaoService','id','nm_nivel_dificuldade')->required(false)->label("Nivel de Dificuldade");
        $objForm->combo("id_temporizacao", '\CadastroQuestao\Service\CadastroQuestaoService','id','nm_temporizacao')->required(false)->label("Tempo");
        $objForm->combo("id_tipo_questao", '\TipoQuestao\Service\TipoQuestaoService','id','nm_tipo_questao')->required(false)->label("Tipo");
        $objForm->combo("id_assunto_materia", '\CadastroQuestao\Service\CadastroQuestaoService','id','nm_assunto_materia')->required(false)->label("Assunto");
        $objForm->text("tx_enunciado")->required(true)->label("Enunciado da Questão");
        $objForm->text("tx_caminho_imagem_questao")->required(true)->label("Alternativas para a Questão");
        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }}
