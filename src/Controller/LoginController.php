<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Entity\Client;
use App\Repository\ClientRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTDecodeFailureException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Filesystem\Filesystem;

class LoginController extends AbstractController
{
   /////////////////////////:LOGIN AVEC QR
   
#[Route('/loginqr/{username}', name: 'app_loginqr',methods: ['POST','GET'])]
public function LoginCheckQR($username,SessionInterface $session,Request $request): Response
{
    $key = $request->query->get('key');
    $code = $request->query->get('code');
    $test = $request->query->get('test');
    if(($test/$key)!=$code)
    {
        return $this->redirectToRoute('app_article_index');
    }
    // Recherchez le client avec le nom d'utilisateur spécifié
    $client = $this->getDoctrine()->getRepository(Client::class)->findOneBy(['username' => $username]);

    if ($client) {
        // Vous pouvez également vérifier ici s'il existe d'autres conditions
        // Comme la validité du lien QR Code, etc.

        // Ensuite, vous pouvez gérer la session et rediriger
        $session = $request->getSession();
        $session->set('username', $username);
        $session->set('id', $client->getId());
        return $this->redirectToRoute('client_profil');
    } else {
        // Rediriger en cas d'échec de l'authentification
        return $this->redirectToRoute('app_article_index');
    }
}
////////////////////////////////////////////////////////////////////////
    #[Route('/login', name: 'app_login')]
    public function Login_check_client(Request $requesty): Response
    { 
        
        $username = $requesty->request->get('username');
        $password = $requesty->request->get('password');
        $client = $this->getDoctrine()->getRepository(Client::class)->findOneBy(['username' => $username]);
        if ($client) {
            if (password_verify($password,$client->getPassword())) {
                $session = $requesty->getSession();
                $session->set('username', $username);
                $session->set('id', $client->getId());
                return $this->redirectToRoute('client_profil');
            } else {
                return $this->redirectToRoute('app_article_index');
            }
        } else {
            return $this->redirectToRoute('app_article_index');
        }
    }

    #[Route('/faceid', name: 'face_id')]
    public function faceid(SessionInterface $session): Response
    {
        return $this->render('login/faceid.html.twig', [
          
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(SessionInterface $session): Response
    {
        $session->clear();
        return $this->redirectToRoute('app_article_index');
    }
    ///////////////////////////////////////////:
    #[Route('/loginadmin', name: 'app_login_admin', methods: ['POST'])]
    public function Login_check_admin(Request $request, JWTTokenManagerInterface $JWTManager): Response
    {
        $matricule = $request->request->get('matricule');
        $password = $request->request->get('password');

        $agent = $this->getDoctrine()->getRepository(Agent::class)->findOneBy(['matricule' => $matricule]);
////////////////file //////////
$filesystem = new Filesystem();

$filename = '..\public\files\log.txt';
$date = new \DateTime();
    $content = "[".$date->format('Y-m-d H:i:s')."] - AGENT [ " .strtoupper($agent->getMatricule())." ] S'EST CONNECTÉ\n";

    // Vérifier si le fichier existe, sinon le créer
    if (!$filesystem->exists($filename)) {
        $filesystem->touch($filename);
    }

    // Écrire dans le fichier

////////////////////////////////////
        if ($agent) {
            if (password_verify($password, $agent->getPassword())) {
               // $token = $JWTManager->create($agent);
               $token = $JWTManager->create($agent);

                // Retourner une réponse JSON avec le token
                //return $this->json(['token' => $token]);
                $session = $request->getSession();
                $session->set('matrricule', $matricule);
                $session->set('id_agent', $agent->getId());
                $session->set('jwt_token', $token);
                $filesystem->appendToFile($filename, $content);

            $request->headers->set('Authorization', 'Bearer ' . $token);
           // return $this->json(['token' => $token]);

              return $this->redirectToRoute('app_agent_new');
            } else {
                // Retourner une réponse JSON si le mot de passe est incorrect
                return $this->json(['message' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
            }
        } else {
            // Retourner une réponse JSON si l'utilisateur n'est pas trouvé
            return $this->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }
    }
    ///////////////////////////////////////////:
    #[Route('/loginadminfaceid/{faceid}', name: 'app_login_admin_faceid')]
    public function Login_check_admin_faceid(Request $requesty,$faceid): Response
    {
      //  $faceid= $requesty->request->get('agent_faceid');
      
        $agent = $this->getDoctrine()->getRepository(Agent::class)->findOneBy(['faceid' => $faceid]);
        if ($agent) {
            $session = $requesty->getSession();
            $session->set('matrricule', $agent->getMatricule());
            $session->set('id_agent', $agent->getId());
                return $this->redirectToRoute('app_agent_new');
            } else {
                return $this->redirectToRoute('app_agent_login');
            }
        }
        #[Route('/session', name: 'session_expired')]
        public function sessionexpired(SessionInterface $session): Response
        {

           if($session->get('id_agent')&& $session->get('jwt_token')){
            $agent = $this->getDoctrine()->getRepository(Agent::class)->find($session->get('id_agent'));
            return $this->render('login/sessionexpired.html.twig', [
                'agent' => $agent,
            ]); 

        } 
        else {
            return $this->redirectToRoute('app_agent_login');
        }

    }

    ////////////*renew session*////////////
    #[Route('/renewsession', name: 'renew_session')]
    public function agent_renew_session(Request $requesty,SessionInterface $session ,JWTTokenManagerInterface $JWTManager): Response
    {
        if($session->get('id_agent')){
        $agent = $this->getDoctrine()->getRepository(Agent::class)->find($session->get('id_agent'));
        $password = $requesty->request->get('password');
        if ($agent) {

            $jwtToken = $session->get('jwt_token');
            $token = new UsernamePasswordToken($agent, $jwtToken, 'main');
    
           
            

            if (password_verify($password,$agent->getPassword())) {
                ////////////////file //////////
$filesystem = new Filesystem();

$filename = '..\public\files\log.txt';
$date = new \DateTime();
$content = "[".$date->format('Y-m-d H:i:s')."] - AGENT [ " .strtoupper($agent->getMatricule())." ] A RENOUVELÉ SA SESSION\n";

    // Vérifier si le fichier existe, sinon le créer
    if (!$filesystem->exists($filename)) {
        $filesystem->touch($filename);
    }

    // Écrire dans le fichier
    $filesystem->appendToFile($filename, $content);

////////////////////////////////////
                $token = $JWTManager->create($agent);
                $session = $requesty->getSession();
                $session->set('matrricule', $agent->getMatricule());
            $session->set('id_agent', $agent->getId());
            $session->set('jwt_token', $token);
            $requesty->headers->set('Authorization', 'Bearer ' . $token);
                return $this->redirectToRoute('app_agent_new');
            } else {
                return $this->redirectToRoute('app_agent_login');
            }}
        } else {
            return $this->redirectToRoute('app_agent_login');
        }
    }
}
