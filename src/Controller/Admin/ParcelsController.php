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
}