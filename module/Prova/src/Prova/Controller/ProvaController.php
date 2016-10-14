<?php

namespace Prova\Controller;

use DOMPDFModule\View\Model\PdfModel;
use Estrutura\Controller\AbstractCrudController;
use Zend\View\Model\JsonModel;
use Estrutura\Helpers\Cript;
use Zend\View\Model\ViewModel;

class ProvaController extends AbstractCrudController
{
    /**
     * @var \Prova\Service\Prova
     */
    protected $service;

    /**
     * @var \Prova\Form\Prova
     */
    protected $form;

    public function __construct(){
        parent::init();
    }

    public function indexAction()
    {
        //return parent::index($this->service, $this->form);
        return new ViewModel([
            'service' => $this->service,
            'form' => $this->form,
            'controller' => $this->params('controller'),
            'atributos' => array()
        ]);
    }

    public function indexPaginationAction()
    {
        //http://igorrocha.com.br/tutorial-zf2-parte-9-paginacao-busca-e-listagem/4/
        
        $filter = $this->getFilterPage();

        $camposFilter = [
            '0' => [
                'filter' => "prova.nm_prova LIKE ?",
            ],
            '1' => [
                'filter' => "prova.dt_aplicacao_prova LIKE ?",
            ],
            '2' => [
                'filter' => "prova.dt_geracao_prova LIKE ?",
            ],
            '3' => [
                'filter' => "prova.ds_prova LIKE ?",
            ],
            
            '5' => NULL,
                
        ];
        
        
        $paginator = $this->service->getProvasPaginator($filter, $camposFilter);

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
        try {
            $controller = $this->params('controller');
            $request = $this->getRequest();
            $service = $this->service;
            $form = $this->form;

            if (!$request->isPost()) {
                throw new \Exception('Dados Inválidos');
            }

            $post = \Estrutura\Helpers\Utilities::arrayMapArray('trim', $request->getPost()->toArray());

            $files = $request->getFiles();
            $upload = $this->uploadFile($files);

            $post = array_merge($post, $upload);

            if (isset($post['id']) && $post['id']) {
                $post['id'] = Cript::dec($post['id']);
            }


            $cidade = new \Cidade\Service\CidadeService();
            $arrCidade = $cidade->getIdCidadePorNomeToArray($post['id_cidade']);
            $post['id_cidade'] = $arrCidade['id_cidade'];

            $form->setData($post);

            if (!$form->isValid()) {
                $this->addValidateMessages($form);
                $this->setPost($post);
                $this->redirect()->toRoute('navegacao', array('controller' => $controller, 'action' => 'cadastro'));
                return false;
            }

            $service->exchangeArray($form->getData());
            $this->addSuccessMessage('Registro Alterado com sucesso');
            $this->redirect()->toRoute('navegacao', array('controller' => $controller, 'action' => 'index'));
            return $service->salvar();

        } catch (\Exception $e) {

            $this->setPost($post);
            $this->addErrorMessage($e->getMessage());
            $this->redirect()->toRoute('navegacao', array('controller' => $controller, 'action' => 'cadastro'));
            return false;
        }

    }

    public function cadastroAction()
    {
        return parent::cadastro($this->service, $this->form);
    }

    public function excluirAction()
    {
        return parent::excluir($this->service, $this->form);
    }

    public function gerarRelatorioPdfAction()
    {
        $catequizandoService = new \Prova\Service\ProvaService();
        $arteste = $catequizandoService->fetchAll()->toArray();
        $pdf = new PdfModel();
        $pdf->setVariables(array(
            'caminho_imagem'=>__DIR__,
            'inicio_contador'=>3,
            'teste' => $arteste,

        ));
        $pdf->setOption('filename', 'ordem_serviço_'); // Triggers PDF download, automatically appends ".pdf"
        $pdf->setOption("paperSize", "a4"); //Defaults to 8x11
        $pdf->setOption("basePath", __DIR__); //Defaults to 8x11
        #$pdf->setOption("paperOrientation", "landscape"); //Defaults to portrait
        return $pdf;

    }
}
