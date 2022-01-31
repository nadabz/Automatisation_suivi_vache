<?php

namespace Pfe\SuiviVacheBundle\Controller;

use Pfe\SuiviVacheBundle\Entity\Lot;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Lot controller.
 *
 * @Route("lot")
 */
class LotController extends Controller
{
    /**
     * Lists all lot entities.
     *
     * @Route("/", name="lot_index")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function indexAction(Request $request)
    {  $form = $this->createForm('Pfe\SuiviVacheBundle\Form\LotSearchType');
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $url = $this->buildSearchUrl($request->request->all());

            if (!empty($url)) {
                return $this->redirectToRoute('lot_index', $url);
            }
        }
        $em = $this->getDoctrine()->getManager();
        $paginator = $this->get('knp_paginator');

        $lots = $paginator->paginate(
            $em->getRepository('PfeSuiviVacheBundle:Lot')->rechercheLot($request->query->all()), /* query NOT result */
            $request->query->getInt('page', 1)/* page number */, 10/* limit per page */
        );

        return $this->render('@PfeSuiviVache/lot/index.html.twig', array(
            'lots' => $lots,
            'form' => $form->createView(),
        ));
    }

    /**
     * Lists des lot.
     *
     * @Route("/lot_index_ajax", name="lot_index_ajax")
     * @Method("GET")

     */
    public function indexAjaxAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $num_vache=$request->request->get('num_vache');
        $vache=$em->getRepository('PfeSuiviVacheBundle:Vache')->findOneBy(['numero'=>$num_vache]);

        $lots = $em->getRepository('PfeSuiviVacheBundle:Lot')->findby(['race'=>$vache->getRace()->getId(),'typeVache'=>$vache->getTypeVache()->getId()]);
        $tab_lot = [];
        foreach ($lots as $lot) {
            if ($lot->getNbreVache() > count($lot->getVaches())) {
                $tab_lot[] = $lot;
            }
        }

        return $this->render('@PfeSuiviVache/lot/index_ajax.html.twig', array(
            'tab_lot' => $tab_lot,
            'vache' => $vache,
        ));
    }

    /**
     * Creates a new lot entity.
     *
     * @Route("/new", name="lot_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_ELEVEUR')")

     */
    public function newAction(Request $request)
    {
        $lot = new Lot();
        $form = $this->createForm('Pfe\SuiviVacheBundle\Form\LotType', $lot);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($lot);
            $em->flush();

            return $this->redirectToRoute('lot_show', array('id' => $lot->getId()));
        }
        $last_lot = $em->getRepository('PfeSuiviVacheBundle:Lot')->findOneBy(
            [],        // $where
            array('id' => 'DESC'),    // $orderBy
            1,                        // $limit
            0                          // $offset
        );
        if (count($last_lot) > 0) {
            $last_numLot = $last_lot->getNumLot() + 1;
        } else {
            $last_numLot = 1;
        }
        return $this->render('@PfeSuiviVache/lot/new.html.twig', array(
            'lot' => $lot,
            'last_numLot' => $last_numLot,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a lot entity.
     *
     * @Route("/{id}", name="lot_show")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function showAction(Lot $lot)
    {
        $deleteForm = $this->createDeleteForm($lot);

        return $this->render('@PfeSuiviVache/lot/show.html.twig', array(
            'lot' => $lot,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing lot entity.
     *
     * @Route("/{id}/edit", name="lot_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function editAction(Request $request, Lot $lot)
    {
        $deleteForm = $this->createDeleteForm($lot);
        $editForm = $this->createForm('Pfe\SuiviVacheBundle\Form\LotType', $lot);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "Modification avec succées");


            return $this->redirectToRoute('lot_show', array('id' => $lot->getId()));
        }

        return $this->render('@PfeSuiviVache/lot/edit.html.twig', array(
            'lot' => $lot,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a lot entity.
     *
     * @Route("/{id}/delete", name="lot_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function deleteAction(Request $request, Lot $lot)
    {
        $form = $this->createDeleteForm($lot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($lot);
            $em->flush();
        }

        return $this->redirectToRoute('lot_index');
    }

    /**
     * Creates a form to delete a lot entity.
     *
     * @param Lot $lot The lot entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Lot $lot)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('lot_delete', array('id' => $lot->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
    private function buildSearchUrl($data)
    {
        $url = [];
        foreach ($data as $k => $v) {
            if (isset($data['search_lot']['numLot']) && !empty($data['search_lot']['numLot'])) {
                $url['numLot'] = $data['search_lot']['numLot'];
            }

        }
        return $url;
    }
}
