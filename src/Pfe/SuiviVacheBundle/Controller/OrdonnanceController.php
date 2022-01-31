<?php

namespace Pfe\SuiviVacheBundle\Controller;

use Pfe\SuiviVacheBundle\Entity\Ordonnance;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Ordonnance controller.
 *
 * @Route("ordonnance")
 */
class OrdonnanceController extends Controller
{
    /**
     * Lists all ordonnance entities.
     *
     * @Route("/", name="ordonnance_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ordonnances = $em->getRepository('PfeSuiviVacheBundle:Ordonnance')->findAll();

        return $this->render('@PfeSuiviVache/ordonnance/index.html.twig', array(
            'ordonnances' => $ordonnances,
        ));
    }

    /**
     * Creates a new ordonnance entity.
     *
     * @Route("/new", name="ordonnance_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ordonnance = new Ordonnance();
        $form = $this->createForm('Pfe\SuiviVacheBundle\Form\OrdonnanceType', $ordonnance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ordonnance);
            $em->flush();

            return $this->redirectToRoute('ordonnance_show', array('id' => $ordonnance->getId()));
        }

        return $this->render('@PfeSuiviVache/ordonnance/new.html.twig', array(
            'ordonnance' => $ordonnance,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ordonnance entity.
     *
     * @Route("/{id}", name="ordonnance_show")
     * @Method("GET")
     */
    public function showAction(Ordonnance $ordonnance)
    {
        $deleteForm = $this->createDeleteForm($ordonnance);

        return $this->render('@PfeSuiviVache/ordonnance/show.html.twig', array(
            'ordonnance' => $ordonnance,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ordonnance entity.
     *
     * @Route("/{id}/edit", name="ordonnance_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Ordonnance $ordonnance)
    {
        $deleteForm = $this->createDeleteForm($ordonnance);
        $editForm = $this->createForm('Pfe\SuiviVacheBundle\Form\OrdonnanceType', $ordonnance);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "Modification avec succées");


            return $this->redirectToRoute('ordonnance_show', array('id' => $ordonnance->getId()));
        }

        return $this->render('@PfeSuiviVache/ordonnance/edit.html.twig', array(
            'ordonnance' => $ordonnance,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ordonnance entity.
     *
     * @Route("/{id}", name="ordonnance_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Ordonnance $ordonnance)
    {
        $form = $this->createDeleteForm($ordonnance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ordonnance);
            $em->flush();
        }

        return $this->redirectToRoute('ordonnance_index');
    }

    /**
     * Creates a form to delete a ordonnance entity.
     *
     * @param Ordonnance $ordonnance The ordonnance entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Ordonnance $ordonnance)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ordonnance_delete', array('id' => $ordonnance->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
