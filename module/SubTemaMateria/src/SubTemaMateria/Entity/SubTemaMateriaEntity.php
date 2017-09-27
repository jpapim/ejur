<?php
/**
 * Created by PhpStorm.
 * User: EduFerr
 * Date: 27/09/2017
 * Time: 09:35
 */

namespace SubTemaMateria\Entity;

use Estrutura\Service\AbstractEstruturaService;

class SubTemaMateriaEntity extends AbstractEstruturaService{

    protected $id;
    protected $id_assunto_materia;
    protected $nm_sub_tema_materia;
    protected $cs_ativo;
}