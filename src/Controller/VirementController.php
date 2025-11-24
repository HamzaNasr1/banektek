<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Entity\Client;
use App\Entity\Compte;
use App\Entity\Virement;
use App\Form\VirementType;
use App\Repository\VirementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

use TCPDF;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
//include_once('TCPDF/tcpdf.php');
  
#[Route('/virement')]
class VirementController extends AbstractController
{
    #[Route('/exportVirement/pdf', name: 'export_virement_to_pdf', methods: ['GET'])]
    public function exportvirementsToPdf(virementRepository $virementRepository,SessionInterface $session,EntityManagerInterface $entityManager): Response
    {
     
        $id_client_connecter = $session->get('id');
        $client_connecter = $entityManager->getRepository(Client::class)->find($id_client_connecter);
       #$client_connecter = $entityManager->getRepository(Client::class)->find($id_agent_connecter);
       #$comptes=$client_connecter->getComptes();
        $comptes = $entityManager->getRepository(Compte::class)->findBy(['id_user' => $client_connecter->getId()]);
       
      
    
$pdf = new TCPDf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator("Wael Salah");
$pdf->SetAuthor('Wael Salah');
$pdf->SetTitle('Demonstrating pdf with php');
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH);
$pdf->setFooterData(array(0,64,0), array(0,64,128));
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->setFont('dejavusans', '', 14, '', true);
$pdf->AddPage();
$html = <<<EOD
<img src="" alt="Your Logo">
<p>In this simple example i show how to generate pdf documents using TCPDF</p>
EOD;
$pdf->writeHTML($this->renderView('pdff/index_virement.html.twig', [
    'comptes' => $comptes,
 
]));
$response = new Response($pdf->Output('test.pdf', 'I'));
return $response;

}

    #[Route('/mesvirements', name: 'app_mes_virement', methods: ['GET'])]
    public function mesvirements( EntityManagerInterface $entityManager,SessionInterface $session): Response
    {        if($session->get('id')){
        $id_client_connecter = $session->get('id');
        $client_connecter = $entityManager->getRepository(Client::class)->find($id_client_connecter);
       #$client_connecter = $entityManager->getRepository(Client::class)->find($id_agent_connecter);
       #$comptes=$client_connecter->getComptes();
        $comptes = $entityManager->getRepository(Compte::class)->findBy(['id_user' => $client_connecter->getId()]);

        
        return $this->render('virement/mesvirements.html.twig', [
         'comptes' => $comptes,
         'client' =>$client_connecter,
        ]);}
        else {
            return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);

        } }
    #[Route('/', name: 'app_virement_index', methods: ['GET'])]
    public function index(virementRepository $virementRepository,Request $request,EntityManagerInterface $entityManager,SessionInterface $session): Response
    {   if($session->get('id_agent')){
        $id_agent_connecter = $session->get('id_agent');
        $agent_connecter = $entityManager->getRepository(Agent::class)->find($id_agent_connecter);
        $virements = $virementRepository->findAll();
        $forms = [];
    
        foreach ($virements as $virement) {
            $form = $this->createForm(virementType::class, $virement, [
                'action' => $this->generateUrl('app_virement_edit', ['id' => $virement->getId()]),
                'method' => 'POST',
            ]);
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->flush();
                $this->addFlash('success', 'virement updated successfully!');
            }
    
            $forms[] = $form->createView();
        }
    
        return $this->render('virement/index.html.twig', [
            'virements' => $virements,
            'forms' => $forms,
            'agent_connecter' => $agent_connecter,

        ]); } 
        else {
            return $this->redirectToRoute('app_agent_login');
        }
    }

    #[Route('/new', name: 'app_virement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,SessionInterface $session): Response
    {
        if($session->get('id_agent')){
            $id_agent_connecter = $session->get('id_agent');
            $agent_connecter = $entityManager->getRepository(Agent::class)->find($id_agent_connecter);
        $virement = new Virement();
        $form = $this->createForm(VirementType::class, $virement);
        $virement->setDateEmission(new \DateTime());
        $virement->setDateApprobation(new \DateTime());
     
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($virement);
            $entityManager->flush();

            return $this->redirectToRoute('app_virement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('virement/new.html.twig', [
            'virement' => $virement,
            'form' => $form,
            'agent_connecter' => $agent_connecter,

        ]); }
        else {
            return $this->redirectToRoute('app_agent_login');
        }
    }

    #[Route('/{id}', name: 'app_virement_show', methods: ['GET'])]
    public function show(Virement $virement): Response
    {
        return $this->render('virement/show.html.twig', [
            'virement' => $virement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_virement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Virement $virement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VirementType::class, $virement);
       
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_virement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('virement/edit.html.twig', [
            'virement' => $virement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_virement_delete', methods: ['POST'])]
    public function delete(Request $request, Virement $virement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$virement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($virement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_virement_index', [], Response::HTTP_SEE_OTHER);
    }
}
