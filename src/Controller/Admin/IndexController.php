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
class IndexController extends AbstractController
{
    /**
     * @Route("/", name="admin.index")
     */
    public function indexAction()
    {
        /** @var EntityManagerInterface $em */
        $em = $this->getDoctrine()->getManager();

        $parcels = $em->createQueryBuilder()
            ->select('p')
            ->from(Parcel::class, 'p')
            ->getQuery()->execute();

        return $this->render('admin/index.html.twig', [
            'parcels' => $parcels
        ]);
    }
}