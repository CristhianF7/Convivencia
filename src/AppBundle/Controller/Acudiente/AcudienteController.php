<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller\Acudiente;

use Symfony\Component\HttpFoundation\Request;
use AppBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

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

    /**
     * @Route("/mis-estudiantes", name="acudientes-estudiantes")
     */
    public function estudiantesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $this->getUser();
        $estudiantes = $em->getRepository('AppBundle:AcudienteEstudiante')->findByAcudiente($usuario);
        return $this->render('acudientes/estudiantes.html.twig',[
            'estudiantes' => $estudiantes
        ]);
    }

     /**
     * @Route("/faltas", name="acudientes-faltas")
     */
    public function acudientesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $this->getUser();
        
        $faltas = $em->createQuery('
            SELECT f,e FROM AppBundle:Falta f
            JOIN f.estudiante e
            JOIN e.acudientes a
        ');
        //$faltas->setParameter('acudiente',$usuario);
        $falta = $faltas->getResult();
        return $this->render('acudientes/faltas.html.twig',[
            'faltas' => $falta,
            'usuario'=>$usuario
        ]);
    }

    /**
     * Método para agregar la respuesta del acudiente
     * @Route("/agregarRespuesta", name="agregar-respuesta")
     * @Method("POST")
     */
    public function AgregarRespuestaAction(Request $request)
    {
        $usuario = $this->getUser();
        $id = $request->request->get('falta');
        $mensaje = $request->request->get('mensaje');
        $estudiante = $request->request->get('estudiante');
        
        $em = $this->getDoctrine()->getManager();

        $acudienteEstudiante = $em->getRepository('AppBundle:AcudienteEstudiante')->findOneBy(array(
            'acudiente'=>$usuario->getId(),
            'estudiante'=>$estudiante
        ));


        $falta = $em->getRepository('AppBundle:Falta')->findOneBy(array(
            'estudiante' => $estudiante,
            'id'        => $id
        ));

        $mensajePeticion = "";
        $codigo = "201";

        if($falta != null && $acudienteEstudiante != null){
            $mensajePeticion = "Guardado correctamente";
            $falta->setRespuesta($mensaje);
            $em->flush();
        }else{
            $mensajePeticion ="Ha habido un error";
            $codigo = 500;
        }

        $response = new JsonResponse();


        $response->setData(array(
            'falta' => $mensajePeticion,
            'codigo'=> $codigo
        ));

        $response->setStatusCode($codigo);
        return $response;
    }
}
