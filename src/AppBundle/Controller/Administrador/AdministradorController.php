<?php

namespace AppBundle\Controller\Administrador;

use AppBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Administrador controller.
 *
 * @Route("/administrador")
 */
class AdministradorController extends BaseController
{
    
    /**
     * @Route("/", name="admin-entrada")
     */
    public function entradaAction()
    {
        return $this->render('administrador/entrada.html.twig');
    }
    
    /**
     * @Route("/docentes", name="admin-docentes")
     */
    public function docentesAction()
    {
        $em = $this->getDoctrine()->getManager()->getRepository("AppBundle:Docente")->findAll();
        dump($em, $this->esquema);
        //$this->em->getRepository("AppBundle:Docente")->findAll();
        return $this->render('administrador/docente.html.twig');
    }
}
