<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\Mail;
use App\Form\RegistrationFormType;
use App\Security\UserAuthenticator;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, UserAuthenticator $authenticator, EntityManagerInterface $entityManager, Mail $email): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setToken($this->generateToken());
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            $email->sendEmail(
                'apcrypto.noreply@gmail.com',
                $user->getEmail(),
                'Veuillez Activer votre compte',
                'Pour activer votre compte veuillez cliquez sur le lien suivant',
                $user->getToken(),
            );

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    public function generateToken()
    {
        return rtrim(strtr(base64_encode(random_bytes(length: 32)), '+/', '-_'));
    }


    #[Route('/confirmationCompte/{tokenId}', name: 'app_confirmation')]
    public function confirmation(string $tokenId,ManagerRegistry $managerRegistry,int $validite = 7200)
    {
        $entityManager = $managerRegistry->getManager();
        $userRepository = $entityManager->getRepository(User::class);
        $user = $userRepository->findOneBy(['token' => $tokenId]);
        $now = new DateTimeImmutable();
        $exp = $now->getTimestamp() + $validite;
        if($user){
            $user->setToken(token:null);
            $user->setestActif(true);
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('app_index');
        }
        return $this->json($tokenId);
    }
}
