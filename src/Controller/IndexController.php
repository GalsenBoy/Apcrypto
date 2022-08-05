<?php

namespace App\Controller;

use App\Entity\AnalyseFondamentale;
use App\Entity\AnalyseTechnique;
use App\Entity\Commentaire;
use App\Entity\CommentaireFonda;
use App\Entity\User;
use App\Form\AnalyseFondamentaleType;
use App\Form\AnalyseTechniqueType;
use App\Form\CommentaireFondaType;
use App\Form\CommentaireType;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends AbstractController
{


    #[Route('/communaute', name: 'app_communaute')]
    public function communaute(Request $request, PaginatorInterface $paginatorInterface, ManagerRegistry $managerRegistry): Response
    {
        $entityManager = $managerRegistry->getManager();
        $analyseRepository = $entityManager->getRepository(AnalyseTechnique::class);
        $analyse = $analyseRepository->findBy(array(), array('date' => 'DESC'));

        $analyse = $paginatorInterface->paginate(
            $analyse,
            $request->query->getInt(key: 'page', default: 1),
            limit: 3,
        );
        return $this->render('index/communaute.html.twig', [
            'analyse' => $analyse,
        ]);
    }
    #[Route('/analyse/fondamentale', name: 'app_fondamentale')]
    public function fondamentale(Request $request, PaginatorInterface $paginatorInterface, ManagerRegistry $managerRegistry): Response
    {
        $entityManager = $managerRegistry->getManager();
        $fondamentaleRepository = $entityManager->getRepository(AnalyseFondamentale::class);
        $fondamentale = $fondamentaleRepository->findBy(array(), array('createat' => 'DESC'));

        $fondamentale = $paginatorInterface->paginate(
            $fondamentale,
            $request->query->getInt(key: 'page', default: 1),
            limit: 3,
        );


        return $this->render('index/fondamentale.html.twig', [
            'fondamentale' => $fondamentale,
        ]);
    }

    #[Route('analyse/technique/{analyseId}', name: 'analyse_display')]
    public function displayAnalyse(int $analyseId, ManagerRegistry $managerRegistry, Request $request): Response
    {
        $entityManager = $managerRegistry->getManager();
        $analyseRepository = $entityManager->getRepository(AnalyseTechnique::class);
        $analyse = $analyseRepository->find($analyseId);
        if (!$analyse) {
            return $this->redirectToRoute('app_communaute');
        }

        //Partie commentaire
        //On crée le commentaire
        $commentaire = new Commentaire;
        $user = $this->getUser()->getUserIdentifier();

        //On génère le formulaire
        $commentaireForm = $this->createForm(CommentaireType::class, $commentaire);
        $commentaireForm->handleRequest($request);

        if ($commentaireForm->isSubmitted() && $commentaireForm->isValid()) {
            $commentaire->setDate(new \DateTime("now"));
            $commentaire->setEmail('test@gmail.com');
            $commentaire->setAnalysetechnique($analyse);
            $commentaire->setPseudo($user);
            $entityManager->persist($commentaire);
            $entityManager->flush();
            return $this->redirectToRoute('app_communaute');
        }

        return $this->render('index/analyse_technique.html.twig', [
            'analyse' => $analyse,
            'commentaire' => $commentaire,
            'formName' => "Commentaire",
            'dataForm' => $commentaireForm->createView(),

        ]);
    }
    #[Route('analyse/creer', name: 'analyse_create')]
    public function createAnalyse(Request $request, ManagerRegistry $managerRegistry): Response
    {

        $user = $this->getUser()->getUserIdentifier();
        //Pour dialoguer avec notre base de données et envoyer des éléments, nous avons besoin de l'Entity Manager
        $entityManager = $managerRegistry->getManager();

        $analyse = new AnalyseTechnique;
        $analyseForm = $this->createForm(AnalyseTechniqueType::class, $analyse);
        //Nous appliquons la Request sur notre formulaire AnalyseTechniqueType, et si ce dernier est validé, nous le persistons au sein de notre base de données
        $analyseForm->handleRequest($request);
        if ($analyseForm->isSubmitted() && $analyseForm->isValid()) {
            $analyse->setDate(new \DateTime("now"));
            $analyse->setUtilisateur($user);
            //Condition supplémentaire: on ne persiste
            $entityManager->persist($analyse);
            $entityManager->flush();
            return $this->redirectToRoute('app_communaute');
        }
        //Si le formulaire n'est pas rempli ou valide, nous transmettons une page web présentant notre formulaire à l'Utilisateur
        return $this->render('index/dataform.html.twig', [
            'formName' => "Partage d'analyse technique",
            'dataForm' => $analyseForm->createView(),
            'analyse' => $analyse,
        ]);
    }

    #[Route('analyse/update{fondamentaleId}', name: 'analyse_update')]
    public function updateAnalyse(int $fondamentaleId = 0, ManagerRegistry $managerRegistry, Request $request): Response
    {
        $entityManager = $managerRegistry->getManager();
        $analyseFondaRepository = $entityManager->getRepository(AnalyseFondamentale::class);
        $analyseFonda = $analyseFondaRepository->find($fondamentaleId);
        if (!$analyseFonda) {
            return $this->redirectToRoute('app_communaute');
        }
        $analyseFondaForm = $this->createForm(AnalyseFondamentaleType::class, $analyseFonda);
        $analyseFondaForm->handleRequest($request);
        if ($analyseFondaForm->isSubmitted() && $analyseFondaForm->isValid()) {
            $entityManager->persist($analyseFonda);
            $entityManager->flush();
            return $this->redirectToRoute('app_communaute');
        }
        return $this->render('index/dataform.html.twig', [
            'formName' => "Modifier l'analyse fondamentale",
            'dataForm' => $analyseFondaForm->createView(),
        ]);
    }

    #[Route('analyse/fondamental/creer', name: 'fondamentale_create')]
    public function createAnalyseFondamentale(Request $request, ManagerRegistry $managerRegistry): Response
    {

        $user = $this->getUser()->getUserIdentifier();
        //Pour dialoguer avec notre base de données et envoyer des éléments, nous avons besoin de l'Entity Manager
        $entityManager = $managerRegistry->getManager();
        $fondamentale = new AnalyseFondamentale;
        $fondamentaleForm = $this->createForm(AnalyseFondamentaleType::class, $fondamentale);

        $fondamentaleForm->handleRequest($request);
        if ($fondamentaleForm->isSubmitted() && $fondamentaleForm->isValid()) {
            $fondamentale->setCreateat(new \DateTime("now"));
            $fondamentale->setUtilisateur($user);
            $entityManager->persist($fondamentale);
            $entityManager->flush();
            return $this->redirectToRoute('app_fondamentale');
        }
        //Si le formulaire n'est pas rempli ou valide, nous transmettons une page web présentant notre formulaire à l'Utilisateur
        return $this->render('index/dataform.html.twig', [
            'formName' => "Partage d'analyse fondamentale ",
            'dataForm' => $fondamentaleForm->createView(),
            'fondamentale' => $fondamentale,
        ]);
    }


    #[Route('analyse/fondamentale/{fondamentaleId}', name: 'analyse_fondamentale_display')]
    public function displayAnalyseFondamentale(int $fondamentaleId, ManagerRegistry $managerRegistry, Request $request): Response
    {
        $entityManager = $managerRegistry->getManager();
        $user = $this->getUser()->getUserIdentifier();
        $fondamentaleRepository = $entityManager->getRepository(AnalyseFondamentale::class);
        $fondamentale = $fondamentaleRepository->find($fondamentaleId);
        if (!$fondamentale) {
            return $this->redirectToRoute('app_communaute');
        }

        //Partie commentaire
        //On crée le commentaire
        $commentaireFonda = new CommentaireFonda;

        //On génère le formulaire
        $commentaireFondaForm = $this->createForm(CommentaireFondaType::class, $commentaireFonda);
        $commentaireFondaForm->handleRequest($request);

        if ($commentaireFondaForm->isSubmitted() && $commentaireFondaForm->isValid()) {
            $commentaireFonda->setDate(new \DateTime("now"));
            $commentaireFonda->setanalyseFondamentale($fondamentale);
            $commentaireFonda->setNickname($user);
            $entityManager->persist($commentaireFonda);
            $entityManager->flush();
            return $this->redirectToRoute('app_fondamentale');
        }

        return $this->render('index/analysefondamentale.html.twig', [
            'fondamentale' => $fondamentale,
            'commentaireFonda' => $commentaireFonda,
            'formName' => "Commentaire",
            'dataForm' => $commentaireFondaForm->createView(),
        ]);
    }
}
