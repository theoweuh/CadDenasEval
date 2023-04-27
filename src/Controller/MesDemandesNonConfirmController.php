<?php

namespace App\Controller;

use App\Entity\Demande;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MesDemandesNonConfirmController extends AbstractController
{

    #[Route('/demandes-non-confirmees', name: 'app_demandes_non_confirmees')]
    public function index(ManagerRegistry $doctrine): Response
    {

        $user = $doctrine->getRepository(Demande::class)->findBy(['user' => $this->getUser()]);

        $mesDemandes = $doctrine->getRepository(Demande::class)->findBy(['user' => $this->getUser(), 'dateConfirmation' => null]);

        return $this->render('mes_demandes/nonconfirm.html.twig', [
            'demandes' => $mesDemandes,
            'user' => $doctrine->getRepository(User::class)->find($this->getUser()),
            'dateConfirmation' => $doctrine->getRepository(User::class)->find($this->getUser()),
        ]);
    }


    #[Route('/demandes-non-confirmees/confirm-all', name: 'app_confirm_all_demandes_non_confirmees')]
    public function confirmAllDemandesNonConfirmees(ManagerRegistry $doctrine): Response
    {
        $user = $this->getUser();
        $demandes = $doctrine->getRepository(Demande::class)->findNonConfirmeesByUser($user);

        foreach ($demandes as $demande) {
            $demande->setDateConfirmation(new \DateTime());
        }

        $doctrine->getManager()->flush();

        $this->addFlash('success', 'Toutes les demandes non confirmées ont été confirmées.');

        return $this->redirectToRoute('app_demandes_non_confirmees');
    }
}
