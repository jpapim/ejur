<?php

namespace Nivel\Table;

use Estrutura\Table\AbstractEstruturaTable;

class NivelTable extends AbstractEstruturaTable{

    public $table = 'nivel_dificuldade';
    public $campos = [
        'id_nivel_dificuldade'=>'id',
        'nm_nivel_dificuldade'=>'nm_nivel_dificuldade',
        
    ];

}