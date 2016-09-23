<?php

namespace CadastroQuestao\Controller;

use Estrutura\Controller\AbstractCrudController;

use Estrutura\Helpers\Cript;
use Estrutura\Helpers\Data;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class CadastroQuestaoController extends AbstractCrudController
{
    /**
     * @var \CadastroQuestao\Service\CadastroQuestao
     */
    protected $service;

    /**
     * @var \CadastroQuestao\Form\CadastroQuestao
     */
    protected $form;

    public function __construct(){
        parent::init();
    }

    public function indexAction()
    {
        return parent::index($this->service, $this->form);
    }


    public function indexPaginationAction()
    {
        //http://igorrocha.com.br/tutorial-zf2-parte-9-paginacao-busca-e-listagem/4/

        $filter = $this->getFilterPage();

        $camposFilter = [
//            '0' => [
//                'filter' => "fonte_questao.nm_fonte_questao LIKE ?",
//            ],
//            '1' => [
//                'filter' => "classificacao_semestre.nm_classificacao_semestre LIKE ?",
//            ],
//            '2' => [
//                'filter' => "nivel_dificuldade.nm_nivel_dificuldade LIKE ?",
//            ],
//            '3' => [
//                'filter' => "temporizacao.nm_temporizacao LIKE ?",
//            ],
//            '4' => [
//                'filter' => "tipo_questao.nm_tipo_questao LIKE ?",
//            ],
//            '5' => [
//                'filter' => "assunto_materia.nm_assunto_materia LIKE ?",
//            ],
            '0' => [
                'filter' => "questao.tx_enunciado LIKE ?",
            ],
//            '7' => [
//                'filter' => "questao.tx_caminho_imagem_questao LIKE ?",
//            ],
            '1' => NULL,
        ];
$paginator = $this->service->getAtletasPaginator($filter, $camposFilter);

$paginator->setItemCountPerPage($paginator->getTotalItemCount());

$countPerPage = $this->getCountPerPage(
current(\Estrutura\Helpers\Pagination::getCountPerPage($paginator->getTotalItemCount()))
);

$paginator->setItemCountPerPage($this->getCountPerPage(
current(\Estrutura\Helpers\Pagination::getCountPerPage($paginator->getTotalItemCount()))
))->setCurrentPageNumber($this->getCurrentPage());

$viewModel = new ViewModel([
'service' => $this->service,
'form' => $this->form,
'paginator' => $paginator,
'filter' => $filter,
'countPerPage' => $countPerPage,
'camposFilter' => $camposFilter,
'controller' => $this->params('controller'),
'atributos' => array()
]);

return $viewModel->setTerminal(TRUE);

    }
    

    public function gravarAction() {
        #Alysson
        $controller = $this->params('controller');
        $this->addSuccessMessage('Registro Alterado com sucesso');
        $this->redirect()->toRoute('navegacao', array('controller' => $controller, 'action' => 'index'));
        return parent::gravar($this->service, $this->form);
    }

    public function cadastroAction()
    {
        return parent::cadastro($this->service, $this->form);
    }

    public function excluirAction()
    {
        return parent::excluir($this->service, $this->form);
    }

    public function realizarinscricoesAction()
    {
        //Se for a chamada Ajax
        if ($this->getRequest()->isPost()) {
            $request = $this->getRequest();
            $nm_atleta = $this->params()->fromPost('nm_atleta');
            $id_evento = $this->params()->fromPost('id_evento');

            $atleta = new \Atleta\Service\AtletaService();
            $arrAtleta = $atleta->getIdAtletaPorNomeToArray($this->params()->fromPost('nm_atleta'));
            $realizar_inscricao = new \InscricoesEvento\Service\InscricoesEventoService();

            //TODO - Implementar Validador para certificar que o Atleta ainda nao esta na base.
            if($realizar_inscricao->checarSeAtletaEstaInscritoNoEvento($arrAtleta['id_atleta'],$id_evento)){
                $valuesJson = new JsonModel( array('sucesso'=>false, 'nm_atleta'=>$nm_atleta) );
            }else{
                $id_inserido = $realizar_inscricao->getTable()->salvar(array('id_evento'=>$id_evento, 'id_atleta'=>$arrAtleta['id_atleta']), null);
                $valuesJson = new JsonModel( array('id_inserido'=>$id_inserido, 'sucesso'=>true, 'nm_atleta'=>$nm_atleta) );
            }

            return $valuesJson;
        } else { //Se for requisição normal
            $id = Cript::dec($this->params('id'));
            $post = $this->getPost();
            #Alysson - Se for Alterar
            if ($id) {
                #$this->form->setData($this->service->buscar($id)->toArray());
            }
            #Alysson - Submissao do Formulario de alteraçao
            if (!empty($post)) {
                $this->form->setData($post);
            }
            $evento = new \Evento\Service\EventoService();
            $dadosEvento = $evento->getEventoToArray($id);

            $inscricoes = new \InscricoesEvento\Service\InscricoesEventoService();
            $dadosInscricoes = $inscricoes->fetchAllEventos(array('id_evento' => $dadosEvento['id_evento']));

            $dadosView = [
                'service' => $this->service,
                'form' => $this->form,
                'controller' => $this->params('controller'),
                'atributos' => array(),
                'dados_evento' => $dadosEvento,
                'lista_inscritos' => $dadosInscricoes
            ];

            return new ViewModel($dadosView);
        }
    }
}
