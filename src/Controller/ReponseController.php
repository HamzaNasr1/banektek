<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Entity\Reclamation;
use App\Entity\Reponse;
use App\Form\ReponseType;
use App\Repository\ReponseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use src\Entity\BadWordFilter;
use Merorin\FlashyBundle\Factory\FlashyFactory;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

// Injecter le service FlashyFactory dans votre contrôleur




#[Route('/reponse')]
class ReponseController extends AbstractController

{
    /*private $flashyFactory;

    public function __construct(FlashyFactory $flashyFactory)
    {
        $this->flashyFactory = $flashyFactory;
    }*/

    #[Route('/', name: 'app_reponse_index', methods: ['GET'])]
    public function index(ReponseRepository $reponseRepository): Response
    {
        return $this->render('reponse/index.html.twig', [
            'reponses' => $reponseRepository->findAll(),
        ]);
    }

    #[Route('/new/{id}', name: 'app_reponse_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, $id,SessionInterface $session): Response
    {
        if($session->get('id_agent')){
            $id_agent_connecter = $session->get('id_agent');
            $agent_connecter = $entityManager->getRepository(Agent::class)->find($id_agent_connecter);
       // $flashy->success('Reclamation ajoutée avec succès!', 'http://your-awesome-link.com');
        function badWordFiter($data)
{
    $originals = array("hamza", "mohamed", "ali");
    $replacements = array("h***a", "m****d", "a**");
    $data = str_ireplace($originals, $replacements, $data);
    return $data;
}
        // Fetch the Reclamation entity based on the ID from the route parameter
        $reclamation = $entityManager->getRepository(Reclamation::class)->find($id);
        
        // Create a new Reponse instance
        $reponse = new Reponse();
    
        // Set the Reclamation entity to the Reponse instance
        $reponse->setIdReclamation($reclamation);
    
        // Create the form, passing the Reponse object
        $form = $this->createForm(ReponseType::class, $reponse);
    
        // Handle form submission
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            // Set other properties of the Reponse entity if needed
            $reponse->setDateReponse(new \DateTime());
            $agent = $this->getDoctrine()->getRepository(Agent::class)->findOneBy(['id' => 11]);
            $reponse->setIdAgent($agent_connecter);
            

            // Apply bad word filter to the response content
            $content = $reponse->getMessage();
            $filteredContent = badWordFiter($content);
            $reponse->setMessage($filteredContent);


            // Persist and flush the Reponse entity
            $entityManager->persist($reponse);
            $entityManager->flush();
            
            // Redirect to the appropriate route after successful form submission
            return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
        }
    
        // Render the form along with any required data
        return $this->render('reclamation/index.html.twig', [
            'reponse' => $reponse,
            'form' => $form->createView(),
        ]); } 
        else {
            return $this->redirectToRoute('app_agent_login');
        }
    }

    #[Route('/{id}', name: 'app_reponse_show', methods: ['GET'])]
    public function show(Reponse $reponse): Response
    {
        return $this->render('reponse/show.html.twig', [
            'reponse' => $reponse,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reponse_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reponse $reponse, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReponseType::class, $reponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reponse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reponse/edit.html.twig', [
            'reponse' => $reponse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reponse_delete', methods: ['POST'])]
    public function delete(Request $request, Reponse $reponse, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reponse->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reponse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
    }
}
