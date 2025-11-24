<?php

namespace App\Controller;
//include_once '../src/Entity/Article.php';

use App\Entity\Agent;
use App\Entity\Article;
use App\Entity\Client;
use App\Entity\Commentaire;
use App\Form\ArticleType;
use App\Form\ArticleType2;
use App\Form\CommentaireType;
use App\Repository\ArticleRepository;
use App\Repository\CommentaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

    


#[Route('/article')]
class ArticleController extends AbstractController
{
    #[Route('/', name: 'app_article_index', methods: ['GET'])]
    public function index(ArticleRepository $articleRepository): Response
    {
       $articles= $articleRepository->findAll();

       
      
        return $this->render('article/index.html.twig', [
            'articles' => $articles,
          
         
        ]);
    }

    #[Route('/articleback', name: 'app_article_back', methods: ['GET'])]
    public function indexback(ArticleRepository $articleRepository, Request $request, EntityManagerInterface $entityManager,SessionInterface $session): Response
    { if($session->get('id_agent')){
        $id_agent_connecter = $session->get('id_agent');
        $agent_connecter = $entityManager->getRepository(Agent::class)->find($id_agent_connecter);  $articles= $articleRepository->findAll();

        foreach ($articles as $article) {
            $form = $this->createForm(ArticleType2::class, $article, [
                'action' => $this->generateUrl('app_article_edit', ['id' => $article->getId()]),
                'method' => 'POST',
            ]);
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->flush();
              
            }
    
            $forms[] = $form->createView();
        }
       
    
      
        return $this->render('article/indexback.html.twig', [
            'articles' => $articles,
            'forms' => $forms,
            'agent_connecter' => $agent_connecter,

        ]); } 
      else {  return $this->redirectToRoute('app_agent_login');}
    }
  
    #[Route('/convertisseur', name: 'app_convertisseur', methods: ['GET'])]
    public function convertir(ArticleRepository $articleRepository): Response
    {

        
        return $this->render('article/convertisseur.html.twig',[
            'articles' =>$articleRepository->findAll(),
      
        ]);
    }
   
   
    #[Route('/new', name: 'app_article_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,SessionInterface $session): Response
    { if($session->get('id_agent')){
        $id_agent_connecter = $session->get('id_agent');
        $agent_connecter = $entityManager->getRepository(Agent::class)->find($id_agent_connecter);
        $article = new Article();
        
        $form = $this->createForm(ArticleType::class, $article);
        $article->setDatePub(( new \DateTime()));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $entityManager->flush();
    
            // Now that the article is persisted, get its ID
          
            $lastArticle  = $entityManager->getRepository(Article::class)->findOneBy([], ['id' => 'DESC']);
            $newId = $lastArticle ? $lastArticle->getId() + 1 : 1;
            $article->setId($newId);
            $articletitle = $article->getTitre();
            $tempFilePath = $form['image']->getData();
            $destinationPath = "uploads/article_" . $articletitle.$article->getId().".png";
            $compressionQuality = 100;
    
            $this->compressImage($tempFilePath, $destinationPath, $compressionQuality);
    
            $article->setImage($destinationPath);
            $entityManager->persist($article);
            $entityManager->flush();
    
            return $this->redirectToRoute('app_article_back', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article/new.html.twig', [
            'article' => $article,
            'form' => $form,
            'agent_connecter' => $agent_connecter,

        ]);  } 
        else {
            return $this->redirectToRoute('app_agent_login');
        }
    }

    #[Route('/{id}', name: 'app_article_show', methods: ['GET', 'POST'])]
    public function show(Article $article, CommentaireRepository $commentaireRepository, EntityManagerInterface $entityManager, Request $request,SessionInterface $session): Response
    {
           // Get commentaires
           if ($session->get('id')) {
            $idClientConnecte = $session->get('id');
            $clientConnecte = $entityManager->getRepository(Client::class)->find($idClientConnecte);
        $commentaires = $commentaireRepository->findBy(['article' => $article->getId()]);
        // Create form
        $commentaire = new Commentaire();
      //  $commentairecontroller = new CommentaireController();
        $formCommentaire = $this->createForm(CommentaireType::class, $commentaire);
        $formCommentaire->handleRequest($request);
      
     

        if ($formCommentaire->isSubmitted() && $formCommentaire->isValid()) {
        
            //$entityManager->flush();
            $commentaire->setContenu($this->filterComment($commentaire->getContenu()));
            $commentaire->setDate(new \DateTime());
            $commentaire->setArticle($article);
            $session = $request->getSession();
            $client = $this->getDoctrine()->getRepository(Client::class)->findOneBy(['username' =>  $session->get('username')]);
            $commentaire->setUser($client);
            $entityManager->persist($commentaire);
            $entityManager->flush();
        
            return $this->redirectToRoute('app_article_show', ['id' => $article->getId()], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('article/show.html.twig', [
            'article' => $article,
            'commentaires' => $commentaires,
            'commentform' => $formCommentaire,
            'client_connecter' => $clientConnecte,
        ]); }
        else {
            return $this->redirectToRoute('app_client_login');
        }
    }
    

    #[Route('/{id}/edit', name: 'app_article_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Article $article, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ArticleType2::class, $article);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_article_back', [], Response::HTTP_SEE_OTHER);
        }

      return $this->redirectToRoute('app_article_back', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/delete/{id}', name: 'app_article_delete', methods: ['POST', 'GET'])]
    public function delete(Request $request, Article $article, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            // Fetch all comments associated with the article
            $comments = $article->getCommentaires();
    
            // Delete each comment
            foreach ($comments as $comment) {
                $entityManager->remove($comment);
            }
    
            // Flush the changes to delete the comments
            $entityManager->flush();
    
            // Now you can safely remove the article
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_article_back', [], Response::HTTP_SEE_OTHER);
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

    private   function filterComment($comment) {
        // Define a list of bad words (you can customize this list to your needs)
        $badWords = array('badword1', 'aminemalouche', 'grosmot');
        
        // Loop through each word in the comment
        $words = explode(' ', $comment);
        foreach ($words as &$word) {
            // Remove any punctuation from the word
            $word = preg_replace('/[^a-zA-Z0-9]/', '', $word);
            
            // Check if the word is a bad word (case insensitive)
            $found = false;
            foreach ($badWords as $badWord) {
                $similarity = 0;
                similar_text(strtolower($word), strtolower($badWord), $similarity);
                if ($similarity >= 80) {
                    $found = true;
                    break;
                }
            }
          
            // Replace the word with a censored version if it's a bad word
            if ($found) {
                $censoredWord = '';
                for ($i = 0; $i < strlen($word); $i++) {
                    if (ctype_upper($word[$i])) {
                        // If the character is an uppercase letter, use an uppercase asterisk
                        $censoredWord .= '*';
                    } else {
                        // Otherwise, use a lowercase asterisk
                        $censoredWord .= '*';
                    }
                }
                $word = $censoredWord;
            }
        }
        
        // Combine the words back into a comment and return it
        return implode(' ', $words);
    }
}
