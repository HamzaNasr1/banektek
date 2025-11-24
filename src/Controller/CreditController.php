<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Entity\Client;
use App\Entity\Credit;
use App\Entity\Echeance;
use App\Form\CreditType;
use App\Repository\CreditRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;
use DateTime;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use Twilio\Rest\Proxy\V1\Service\SessionInstance;

#[Route('/credit')]
class CreditController extends AbstractController
{
    #[Route('/simulateur', name: 'app_simulateur')]
    public function simulateur(): Response
    {
        return $this->render('credit/simulateur.html.twig');
    }
    
    #[Route('/export/pdf', name: 'export_credits_to_pdf', methods: ['GET'])]
    public function exportcreditsToPdf(creditRepository $creditRepository, EntityManagerInterface $entityManager, Request $request): Response
    {   


        // Retrieve credits from the database
        $id = $request->getSession()->get('id');
        $client = $entityManager->getRepository(Client::class)->findOneBy(['id' => $id]); 
        
        $allCredits = new ArrayCollection(); // Créez une collection pour stocker tous les crédits
        
        foreach ($client->getComptes() as $compteparc) {
            $credits = $creditRepository->findBy(['id_compte' => $compteparc->getId()]);   
            // Ajoutez les crédits trouvés à la collection
            foreach ($credits as $credit) {
                $allCredits->add($credit);
            }
        }
        // Create PDF document
        $dompdf = new \Dompdf\Dompdf(); // Add backslash before Dompdf to use the global namespace

        $dompdf->loadHtml($this->renderView('pdf/pdf.html.twig', [
            'credits' => $allCredits,
        ]));

        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Return PDF as response
        $response = new Response($dompdf->output());
        $response->headers->set('Content-Type', 'application/pdf');
        $response->headers->set('Content-Disposition', 'attachment; filename="credits.pdf"');

        return $response;
    }

    #[Route('/list', name: 'list_credits', methods: ['GET'])]
    public function listcredits(creditRepository $creditRepository): Response
    {
        $credits = $creditRepository->findAll();

        return $this->json($credits, 200, [], ['groups' => 'api']);
    }


    #[Route('/mescredits', name: 'app_mes_credits', methods: ['GET'])]
    public function mes_credits(CreditRepository $creditRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $id = $request->getSession()->get('id');
        $client = $entityManager->getRepository(Client::class)->findOneBy(['id' => $id]); 
        
        $allCredits = new ArrayCollection(); // Créez une collection pour stocker tous les crédits
        
        foreach ($client->getComptes() as $compteparc) {
            $credits = $creditRepository->findBy(['id_compte' => $compteparc->getId()]);   
            // Ajoutez les crédits trouvés à la collection
            foreach ($credits as $credit) {
                $allCredits->add($credit);
            }
        }
        
        // Convertir la collection en tableau pour l'utiliser dans le rendu Twig
        $creditsArray = $allCredits->toArray();
    
        return $this->render('credit/mescredits.html.twig', [
            'client' => $client,
            'credits' => $creditsArray,
        ]);
    }
    
      /********************************************************************** */

      #[Route('/desactiver/{id}', name: 'credit_desactiver', methods: ['GET', 'POST'])]
      public function desactiver(Request $request, Credit $client = null, EntityManagerInterface $entityManager): Response
      {
          // Vérifier si l'entité Client existe
          if (!$client) {
              throw $this->createNotFoundException('Client non trouvé.');
          }
  
          // Modifier l'attribut etat en 'desactive'
          $client->setEtat('suspendu');
          $entityManager->flush();
  
          // Redirection vers la page index avec un message de succès
          $this->addFlash('success', 'Accès bloqué avec succès.');
          return $this->redirectToRoute('app_credit_index', [], Response::HTTP_SEE_OTHER);
      }
      ///////////////////////////
      #[Route('/activer/{id}', name: 'credit_activer', methods: ['GET', 'POST'])]
      public function activer(Request $request, Credit $client = null, EntityManagerInterface $entityManager): Response
      {
          // Vérifier si l'entité Client existe
          if (!$client) {
              throw $this->createNotFoundException('credit non trouvé.');
          }
  
          // Modifier l'attribut etat en 'desactive'
          $client->setEtat('en cours');
          $entityManager->flush();
  
          // Redirection vers la page index avec un message de succès
          $this->addFlash('success', 'Accès bloqué avec succès.');
          return $this->redirectToRoute('app_credit_index', [], Response::HTTP_SEE_OTHER);
      }
      #[Route('/', name: 'app_credit_index', methods: ['GET'])]
    public function index(CreditRepository $creditRepository,Request $request,EntityManagerInterface $entityManager,SessionInterface $session): Response
    {  if($session->get('id_agent')){
        $id_agent_connecter = $session->get('id_agent');
        $agent_connecter = $entityManager->getRepository(Agent::class)->find($id_agent_connecter);
        $credits = $creditRepository->findAll();
         $tab = [];
        foreach ($credits as $credit) {
            //$echeances = $credit->getEcheances();
            $echeances = $credit->getEcheances();   
            $echeances_payees=$echeances->filter(function (Echeance $echeance) {
                return $echeance->getEtat() == 'paye';
            });
            $nb_echeances_restants = $echeances_payees->count();

            $echancesPayees = $credit->getDuree() - $credit->getNbEcheancesRestants();
            $pourcentagePaye_avecVirgule = (($nb_echeances_restants / $credit->getDuree()) * 100);
            $pourcentagePaye = round($pourcentagePaye_avecVirgule, 0); // Round the float to two decimal places

            $tab[$credit->getId()] = $pourcentagePaye;
                        $criteria = Criteria::create()
                ->where(Criteria::expr()->eq('etat', 'en cours'))
                ->orderBy(['date' => Criteria::ASC])
                ->setMaxResults(5);
    
            $closestEcheances = $echeances->matching($criteria);
    
            // Assign the closestEcheances to the credit object
            $credit->setEcheances($closestEcheances);
        
           
        }
    
        return $this->render('credit/index.html.twig', [
            'credits' => $credits,
            'pourcentagePaye' => $pourcentagePaye,
            'tab' => $tab,
            'agent_connecter' => $agent_connecter,
        ]);}
        else {
            return $this->redirectToRoute('app_agent_login');
        }
    }
    #[Route('/new', name: 'app_credit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,SessionInterface $session): Response
    {if($session->get('id_agent')){
        $id_agent_connecter = $session->get('id_agent');
        $agent_connecter = $entityManager->getRepository(Agent::class)->find($id_agent_connecter);


        $credit = new Credit();
        $form = $this->createForm(CreditType::class, $credit);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            if($credit->getType()=="commercial")
                $credit->setTaux(0.09);
            elseif($credit->getType()=="agricole")
                $credit->setTaux(0.07);
            elseif($credit->getType()=="automobile")
                $credit->setTaux(0.1);
            elseif($credit->getType()=="consommation")
                $credit->setTaux(0.12);
            elseif($credit->getType()=="hypothecaire")
                $credit->setTaux(0.05);
            elseif($credit->getType()=="etudiant")
                $credit->setTaux(0.11);

            $montant_total=($credit->getMontant()-$credit->getApportPropre())*(1+$credit->getTaux()) ;
   
            $montant_echeance_form=$credit->getMontantEcheance(); //pour detetecter ..

            $montant_echeance=$montant_total/$credit->getDuree();
            
            $montantEcheance = round($montant_echeance, 3); // Round the float to three decimal places
            $credit->setMontantEcheance($montantEcheance); // Pass the float value directly to the method
            $credit->setNbEcheancesRestants($credit->getDuree());
            
                        $credit->setNbEcheancesRestants($credit->getDuree());
            $credit->setEtat('en cours');


            $echeances = new ArrayCollection();
            $dateEcheance = new DateTime(); 
            $dateEcheance =  $credit->getDateDebut(); // Clone the date to avoid modifying the original object
            $dayOfMonth = $credit->getDateEcheance(); // Get the day from $credit->getDateEcheance()

            // Set the day of $dateEcheance to the value of $dayOfMonth
            $dateEcheance->setDate($dateEcheance->format('Y'), $dateEcheance->format('m'), $dayOfMonth);
            $credit->getIdCompte()->setSolde(($credit->getMontant()-$credit->getApportPropre())+$credit->getIdCompte()->getSolde());

            for ($i = 0; $i < $credit->getDuree(); $i++) {
                $echeance = new Echeance();
                $echeance->setIdCredit($credit);
                $echeance->setModePaiement('Your mode of payment'); // Set the mode of payment
                $echeance->setEtat('en cours'); // Set the state
                $echeance->setDate($dateEcheance);
                $entityManager->persist($echeance); // Persist each Echeance entity

                $dateEcheance = clone $dateEcheance;
                $dateEcheance->modify('+1 month'); // Increment date by 1 month

                $echeances->add($echeance);
            }

            // Add echeances to the credit
            $credit->setEcheances($echeances);
           
            $entityManager->persist($credit);
            $entityManager->flush();
                ////////////////file //////////
                $filesystem = new Filesystem();

                $filename = '..\public\files\log.txt';
                $date = new \DateTime();
                $content = "[".$date->format('Y-m-d H:i:s')."] - AGENT [ " .strtoupper($agent_connecter->getMatricule())." ] A AJOÛTÉ UN CRÉDIT AU COMPTE [".$credit->getIdCompte()->getRib()."]  AVEC UN MONTANT DE ".$montant_total."Dt \n";
                
                    // Vérifier si le fichier existe, sinon le créer
                    if (!$filesystem->exists($filename)) {
                        $filesystem->touch($filename);
                    }
                    
                    // Écrire dans le fichier
                    $filesystem->appendToFile($filename, $content);
                    if ($montant_echeance_form!=$montant_echeance)  {
                        
                        $anti_triche = "TENTATIVE DE MODIFICATION ILLÉGALE DU MONTANT D'ÉCHÉANCE DE [".$montant_echeance."] À [".$montant_echeance_form."]\n";
                        $filesystem->appendToFile($filename, $anti_triche);
                    }
                ////////////////////////////////////
           // return $this->redirectToRoute('app_credit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('credit/new.html.twig', [
            'credit' => $credit,
            'form' => $form,
            'agent_connecter' => $agent_connecter,
        ]); } 
        else {
            return $this->redirectToRoute('app_agent_login');
        }
    }

    #[Route('/{id}', name: 'app_credit_show', methods: ['GET'])]
    public function show(Credit $credit): Response
    {
        return $this->render('credit/show.html.twig', [
            'credit' => $credit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_credit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Credit $credit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CreditType::class, $credit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_credit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('credit/edit.html.twig', [
            'credit' => $credit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_credit_delete', methods: ['POST'])]
    public function delete(Request $request, Credit $credit, EntityManagerInterface $entityManager): Response
    {
        // Récupérer toutes les échéances liées à ce crédit
        $echeances = $credit->getEcheances();
    
        // Parcourir chaque échéance et les supprimer une par une
        foreach ($echeances as $echeance) {
            $entityManager->remove($echeance);
        }
    
        // Supprimer le crédit lui-même
        $entityManager->remove($credit);
    
        // Enregistrer les modifications dans la base de données
        $entityManager->flush();
    
        return $this->redirectToRoute('app_credit_index', [], Response::HTTP_SEE_OTHER);
    }
 
}
