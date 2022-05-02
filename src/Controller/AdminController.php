<?php

namespace App\Controller;


use App\Entity\AnalyseTechnique;
use App\Entity\Commentaire;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function indexAdmin(ManagerRegistry $managerRegistry): Response
    {
        $entityManager = $managerRegistry->getManager();
        $analyseRepository = $entityManager->getRepository(AnalyseTechnique::class);
        $analyse =$analyseRepository->findAll();
        //$analyse =$analyseRepository->findBy(['id' => 'DESC']);

        return $this->render('admin/index.html.twig', [
            'analyse' => $analyse,
        ]);
    }

    #[Route('/admin/commentaire',name:'app_commentaire')]
    public function AdminCommentaire(ManagerRegistry $managerRegistry):Response
    {
        $entityManager = $managerRegistry->getManager();
        $analyseRepository = $entityManager->getRepository(AnalyseTechnique::class);
        $analyse =$analyseRepository->findAll();

        $commentaireRepository = $entityManager->getRepository(Commentaire::class);
        $commentaire =$commentaireRepository->findAll();
        //$analyse =$commentaireRepository->findBy(['id' => 'DESC']);

        return $this->render('admin/adminCommentaire.html.twig', [
            'commentaires' => $commentaire,
            'analyse' => $analyse,
        ]);
    }

    #[Route('commentaire/delete{commentairesId}',name:'commentaire_delete')]
    public function deleteCommentaire(int $commentairesId = 0 ,ManagerRegistry $managerRegistry):Response
    {
        $entityManager = $managerRegistry->getManager();
        $commentaireRepository = $entityManager->getRepository(Commentaire::class);
        $commentaire = $commentaireRepository->find($commentairesId);
        if(!$commentaire){
            return $this->redirectToRoute('app_commentaire');
        }
        $entityManager->remove($commentaire);
        $entityManager->flush();
        return $this->redirectToRoute('app_commentaire');
    }   
}
