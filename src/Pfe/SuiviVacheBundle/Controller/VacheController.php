<?php

namespace Pfe\SuiviVacheBundle\Controller;

use Pfe\SuiviVacheBundle\Entity\Consultation;
use Pfe\SuiviVacheBundle\Entity\Vache;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Pfe\SuiviVacheBundle\Form\VacheSearchType;

/**
 * Vache controller.
 *
 * @Route("vache")
 */
class VacheController extends Controller
{
    /**
     * Lists all vache entities.
     *
     * @Route("/", name="vache_index")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_ELEVEUR') or has_role('ROLE_VETIRINAIRE')")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm('Pfe\SuiviVacheBundle\Form\VacheSearchType');
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $url = $this->buildSearchUrl($request->request->all());

            if (!empty($url)) {
                return $this->redirectToRoute('vache_index', $url);
            }
        }
        $em = $this->getDoctrine()->getManager();
        $paginator = $this->get('knp_paginator');

        $vaches = $paginator->paginate(
            $em->getRepository('PfeSuiviVacheBundle:Vache')->rechercheVache($request->query->all()), /* query NOT result */
            $request->query->getInt('page', 1)/* page number */, 10/* limit per page */
        );

        return $this->render('@PfeSuiviVache/vache/index.html.twig', array(
            'vaches' => $vaches,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing vache entity.
     *
     * @Route("/affectation_vache", name="affectation_vache")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function affectVacheAction(Request $request)
    {
        $id_lot = $request->request->get('id_lot');
        $id_vache = $request->request->get('id_vache');

        $em = $this->getDoctrine()->getManager();
        $vache = $em->getRepository('PfeSuiviVacheBundle:Vache')->find($id_vache);
        $lot = $em->getRepository('PfeSuiviVacheBundle:Lot')->find($id_lot);
        $vache->setLot($lot);
        $this->getDoctrine()->getManager()->flush();

        $tab_json = [
            'num_lot' => $lot->getNumLot(),
            'type_vache' => $lot->getTypeVache()->getId()
        ];
        return new Response(json_encode($tab_json));
    }

    /**
     * Creates a new vache entity.
     *
     * @Route("/new", name="vache_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $vache = new Vache();
        $form = $this->createForm('Pfe\SuiviVacheBundle\Form\VacheType', $vache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vache);
            $em->flush();

            return $this->redirectToRoute('vache_show', array('id' => $vache->getId()));
        }
        $em = $this->getDoctrine()->getManager();
        $last_vache = $em->getRepository('PfeSuiviVacheBundle:Vache')->findOneBy(
            [],        // $where
            array('id' => 'DESC'),    // $orderBy
            1,                        // $limit
            0                          // $offset
        );
        if (count($last_vache) > 0) {
            $last_numero = $last_vache->getNumero() + 1;
        } else {
            $last_numero = 1;
        }
        return $this->render('@PfeSuiviVache/vache/new.html.twig', array(
            'last_numero' => $last_numero,
            'vache' => $vache,
            'form' => $form->createView(),
        ));
    }
    /**
     * Finds and displays a vache entity.
     *
     * @Route("/{id}", name="vache_show")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_ELEVEUR') or has_role('ROLE_VETIRINAIRE')")
     */
    public function showAction(Vache $vache)
    {
        $deleteForm = $this->createDeleteForm($vache);

        return $this->render('@PfeSuiviVache/vache/show.html.twig', array(
            'vache' => $vache,
            'delete_form' => $deleteForm->createView(),
        ));
    }

        /**
         * Finds and displays a vache entity.
         *
         * @Route("/{id}/consultation", name="vache_consultation")
         * @Method("GET")
         * @Security("has_role('ROLE_VETIRINAIRE')")
         */
        public function consultationAction(Vache $vache,Request $request)
        {
            $em = $this->getDoctrine()->getManager();
            $consultation = new Consultation();
            $form = $this->createForm('Pfe\SuiviVacheBundle\Form\ConsultationType', $consultation);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $consultation->setUser($this->getUser());
                $consultation->setVache($vache);
                $em->persist($consultation);
                $em->flush();

                return $this->redirectToRoute('vache_consultation', array('id' => $vache->getId()));
            }

            $consultations = $em->getRepository('PfeSuiviVacheBundle:Consultation')->findBy(['vache'=>$vache->getId()],['dateConsultation'=>'desc']);
            return $this->render('@PfeSuiviVache/vache/consultation.html.twig', array(
                'vache' => $vache,
                'consultations' => $consultations,
                'form' => $form->createView(),
            ));
        }

    /**
     * Displays a form to edit an existing vache entity.
     *
     * @Route("/{id}/edit", name="vache_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, Vache $vache)
    {
        $deleteForm = $this->createDeleteForm($vache);
        $editForm = $this->createForm('Pfe\SuiviVacheBundle\Form\VacheType', $vache);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "Modification avec succées");

            return $this->redirectToRoute('vache_show', array('id' => $vache->getId()));
        }

        return $this->render('@PfeSuiviVache/vache/edit.html.twig', array(
            'vache' => $vache,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Deletes a vache entity.
     *
     * @Route("/{id}/delete", name="vache_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, Vache $vache)
    {
        $form = $this->createDeleteForm($vache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($vache);
            $em->flush();
        }

        return $this->redirectToRoute('vache_index');
    }

    /**
     * Creates a form to delete a vache entity.
     *
     * @param Vache $vache The vache entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Vache $vache)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('vache_delete', array('id' => $vache->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    private function buildSearchUrl($data)
    {
        $url = [];
        foreach ($data as $k => $v) {
            if (isset($data['search_vache']['numero']) && !empty($data['search_vache']['numero'])) {
                $url['numero'] = $data['search_vache']['numero'];
            }
            if (isset($data['search_vache']['ageMin']) && !empty($data['search_vache']['ageMin'])) {
                $url['ageMin'] = $data['search_vache']['ageMin'];
            }
            if (isset($data['search_vache']['ageMax']) && !empty($data['search_vache']['ageMax'])) {
                $url['ageMax'] = $data['search_vache']['ageMax'];
            }
        }
        return $url;
    }
}
