<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller\Acudiente;
use AppBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Description of AcudienteController
 *
 * @author CristhianF
 * @Route("/acudientes")
 */
class AcudienteController  extends BaseController
{
    /**
     * @Route("/", name="acudientes-entrada")
     */
    public function entradaAction()
    {
        return $this->render('acudientes/entrada.html.twig');
    }
    
    /**
     * @Route("/perfil", name="acudientes-perfil")
     */
    public function perfilAction()
    {
        return $this->render('fragmentos/perfil.html.twig');
    }
}
