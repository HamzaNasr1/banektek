<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Entity\Client;
use App\Entity\Reclamation;
use App\Entity\Reponse;
use App\Form\ReclamationType;
use App\Form\ReclamationTypeClient;
use App\Form\ReclamationTypeModal;
use App\Form\ReponseType;
use App\Repository\ReclamationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\JsonResponse;



use Symfony\Component\HttpFoundation\Session\SessionInterface;

#[Route('/reclamation')]
class ReclamationController extends AbstractController
{
  
    #[Route('/', name: 'app_reclamation_index', methods: ['GET','POST'])]
public function index(ReclamationRepository $reclamationRepository, Request $request, EntityManagerInterface $entityManager,SessionInterface $session): Response
{  if($session->get('id_agent')){
    $id_agent_connecter = $session->get('id_agent');
    $agent_connecter = $entityManager->getRepository(Agent::class)->find($id_agent_connecter);
    $reclamations = $reclamationRepository->findAll();
    $forms = [];

    // Create Reponse form outside of the loop
    $formrep = [];
 

    foreach ($reclamations as $reclamation) {
        $form = $this->createForm(ReclamationTypeModal::class, $reclamation, [
            'action' => $this->generateUrl('app_reclamation_edit', ['id' => $reclamation->getId()]),
            'method' => 'POST',
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Reclamation updated successfully!');
        }

        $forms[] = $form->createView();
        $reponse = new Reponse();
        $reponse->setIdReclamation($reclamation);
        $formr = $this->createForm(ReponseType::class, $reponse, [
            'action' => $this->generateUrl('app_reponse_new', ['id' => $reclamation->getId()]),
            'method' => 'POST',
            
        ]);
        $formr->handleRequest($request);    

       

        $formrep[] = $formr->createView(); }
     
    

    function saveRatingAction(Request $request): JsonResponse
{
    // Retrieve data from the request
    $uID = $request->request->get('uID');
    $ratedIndex = $request->request->get('ratedIndex');

    // Logic to save the rating to the database using EntityManager

    // Return a JSON response with the user ID
    return new JsonResponse(['id' => $uID]);
}

    // Handle Reponse form submission outside of the loop
   

    return $this->render('reclamation/index.html.twig', [
        'reclamations' => $reclamations,
        'forms' => $forms,
        'formrep' => $formrep,
        'agent_connecter' => $agent_connecter,

    ]); } 
    else {
        return $this->redirectToRoute('app_agent_login');
    }
    
}


    #[Route('/new', name: 'app_reclamation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $reclamation->setEtat("En Attente");
        $reclamation->setDateReclamation(( new \DateTime()));

       
        
        //$reclamation->setIdClient();
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $tempFilePath = $form['document']->getData();
            $destinationPath = "uploads/" .$reclamation->getType().$reclamation->getId().".png";
            $compressionQuality = 100;
    
            $this->compressImage($tempFilePath, $destinationPath, $compressionQuality);
    
            $reclamation->setDocument($destinationPath);


            $entityManager->persist($reclamation);
            $entityManager->flush();

            return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reclamation/new.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,

        ]);
    }



    #[Route('/newClient', name: 'app_reclamation_newclient', methods: ['GET', 'POST'])]
    public function newClient(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationTypeClient::class, $reclamation);
      
        $session = $request->getSession();
        $username = $session->get('username');
        $client = $this->getDoctrine()->getRepository(Client::class)->findOneBy(['username' => $username]);
        //$reclamation->setIdClient();
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//
     
        
        $reclamation->setEtat("En attente");
        $reclamation->setDateReclamation(( new \DateTime()));
        $session = $request->getSession();
        $username = $session->get('username');
        $client = $this->getDoctrine()->getRepository(Client::class)->findOneBy(['username' => $username]);
        $reclamation->setIdClient($client);
        $email= $client->getEmail();
        $reclamation->setEmail($email);
       
//

        
            $tempFilePath = $form['document']->getData();


            $lastReclamation = $entityManager->getRepository(Reclamation::class)->findOneBy([], ['id' => 'DESC']);
            $newId = $lastReclamation ? $lastReclamation->getId() + 1 : 1;
            $reclamation->setId($newId);

            $destinationPath = "uploads/" . $reclamation->getType() . "-".$reclamation->getId(). "-" . $reclamation->getDateReclamation()->format('Y-m-d-H-i') . ".png";

            $compressionQuality = 100;
    
            $this->compressImage($tempFilePath, $destinationPath, $compressionQuality);
    
            $reclamation->setDocument($destinationPath);


            $entityManager->persist($reclamation);
            $entityManager->flush();

            return $this->redirectToRoute('app_reclamation_newclient', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reclamation/newclient.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,
            'client'=>$client,
        ]);
    }


    
    #[Route('/{id}', name: 'app_reclamation_show', methods: ['GET'])]
    public function show(Reclamation $reclamation): Response
    {
        return $this->render('reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reclamation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReclamationTypeModal::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reclamation/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reclamation_delete', methods: ['POST'])]
    public function delete(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reclamation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
    }


    #[Route('/desactiver/{id}', name: 'reclamation_desactiver', methods: ['GET', 'POST'])]
    public function desactiver(Request $request, Reclamation $reclamation = null, EntityManagerInterface $entityManager): Response
    {
       

        // Modifier l'attribut etat en 'desactive'
        $reclamation->setEtat('En cours');
        $entityManager->flush();

        // Redirection vers la page index avec un message de succès
       // $this->addFlash('success', 'Accès bloqué avec succès.');
        return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
    }
    ///////////////////////////
    #[Route('/activer/{id}', name: 'reclamation_activer', methods: ['GET', 'POST'])]
    public function activer(Request $request, Reclamation $reclamation = null, EntityManagerInterface $entityManager): Response
    {
       

        // Modifier l'attribut etat en 'desactive'
        if ($reclamation->getEtat() == 'En attente'){
            $reclamation->setEtat('En cours');
        }
        else{
            $reclamation->setEtat('Termine');
        }
        
        $entityManager->flush();

        // Redirection vers la page index avec un message de succès
        //$this->addFlash('success', 'Accès bloqué avec succès.');
        return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/save-rating', name: 'save_rating', methods: ['POST'])]
public function saveRatingAction(Request $request): JsonResponse
{
    // Retrieve data from the request
    $uID = $request->request->get('uID');
    $ratedIndex = $request->request->get('ratedIndex');

    // Logic to save the rating to the database using EntityManager

    // Return a JSON response with the user ID
    return new JsonResponse(['id' => $uID]);
}


    private  function compressImage($source, $destination, $quality) {
        $info = getimagesize($source);
        
        if ($info['mime'] == 'image/jpeg') {
            $image = imagecreatefromjpeg($source);
        } elseif ($info['mime'] == 'image/png') {
            $image = imagecreatefrompng($source);
        } elseif ($info['mime'] == 'image/gif') {
            $image = imagecreatefromgif($source);
        } else {
            return false;
        }    // Sauvegarder l'image compressée
           imagejpeg($image, $destination, $quality);
           
           // Libérer la mémoire
           imagedestroy($image);
           
           return true;
       }
    }

    

    // Make sure to import the PDO class from the global namespace
    use PDO;
    
    /*if(isset($_GET['insert'])){
        $badword = isset($_GET['badword']) ? $_GET['badword'] : '';
        $goodword = isset($_GET['goodword']) ? $_GET['goodword'] : '';
    
        // Establish a PDO connection
        $dsn = 'mysql:host=127.0.0.1;dbname=banektek;charset=utf8mb4';
        $username = 'root';
        $password = '';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
    
        try {
            $pdo = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            // Handle connection error
            echo 'Connection failed: ' . $e->getMessage();
            exit;
        }
    
        // Prepare and execute the SQL query
        $query = "INSERT INTO word VALUES (NULL, ?, ?)";
$stmt = $pdo->prepare($query);
$stmt->bindParam(1, $badword);
$stmt->bindParam(2, $goodword);
$stmt->execute();


       /* $stmt = $pdo->prepare($query);
        $stmt->execute([$badword, $goodword]);*/
    
       // echo "<script> alert('Word inserted Successfully'); </script>";

        
    
       
       /*use App\Entity\Stars; // Assuming you have created an entity class for your stars table

    function yourAction(EntityManagerInterface $entityManager, Request $request): JsonResponse
       {
           $uID = $request->request->get('uID');
           $ratedIndex = $request->request->get('ratedIndex');
       
           $starsRepository = $entityManager->getRepository(Stars::class);
       
           if (!$uID) {
               $stars = new Stars();
               $stars->setRateIndex($ratedIndex);
               $entityManager->persist($stars);
               $entityManager->flush();
               $uID = $stars->getId();
           } else {
               $stars = $starsRepository->find($uID);
               if ($stars) {
                   $stars->setRateIndex($ratedIndex);
                   $entityManager->flush();
               }
           }
       
           return new JsonResponse(['id' => $uID]);
       }*/
       
       // Controller action to handle the AJAX request




   
     

    
       ?>


       

