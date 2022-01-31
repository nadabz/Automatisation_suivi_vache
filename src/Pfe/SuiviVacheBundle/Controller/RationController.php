<?php

namespace Pfe\SuiviVacheBundle\Controller;

use Pfe\SuiviVacheBundle\Entity\Ration;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Ration controller.
 *
 * @Route("ration")
 */
class RationController extends Controller
{
    /**
     * Lists all ration entities.
     *
     * @Route("/", name="ration_index")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rations = $em->getRepository('PfeSuiviVacheBundle:Ration')->findAll();

        return $this->render('@PfeSuiviVache/ration/index.html.twig', array(
            'rations' => $rations,
        ));
    }

    /**
     * Creates a new ration entity.
     *
     * @Route("/new", name="ration_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function newAction(Request $request)
    {
        $ration = new Ration();
        $form = $this->createForm('Pfe\SuiviVacheBundle\Form\RationType', $ration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ration);
            $em->flush();

            return $this->redirectToRoute('ration_show', array('id' => $ration->getId()));
        }

        return $this->render('@PfeSuiviVache/ration/new.html.twig', array(
            'ration' => $ration,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ration entity.
     *
     * @Route("/{id}", name="ration_show")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function showAction(Ration $ration)
    {
        $deleteForm = $this->createDeleteForm($ration);

        return $this->render('@PfeSuiviVache/ration/show.html.twig', array(
            'ration' => $ration,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ration entity.
     *
     * @Route("/{id}/edit", name="ration_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function editAction(Request $request, Ration $ration)
    {
        $deleteForm = $this->createDeleteForm($ration);
        $editForm = $this->createForm('Pfe\SuiviVacheBundle\Form\RationType', $ration);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ration_edit', array('id' => $ration->getId()));
        }

        return $this->render('@PfeSuiviVache/ration/edit.html.twig', array(
            'ration' => $ration,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ration entity.
     *
     * @Route("/{id}/delete", name="ration_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function deleteAction(Request $request, Ration $ration)
    {
        $form = $this->createDeleteForm($ration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ration);
            $em->flush();
        }

        return $this->redirectToRoute('ration_index');
    }

    /**
     * Creates a form to delete a ration entity.
     *
     * @param Ration $ration The ration entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Ration $ration)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ration_delete', array('id' => $ration->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
