<?php

namespace AppBundle\Controller\Administrador;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\AcudienteEstudiante;
use AppBundle\Form\AcudienteEstudianteType;

/**
 * AcudienteEstudiante controller.
 *
 * @Route("/administrador/acudiente-estudiante")
 */
class AcudienteEstudianteController extends Controller
{
    /**
     * Lists all AcudienteEstudiante entities.
     *
     * @Route("/", name="administrador_acudiente-estudiante_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $acudienteEstudiantes = $em->getRepository('AppBundle:AcudienteEstudiante')->findAll();

        return $this->render('administrador/acudienteestudiante/index.html.twig', array(
            'acudienteEstudiantes' => $acudienteEstudiantes,
        ));
    }

    /**
     * Creates a new AcudienteEstudiante entity.
     *
     * @Route("/new", name="administrador_acudiente-estudiante_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $acudienteEstudiante = new AcudienteEstudiante();
        $form = $this->createForm('AppBundle\Form\AcudienteEstudianteType', $acudienteEstudiante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($acudienteEstudiante);
            $em->flush();
            $this->MsgFlash("Creado correctamente.","info");

            return $this->redirectToRoute('administrador_acudiente-estudiante_show', array('id' => $acudienteEstudiante->getId()));
        }

        return $this->render('administrador/acudienteestudiante/new.html.twig', array(
            'acudienteEstudiante' => $acudienteEstudiante,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a AcudienteEstudiante entity.
     *
     * @Route("/{id}", name="administrador_acudiente-estudiante_show")
     * @Method("GET")
     */
    public function showAction(AcudienteEstudiante $acudienteEstudiante)
    {
        $deleteForm = $this->createDeleteForm($acudienteEstudiante);

        return $this->render('administrador/acudienteestudiante/show.html.twig', array(
            'acudienteEstudiante' => $acudienteEstudiante,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing AcudienteEstudiante entity.
     *
     * @Route("/{id}/edit", name="administrador_acudiente-estudiante_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, AcudienteEstudiante $acudienteEstudiante)
    {
        $deleteForm = $this->createDeleteForm($acudienteEstudiante);
        $editForm = $this->createForm('AppBundle\Form\AcudienteEstudianteType', $acudienteEstudiante);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($acudienteEstudiante);
            $em->flush();
            $this->MsgFlash("Actualización correcta.");

            return $this->redirectToRoute('administrador_acudiente-estudiante_edit', array('id' => $acudienteEstudiante->getId()));
        }

        return $this->render('administrador/acudienteestudiante/edit.html.twig', array(
            'acudienteEstudiante' => $acudienteEstudiante,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a AcudienteEstudiante entity.
     *
     * @Route("/{id}", name="administrador_acudiente-estudiante_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AcudienteEstudiante $acudienteEstudiante)
    {
        $form = $this->createDeleteForm($acudienteEstudiante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($acudienteEstudiante);
            $em->flush();
            $this->MsgFlash("Eliminado correctamente.","danger");

        }

        return $this->redirectToRoute('administrador_acudiente-estudiante_index');
    }

    /**
     * Creates a form to delete a AcudienteEstudiante entity.
     *
     * @param AcudienteEstudiante $acudienteEstudiante The AcudienteEstudiante entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AcudienteEstudiante $acudienteEstudiante)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administrador_acudiente-estudiante_delete', array('id' => $acudienteEstudiante->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    private function MsgFlash($mensaje = "Acción Realizada correctamente.", $tipoAlerta = 'success', $tituloAlerta = 'Mensaje: ')
    {
        $this->get('session')->getFlashBag()->add(
                'notice',
                array(
                    'alert' => $tipoAlerta,
                    'title' => $tituloAlerta,
                    'message' => $mensaje
                )
            );
    }
}
