<?php

namespace Pfe\SuiviVacheBundle\Controller;

use Pfe\SuiviVacheBundle\Entity\TrancheAge;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Trancheage controller.
 *
 * @Route("trancheage")
 */
class TrancheAgeController extends Controller
{
    /**
     * Lists all trancheAge entities.
     *
     * @Route("/", name="trancheage_index")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $trancheAges = $em->getRepository('PfeSuiviVacheBundle:TrancheAge')->findAll();

        return $this->render('@PfeSuiviVache/trancheage/index.html.twig', array(
            'trancheAges' => $trancheAges,
        ));
    }

    /**
     * Creates a new trancheAge entity.
     *
     * @Route("/new", name="trancheage_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function newAction(Request $request)
    {
        $trancheAge = new Trancheage();
        $form = $this->createForm('Pfe\SuiviVacheBundle\Form\TrancheAgeType', $trancheAge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($trancheAge);
            $em->flush();

            return $this->redirectToRoute('trancheage_show', array('id' => $trancheAge->getId()));
        }

        return $this->render('@PfeSuiviVache/trancheage/new.html.twig', array(
            'trancheAge' => $trancheAge,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a trancheAge entity.
     *
     * @Route("/{id}", name="trancheage_show")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function showAction(TrancheAge $trancheAge)
    {
        $deleteForm = $this->createDeleteForm($trancheAge);

        return $this->render('@PfeSuiviVache/trancheage/show.html.twig', array(
            'trancheAge' => $trancheAge,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing trancheAge entity.
     *
     * @Route("/{id}/edit", name="trancheage_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function editAction(Request $request, TrancheAge $trancheAge)
    {
        $deleteForm = $this->createDeleteForm($trancheAge);
        $editForm = $this->createForm('Pfe\SuiviVacheBundle\Form\TrancheAgeType', $trancheAge);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "Modification avec succées");


            return $this->redirectToRoute('trancheage_show', array('id' => $trancheAge->getId()));
        }

        return $this->render('@PfeSuiviVache/trancheage/edit.html.twig', array(
            'trancheAge' => $trancheAge,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a trancheAge entity.
     *
     * @Route("/{id}/delete", name="trancheage_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function deleteAction(Request $request, TrancheAge $trancheAge)
    {
        $form = $this->createDeleteForm($trancheAge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($trancheAge);
            $em->flush();
        }

        return $this->redirectToRoute('trancheage_index');
    }

    /**
     * Creates a form to delete a trancheAge entity.
     *
     * @param TrancheAge $trancheAge The trancheAge entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TrancheAge $trancheAge)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('trancheage_delete', array('id' => $trancheAge->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
