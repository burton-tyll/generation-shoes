<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;
use App\Form\RegisterType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthController extends MyAbstractController
{
    #[Route('/compte/connexion', name: 'auth_login')]
    public function login(Request $request): Response
    {
        $session = $request->getSession();
        // Créez le formulaire
        $form = $this->formFactory->create(LoginType::class);

        // Traitez la requête
        $form->handleRequest($request);

        // Validez le formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            // Si le formulaire est valide, faites quelque chose (connexion, redirection, etc.)
            $data = $form->getData();


            $user = $this->userRepository->findOneBy(['email' => $data->getEmail()]);

            if($user){
                //Si l'utilisateur est trouvé
                $password = $this->passwordHasher->isPasswordValid($user, $data->getPassword());
                if($password){
                    $session->set('user', $user);
                    return $this->redirectToRoute('home');
                }else{
                    $this->addFlash('alert', 'Mot de passe incorrect!');
                }
            }else{
                //Si l'utilisateur n'existe pas
                $this->addFlash('alert','L\'utilisateur n\'existe pas!');
            }
        }

        return $this->render('auth/login.html.twig', [
            'controller_name' => 'AuthController',
            'loginForm' => $form->createView(),
        ]);
    }

    #[Route('/compte/inscription', name: 'auth_register')]
    public function register(Request $request): Response
    {
        $session = $request->getSession();

        $form = $this->createForm(RegisterType::class);

        // Traitez la requête
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Si le formulaire est valide:
            $data = $form->getData();

            $user = $this->userRepository->findOneBy(['email' => $data->getEmail()]);

            if($user){
                //Si 'lutilisateur existe déjà
                $this->addFlash('alert', 'Un utilisateur est déjà inscrit avec cette adresse e-mail!');
            }else{
                //Si l'utilisateur n'existe pas
                $this->addFlash('success','Votre insciption a bien été prise en compte, vous voici connecté!');
                $newUser = new User();

                $plainPassword = $data->getPassword();
                $hashedPassword = $this->passwordHasher->hashPassword($newUser, $plainPassword);

                $newUser->setFirstname($data->getFirstname());
                $newUser->setLastname($data->getLastname());
                $newUser->setEmail($data->getEmail());
                $newUser->setPassword($hashedPassword);
                $newUser->setRole('ROLE_USER');
                $newUser->setCreatedAt(new \DateTime("now"));

                $this->entityManager->persist($newUser);
                $this->entityManager->flush();

                $session->set('user', $newUser);
                return $this->render('auth/register.html.twig', [
                    'page_title' => 'Inscrivez-vous!',
                    'registerForm' => $form->createView(),
                    'redirectDelay' => 5,
                    'redirectRoute' => 'home'
                ]);
            }
        }

        return $this->render('auth/register.html.twig', [
            'page_title' => 'Inscrivez-vous!',
            'registerForm' => $form->createView(),
        ]);
    }
}
