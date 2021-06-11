<?php


namespace App\Controller\Admin;


use App\Entity\Parcel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class IndexController
 * @package App\Controller\Admin
 *
 * @Route("/admin")
 */
class ParcelsController extends AbstractController
{
    /**
     * @Route("/parcels", name="admin.parcels.index")
     */
    public function indexAction()
    {
        /** @var EntityManagerInterface $em */
        $em = $this->getDoctrine()->getManager();

        $parcels = $em->createQueryBuilder()
            ->select('p')
            ->from(Parcel::class, 'p')
            ->getQuery()->execute();

        return $this->render('admin/parcels.html.twig', [
            'parcels' => $parcels
        ]);
    }

    /**
     * @Route("/parcels/pickup", name="admin.parcels.pickup.index")
     */
    public function toPickupAction()
    {
        /** @var EntityManagerInterface $em */
        $em = $this->getDoctrine()->getManager();

        $parcels = $em->getRepository(Parcel::class)
            ->getToPickup();

        return $this->render('admin/parcels_to_pickup.html.twig', [
            'parcels' => $parcels
        ]);
    }

    /**
     * @Route("/parcels/delivery", name="admin.parcels.delivery.index")
     */
    public function toDeliveryAction()
    {
        /** @var EntityManagerInterface $em */
        $em = $this->getDoctrine()->getManager();

        $parcels = $em->getRepository(Parcel::class)
            ->getToDelivery();

        return $this->render('admin/parcels_to_delivery.html.twig', [
            'parcels' => $parcels
        ]);
    }

    /**
     * @Route("/parcels/in-delivery", name="admin.parcels.in-delivery.index")
     */
    public function inDeliveryAction()
    {
        /** @var EntityManagerInterface $em */
        $em = $this->getDoctrine()->getManager();

        $parcels = $em->getRepository(Parcel::class)
            ->getInDelivery();

        return $this->render('admin/parcels_in_delivery.html.twig', [
            'parcels' => $parcels
        ]);
    }
}