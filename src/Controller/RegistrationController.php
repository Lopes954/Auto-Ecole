<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Contactf;
use App\Entity\Renseignement;
use App\Form\RegistrationFormType;
use App\Form\FormRenseignementType;
use App\Repository\ContactfRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(AuthenticationUtils $authenticationUtils, Request $request, UserPasswordHasherInterface $passwordEncoder, FormRenseignementType $renseignement, ContactfRepository $repo, EntityManagerInterface $manager): Response
    {
        $route = "app_register";
        $user = new User;
        $registrationForm = $this->createForm(RegistrationFormType::class, $user);
        $registrationForm->handleRequest($request);
        if ($registrationForm->isSubmitted() && $registrationForm->isValid()) {
            $user->setPassword(
                $passwordEncoder->hashPassword(
                    $user,
                    $registrationForm->get('plainPassword')->getData()
                )

            );
            // $role=[];
            // $role[]="ROLE_USERS";
            // $user->setRoles($role);
            $manager->persist($user);
            $manager->flush();
            $this->addFlash('success', 'Inscription effectuée');

            return $this->redirectToRoute('app_register');
        }

        //footer
        $renseignement = new Renseignement;

        // $contact = $this->contactfRepository->findAll();


        $contact = $repo->findBy(array('id' => 1));
        $contact = $contact[0];

        $form = $this->createForm(FormRenseignementType::class, $renseignement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $renseignement = $form->getData();
            $manager->persist($renseignement);
            $manager->flush();
            return $this->redirectToRoute('contactf');
        }
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        return $this->render('registration/register.html.twig', [
            // 'last_username' => $lastUsername, 
            // 'error' => $error,
            'registrationForm' => $registrationForm->createView(),
            'contact' => $contact,
            'form' => $form->createView(),
            'route' => $route,
            'user' => $user,
        ]);
    }
}
