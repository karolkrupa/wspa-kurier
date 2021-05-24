<?php


namespace App\Controller;


use App\Entity\Courier;
use App\Entity\ParcelType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OrderParcelController extends AbstractController
{
    /**
     * @Route("/zamow/{type}", name="parcel.order")
     */
    public function indexAction(ParcelType $type)
    {
        $parcelTypes = $this->getDoctrine()->getManager()
            ->getRepository(ParcelType::class)
            ->findAll();

        $couriers = $this->getDoctrine()->getManager()
            ->getRepository(Courier::class)
            ->findAll();

        return $this->render('orderParcel.html.twig', [
            'type' => $type,
            'parcelTypes' => $parcelTypes,
            'couriers' => $couriers
        ]);
    }
}