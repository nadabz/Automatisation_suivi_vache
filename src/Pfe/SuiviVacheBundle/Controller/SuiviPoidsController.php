<?php

namespace Pfe\SuiviVacheBundle\Controller;

use Pfe\SuiviVacheBundle\Entity\SuiviPoids;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * Suivipoid controller.
 *
 * @Route("suivipoids")
 */
class SuiviPoidsController extends Controller
{
    /**
     * Lists all suiviPoid entities.
     *
     * @Route("/", name="suivipoids_index")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $suiviPoids = $em->getRepository('PfeSuiviVacheBundle:SuiviPoids')->findAll();

        return $this->render('@PfeSuiviVache/suivipoids/index.html.twig', array(
            'suiviPoids' => $suiviPoids,
        ));
    }

    /**
     * Creates a new suiviPoid entity.
     *
     * @Route("/new", name="suivipoids_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function newAction(Request $request)
    {
        $suiviPoid = new Suivipoid();
        $form = $this->createForm('Pfe\SuiviVacheBundle\Form\SuiviPoidsType', $suiviPoid);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($suiviPoid);
            $em->flush();

            return $this->redirectToRoute('suivipoids_show', array('id' => $suiviPoid->getId()));
        }

        return $this->render('@PfeSuiviVache/suivipoids/new.html.twig', array(
            'suiviPoid' => $suiviPoid,
            'form' => $form->createView(),
        ));
    }
    /**
     * Creates a new suiviPoid entity.
     *
     * @Route("/suivi_poids_vache", name="suivi_poids_vache")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function suiviPoidsVacheAction(Request $request)
    {
        $poids_vache=$request->request->get('poids_vache');
        $id_vache=$request->request->get('id_vache');
        $em = $this->getDoctrine()->getManager();

        $vache = $em->getRepository('PfeSuiviVacheBundle:Vache')->find($id_vache);
        $suiviPoids=new SuiviPoids();
        $suiviPoids->setPoidsActuel($poids_vache);
        $suiviPoids->setVache($vache);
        $suiviPoids->setDateSuivi(new \DateTime());
        $em->persist($suiviPoids);
        $em->flush();

        return new Response('ok');
    }

    /**
     * Finds and displays a suiviPoid entity.
     *
     * @Route("/{id}", name="suivipoids_show")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function showAction(SuiviPoids $suiviPoid)
    {
        $deleteForm = $this->createDeleteForm($suiviPoid);

        return $this->render('@PfeSuiviVache/suivipoids/show.html.twig', array(
            'suiviPoid' => $suiviPoid,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing suiviPoid entity.
     *
     * @Route("/{id}/edit", name="suivipoids_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")

     */
    public function editAction(Request $request, SuiviPoids $suiviPoid)
    {
        $deleteForm = $this->createDeleteForm($suiviPoid);
        $editForm = $this->createForm('Pfe\SuiviVacheBundle\Form\SuiviPoidsType', $suiviPoid);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "Modification avec succées");

            return $this->redirectToRoute('suivipoids_show', array('id' => $suiviPoid->getId()));
        }

        return $this->render('@PfeSuiviVache/suivipoids/edit.html.twig', array(
            'suiviPoid' => $suiviPoid,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a suiviPoid entity.
     *
     * @Route("/{id}", name="suivipoids_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, SuiviPoids $suiviPoid)
    {
        $form = $this->createDeleteForm($suiviPoid);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($suiviPoid);
            $em->flush();
        }

        return $this->redirectToRoute('suivipoids_index');
    }

    /**
     * Creates a form to delete a suiviPoid entity.
     *
     * @param SuiviPoids $suiviPoid The suiviPoid entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SuiviPoids $suiviPoid)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('suivipoids_delete', array('id' => $suiviPoid->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
