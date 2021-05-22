<?php


namespace App\Controller;


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
        return $this->render('orderParcel.html.twig', [
            'type' => $type
        ]);
    }
}