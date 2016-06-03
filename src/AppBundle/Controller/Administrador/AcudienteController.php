<?php

namespace AppBundle\Controller\Administrador;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Acudiente;
use AppBundle\Form\AcudienteType;

/**
 * Acudiente controller.
 *
 * @Route("/administrador/acudiente")
 */
class AcudienteController extends Controller
{
    /**
     * Lists all Acudiente entities.
     *
     * @Route("/", name="acudiente_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $acudientes = $em->getRepository('AppBundle:Acudiente')->findAll();

        return $this->render('administrador/acudiente/index.html.twig', array(
            'acudientes' => $acudientes,
        ));
    }

    /**
     * Creates a new Acudiente entity.
     *
     * @Route("/new", name="acudiente_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $acudiente = new Acudiente();
        $form = $this->createForm('AppBundle\Form\AcudienteType', $acudiente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($acudiente);
            $em->flush();
            $this->MsgFlash("Creado correctamente.","info");

            return $this->redirectToRoute('acudiente_show', array('id' => $acudiente->getId()));
        }

        return $this->render('administrador/acudiente/new.html.twig', array(
            'acudiente' => $acudiente,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Acudiente entity.
     *
     * @Route("/{id}", name="acudiente_show")
     * @Method("GET")
     */
    public function showAction(Acudiente $acudiente)
    {
        $deleteForm = $this->createDeleteForm($acudiente);

        return $this->render('administrador/acudiente/show.html.twig', array(
            'acudiente' => $acudiente,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Acudiente entity.
     *
     * @Route("/{id}/edit", name="acudiente_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Acudiente $acudiente)
    {
        $deleteForm = $this->createDeleteForm($acudiente);
        $editForm = $this->createForm('AppBundle\Form\AcudienteType', $acudiente);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($acudiente);
            $em->flush();
            $this->MsgFlash("Actualización correcta.");

            return $this->redirectToRoute('acudiente_edit', array('id' => $acudiente->getId()));
        }

        return $this->render('administrador/acudiente/edit.html.twig', array(
            'acudiente' => $acudiente,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Acudiente entity.
     *
     * @Route("/{id}", name="acudiente_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Acudiente $acudiente)
    {
        $form = $this->createDeleteForm($acudiente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($acudiente);
            $em->flush();
            $this->MsgFlash("Eliminado correctamente.","danger");
            
        }

        return $this->redirectToRoute('acudiente_index');
    }

    /**
     * Creates a form to delete a Acudiente entity.
     *
     * @param Acudiente $acudiente The Acudiente entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Acudiente $acudiente)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('acudiente_delete', array('id' => $acudiente->getId())))
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
