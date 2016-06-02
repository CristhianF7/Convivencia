<?php

namespace AppBundle\Controller\Administrador;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\EstadosFaltas;
use AppBundle\Form\EstadosFaltasType;

/**
 * EstadosFaltas controller.
 *
 * @Route("/administrador/estadosfaltas")
 */
class EstadosFaltasController extends Controller
{
    /**
     * Lists all EstadosFaltas entities.
     *
     * @Route("/", name="administrador_estadosfaltas_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $estadosFaltas = $em->getRepository('AppBundle:EstadosFaltas')->findAll();

        return $this->render('administrador/estadosfaltas/index.html.twig', array(
            'estadosFaltas' => $estadosFaltas,
        ));
    }

    /**
     * Creates a new EstadosFaltas entity.
     *
     * @Route("/new", name="administrador_estadosfaltas_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $estadosFalta = new EstadosFaltas();
        $form = $this->createForm('AppBundle\Form\EstadosFaltasType', $estadosFalta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($estadosFalta);
            $em->flush();

            return $this->redirectToRoute('administrador_estadosfaltas_show', array('id' => $estadosFalta->getId()));
        }

        return $this->render('administrador/estadosfaltas/new.html.twig', array(
            'estadosFalta' => $estadosFalta,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a EstadosFaltas entity.
     *
     * @Route("/{id}", name="administrador_estadosfaltas_show")
     * @Method("GET")
     */
    public function showAction(EstadosFaltas $estadosFalta)
    {
        $deleteForm = $this->createDeleteForm($estadosFalta);

        return $this->render('administrador/estadosfaltas/show.html.twig', array(
            'estadosFalta' => $estadosFalta,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing EstadosFaltas entity.
     *
     * @Route("/{id}/edit", name="administrador_estadosfaltas_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, EstadosFaltas $estadosFalta)
    {
        $deleteForm = $this->createDeleteForm($estadosFalta);
        $editForm = $this->createForm('AppBundle\Form\EstadosFaltasType', $estadosFalta);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($estadosFalta);
            $em->flush();

            return $this->redirectToRoute('administrador_estadosfaltas_edit', array('id' => $estadosFalta->getId()));
        }

        return $this->render('administrador/estadosfaltas/edit.html.twig', array(
            'estadosFalta' => $estadosFalta,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a EstadosFaltas entity.
     *
     * @Route("/{id}", name="administrador_estadosfaltas_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, EstadosFaltas $estadosFalta)
    {
        $form = $this->createDeleteForm($estadosFalta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($estadosFalta);
            $em->flush();
        }

        return $this->redirectToRoute('administrador_estadosfaltas_index');
    }

    /**
     * Creates a form to delete a EstadosFaltas entity.
     *
     * @param EstadosFaltas $estadosFalta The EstadosFaltas entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(EstadosFaltas $estadosFalta)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administrador_estadosfaltas_delete', array('id' => $estadosFalta->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
