<?php

namespace CadastroQuestao\Table;

use Estrutura\Table\AbstractEstruturaTable;

class CadastroQuestaoTable extends AbstractEstruturaTable{

    public $table = 'questao';
    public $campos = [
        'id_questao'=>'id',
        'id_usuario_cadastro'=>'id_usuario_cadastro',
        'id_usuario_alteracao'=>'id_usuario_alteracao',
        'id_classificacao_semestre'=>'id_classificacao_semestre',
        'id_nivel_dificuldade'=>'id_nivel_dificuldade',
        'id_temporizacao'=> 'id_temporizacao',
        'id_tipo_questao'=>'id_tipo_questao',
        'id_fonte_questao'=>'id_fonte_questao',
        'id_assunto_materia'=>'id_assunto_materia',
        'tx_enunciado'=>'id_enunciado',
        'tx_caminho_imagem_questao'=>'tx_caminho_imagem_questao',
    ];

}