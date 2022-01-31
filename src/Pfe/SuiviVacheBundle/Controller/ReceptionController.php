<?php

namespace Pfe\SuiviVacheBundle\Controller;

use Pfe\SuiviVacheBundle\Entity\Reception;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Reception controller.
 *
 * @Route("reception")
 */
class ReceptionController extends Controller
{
    /**
     * Lists all reception entities.
     *
     * @Route("/", name="reception_index")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $receptions = $em->getRepository('PfeSuiviVacheBundle:Reception')->findAll();

        return $this->render('@PfeSuiviVache/reception/index.html.twig', array(
            'receptions' => $receptions,
        ));
    }

    /**
     * Creates a new reception entity.
     *
     * @Route("/new", name="reception_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $reception = new Reception();
        $form = $this->createForm('Pfe\SuiviVacheBundle\Form\ReceptionType', $reception);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($reception);
            $em->flush();
            $aliment = $em->getRepository('PfeSuiviVacheBundle:Aliment')->find($reception->getAliment()->getId());
            $aliment->setQteStock($aliment->getQteStock() + $reception->getQteReception());

            $em->persist($aliment);
            $em->flush();
            return $this->redirectToRoute('reception_show', array('id' => $reception->getId()));
        }
//$receptions=$em->getRepository('PfeSuiviVacheBundle:Reception')->findBy()
        return $this->render('@PfeSuiviVache/reception/new.html.twig', array(
            'reception' => $reception,
            'form' => $form->createView(),
        ));
    }

    /**
     * histrique reception aliment.
     *
     * @Route("/historique_aliment", name="historique_aliment")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function historiqueAlimentAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $data = $request->request->all();
        $receptions = $em->getRepository('PfeSuiviVacheBundle:Reception')->findBy(['aliment' => $data['aliment']]);

        return $this->render('@PfeSuiviVache/reception/historique_aliment.html.twig', array(
            'receptions' => $receptions,
        ));
    }

    /**
     * Finds and displays a reception entity.
     *
     * @Route("/{id}", name="reception_show")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showAction(Reception $reception)
    {
        $deleteForm = $this->createDeleteForm($reception);

        return $this->render('@PfeSuiviVache/reception/show.html.twig', array(
            'reception' => $reception,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing reception entity.
     *
     * @Route("/{id}/edit", name="reception_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, Reception $reception)
    {
        $deleteForm = $this->createDeleteForm($reception);
        $editForm = $this->createForm('Pfe\SuiviVacheBundle\Form\ReceptionType', $reception);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "Modification avec succées");


            return $this->redirectToRoute('reception_show', array('id' => $reception->getId()));
        }

        return $this->render('@PfeSuiviVache/reception/edit.html.twig', array(
            'reception' => $reception,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reception entity.
     *
     * @Route("/{id}/delete", name="reception_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Reception $reception)
    {
        $form = $this->createDeleteForm($reception);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reception);
            $em->flush();
        }

        return $this->redirectToRoute('reception_index');
    }

    /**
     * Creates a form to delete a reception entity.
     *
     * @param Reception $reception The reception entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Reception $reception)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reception_delete', array('id' => $reception->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
