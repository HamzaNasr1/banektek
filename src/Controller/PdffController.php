<?php

namespace App\Controller;

use APP\Entity\Compte;
use APP\Entity\Virement;
use App\Repository\CompteRepository;
use App\Repository\VirementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

#[Route('/api/compte') ] 
class PdffController extends AbstractController
{
   

    

    

    ///

    #[Route('/list', name: 'list_comptes', methods: ['GET'])]
    public function listcomptes(compteRepository $compteRepository): Response
    {
        $comptes = $compteRepository->findAll();

        return $this->json($comptes, 200, [], ['groups' => 'api']);
    }
}

