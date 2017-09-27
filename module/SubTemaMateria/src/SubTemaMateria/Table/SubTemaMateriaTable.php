<?php
/**
 * Created by PhpStorm.
 * User: EduFerr
 * Date: 27/09/2017
 * Time: 09:34
 */

namespace SubTemaMateria\Table;

use Estrutura\Table\AbstractEstruturaTable;

class SubTemaMateriaTable extends AbstractEstruturaTable{

    public $table = 'id_sub_tema_materia';
    public $campos = [
        'id_sub_tema_materia'=>'id',
        'id_assunto_materia'=> 'id_assunto_materia',
        'nm_sub_tema_materia'=>'nm_sub_tema_materia',
        'cs_ativo'=>'cs_ativo',


    ];

}