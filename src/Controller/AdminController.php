<?php

namespace App\Controller;


use App\Entity\Commentaire;
use App\Entity\AnalyseTechnique;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



#[Security('is_granted("ROLE_ADMIN")')]
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

    #[Route('/admin/user', name: 'app_admin_user')]
    public function indexUser(ManagerRegistry $managerRegistry): Response
    {
        $entityManager = $managerRegistry->getManager();
        $userRepository = $entityManager->getRepository(User::class);
        $user =$userRepository->findAll();
        //$analyse =$analyseRepository->findBy(['id' => 'DESC']);

        return $this->render('admin/adminBackoffice.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('analyse/delete{analyseId}', name: 'analyse_delete')]
    public function deleteAnalyse(int $analyseId = 0, ManagerRegistry $managerRegistry): Response
    {
        $entityManager = $managerRegistry->getManager();
        $analyseRepository = $entityManager->getRepository(AnalyseTechnique::class);
        $analyse = $analyseRepository->find($analyseId);
        if (!$analyse) {
            return $this->redirectToRoute('app_communaute');
        }
        $entityManager->remove($analyse);
        $entityManager->flush();
        return $this->redirectToRoute('app_communaute');
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
