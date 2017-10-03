<?php

namespace FiltroProva\Service;

use \FiltroProva\Entity\FiltroProvaEntity as Entity;

class FiltroProvaService extends Entity{

    //Funções copiadas do sistema Catequese, módulo=>GrauParentesco

    //buscando id do filtro
    public function getFiltroToArray($id) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        #die($id);
        $select = $sql->select('filtro_prova')
            ->where([
                'filtro_prova.id_filtro_prova = ?' => $id,
                'filtro_prova.cs_ativo=1',
            ]);
        #print_r($sql->prepareStatementForSqlObject($select)->execute());exit;

        return $sql->prepareStatementForSqlObject($select)->execute()->current();
    }

    public function getFiltrosProvaToArray($id){

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        #die($id);
        $select = $sql->select('filtro_prova')
            ->where([
                'filtro_prova.id_filtro_prova = ?' => $id,
                'filtro_prova.id_prova = ?' => $id_prova,
                'filtro_prova.id_tipo_questao = ?' => $id_tipo_questao,
                'filtro_prova.id_fonte_questao = ?' => $id_fonte_questao,
                'filtro_prova.id_assunto_materia = ?' => $id_fonte_questao,
                'filtro_prova.id_nivel_dificuldade = ?' => $id_nivel_dificuldade,
                'filtro_prova.id_classificacao_semestre = ?' => $id_classificacao_semestre,
                'filtro_prova.nr_questoes = ?' => $nr_questoes,
                'filtro_prova.nm_filtro_prova = ?' => $nm_filtro_prova,
                'filtro_prova.cs_ativo=1',
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute()->current();

    }

    //buscando nome do filtro
    public function getIdFiltroPorNomeToArray($nm_filtro_prova) {

        $arNomeFiltro_prova = explode('(', $nm_filtro_prova);
        $nm_filtro_prova = $arNomeFiltro_prova[0];

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());
        $filter = new \Zend\Filter\StringTrim();
        $select = $sql->select('filtro_prova')
            ->columns(array('id_filtro_prova'))
            ->where([
                'filtro_prova.nm_filtro_prova = ?' => $filter->filter($nm_filtro_prova),
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute()->current();
    }

    public function fetchPaginator($pagina = 1, $itensPagina = 5, $ordem = 'nm_filtro_prova ASC', $like = null, $itensPaginacao = 5) {
        //http://igorrocha.com.br/tutorial-zf2-parte-9-paginacao-busca-e-listagem/4/
        // preparar um select para tabela contato com uma ordem
        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());
        $select = $sql->select('filtro_prova')->order($ordem);

        if (isset($like)) {
            $select
                ->where
                ->like('id_filtro_prova', "%{$like}%")
                ->or
                ->like('nm_filtro_prova', "%{$like}%");
        }

        // criar um objeto com a estrutura desejada para armazenar valores
        $resultSet = new HydratingResultSet(new Reflection(), new \FiltroProva\Entity\FiltroProvaEntity());

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


    public function getFiltroProvaPaginator($filter = NULL, $camposFilter = NULL) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('filtro_prova')->columns([
            'id_filtro_prova',
            'nm_filtro_prova',
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

        $select->where($where)->order(['nm_filtro_prova DESC']);

        return new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\DbSelect($select, $this->getAdapter()));
    }

}