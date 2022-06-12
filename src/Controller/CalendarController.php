<?php

namespace App\Controller;

use App\Entity\Calendar;
use App\Form\CalendarType;
use App\Entity\Renseignement;
use App\Form\FormRenseignementType;
use App\Repository\CalendarRepository;
use App\Repository\ContactfRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\RenseignementRepository;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/calendar")
 */
class CalendarController extends AbstractController
{
    public function __construct(ContactfRepository $repocon, RenseignementRepository $reporen, EntityManagerInterface $em)
    {
        $this->contactfRepository = $repocon; //Initialisation
        $this->renseignementRepository = $reporen; //Initialisation
        $this->em = $em; //Initialisation
        
    }


    //cette fontion va nous permettre de mettre a jour un evenement sur notre calendrier

    /**
     * @Route("/{id}/edit", name="api_event_edit", methods={"PUT"})
     */
    public function majEvent(?Calendar $calendar, Request $request): Response
    {
        $user = $this->getUser();
        //on recupere les données
        $donnees = json_decode($request->getContent());
        dump($donnees);
        //on verifie les données

        if (
            isset($donnees->start) && !empty($donnees->start) &&
            isset($donnees->end) && !empty($donnees->end) &&
            isset($donnees->backgroundColor) && !empty($donnees->backgroundColor) &&
            isset($donnees->textColor) && !empty($donnees->textColor)
        ) {
            //les données sont complétes
            //on initialise un code
            $code = 200;
            //on verifie si il existe
            if (!$calendar) {
                $calendar = new Calendar;

                //on change le code
                $code = 201;
            }

            //on hydrate l'objet avec les données
            $calendar->setStart(new DateTimeImmutable($donnees->start));
            if ($donnees->allDay) {
                $calendar->setEnd(new DateTimeImmutable($donnees->start));
            } else {
                $calendar->setEnd(new DateTimeImmutable($donnees->end));
            }
            $calendar->setAllDay($donnees->allDay);
            $calendar->setBackgroundColor($donnees->backgroundColor);
            $calendar->setTextColor($donnees->textColor);
            $this->em->persist($calendar);
            $this->em->flush();


            //on retourne le code

            return new Response('OK', $code);
        } else {
            //les données sont incompletes
            return new Response('Données imcomplètes', 404);
        }
        $route = "calendar";
        return $this->render('calendar/index.html.twig', [
            'data' => $donnees,
            'route' => $route,
            'user' => $user
        ]
    );
    }



    /**
     * @Route("/", name="calendar_index", methods={"GET"})
     */
    public function index(CalendarRepository $calendarRepository, Request $request): Response
    {
        $user = $this->getUser();
        $route = "calendar";
        $events = $calendarRepository->findAll();
        dump($events);
        $rdvs = [];
        foreach ($events as $event) {
            $nomPrenom = $event->getClient()->__toString();
            $rdvs[] = [
                "id" => $event->getId(),
                "start" => $event->getStart()->format('Y-m-d H:i:s'),
                "end" => $event->getEnd()->format('Y-m-d H:i:s'),
                "title" => $nomPrenom,
                "backgroundColor" => $event->getBackgroundColor(),
                "textColor" => $event->getTextColor(),
                
            ];
        }
        $data = json_encode($rdvs);
        return $this->render('calendar/index.html.twig', [
            'route' => $route,
            'data' => $data,
            'user' => $user
                    
        ]);
    }



    /**
     * @Route("/new", name="calendar_new", methods={"GET","POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $route = "calendar_new";

        $contact = $this->contactfRepository->findBy(array('id' => 1));
        $contact = $contact[0];
        $renseignement = new Renseignement;

        $formRenseignement = $this->createForm(FormRenseignementType::class, $renseignement);
        $formRenseignement->handleRequest($request);


        if ($formRenseignement->isSubmitted() && $formRenseignement->isValid()) {
            $entityManager->persist($renseignement);
            $entityManager->flush();

            return $this->redirectToRoute('calendar_index', [], Response::HTTP_SEE_OTHER);
        }
        
        $calendar = new Calendar();

        $formCalendar = $this->createForm(CalendarType::class, $calendar);
        $formCalendar->handleRequest($request);

        if ($formCalendar->isSubmitted() && $formCalendar->isValid()) {
            $calendar->setClient($user);
            $calendar->setBackgroundColor('#000000');
            $calendar->setTextColor('#ffffff');
            $calendar->setAllDay(0);
            $entityManager->persist($calendar);
            $entityManager->flush();
            
            $this->addFlash('success', 'reservation effectuée');
            return $this->redirectToRoute('calendar_new', [], Response::HTTP_SEE_OTHER);            
        }

        return $this->renderForm('calendar/new.html.twig', [
            'formCalendar' => $formCalendar,
            'form' => $formRenseignement,
            'route' => $route,
            'contact' => $contact,
            'user' => $user

        ]);
    }




    /**
     * @Route("/{id}", name="calendar_show", methods={"GET"})
     */
    public function show(Calendar $calendar): Response
    {
        return $this->render('calendar/show.html.twig', [
            'calendar' => $calendar,
        ]);
    }

    /**
     * @Route("/{id}", name="calendar_delete", methods={"POST"})
     */
    public function delete(Request $request, Calendar $calendar, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $calendar->getId(), $request->request->get('_token'))) {
            $entityManager->remove($calendar);
            $entityManager->flush();
        }

        return $this->redirectToRoute('calendar_index', [], Response::HTTP_SEE_OTHER);
    }
}
