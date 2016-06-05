<?php

namespace Unidade\Table;

use Estrutura\Table\AbstractEstruturaTable;

class UnidadeTable extends AbstractEstruturaTable{

    public $table = 'unidade_tempo';
    public $campos = [
        'id_unidade_tempo'=>'id',
        'nm_unidade_tempo'=>'nm_unidade_tempo',
        
    ];

}