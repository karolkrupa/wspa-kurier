<?php


namespace App\Controller;


use App\Entity\Courier;
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

    public function footerAction()
    {
        $parcelTypes = $this->getDoctrine()->getManager()
            ->getRepository(ParcelType::class)
            ->findAll();

        $couriers = $this->getDoctrine()->getManager()
            ->getRepository(Courier::class)
            ->findAll();

        return $this->render('partials/footer.html.twig', [
            'parcelTypes' => $parcelTypes,
            'couriers' => $couriers
        ]);
    }
}