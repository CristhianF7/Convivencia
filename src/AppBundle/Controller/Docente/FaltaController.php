<?php

namespace AppBundle\Controller\Docente;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Falta;
use AppBundle\Form\FaltaType;
use AppBundle\Controller\BaseController;
/**
 * Falta controller.
 *
 * @Route("/docentes/falta")
 */
class FaltaController extends Controller
{
    /**
     * Lists all Falta entities.
     *
     * @Route("/", name="docentes_falta_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $docente = $this->getUser();
        $faltas = $em->getRepository('AppBundle:Falta')->findBy(array(
            'docente'=>$docente
        ));

        return $this->render('docentes/falta/index.html.twig', array(
            'faltas' => $faltas,
        ));
    }
    

    /**
     * Creates a new Falta entity.
     *
     * @Route("/new", name="docentes_falta_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $faltum = new Falta();
        $faltum->setFechaCreacion(new \DateTime());
        $form = $this->createForm('AppBundle\Form\FaltaType', $faltum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($faltum);
            $em->flush();
            $this->MsgFlash("Creado correctamente.","info");
            return $this->redirectToRoute('docentes_falta_show', array('id' => $faltum->getId()));
        }

        return $this->render('docentes/falta/new.html.twig', array(
            'faltum' => $faltum,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Falta entity.
     *
     * @Route("/{id}", name="docentes_falta_show")
     * @Method("GET")
     */
    public function showAction(Falta $faltum)
    {
        $deleteForm = $this->createDeleteForm($faltum);

       if($faltum->getDocente()->getId() != $this->getUser()->getId()){
            $this->MsgFlash("Estás accediento a un recurso que no tienes permiso.","danger");
            return $this->redirectToRoute('docentes_falta_index');
        }

        return $this->render('docentes/falta/show.html.twig', array(
            'faltum' => $faltum,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Falta entity.
     *
     * @Route("/{id}/edit", name="docentes_falta_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Falta $faltum)
    {
        $deleteForm = $this->createDeleteForm($faltum);
        $editForm = $this->createForm('AppBundle\Form\FaltaType', $faltum);
        $editForm->handleRequest($request);

       if($faltum->getDocente()->getId() != $this->getUser()->getId()){
            $this->MsgFlash("Estás accediento a un recurso que no tienes permiso.","danger");
            return $this->redirectToRoute('docentes_falta_index');
        }

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($faltum);
            $em->flush();
            $this->MsgFlash("Actualización correcta.");
            return $this->redirectToRoute('docentes_falta_edit', array('id' => $faltum->getId()));
        }

        return $this->render('docentes/falta/edit.html.twig', array(
            'faltum' => $faltum,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Falta entity.
     *
     * @Route("/{id}", name="docentes_falta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Falta $faltum)
    {
        $form = $this->createDeleteForm($faltum);
        $form->handleRequest($request);

        if($faltum->getDocente()->getId() != $this->getUser()->getId()){
            $this->MsgFlash("Estás accediento a un recurso que no tienes permiso.","danger");
            return $this->redirectToRoute('docentes_falta_index');
        }
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($faltum);
            $em->flush();
            $this->MsgFlash("Eliminado correctamente.","danger");
        }

        return $this->redirectToRoute('docentes_falta_index');
    }

    /**
     * Creates a form to delete a Falta entity.
     *
     * @param Falta $faltum The Falta entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Falta $faltum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('docentes_falta_delete', array('id' => $faltum->getId())))
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
