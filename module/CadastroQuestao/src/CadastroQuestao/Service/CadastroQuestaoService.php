<?php

namespace CadastroQuestao\Service;

use \CadastroQuestao\Entity\CadastroQuestaoEntity as Entity;

use CadastroQuestao\Table\CadastroQuestao;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Stdlib\Hydrator\Reflection;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class CadastroQuestaoService extends Entity{

    public function getCadastroQuestaoToArray($id) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        #die($id);
        $select = $sql->select('questao')
            ->where([
                'questao.id_questao = ?' => $id,
            ]);
        #print_r($sql->prepareStatementForSqlObject($select)->execute());exit;

        return $sql->prepareStatementForSqlObject($select)->execute()->current();
    }

    public function getFiltrarQuestaoPorNomeToArray($tx_enunciado) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('questao')
            ->columns(array('tx_enunciado',) ) #Colunas a retornar. Basta Omitir que ele traz todas as colunas
            ->where([
                "questao.id_questao LIKE ?" => '%'.$tx_enunciado.'%',
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute();
    }

    public function getIdQuestaoPorNomeToArray($tx_enunciado) {

        $arNomeDaQuestao = explode('(', $tx_enunciado);
        $tx_enunciado = $arNomeDaQuestao[0];

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());
        $filter = new \Zend\Filter\StringTrim();
        $select = $sql->select('questao')
            ->columns(array('id_questao') )
            ->where([
                'questao.tx_enunciado = ?' => $filter->filter($tx_enunciado),
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute()->current();
    }

    public function fetchPaginator($pagina = 1, $itensPagina = 5, $ordem = 'tx_enunciado DESC', $like = null, $itensPaginacao = 5) {
        //http://igorrocha.com.br/tutorial-zf2-parte-9-paginacao-busca-e-listagem/4/
        // preparar um select para tabela contato com uma ordem
        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());
        $select = $sql->select('questao')->order($ordem);

        if (isset($like)) {
            $select
                ->where
                ->like('tx_enunciado', "%{$like}%")
//                ->or
//                ->like('id_cidade', "%{$like}%")
                #->or
                #->like('telefone_principal', "%{$like}%")
                #->or
                #->like('data_criacao', "%{$like}%")
            ;
        }

        // criar um objeto com a estrutura desejada para armazenar valores
        $resultSet = new HydratingResultSet(new Reflection(), new \CadastroQuestao\Entity\CadatroQuestao());

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

    public function getAtletasPaginator($filter = NULL, $camposFilter = NULL) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('questao')->columns([
            'id_questao',
            'tx_enunciado',
            'tx_caminho_imagem_questao'
        ]);

            
//        ->join('fonte_questao', 'fonte_questao.id_fonte_questao = questao.id_fonte_questao', [
//                'nm_fonte_questao'
//            ])
//            ->join('classificacao_semestre', 'classificacao_semestre.id_classificacao_semestre = questao.id_classificacao_semestre', [
//                'nm_classificacao_semestre'
//           ])
//            ->join('nivel_dificuldade', 'nivel_dificuldade.id_nivel_dificuldade = questao.id_nivel_dificuldade', [
//                'nm_nivel_dificuldade'
//            ])
//            ->join('temporizacao', 'temporizacao.id_temporizacao = questao.id_temporizacao', [
//                'nm_temporizacao',
//            ])
//            ->join('tipo_questao', 'tipo_questao.id_tipo_questao = questao.id_tipo_questao', [
//                'nm_tipo_questao',
//           ])
//         ->join('assunto_materia', 'assunto_materia.id_assunto_materia = questao.id_assunto_materia', [
//                'nm_assunto_materia',
//            ]);








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

        $select->where($where)->order(['tx_enunciado DESC']);

        return new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\DbSelect($select, $this->getAdapter()));
    }



//    public function fetchPaginator($pagina = 1, $itensPagina = 5, $ordem = 'tx_enunciado ASC', $like = null, $itensPaginacao = 5) {
//        //http://igorrocha.com.br/tutorial-zf2-parte-9-paginacao-busca-e-listagem/4/
//        // preparar um select para tabela contato com uma ordem
//        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());
//        $select = $sql->select('questao')->order($ordem);
//
//        if (isset($like)) {
//            $select
//                ->where
//                ->like('tx_enunciado', "%{$like}%")
//               // ->or
//               // ->like('tx_enunciado', "%{$like}%")
//                #->or
//                #->like('telefone_principal', "%{$like}%")
//                #->or
//                #->like('data_criacao', "%{$like}%")
//            ;
//        }
//
//        // criar um objeto com a estrutura desejada para armazenar valores
//        $resultSet = new HydratingResultSet(new Reflection(), new \Atleta\Entity\AtletaEntity());
//
//        // criar um objeto adapter paginator
//        $paginatorAdapter = new DbSelect(
//        // nosso objeto select
//            $select,
//            // nosso adapter da tabela
//            $this->getAdapter(),
//            // nosso objeto base para ser populado
//            $resultSet
//        );
//
//        # var_dump($paginatorAdapter);
//        #die;
//        // resultado da pagina��o
//        return (new Paginator($paginatorAdapter))
//            // pagina a ser buscada
//            ->setCurrentPageNumber((int) $pagina)
//            // quantidade de itens na p�gina
//            ->setItemCountPerPage((int) $itensPagina)
//            ->setPageRange((int) $itensPaginacao);
//    }
//
//    /**
//     *
//     * @param type $dtInicio
//     * @param type $dtFim
//     * @return type
//     */
//    public function getAtletasPaginator($filter = NULL, $camposFilter = NULL) {
//
//        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());
//
//        $select = $sql->select('questao')->columns([
//            'id_questao',
//            'tx_enunciado',
//            'tx_caminho_imagem_questao',
//        ])
////            ->join('fonte_questao', 'fonte_questao.id_fonte_questao = questao.id_fonte_questao', [
////                'nm_fonte_questao'
////            ])
////            ->join('classificacao_semestre', 'classificacao_semestre.id_classificacao_semestre = questao.id_classificacao_semestre', [
////                'nm_classificacao_semestre'
////            ])
////            ->join('nivel_dificuldade', 'nivel_dificuldade.id_nivel_dificuldade = questao.id_nivel_dificuldade', [
////                'nm_nivel_dificuldade'
////            ])
////            ->join('temporizacao', 'temporizacao.id_temporizacao = questao.id_temporizacao', [
////                'nm_temporizacao',
////            ])
////            ->join('tipo_questao', 'tipo_questao.id_tipo_questao = questao.id_tipo_questao', [
////                'nm_tipo_questao',
////            ])
////            ->join('assunto_materia', 'assunto_materia.id_assunto_materia = questao.id_assunto_materia', [
////                'nm_assunto_materia',
////            ])
//
//        ;
//
//        $where = [
//        ];
//
//        if (!empty($filter)) {
//
//            foreach ($filter as $key => $value) {
//
//                if ($value) {
//
//                    if (isset($camposFilter[$key]['mascara'])) {
//
//                        eval("\$value = " . $camposFilter[$key]['mascara'] . ";");
//                    }
//
//                    $where[$camposFilter[$key]['filter']] = '%' . $value . '%';
//                }
//            }
//        }
//
//        $select->where($where)->order(['tx_enunciado']);
//
//        return new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\DbSelect($select, $this->getAdapter()));
//    }

}