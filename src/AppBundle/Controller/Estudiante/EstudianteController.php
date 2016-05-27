<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller\Estudiante;
use AppBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
/**
 * Description of EstudianteController
 *
 * @author CristhianF
 * @Route("/estudiantes")
 */
class EstudianteController extends BaseController
{
    
    /**
     * @Route("/", name="estudiantes-entrada")
     */
    public function entradaAction()
    {
        return $this->render('estudiante/entrada.html.twig');
    }
    
    /**
     * @Route("/perfil", name="estudiante-perfil")
     */
    public function perfilAction()
    {
        return $this->render('fragmentos/perfil.html.twig');
    }
}
