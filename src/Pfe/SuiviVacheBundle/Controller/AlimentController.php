<?php

namespace Pfe\SuiviVacheBundle\Controller;

use Pfe\SuiviVacheBundle\Entity\Aliment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Aliment controller.
 *
 * @Route("aliment")
 */
class AlimentController extends Controller
{
    /**
     * Lists all aliment entities.
     *
     * @Route("/", name="aliment_index")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm('Pfe\SuiviVacheBundle\Form\AlimentSearchType');
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $url = $this->buildSearchUrl($request->request->all());

            if (!empty($url)) {
                return $this->redirectToRoute('aliment_index', $url);
            }
        }
        $em = $this->getDoctrine()->getManager();
        $paginator = $this->get('knp_paginator');

        $aliments = $paginator->paginate(
            $em->getRepository('PfeSuiviVacheBundle:Aliment')->rechercheAliment($request->query->all()), /* query NOT result */
            $request->query->getInt('page', 1)/* page number */, 10/* limit per page */
        );

        return $this->render('@PfeSuiviVache/aliment/index.html.twig', array(
            'aliments' => $aliments,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new aliment entity.
     *
     * @Route("/new", name="aliment_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function newAction(Request $request)
    {
        $aliment = new Aliment();
        $form = $this->createForm('Pfe\SuiviVacheBundle\Form\AlimentType', $aliment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($aliment);
            $em->flush();
            return $this->redirectToRoute('aliment_show', array('id' => $aliment->getId()));
        }

        return $this->render('@PfeSuiviVache/aliment/new.html.twig', array(
            'aliment' => $aliment,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a aliment entity.
     *
     * @Route("/{id}", name="aliment_show")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function showAction(Aliment $aliment)
    {
        $deleteForm = $this->createDeleteForm($aliment);

        return $this->render('@PfeSuiviVache/aliment/show.html.twig', array(
            'aliment' => $aliment,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing aliment entity.
     *
     * @Route("/{id}/edit", name="aliment_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function editAction(Request $request, Aliment $aliment)
    {
        $deleteForm = $this->createDeleteForm($aliment);
        $editForm = $this->createForm('Pfe\SuiviVacheBundle\Form\AlimentType', $aliment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "Modification avec succées");

            return $this->redirectToRoute('aliment_show', array('id' => $aliment->getId()));
        }


        return $this->render('@PfeSuiviVache/aliment/edit.html.twig', array(
            'aliment' => $aliment,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a aliment entity.
     *
     * @Route("/{id}/delete", name="aliment_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function deleteAction(Request $request, Aliment $aliment)
    {
        $form = $this->createDeleteForm($aliment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($aliment);
            $em->flush();
        }

        return $this->redirectToRoute('aliment_index');
    }

    /**
     * Creates a form to delete a aliment entity.
     *
     * @param Aliment $aliment The aliment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Aliment $aliment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('aliment_delete', array('id' => $aliment->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    private function buildSearchUrl($data)
    {
        $url = [];
        foreach ($data as $k => $v) {
            if (isset($data['search_vache']['numero']) && !empty($data['search_vache']['numero'])) {
                $url['numero'] = $data['search_vache']['numero'];
            }
        }
        return $url;
    }
}
