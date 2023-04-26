<?php

namespace App\Controller;

use App\Entity\Demande;
use App\Entity\Piece;
use App\Entity\TypePiece;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class InitController extends AbstractController
{
    #[Route('/init', name: 'app_init')]
    public function index(ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher): Response
    {
        $client1 = new User();
        $client1->setNom('Etienne Buffet');
        $client1->setAdresse('2 avenue du Rhone 74000 ANNECY');
        $client1->setCourriel('etienne.buffet@ac-grenoble.fr');
        $client1->setLogin('ebuffet');
        $client1->setPays('FRANCE');
        $client1->setEstBloque(true);
        $cleartextpassword = 'motdepasseebu';
        $hashedPassword = $passwordHasher->hashPassword($client1, $cleartextpassword);
        $client1->setPassword($hashedPassword);
        $doctrine->getManager()->persist($client1);
        $doctrine->getManager()->flush();

        $client2 = new User();
        $client2->setNom('David Tissot');
        $client2->setAdresse('2 avenue du Rhone 74000 ANNECY');
        $client2->setCourriel('david.tissot@ac-grenoble.fr');
        $client2->setLogin('dtissot');
        $client2->setPays('FRANCE');
        $client2->setEstBloque(false);
        $cleartextpassword = 'motdepassedti';
        $hashedPassword = $passwordHasher->hashPassword($client2, $cleartextpassword);
        $client2->setPassword($hashedPassword);
        $doctrine->getManager()->persist($client2);
        $doctrine->getManager()->flush();

        $typePiece1 = new TypePiece();
        $typePiece1->setLibelle('Aile');
        $doctrine->getManager()->persist($typePiece1);
        $doctrine->getManager()->flush();

        $typePiece2 = new TypePiece();
        $typePiece2->setLibelle('Train d\'atterrissage');
        $doctrine->getManager()->persist($typePiece2);
        $doctrine->getManager()->flush();

        $typePiece3 = new TypePiece();
        $typePiece3->setLibelle('Manche à balai');
        $doctrine->getManager()->persist($typePiece3);
        $doctrine->getManager()->flush();

        $piece1 = new Piece();
        $piece1->setTypePiece($typePiece1);
        $piece1->setEtat('Neuf');
        $piece1->setPrix(240050);
        $piece1->setDateFabrication(new \DateTime('20220323'));
        $piece1->setNumSerie('2A343A344Z');
        $piece1->setSiteStockage('Annecy');
        $doctrine->getManager()->persist($piece1);
        $doctrine->getManager()->flush();

        $piece2 = new Piece();
        $piece2->setTypePiece($typePiece2);
        $piece2->setEtat('Occasion');
        $piece2->setPrix(143234);
        $piece2->setDateFabrication(new \DateTime('20220621'));
        $piece2->setNumSerie('4AR45A344Z');
        $piece2->setSiteStockage('Saint Etienne');
        $doctrine->getManager()->persist($piece2);
        $doctrine->getManager()->flush();

        $piece3 = new Piece();
        $piece3->setTypePiece($typePiece3);
        $piece3->setEtat('Neuf');
        $piece3->setPrix(2453);
        $piece3->setDateFabrication(new \DateTime('20211005'));
        $piece3->setNumSerie('AAR45A3ERZ');
        $piece3->setSiteStockage('Berlin');
        $doctrine->getManager()->persist($piece3);
        $doctrine->getManager()->flush();

        $piece4 = new Piece();
        $piece4->setTypePiece($typePiece2);
        $piece4->setEtat('Neuf');
        $piece4->setPrix(2453);
        $piece4->setDateFabrication(new \DateTime('20211104'));
        $piece4->setNumSerie('AAE4RA3ERZ');
        $piece4->setSiteStockage('Annecy');
        $doctrine->getManager()->persist($piece4);
        $doctrine->getManager()->flush();

        $demande1 = new Demande();
        $demande1->setUser($client1);
        $demande1->setDateDemande(new \DateTime('20230426'));
        $demande1->setDateConfirmation(new \DateTime('20230427'));
        $demande1->setPiece($piece1);
        $demande1->setFraisTransport(234);
        $demande1->setModeleAeronef('Airbus A320');
        $demande1->setNumSerieAeronef('A3203243');
        $demande1->setTypeEchange(0);
        $demande1->setModeTransport('Bateau');
        $doctrine->getManager()->persist($demande1);
        $doctrine->getManager()->flush();

        $demande2 = new Demande();
        $demande2->setUser($client1);
        $demande2->setDateDemande(new \DateTime('20230426'));
        $demande2->setDateConfirmation(new \DateTime('20230427'));
        $demande2->setPiece($piece2);
        $demande2->setFraisTransport(2334);
        $demande2->setModeleAeronef('Airbus A380');
        $demande2->setNumSerieAeronef('A3803393');
        $demande2->setTypeEchange(0);
        $demande2->setModeTransport('Camion');
        $doctrine->getManager()->persist($demande2);
        $doctrine->getManager()->flush();

        $demande3 = new Demande();
        $demande3->setUser($client1);
        $demande3->setDateDemande(new \DateTime('20230426'));
        $demande3->setPiece($piece3);
        $demande3->setFraisTransport(34);
        $demande3->setModeleAeronef('Airbus A320');
        $demande3->setNumSerieAeronef('A3204393');
        $demande3->setTypeEchange(1);
        $demande3->setModeTransport('Bateau');
        $doctrine->getManager()->persist($demande3);
        $doctrine->getManager()->flush();

        $demande4 = new Demande();
        $demande4->setUser($client2);
        $demande4->setDateDemande(new \DateTime('20230426'));
        $demande4->setPiece($piece4);
        $demande4->setFraisTransport(66);
        $demande4->setModeleAeronef('Airbus A350');
        $demande4->setNumSerieAeronef('A3504393');
        $demande4->setTypeEchange(0);
        $demande4->setModeTransport('Avion');
        $doctrine->getManager()->persist($demande4);
        $doctrine->getManager()->flush();

        return $this->redirectToRoute('app_login');
    }
}
