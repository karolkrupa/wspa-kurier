<?php


namespace App\Controller\Admin;


use App\Entity\Parcel;
use App\Form\ParcelsDeliveredType;
use App\Form\ParcelsPickupType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\HttpFoundation\Request;
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
    public function toPickupAction(Request $request)
    {
        /** @var EntityManagerInterface $em */
        $em = $this->getDoctrine()->getManager();

        $parcels = $em->getRepository(Parcel::class)
            ->getToPickup();

        $form = $this->createForm(ParcelsPickupType::class, [
            'parcels' => $parcels
        ]);

        $form->handleRequest($request);

        dump($form);

        if($form->isSubmitted() && $form->isValid()) {
            foreach ($form->get('parcels')->all() as $parcelForm) {
                if($parcelForm->get('select')->getData()) {
                    /** @var Parcel $parcel */
                    $parcel = $parcelForm->getData();

                    /**
                     * Przypisywanie aktualnego użytkownika jako kuriera
                     */
                    $parcel->setCourier($this->getUser());
                }
            }

            $em->flush();
        }

        return $this->render('admin/parcels_to_pickup.html.twig', [
            'parcels' => $parcels,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/parcels/my", name="admin.parcels.my.index")
     */
    public function myParcelsAction(Request $request)
    {
        /** @var EntityManagerInterface $em */
        $em = $this->getDoctrine()->getManager();

        $parcels = $em->getRepository(Parcel::class)
            ->getUser($this->getUser());

        $form = $this->createForm(ParcelsDeliveredType::class, [
            'parcels' => $parcels
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            foreach ($form->get('parcels')->all() as $parcelForm) {
                if($parcelForm->get('select')->getData()) {
                    /** @var Parcel $parcel */
                    $parcel = $parcelForm->getData();

                    /**
                     * Oznaczenie paczki jako dostarczona
                     */
                    $parcel->markAsDelivered();
                }
            }

            $em->flush();

            return $this->redirectToRoute('admin.parcels.my.index');
        }

        return $this->render('admin/parcels_to_pickup.html.twig', [
            'parcels' => $parcels,
            'form' => $form->createView()
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