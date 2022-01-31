<?php

namespace Pfe\SuiviVacheBundle\Controller;

use Pfe\SuiviVacheBundle\Entity\TypeVache;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Typevache controller.
 *
 * @Route("typevache")
 */
class TypeVacheController extends Controller
{
    /**
     * Lists all typeVache entities.
     *
     * @Route("/", name="typevache_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $typeVaches = $em->getRepository('PfeSuiviVacheBundle:TypeVache')->findAll();

        return $this->render('@PfeSuiviVache/typevache/index.html.twig', array(
            'typeVaches' => $typeVaches,
        ));
    }

    /**
     * Creates a new typeVache entity.
     *
     * @Route("/new", name="typevache_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $typeVache = new Typevache();
        $form = $this->createForm('Pfe\SuiviVacheBundle\Form\TypeVacheType', $typeVache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeVache);
            $em->flush();

            return $this->redirectToRoute('typevache_show', array('id' => $typeVache->getId()));
        }

        return $this->render('@PfeSuiviVache/typevache/new.html.twig', array(
            'typeVache' => $typeVache,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a typeVache entity.
     *
     * @Route("/{id}", name="typevache_show")
     * @Method("GET")
     */
    public function showAction(TypeVache $typeVache)
    {
        $deleteForm = $this->createDeleteForm($typeVache);

        return $this->render('@PfeSuiviVache/typevache/show.html.twig', array(
            'typeVache' => $typeVache,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing typeVache entity.
     *
     * @Route("/{id}/edit", name="typevache_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TypeVache $typeVache)
    {
        $deleteForm = $this->createDeleteForm($typeVache);
        $editForm = $this->createForm('Pfe\SuiviVacheBundle\Form\TypeVacheType', $typeVache);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('typevache_edit', array('id' => $typeVache->getId()));
        }

        return $this->render('@PfeSuiviVache/typevache/edit.html.twig', array(
            'typeVache' => $typeVache,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a typeVache entity.
     *
     * @Route("/{id}", name="typevache_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TypeVache $typeVache)
    {
        $form = $this->createDeleteForm($typeVache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($typeVache);
            $em->flush();
        }

        return $this->redirectToRoute('typevache_index');
    }

    /**
     * Creates a form to delete a typeVache entity.
     *
     * @param TypeVache $typeVache The typeVache entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TypeVache $typeVache)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('typevache_delete', array('id' => $typeVache->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
