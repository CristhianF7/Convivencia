<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller\Docente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Description of DocenteController
 *
 * @author flia
 * @Route("/docentes")
 */
class DocenteController extends Controller
{
    /**
     * @Route("/", name="docente-entrada")
     */
    public function entradaAction()
    {
        return $this->render('docentes/entrada.html.twig');
    }
    
    /**
     * @Route("/perfil", name="docente-perfil")
     */
    public function perfilAction()
    {
        return $this->render('fragmentos/perfil.html.twig');
    }
    
    /**
     * @Route("/registro", name="docente-registro")
     */
    public function RegistrarFaltaAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tiposFaltas = $em->getRepository('AppBundle:TipoFalta')->findAll();
        
        return $this->render('docentes/registroFalta.html.twig',[
            'tiposFaltas' => $tiposFaltas
        ]);
    }
}
