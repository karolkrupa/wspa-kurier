<?php


namespace App\Controller;


use App\Entity\ParcelType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $parcelTypes = $this->getDoctrine()->getManager()
            ->getRepository(ParcelType::class)
            ->findAll();

        return $this->render('home.html.twig', [
            'parcelTypes' => $parcelTypes
        ]);
    }
}