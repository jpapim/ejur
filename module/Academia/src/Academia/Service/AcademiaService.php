<?php

namespace Academia\Service;

use \Academia\Entity\AcademiaEntity as Entity;
use Academia\Table\AcademiaTable;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Stdlib\Hydrator\Reflection;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;
class AcademiaService extends Entity{

    public function fetchAllCidade($params) {

        $resultSet = NULL;

        if (isset($params['id_cidade']) && $params['id_cidade']) {

            $resultSet = $this->select(
                [
                    'academias.id_cidade = ? ' => $params['id_cidade']
                ]
            );
        }
        return $resultSet;
    }

    public function getAcademiaToArray($id) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('academias')
            ->where([
                'academias.id_academia = ?' => $id,
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute()->current();
    }

    public function getFiltrarAcademiaPorNomeToArray($nm_academia) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('academias')
            ->columns(array('nm_academia', 'id_cidade') ) #Colunas a retornar. Basta Omitir que ele traz todas as colunas
            ->where([
                "academias.nm_academia LIKE ?" => '%'.$nm_academia.'%',
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute();
    }

    public function getIdAcademiaPorNomeToArray($nm_academia) {

        $arNomeAcademia = explode('(', $nm_academia);
        $nm_academia = $arNomeAcademia[0];

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());
        $filter = new \Zend\Filter\StringTrim();
        $select = $sql->select('academias')
            ->columns(array('id_academia') )
            ->where([
                'academias.nm_academia = ?' => $filter->filter($nm_academia),
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute()->current();
    }





     /**
     * Localizar itens por pagina��o
     *
     * @param type $pagina
     * @param type $itensPagina
     * @param type $ordem
     * @param type $like
     * @param type $itensPaginacao
     * @return type Paginator
     */
    public function fetchPaginator($pagina = 1, $itensPagina = 5, $ordem = 'nm_academia ASC', $like = null, $itensPaginacao = 5) {
        //http://igorrocha.com.br/tutorial-zf2-parte-9-paginacao-busca-e-listagem/4/
        // preparar um select para tabela contato com uma ordem
        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());
        $select = $sql->select('academias')->order($ordem);

        if (isset($like)) {
            $select
                    ->where
                    ->like('id_academia', "%{$like}%")
                    ->or
                    ->like('nm_academia', "%{$like}%")
            #->or
            #->like('telefone_principal', "%{$like}%")
            #->or
            #->like('data_criacao', "%{$like}%")
            ;
        }





 // criar um objeto com a estrutura desejada para armazenar valores
        $resultSet = new HydratingResultSet(new Reflection(), new \Academia\Entity\AtletaEntity());

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
        // resultado da pagina��o
        return (new Paginator($paginatorAdapter))
                        // pagina a ser buscada
                        ->setCurrentPageNumber((int) $pagina)
                        // quantidade de itens na p�gina
                        ->setItemCountPerPage((int) $itensPagina)
                        ->setPageRange((int) $itensPaginacao);
    }



     /**
     * 
     * @param type $dtInicio
     * @param type $dtFim
     * @return type
     */
    public function getAcademiasPaginator($filter = NULL, $camposFilter = NULL) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('academias')->columns([
                    'id_academia',
                    'nm_academia',
                    
                ])
                ->join('cidade', 'cidade.id_cidade = academias.id_cidade', [
                    'nm_cidade'
                ])
                ->join('estado', 'estado.id_estado = cidade.id_estado', [
                    'sg_estado'
                ]);               
               

        $where = [
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

        $select->where($where)->order(['nm_academia DESC']);

        return new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\DbSelect($select, $this->getAdapter()));
    }


}