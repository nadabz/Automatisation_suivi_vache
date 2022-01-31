<?php

namespace Pfe\SuiviVacheBundle\Controller;

use Pfe\SuiviVacheBundle\Entity\Productionlait;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Productionlait controller.
 *
 * @Route("productionlait")
 */
class ProductionlaitController extends Controller
{
    /**
     * Lists all productionlait entities.
     *
     * @Route("/", name="productionlait_index")
     * @Method("GET")
     *      * @Security("has_role('ROLE_ADMIN')")

     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $productionlaits = $em->getRepository('PfeSuiviVacheBundle:Productionlait')->findAll();

        return $this->render('productionlait/index.html.twig', array(
            'productionlaits' => $productionlaits,
        ));
    }

    /**
     * Creates a new productionlait entity.
     *
     * @Route("/new", name="productionlait_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function newAction(Request $request)
    {
        $productionlait = new Productionlait();
        $form = $this->createForm('Pfe\SuiviVacheBundle\Form\ProductionlaitType', $productionlait);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($productionlait);
            $em->flush();

            return $this->redirectToRoute('productionlait_show', array('id' => $productionlait->getId()));
        }

        return $this->render('productionlait/new.html.twig', array(
            'productionlait' => $productionlait,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new productionlait entity.
     *
     * @Route("/production_lait_vache", name="production_lait_vache")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function ProductionLaitVacheAction(Request $request)
    {
        $production_vache=$request->request->get('production_vache');
        $id_vache=$request->request->get('id_vache');
        $em = $this->getDoctrine()->getManager();

        $vache = $em->getRepository('PfeSuiviVacheBundle:Vache')->find($id_vache);
        $suiviProduction=new Productionlait();
        $suiviProduction->setQtelait($production_vache);
        $suiviProduction->setVache($vache);
        $suiviProduction->setDate(new \DateTime());
        $em->persist($suiviProduction);
        $em->flush();

        return new Response('ok');

    }
    /**
     * Finds and displays a productionlait entity.
     *
     * @Route("/{id}", name="productionlait_show")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function showAction(Productionlait $productionlait)
    {
        $deleteForm = $this->createDeleteForm($productionlait);

        return $this->render('productionlait/show.html.twig', array(
            'productionlait' => $productionlait,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing productionlait entity.
     *
     * @Route("/{id}/edit", name="productionlait_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function editAction(Request $request, Productionlait $productionlait)
    {
        $deleteForm = $this->createDeleteForm($productionlait);
        $editForm = $this->createForm('Pfe\SuiviVacheBundle\Form\ProductionlaitType', $productionlait);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('productionlait_edit', array('id' => $productionlait->getId()));
        }

        return $this->render('productionlait/edit.html.twig', array(
            'productionlait' => $productionlait,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a productionlait entity.
     *
     * @Route("/{id}", name="productionlait_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function deleteAction(Request $request, Productionlait $productionlait)
    {
        $form = $this->createDeleteForm($productionlait);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($productionlait);
            $em->flush();
        }

        return $this->redirectToRoute('productionlait_index');
    }
    /**
     * Creates a form to delete a productionlait entity.
     *
     * @param Productionlait $productionlait The productionlait entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Productionlait $productionlait)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('productionlait_delete', array('id' => $productionlait->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
