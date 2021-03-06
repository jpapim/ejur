<?php

namespace Relatorio\Controller;

use Estrutura\Controller\AbstractCrudController;
use DOMPDFModule\View\Model\PdfModel;

class RelatorioController extends AbstractCrudController {

    /**
     * @var \Action\Service\Action
     */
    protected $service;

    public function __construct() {
        parent::setServiceObj();
    }

    public function gerarPdfQuantitativoQuestoesPorAssuntoAction() {
        $pdf = new PdfModel();

        $pdf->setOption('filename', 'quantitativo-questoes-por-assunto.pdf');
        $pdf->setOption('paperSize', 'a4');
        $pdf->setOption('paperOrientation', 'portrait');

        $resultado = $this->service->getQuantitativoQuestoesPorAssunto();

        $pdf->setVariables(array(
            'resultado' => $resultado
        ));

        return $pdf;
    }

    public function relatorioUsuariosAction() {
        $pdf = new PdfModel();

        $pdf->setOption('filename', 'relatorio-usuarios.pdf');
        $pdf->setOption('paperSize', 'a4');
        $pdf->setOption('paperOrientation', 'portrait');

        $resultado = $this->service->getUsuariosPerfis();

        $pdf->setVariables(array(
                    'resultado' => $resultado 
        ));
        return $pdf;
    }

    public function gerarPdfMateriaSemestreAction() {
        $pdf = new PdfModel();

        $pdf->setOption('filename', 'Materia-semestre.pdf');
        $pdf->setOption('paperSize', 'a4');
        $pdf->setOption('paperOrientation', 'portrait');

        $resultado = $this->service->getMateriasSemestre();

        $pdf->setVariables(array(
            'resultado' => $resultado
        ));

        return $pdf;
    }

}
