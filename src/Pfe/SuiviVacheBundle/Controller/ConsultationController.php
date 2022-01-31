<?php

namespace Pfe\SuiviVacheBundle\Controller;

use Pfe\SuiviVacheBundle\Entity\Consultation;
use Pfe\SuiviVacheBundle\Entity\Medicament;
use Pfe\SuiviVacheBundle\Entity\Ordonnance;
use Pfe\SuiviVacheBundle\Entity\Dose;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Consultation controller.
 *
 * @Route("consultation")
 */
class ConsultationController extends Controller
{
    /**
     * Lists all consultation entities.
     *
     * @Route("/", name="consultation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $consultations = $em->getRepository('PfeSuiviVacheBundle:Consultation')->findAll();

        return $this->render('@PfeSuiviVache/consultation/index.html.twig', array(
            'consultations' => $consultations,
        ));
    }

    /**
     * Creates a new consultation entity.
     *
     * @Route("/new", name="consultation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $consultation = new Consultation();
        $form = $this->createForm('Pfe\SuiviVacheBundle\Form\ConsultationType', $consultation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($consultation);
            $em->flush();

            return $this->redirectToRoute('consultation_show', array('id' => $consultation->getId()));
        }

        return $this->render('@PfeSuiviVache/consultation/new.html.twig', array(
            'consultation' => $consultation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a vache entity.
     *
     * @Route("/{id}/ordonnance", name="consultation_ordonnance")
     * @Method("GET")
     */
    public function ordonnanceAction(Consultation $consultation, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $dose = new Dose();

        $form = $this->createForm('Pfe\SuiviVacheBundle\Form\DoseType', $dose);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            if (count($consultation->getOrdonnance()) == 0) {
                $ordonnance = new Ordonnance();
                $ordonnance->setConsultation($consultation);
                $ordonnance->setDateOrdonnance(new \DateTime());
                $em->persist($ordonnance);
                $em->flush();
            } else {
                $ordonnance = $consultation->getOrdonnance();
            }

            $dose->setOrdonnance($ordonnance);
            $em->persist($dose);
            $em->flush();
            return $this->redirectToRoute('consultation_ordonnance', array('id' => $consultation->getId()));

        }

        return $this->render('@PfeSuiviVache/consultation/ordonnance.html.twig', array(
            'form' => $form->createView(),
            'consultation' => $consultation
        ));
    }

    /**
     * Finds and displays a consultation entity.
     *
     * @Route("/{id}", name="consultation_show")
     * @Method("GET")
     */
    public
    function showAction(Consultation $consultation)
    {
        $deleteForm = $this->createDeleteForm($consultation);

        return $this->render('@PfeSuiviVache/consultation/show.html.twig', array(
            'consultation' => $consultation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing consultation entity.
     *
     * @Route("/{id}/edit", name="consultation_edit")
     * @Method({"GET", "POST"})
     */
    public
    function editAction(Request $request, Consultation $consultation)
    {
        $deleteForm = $this->createDeleteForm($consultation);
        $editForm = $this->createForm('Pfe\SuiviVacheBundle\Form\ConsultationType', $consultation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash("success", "Modification avec succées");

            return $this->redirectToRoute('consultation_ordonnance', array('id' => $consultation->getId()));
        }

        return $this->render('@PfeSuiviVache/consultation/edit.html.twig', array(
            'consultation' => $consultation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));

    }

    /**
     * Deletes a consultation entity.
     *
     * @Route("/{id}", name="consultation_delete")
     * @Method("DELETE")
     */
    public
    function deleteAction(Request $request, Consultation $consultation)
    {
        $form = $this->createDeleteForm($consultation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($consultation);
            $em->flush();
        }

        return $this->redirectToRoute('consultation_index');
    }

    /**
     * Creates a form to delete a consultation entity.
     *
     * @param Consultation $consultation The consultation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private
    function createDeleteForm(Consultation $consultation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('consultation_delete', array('id' => $consultation->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
