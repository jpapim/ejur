<?php
/**
 * Created by PhpStorm.
 * User: EduFerr
 * Date: 27/09/2017
 * Time: 09:34
 */

namespace SubAssuntoMateria\Table;

use Estrutura\Table\AbstractEstruturaTable;

class SubAssuntoMateriaTable extends AbstractEstruturaTable{

    public $table = 'sub_assunto_materia';
    public $campos = [
        'id_sub_assunto_materia'=>'id',
        'id_assunto_materia'=> 'id_assunto_materia',
        'nm_sub_assunto_materia'=>'nm_sub_assunto_materia',
        'cs_ativo'=>'cs_ativo',


    ];

}