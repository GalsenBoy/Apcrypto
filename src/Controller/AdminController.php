<?php

namespace App\Controller;

use App\Entity\AnalyseFondamentale;
use App\Entity\Commentaire;
use App\Entity\AnalyseTechnique;
use App\Entity\CommentaireFonda;
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
        

        return $this->render('admin/index.html.twig', [
            'analyse' => $analyse,
        ]);
    }

    #[Route('/admin/fonda', name:'app_admin_fonda')]
    public function indexFonda(ManagerRegistry $managerRegistry): Response
    {
        $entityManager = $managerRegistry->getManager();
        $analyseFondaRepository = $entityManager->getRepository(AnalyseFondamentale::class);
        $analyseFonda =$analyseFondaRepository->findAll();
        

        return $this->render('admin/adminFonda.html.twig', [
            'fondamentale' => $analyseFonda,
        ]);
    }

    #[Route('/admin/user', name: 'app_admin_user')]
    public function indexUser(ManagerRegistry $managerRegistry): Response
    {
        $entityManager = $managerRegistry->getManager();
        $userRepository = $entityManager->getRepository(User::class);
        $user =$userRepository->findAll();


        return $this->render('admin/adminBackoffice.html.twig', [
            'user' => $user,
        ]);
    }
    #[Route('/admin/user/delete{userId}',name:'app_user_delete')]
    public function deleteUser(int $userId = 0,ManagerRegistry $managerRegistry):Response
    {
        $entityManager = $managerRegistry->getManager();
        $userRepository = $entityManager->getRepository(User::class);
        $user = $userRepository->find($userId);
        if (!$user) {
            return $this->redirectToRoute('app_admin_user');
        }
        $entityManager->remove($user);
        $entityManager->flush();
        return $this->redirectToRoute('app_admin_user');
    }

    #[Route('/admin/analyse/delete{analyseId}', name: 'analyse_delete')]
    public function deleteAnalyse(int $analyseId = 0, ManagerRegistry $managerRegistry): Response
    {
        $entityManager = $managerRegistry->getManager();
        $analyseRepository = $entityManager->getRepository(AnalyseTechnique::class);
        $analyse = $analyseRepository->find($analyseId);
        if (!$analyse) {
            return $this->redirectToRoute('analyse_delete');
        }
        $entityManager->remove($analyse);
        $entityManager->flush();
        return $this->redirectToRoute('analyse_communaute');
    }

    #[Route('/admin/analyseFonda/delete{fondamentaleId}', name: 'analyse_fondamentale_delete')]
    public function deleteAnalyseFonda(int $fondamentaleId = 0, ManagerRegistry $managerRegistry): Response
    {
        $entityManager = $managerRegistry->getManager();
        $analyseFondaRepository = $entityManager->getRepository(AnalyseFondamentale::class);
        $analyseFonda = $analyseFondaRepository->find($fondamentaleId);
        if (!$analyseFonda) {
            return $this->redirectToRoute('analyse_fondamentale_delete');
        }
        $entityManager->remove($analyseFonda);
        $entityManager->flush();
        return $this->redirectToRoute('app_fondamentale');
    }

    #[Route('/admin/commentaire',name:'app_commentaire')]
    public function AdminCommentaire(ManagerRegistry $managerRegistry):Response
    {
        $entityManager = $managerRegistry->getManager();
        $analyseRepository = $entityManager->getRepository(AnalyseTechnique::class);
        $analyse =$analyseRepository->findAll();

        $commentaireRepository = $entityManager->getRepository(Commentaire::class);
        $commentaire =$commentaireRepository->findAll();

        return $this->render('admin/adminCommentaire.html.twig', [
            'commentaires' => $commentaire,
            'analyse' => $analyse,
        ]);
    }

    #[Route('/admin/adminFonda/commentaire',name:'app_fonda_commentaire')]
    public function adminFondaCommentaire(ManagerRegistry $managerRegistry):Response
    {
        $entityManager = $managerRegistry->getManager();
        $analyseFondaRepository = $entityManager->getRepository(AnalyseFondamentale::class);
        $analyseFonda =$analyseFondaRepository->findAll();

        $commentaireFondaRepository = $entityManager->getRepository(CommentaireFonda::class);
        $commentaireFonda =$commentaireFondaRepository->findAll();
        

        return $this->render('admin/adminFondaCom.html.twig', [
            'commentaireFonda' => $commentaireFonda,
            'fondamentale' => $analyseFonda,
        ]);
    }

    #[Route('/admin/commentaire/delete{commentairesId}',name:'commentaire_delete')]
    public function deleteCommentaire(int $commentairesId = 0 ,ManagerRegistry $managerRegistry):Response
    {
        $entityManager = $managerRegistry->getManager();
        $commentaireRepository = $entityManager->getRepository(Commentaire::class);
        $commentaire = $commentaireRepository->find($commentairesId);
        if(!$commentaire){
            return $this->redirectToRoute('commentaire_delete');
        }
        $entityManager->remove($commentaire);
        $entityManager->flush();
        return $this->redirectToRoute('app_commentaire');
    }   

    #[Route('/admin/commentaireFonda/delete{commentaireFondaId}',name:'commentaire_fonda_delete')]
    public function deleteFondaCommentaire(int $commentaireFondaId = 0 ,ManagerRegistry $managerRegistry):Response
    {
        $entityManager = $managerRegistry->getManager();
        $commentaireFondaRepository = $entityManager->getRepository(CommentaireFonda::class);
        $commentaireFonda = $commentaireFondaRepository->find($commentaireFondaId);
        if(!$commentaireFonda){
            return $this->redirectToRoute('commentaire_fonda_delete');
        }
        $entityManager->remove($commentaireFonda);
        $entityManager->flush();
        return $this->redirectToRoute('commentaire_fonda_delete');
    }   
}
