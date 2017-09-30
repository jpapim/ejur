<?php
/**
 * Created by PhpStorm.
 * User: EduFerr
 * Date: 27/09/2017
 * Time: 09:35
 */

namespace SubAssuntoMateria\Service;

use \SubAssuntoMateria\Entity\SubAssuntoMateriaEntity as Entity;

use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Stdlib\Hydrator\Reflection;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;


class SubAssuntoMateriaService extends Entity {

    public function getTiposToArray($id) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());
        #die($id);
        $select = $sql->select('sub_assunto_materia')
            ->where([
                'sub_assunto_materia.id_sub_assunto_materia = ?' => $id,
                'sub_assunto_materia.cs_ativo = 1',
            ]);
        return $sql->prepareStatementForSqlObject($select)->execute()->current();
    }

    public function getFiltrarTiposPorNomeToArray($nm_sub_assunto_materia) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());
        $select = $sql->select('sub_assunto_materia')
            ->columns(array('nm_sub_assunto_materia',) ) #Colunas a retornar. Basta Omitir que ele traz todas as colunas
            ->where([
                "sub_assunto_materia.id_sub_assunto_materia LIKE ?" => '%'.$nm_sub_assunto_materia.'%',
                'sub_assunto_materia.cs_ativo = 1',
            ]);
        return $sql->prepareStatementForSqlObject($select)->execute();
    }

    public function getIdTipoPorNomeToArray($nm_sub_assunto_materia) {

        $arNomeSubAssunto = explode('(', $nm_sub_assunto_materia);
        $nm_sub_assunto_materia = $arNomeSubAssunto[0];

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());
        $filter = new \Zend\Filter\StringTrim();
        $select = $sql->select('sub_assunto_materia')
            ->columns(array('id_sub_assunto_materia') )
            ->where([
                'sub_assunto_materia.id_sub_assunto_materia = ?' => $filter->filter($nm_sub_assunto_materia),
                'sub_assunto_materia.cs_ativo = 1',
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute()->current();
    }

    public function fetchPaginator($pagina = 1, $itensPagina = 5, $ordem = 'nm_sub_assunto_materia DESC', $like = null, $itensPaginacao = 5) {
        // preparar um select para tabela contato com uma ordem
        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());
        $select = $sql->select('sub_assunto_materia')->order($ordem);
        if (isset($like)) {
            $select
                ->where
                ->like('nm_sub_assunto_materia', "%{$like}%")
            ;
        }
        // criar um objeto com a estrutura desejada para armazenar valores
        $resultSet = new HydratingResultSet(new Reflection(), new \SubAssuntoMateria\Entity\SubAssuntoMateriaMateria());
        // criar um objeto adapter paginator
        $paginatorAdapter = new DbSelect(
        // nosso objeto select
            $select,
            // nosso adapter da tabela
            $this->getAdapter(),
            // nosso objeto base para ser populado
            $resultSet
        );
        # var_dump($paginatorAdapter);
        #die;
        // resultado da paginação
        return (new Paginator($paginatorAdapter))
            // pagina a ser buscada
            ->setCurrentPageNumber((int) $pagina)
            // quantidade de itens na p�gina
            ->setItemCountPerPage((int) $itensPagina)
            ->setPageRange((int) $itensPaginacao);
    }

    public function getSubAssuntoMateriaPaginator($filter = NULL, $camposFilter = NULL) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());
        $select = $sql->select('sub_assunto_materia')->columns([
            'id_sub_assunto_materia',
            'nm_sub_assunto_materia',

        ])
            ->join('assunto_materia', 'assunto_materia.id_assunto_materia = sub_assunto_materia.id_assunto_materia', [
                'nm_assunto_materia'
            ]);
        $where = ['sub_assunto_materia.cs_ativo = 1',
        ];
        if (!empty($filter)) {
            foreach ($filter as $key => $value) {
                if ($value) {
                    if (isset($camposFilter[$key]['mascara'])) {
                        eval("\$value = " . $camposFilter[$key]['mascara'] . ";");
                    }
                    $where[$camposFilter[$key]['filter']] = '%' . $value . '%';
                }
            }
        }
        $select->where($where)->order(['id_sub_assunto_materia DESC']);
        return new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\DbSelect($select, $this->getAdapter()));
    }

    public function filtraSubAssuntoAtivo()
    {
        $subAssuntoAtivo = $this->select(['cs_ativo'=> '1']);
        return $subAssuntoAtivo;
    }


}