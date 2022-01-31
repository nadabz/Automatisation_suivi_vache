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
 * @Route("/")
 */
class PageController extends Controller
{
    /**
     * Lists all aliment entities.
     *
     * @Route("/", name="page_accueil")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_ELEVEUR') or has_role('ROLE_VETIRINAIRE') ")
     */

    public function accueilAction()
    {
        $em = $this->getDoctrine()->getManager();

        $etables = $em->getRepository('PfeSuiviVacheBundle:Etable')->findAll();
        $lots = $em->getRepository('PfeSuiviVacheBundle:Lot')->findAll();
        $vache = $em->getRepository('PfeSuiviVacheBundle:Vache')->findAll();
        $aliment = $em->getRepository('PfeSuiviVacheBundle:Aliment')->findAll();
        $race= $em->getRepository('PfeSuiviVacheBundle:Race')->findAll();
        $type= $em->getRepository('PfeSuiviVacheBundle:TypeVache')->findAll();
        $fournisseur= $em->getRepository('PfeSuiviVacheBundle:Fournisseur')->findAll();

        return $this->render('@PfeSuiviVache/page/accueil.html.twig', array(
        'nb_lot'=>count($lots),
        'nb_etable'=>count($etables),
        'nb_vache'=>count($vache),
            'nb_aliment'=>count($aliment),
            'nb_race'=>count($race),
            'nb_type'=>count($type),
            'nb_fournisseur'=>count($fournisseur),


        ));
    }

}
