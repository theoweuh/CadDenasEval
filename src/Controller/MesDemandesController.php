<?php

namespace App\Controller;

use App\Entity\Demande;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class MesDemandesController extends AbstractController
{
    #[Route('/', name: 'app_mes_demandes')]
    #[IsGranted('ROLE_USER')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $mesDemandes = $doctrine->getRepository(Demande::class)->findBy(['user' => $this->getUser()]);

        return $this->render('mes_demandes/index.html.twig', [
            'demandes' => $mesDemandes,
            'user' => $doctrine->getRepository(User::class)->find($this->getUser()),
        ]);
    }
}
