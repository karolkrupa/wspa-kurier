<?php


namespace App\Controller;


use App\Entity\Courier;
use App\Entity\Parcel;
use App\Entity\ParcelType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OrderParcelController extends AbstractController
{
    /**
     * @Route("/zamow/{type}", name="parcel.order")
     */
    public function indexAction(ParcelType $type, Request $request)
    {
        $parcel = new Parcel();
        $parcel->setType($type);

        $form = $this->createForm(\App\Form\ParcelType::class, $parcel);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var EntityManagerInterface $em */
            $em = $this->getDoctrine()->getManager();

            $em->persist($parcel);
            $em->flush();

            return $this->redirectToRoute('parcel.success');
        }

        return $this->render('orderParcel.html.twig', [
            'form' => $form->createView(),
            'type' => $type
        ]);
    }

    /**
     * @Route("/dziekujemy", name="parcel.success")
     */
    public function successAction()
    {
        return $this->render('orderSuccess.html.twig', []);
    }
}