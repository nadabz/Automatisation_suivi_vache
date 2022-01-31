<?php

namespace Pfe\SuiviVacheBundle\Controller;

use Pfe\SuiviVacheBundle\Entity\Etable;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Etable controller.
 *
 * @Route("etable")
 */
class EtableController extends Controller
{
    /**
     * Lists all etable entities.
     *
     * @Route("/", name="etable_index")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $etables = $em->getRepository('PfeSuiviVacheBundle:Etable')->findAll();

        return $this->render('@PfeSuiviVache/etable/index.html.twig', array(
            'etables' => $etables,
        ));
    }

    /**
     * Creates a new etable entity.
     *
     * @Route("/new", name="etable_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function newAction(Request $request)
    {
        $etable = new Etable();
        $form = $this->createForm('Pfe\SuiviVacheBundle\Form\EtableType', $etable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($etable);
            $em->flush();

            return $this->redirectToRoute('etable_show', array('id' => $etable->getId()));
        }

        return $this->render('@PfeSuiviVache/etable/new.html.twig', array(
            'etable' => $etable,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a etable entity.
     *
     * @Route("/{id}", name="etable_show")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function showAction(Etable $etable)
    {
        $deleteForm = $this->createDeleteForm($etable);

        return $this->render('@PfeSuiviVache/etable/show.html.twig', array(
            'etable' => $etable,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing etable entity.
     *
     * @Route("/{id}/edit", name="etable_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function editAction(Request $request, Etable $etable)
    {
        $deleteForm = $this->createDeleteForm($etable);
        $editForm = $this->createForm('Pfe\SuiviVacheBundle\Form\EtableType', $etable);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "Modification avec succées");

            return $this->redirectToRoute('etable_show', array('id' => $etable->getId()));
        }

        return $this->render('@PfeSuiviVache/etable/edit.html.twig', array(
            'etable' => $etable,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a etable entity.
     *
     * @Route("/{id}/delete", name="etable_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function deleteAction(Request $request, Etable $etable)
    {
        $form = $this->createDeleteForm($etable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($etable);
            $em->flush();
        }

        return $this->redirectToRoute('etable_index');
    }

    /**
     * Creates a form to delete a etable entity.
     *
     * @param Etable $etable The etable entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Etable $etable)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('etable_delete', array('id' => $etable->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
