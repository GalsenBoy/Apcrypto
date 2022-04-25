<?php

namespace App\Controller;

use App\Entity\AnalyseTechnique;
use App\Form\AnalyseTechniqueType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/nft', name: 'app_nft')]
    public function nft(): Response
    {
        return $this->render('index/nft.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/crypto', name: 'app_crypto')]
    public function crypto(): Response
    {
        return $this->render('index/crypto.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }


    #[Route('/metavers', name: 'app_metavers')]
    public function metaverse(): Response
    {
        return $this->render('index/metavers.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/communaute', name: 'app_communaute')]
    public function communaute(ManagerRegistry $managerRegistry): Response
    {
        $entityManager = $managerRegistry->getManager();
        $analyseRepository = $entityManager->getRepository(AnalyseTechnique::class);
        $analyse =$analyseRepository->findAll();
        return $this->render('index/communaute.html.twig', [
            'analyse' => $analyse,
        ]);
    }

/*
    #[Route('/communaute/analyse', name: 'app_index')]
    public function listeblog(ManagerRegistry $managerRegistry): Response
    {
        //Cette méthode affiche notre page d'accueil et la liste des Posts les plus récents
        //Nous récupérons la liste de nos posts via l'Entity Manager et le Repository pertinent
        $entityManager = $managerRegistry->getManager();
        $analyseRepository = $entityManager->getRepository(Post::class);
        //Nous récupérons les Categories à afficher:
        //Nous récupérons notre liste de posts
        $analyse = $analyseRepository->findBy([], ['id' => 'DESC'], 6);

        return $this->render('index/communate.html.twig', 
        [
            'analyse' => $analyse,
        ]);
    }
    */

    #[Route('analyse/creer', name:'analyse_create')]
    public function createAnalyse(Request $request, ManagerRegistry $managerRegistry):Response
    {
        
      
        //Pour dialoguer avec notre base de données et envoyer des éléments, nous avons besoin de l'Entity Manager
        $entityManager = $managerRegistry->getManager();
        //Nous récupérons les Categories à afficher:
        //$categoryRepository = $entityManager->getRepository(Category::class);
        //$categories = $categoryRepository->findAll();
        //Une fois que nous avons notre Entity Manager, nous créons une instance de Tag et nous la lions à un formulaire externalisé de type TagType
        $analyse = new AnalyseTechnique;
        $analyseForm = $this->createForm(AnalyseTechniqueType::class, $analyse);
        //Nous appliquons la Request sur notre formulaire TagType, et si ce dernier est validé, nous le persistons au sein de notre base de données
        $analyseForm->handleRequest($request);
        if($analyseForm->isSubmitted() && $analyseForm->isValid()){
            //Condition supplémentaire: on ne persiste que si l'affirmation que $title ET $text sont tous les deux null est INVALIDE
            $entityManager->persist($analyse);
            $entityManager->flush();
            return $this->redirectToRoute('app_index');
        }
        //Si le formulaire n'est pas rempli ou valide, nous transmettons une page web présentant notre formulaire à l'Utilisateur
        return $this->render('index/dataform.html.twig',[
            'formName' => "Partage d'analyse technique",
            'dataForm' => $analyseForm->createView(),
            'analyse' => $analyse,
        ]);
    }
    
}
    

