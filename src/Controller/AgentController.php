<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Form\AgentType;
use App\Form\TaskType;
use App\Middleware\JwtMiddleware;
use App\Repository\AgentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTDecodeFailureException;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\TokenExtractorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Twilio\Rest\Proxy\V1\Service\SessionInstance;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Filesystem\Filesystem;

#[Route('/agent')]
class AgentController extends AbstractController
{
    #[Route('/', name: 'app_agent_index', methods: ['GET'])]
    public function index(AgentRepository $agentRepository,Request $request,EntityManagerInterface $entityManager,SessionInterface $session): Response
    { 
        if($session->get('id_agent')){
            $id_agent_connecter = $session->get('id_agent');
            $agent_connecter = $entityManager->getRepository(Agent::class)->find($id_agent_connecter);
        $agents = $agentRepository->findAll();
        $forms = [];
    
        foreach ($agents as $agent) {
            $form = $this->createForm(agentType::class, $agent, [
                'action' => $this->generateUrl('app_agent_edit', ['id' => $agent->getId()]),
                'method' => 'POST',
            ]);
            $form->handleRequest($request);
            
            if ($form->isSubmitted() && $form->isValid()) {

                $entityManager->flush();
                $this->addFlash('success', 'agent updated successfully!');
            }
    
            $forms[] = $form->createView();
        }
    
        return $this->render('agent/index.html.twig', [
            'agents' => $agents,
            'forms' => $forms,
            'agent_connecter' => $agent_connecter,
        ]);}
        else {
            return $this->redirectToRoute('app_agent_login');

        }
    }
    #[Route('/login', name: 'app_agent_login', methods: ['GET', 'POST'])]
    public function login(Request $request, EntityManagerInterface $entityManager): Response
    {
        return $this->renderForm('agent/login.html.twig', [
           
        ]); }
       

    #[Route('/new', name: 'app_agent_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,SessionInterface $session,JWTTokenManagerInterface $JWTManager): Response
    {   
        if($session->get('id_agent')&& $session->get('jwt_token')){
        $id_agent_connecter = $session->get('id_agent');
        $agent_connecter = $entityManager->getRepository(Agent::class)->find($id_agent_connecter);
        $agent = new Agent();
        $form = $this->createForm(AgentType::class, $agent);
        $form->handleRequest($request);
  
        $jwtToken = $session->get('jwt_token');
        $token = new UsernamePasswordToken($agent_connecter, $jwtToken, 'main');

        try {
            $decodedToken = $JWTManager->decode($token);

            // Si le token est valide, continuer avec le traitement
        } catch (JWTDecodeFailureException $e) {
            // Le token est invalide, gérer l'erreur (redirection, message d'erreur, etc.)
            $this->addFlash('error', 'Le token JWT est invalide.');
            ////////////////file //////////
$filesystem = new Filesystem();

$filename = '..\public\files\log.txt';
$date = new \DateTime();
$content = "[".$date->format('Y-m-d H:i:s')."] - LA SESSION DE L'AGENT [ " .strtoupper($agent_connecter->getMatricule())." ] A EXPIRÉ\n";

    // Vérifier si le fichier existe, sinon le créer
    if (!$filesystem->exists($filename)) {
        $filesystem->touch($filename);
    }

    // Écrire dans le fichier
    $filesystem->appendToFile($filename, $content);

////////////////////////////////////
            return $this->redirectToRoute('session_expired');
        }

        if ($form->isSubmitted() && $form->isValid()) {
             ////////////////PHOTO//////////
             $tempFilePath = $form['photo']->getData();
             $randomNumber = rand(10000, 99999); // Génère un nombre aléatoire entre 10000 et 99999
             $destinationPath = "agents_photos/" .$agent->getNom().$agent->getPrenom()."_".$randomNumber .".png";
                 $compressionQuality = 100;
         
                 $this->compressImage($tempFilePath, $destinationPath, $compressionQuality);
         
                 $agent->setPhoto($destinationPath);
             
                 ////////////////PHOTO//////////
            $agent->setMatricule($this->generateMatricule($agent->getNom(), $agent->getPrenom()));
            $passwordhash=password_hash($agent->getPassword(),PASSWORD_DEFAULT);
           
            $agent->setPassword($passwordhash);
            $entityManager->persist($agent);
            $entityManager->flush();    
            return $this->redirectToRoute('app_agent_index', [], Response::HTTP_SEE_OTHER);}
           
        

        return $this->renderForm('agent/new.html.twig', [
            'agent' => $agent,
            'form' => $form,
            'agent_connecter' => $agent_connecter,
        ]);}
        else {
            return $this->redirectToRoute('app_agent_login');

        }
    }

    #[Route('/{id}', name: 'app_agent_show', methods: ['GET'])]
    public function show(Agent $agent): Response
    {
        return $this->render('agent/show.html.twig', [
            'agent' => $agent,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_agent_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Agent $agent, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AgentType::class, $agent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $passwordhash=password_hash($agent->getPassword(),PASSWORD_DEFAULT);
           
            $agent->setPassword($passwordhash);
            if($agent->getPoste()=="Chef d'agence")
            {
                $agent->getIdAgence()->setIdChef($agent);
            }
            if ($form->get('photo')->getData() !== null) {
                $ancienCheminImage = $agent->getPhoto();
                if ($ancienCheminImage !== null && file_exists($ancienCheminImage)) {
                    unlink($ancienCheminImage);
                }
    
                $tempFilePath = $form['photo']->getData();
                $randomNumber = rand(10000, 99999); // Génère un nombre aléatoire entre 10000 et 99999
                $destinationPath = "agents_photos/" .$agent->getNom().$agent->getPrenom()."_".$randomNumber .".png";
                $compressionQuality = 100;
                $this->compressImage($tempFilePath, $destinationPath, $compressionQuality);
                $agent->setPhoto($destinationPath);
            }
            $entityManager->flush();

            return $this->redirectToRoute('app_agent_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('agent/edit.html.twig', [
            'agent' => $agent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_agent_delete', methods: ['POST'])]
    public function delete(Request $request, Agent $agent, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$agent->getId(), $request->request->get('_token'))) {
            $entityManager->remove($agent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_agent_index', [], Response::HTTP_SEE_OTHER);
    }

    function generateMatricule(string $nom, string $prenom): string {
        $nomPart = substr($nom, 0, 3);    
        $prenomPart = substr($prenom, -3);
        $randomNumbers = str_pad(mt_rand(0, 99), 2, '0', STR_PAD_LEFT);
            $matricule = strtoupper($nomPart . $prenomPart . $randomNumbers);
    
        return $matricule;
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
