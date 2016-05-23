<?php

namespace AppBundle\Controller\Administrador;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\TipoFalta;
use AppBundle\Form\TipoFaltaType;

/**
 * TipoFalta controller.
 *
 * @Route("/administrador/tipofalta")
 */
class TipoFaltaController extends Controller
{
    /**
     * Lists all TipoFalta entities.
     *
     * @Route("/", name="tipofalta_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tipoFaltas = $em->getRepository('AppBundle:TipoFalta')->findAll();

        return $this->render('administrador/tipofalta/index.html.twig', array(
            'tipoFaltas' => $tipoFaltas,
        ));
    }

    /**
     * Creates a new TipoFalta entity.
     *
     * @Route("/new", name="tipofalta_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tipoFaltum = new TipoFalta();
        $form = $this->createForm('AppBundle\Form\TipoFaltaType', $tipoFaltum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipoFaltum);
            $em->flush();

            return $this->redirectToRoute('tipofalta_show', array('id' => $tipoFaltum->getId()));
        }

        return $this->render('administrador/tipofalta/new.html.twig', array(
            'tipoFaltum' => $tipoFaltum,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TipoFalta entity.
     *
     * @Route("/{id}", name="tipofalta_show")
     * @Method("GET")
     */
    public function showAction(TipoFalta $tipoFaltum)
    {
        $deleteForm = $this->createDeleteForm($tipoFaltum);

        return $this->render('administrador/tipofalta/show.html.twig', array(
            'tipoFaltum' => $tipoFaltum,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TipoFalta entity.
     *
     * @Route("/{id}/edit", name="tipofalta_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TipoFalta $tipoFaltum)
    {
        $deleteForm = $this->createDeleteForm($tipoFaltum);
        $editForm = $this->createForm('AppBundle\Form\TipoFaltaType', $tipoFaltum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipoFaltum);
            $em->flush();

            return $this->redirectToRoute('tipofalta_edit', array('id' => $tipoFaltum->getId()));
        }

        return $this->render('administrador/tipofalta/edit.html.twig', array(
            'tipoFaltum' => $tipoFaltum,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a TipoFalta entity.
     *
     * @Route("/{id}", name="tipofalta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TipoFalta $tipoFaltum)
    {
        $form = $this->createDeleteForm($tipoFaltum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tipoFaltum);
            $em->flush();
        }

        return $this->redirectToRoute('tipofalta_index');
    }

    /**
     * Creates a form to delete a TipoFalta entity.
     *
     * @param TipoFalta $tipoFaltum The TipoFalta entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TipoFalta $tipoFaltum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipofalta_delete', array('id' => $tipoFaltum->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
