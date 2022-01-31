<?php

namespace Pfe\SuiviVacheBundle\Controller;

use Pfe\SuiviVacheBundle\Entity\DistrubtionAliment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Distrubtionaliment controller.
 *
 * @Route("distrubtionaliment")
 */
class DistrubtionAlimentController extends Controller
{
    /**
     * Lists all distrubtionAliment entities.
     *
     * @Route("/", name="distrubtionaliment_index")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $distrubtionAliments = $em->getRepository('PfeSuiviVacheBundle:DistrubtionAliment')->findAll();

        return $this->render('@PfeSuiviVache/distrubtionaliment/index.html.twig', array(
            'distrubtionAliments' => $distrubtionAliments,
        ));
    }

    /**
     * Lists all distrubtionAliment entities.
     *
     * @Route("/distribution_aliment_jour", name="distribution_aliment_jour")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function distributionAlmientJourAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $id_lot = $request->request->get('id_lot');
        $id_type_vache = $request->request->get('id_type_vache');
        $id_race_vache = $request->request->get('id_race_vache');
        $id_tranche_vache = $request->request->get('id_tranche_vache');
        $typeVache = $em->getRepository('PfeSuiviVacheBundle:TypeVache')->find($id_type_vache);
        $race = $em->getRepository('PfeSuiviVacheBundle:Race')->find($id_race_vache);
        $trancheAge = $em->getRepository('PfeSuiviVacheBundle:TrancheAge')->find($id_tranche_vache);
        $lot = $em->getRepository('PfeSuiviVacheBundle:Lot')->find($id_lot);

        $distrubtionAliments = $em->getRepository('PfeSuiviVacheBundle:DistrubtionAliment')->findDistributionVacheJour($id_lot, date('Y-m-d'));

        $rations = $em->getRepository('PfeSuiviVacheBundle:Ration')->findAliment($id_tranche_vache, $id_race_vache, $id_type_vache);

        return $this->render('@PfeSuiviVache/vache/distribution_vache_jour.html.twig', array(
            'distrubtionAliments' => $distrubtionAliments,
            'rations' => $rations,
            'typeVache' => $typeVache,
            'race' => $race,
            'trancheAge' => $trancheAge,
            'lot' => $lot,
        ));
    }

    /**
     * insert distribution ajax.
     *
     * @Route("/save_distribution_lot", name="save_distribution_lot")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function saveDistributionLotAction(Request $request)
    {
        $data = $request->request->all();
        //echo "<pre>" . print_r($data, 1) . "</pre>";
        $tab_id_vache = explode(';', $data['id_vache_ch']);

        $em = $this->getDoctrine()->getManager();
        $id_aliment = $data['aliment_distibuer'];
        $aliment = $em->getRepository('PfeSuiviVacheBundle:Aliment')->find($id_aliment);
        $qte_disponible=$aliment->getQteStock();
        $total_qte_distrub=0;
        foreach ($tab_id_vache as $id_vache) {
            if (isset($data['qte_aliment_' . $id_vache]) and $data['qte_aliment_' . $id_vache] != '') {
                $qte_relle = $data['qte_aliment_' . $id_vache];
                $qte_adistribuer = $data['qte_adistribuer'];
                $vache = $em->getRepository('PfeSuiviVacheBundle:Vache')->find($id_vache);
                $distributionAliment = new DistrubtionAliment();
                $distributionAliment->setDateDistribution(new \DateTime());
                $distributionAliment->setAliment($aliment);
                $distributionAliment->setVache($vache);
                $distributionAliment->setQteADistribuer($qte_adistribuer);
                $distributionAliment->setQteDistribue($qte_relle);
                $em->persist($distributionAliment);
                $em->flush();
                $total_qte_distrub+=$qte_relle;
            }
        }

        $qte_restant=$qte_disponible-$total_qte_distrub;
        $aliment->setQteStock($qte_restant);
        $em->flush($aliment);
        return new Response('ok');
    }

    /**
     * Creates a new distrubtionAliment entity.
     *
     * @Route("/new", name="distrubtionaliment_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $distrubtionAliment = new Distrubtionaliment();
        $form = $this->createForm('Pfe\SuiviVacheBundle\Form\DistrubtionAlimentType', $distrubtionAliment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($distrubtionAliment);
            $em->flush();

            return $this->redirectToRoute('distrubtionaliment_show', array('id' => $distrubtionAliment->getId()));
        }

        return $this->render('distrubtionaliment/new.html.twig', array(
            'distrubtionAliment' => $distrubtionAliment,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a distrubtionAliment entity.
     *
     * @Route("/{id}", name="distrubtionaliment_show")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showAction(DistrubtionAliment $distrubtionAliment)
    {
        $deleteForm = $this->createDeleteForm($distrubtionAliment);

        return $this->render('distrubtionaliment/show.html.twig', array(
            'distrubtionAliment' => $distrubtionAliment,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing distrubtionAliment entity.
     *
     * @Route("/{id}/edit", name="distrubtionaliment_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, DistrubtionAliment $distrubtionAliment)
    {
        $deleteForm = $this->createDeleteForm($distrubtionAliment);
        $editForm = $this->createForm('Pfe\SuiviVacheBundle\Form\DistrubtionAlimentType', $distrubtionAliment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "Modification avec succées");


            return $this->redirectToRoute('distrubtionaliment_show', array('id' => $distrubtionAliment->getId()));
        }

        return $this->render('distrubtionaliment/edit.html.twig', array(
            'distrubtionAliment' => $distrubtionAliment,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a distrubtionAliment entity.
     *
     * @Route("/{id}", name="distrubtionaliment_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, DistrubtionAliment $distrubtionAliment)
    {
        $form = $this->createDeleteForm($distrubtionAliment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($distrubtionAliment);
            $em->flush();
        }

        return $this->redirectToRoute('distrubtionaliment_index');
    }

    /**
     * Creates a form to delete a distrubtionAliment entity.
     *
     * @param DistrubtionAliment $distrubtionAliment The distrubtionAliment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DistrubtionAliment $distrubtionAliment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('distrubtionaliment_delete', array('id' => $distrubtionAliment->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
