<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Renseignement;
use App\Form\ReservationType;
use App\Repository\UserRepository;
use App\Form\FormRenseignementType;
use App\Repository\ForfaitRepository;
use App\Repository\CalendarRepository;
use App\Repository\ContactfRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\HorairebureauRepository;
use App\Repository\RenseignementRepository;
use App\Repository\HoraireconduiteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GeneralController extends AbstractController
{

    // //je cree mes variable
    // /**
    //  * @var ContactfRepository
    //  * @var RenseignementRepository
    //  * @var ForfaitRepository
    //  * @var HorairebureauRepository
    //  */
    // private $contactfRepository;
    // private $renseignementRepository;
    // private $forfaitRepository;
    // private $em;

    // Ensuite je met en place mon constructeur qui va me permettre de de créé mon objet et par la suite pouvoir le recupéré

    public function __construct(HoraireconduiteRepository $repohoraireconduite,ContactfRepository $repocon, RenseignementRepository $reporen, ForfaitRepository $repofor,HorairebureauRepository $repohorairebureau,  EntityManagerInterface $em)
    {
        $this->contactfRepository = $repocon; //Initialisation
        $this->renseignementRepository = $reporen; //Initialisation
        $this->forfaitRepository = $repofor; //Initialisation
        $this->horairebureauRepository = $repohorairebureau; //Initialisation
        $this->horaireconduiteRepository = $repohoraireconduite; //Initialisation

        $this->em = $em; //Initialisation
    }



    // public function test()
    // {
    //     var_dump("ca fonctionne");
    //     die();
    // } 


    /**
     * @Route("/", name="home")
     */
    function home(Request $request)
    {
        $contact = $this->contactfRepository->findBy(array('id' => 1));
        $contact = $contact[0];
        $user = $this->getUser();
        $route = "home";
        
        $renseignement = new Renseignement;
        $form = $this->createForm(FormRenseignementType::class, $renseignement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $renseignement = $form->getData();
            // $manager = $this->getDoctrine()->getManager();
            $this->em->persist($renseignement);
            $this->em->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('general/home.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
            'route' => $route,
            'user' => $user


        ]);
    }


    /**
     * @Route("/localisation", name="localisation")
     */
    function localisation(EntityManagerInterface $manager, Request $request)
    {

        $horairesconduite = $this->horaireconduiteRepository->findAll();
        $horaires = $this->horairebureauRepository->findAll();

        $user = $this->getUser();
        $route = "localisation";
        $renseignement = new Renseignement;
        $contact = $this->contactfRepository->findBy(array('id' => 1));
        $contact = $contact[0];
        $form = $this->createForm(FormRenseignementType::class, $renseignement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $renseignement = $form->getData();
            $manager->persist($renseignement);
            $manager->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('general/localisation.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
            'route' => $route,
            'user' => $user,
            'horaires' => $horaires,
            'horairesconduite' => $horairesconduite
        ]);
    }


    /**
     * @Route("/forfait", name="forfait")
     */
    function forfait(EntityManagerInterface $manager, ContactfRepository $repocon, Request $request, ForfaitRepository $repofor, CategorieRepository $repocategorie, ForfaitRepository $repoforfait, UserRepository $repoClient)
    {
        $user = $this->getUser();
        $route = "forfait";
        $renseignement = new Renseignement;
        $categories = $repocategorie->findAll();
        $forfaits = $repoforfait->findAll();

        $contact = $repocon->findBy(array('id' => 1));
        $contact = $contact[0];

        $form = $this->createForm(FormRenseignementType::class, $renseignement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $renseignement = $form->getData();
            $manager->persist($renseignement);
            $manager->flush();
            return $this->redirectToRoute('contactf');
        }
        return $this->render('general/forfait.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
            'route' => $route,
            'categories' => $categories,
            'forfaits' => $forfaits,
            'user' => $user

        ]);
    }

    /**
     * @Route("/contactf", name="contactf")
     */
    public function index(ContactfRepository $repocon, Request $request, EntityManagerInterface $manager): Response
    {
        $user = $this->getUser();
        $route = "contactf";
        $renseignement = new Renseignement;
        $contact = $repocon->findBy(array('id' => 1));
        $contact = $contact[0];

        $form = $this->createForm(FormRenseignementType::class, $renseignement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $renseignement = $form->getData();
            $manager->persist($renseignement);
            $manager->flush();
            return $this->redirectToRoute('contactf');
        }


        return $this->render('general/home.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
            'route' => $route,
            'user' => $user

        ]);
    }

    /**
     * @Route("/reservation", name="reservation")
     */

    public function reservation( EntityManagerInterface $manager, ContactfRepository $repocon, Request $request, CalendarRepository $calendar): Response
    {
        $user = $this->getUser();
        $route = "reservation";
        $user = $this->getUser();
        $reservation = new Reservation;
        $formReservation = $this->createForm(ReservationType::class, $reservation);
        $formReservation->handleRequest($request);
        if ($formReservation->isSubmitted() && $formReservation->isValid()) {
            $reservation->setClient($user);
            $this->em->persist($reservation);
            $this->em->flush();
            return $this->redirectToRoute('home');
        }
        //footer
        $renseignement = new Renseignement;

        $contact = $repocon->findBy(array('id' => 1));
        $contact = $contact[0];

        $form = $this->createForm(FormRenseignementType::class, $renseignement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $renseignement = $form->getData();
            $manager->persist($renseignement);
            $manager->flush();
            return $this->redirectToRoute('contactf');
        }

        return $this->render('client/reservationHeure.html.twig', [
            'controller_name' => 'GeneralController',
            'contact' => $contact,
            'form' => $form->createView(),
            'formReservation' => $formReservation->createView(),
            'route' => $route,
            'user' => $user

        ]);
    }
}
