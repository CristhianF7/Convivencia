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
}
