<?php

namespace AppBundle\Controller\Estudiante;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Falta;

/**
 * Falta controller.
 *
 * @Route("/estudiantes/falta")
 */
class FaltaController extends Controller
{
    /**
     * Lists all Falta entities.
     *
     * @Route("/", name="estudiante_falta_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $faltas = $em->getRepository('AppBundle:Falta')->findAll();

        return $this->render('estudiantes/falta/index.html.twig', array(
            'faltas' => $faltas,
        ));
    }

    /**
     * Finds and displays a Falta entity.
     *
     * @Route("/{id}", name="estudiante_falta_show")
     * @Method("GET")
     */
    public function showAction(Falta $faltum)
    {

        return $this->render('estudiantes/falta/show.html.twig', array(
            'faltum' => $faltum,
        ));
    }
}
