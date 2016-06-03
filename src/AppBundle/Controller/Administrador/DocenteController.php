<?php

namespace AppBundle\Controller\Administrador;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Docente;
use AppBundle\Form\DocenteType;

/**
 * Docente controller.
 *
 * @Route("/administrador/docentes")
 */
class DocenteController extends Controller
{
    /**
     * Lists all Docente entities.
     *
     * @Route("/", name="docente_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $docentes = $em->getRepository('AppBundle:Docente')->findAll();

        return $this->render('administrador/docente/index.html.twig', array(
            'docentes' => $docentes,
        ));
    }

    /**
     * Creates a new Docente entity.
     *
     * @Route("/new", name="docente_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $docente = new Docente();
        $form = $this->createForm('AppBundle\Form\DocenteType', $docente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($docente);
            $em->flush();
            $this->MsgFlash("Creado correctamente.","info");

            return $this->redirectToRoute('docente_show', array('id' => $docente->getId()));
        }

        return $this->render('administrador/docente/new.html.twig', array(
            'docente' => $docente,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Docente entity.
     *
     * @Route("/{id}", name="docente_show")
     * @Method("GET")
     */
    public function showAction(Docente $docente)
    {
        $deleteForm = $this->createDeleteForm($docente);

        return $this->render('administrador/docente/show.html.twig', array(
            'docente' => $docente,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Docente entity.
     *
     * @Route("/{id}/edit", name="docente_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Docente $docente)
    {
        $deleteForm = $this->createDeleteForm($docente);
        $editForm = $this->createForm('AppBundle\Form\DocenteType', $docente);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($docente);
            $em->flush();
            $this->MsgFlash("Actualización correcta.");

            return $this->redirectToRoute('docente_edit', array('id' => $docente->getId()));
        }

        return $this->render('administrador/docente/edit.html.twig', array(
            'docente' => $docente,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Docente entity.
     *
     * @Route("/{id}", name="docente_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Docente $docente)
    {
        $form = $this->createDeleteForm($docente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($docente);
            $em->flush();
            $this->MsgFlash("Eliminado correctamente.","danger");
            
        }

        return $this->redirectToRoute('docente_index');
    }

    /**
     * Creates a form to delete a Docente entity.
     *
     * @param Docente $docente The Docente entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Docente $docente)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('docente_delete', array('id' => $docente->getId())))
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
