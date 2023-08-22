<?php

namespace App\Controller;

use App\Entity\Diagnostico;
use App\Form\DiagnosticoType;
use App\Repository\DiagnosticoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Dompdf\Dompdf;


#[Route('/diagnostico')]
class DiagnosticoController extends AbstractController
{
    #[Route('/', name: 'app_diagnostico_index', methods: ['GET'])]
    public function index(DiagnosticoRepository $diagnosticoRepository,Request $request,PaginatorInterface $paginator): Response
    {

        //findMyDiagnosys()
        $query=$diagnosticoRepository->findMyDiagnosys();
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            3 /*limit per page*/
        );


        return $this->render('diagnostico/index.html.twig', [
            'diagnosticos' => $diagnosticoRepository->findAll(),
            'pagination' => $pagination
        ]);
    }

    #[Route('/new', name: 'app_diagnostico_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DiagnosticoRepository $diagnosticoRepository): Response
    {
        $diagnostico = new Diagnostico();
        $form = $this->createForm(DiagnosticoType::class, $diagnostico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $diagnosticoRepository->save($diagnostico, true);

            return $this->redirectToRoute('app_diagnostico_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('diagnostico/new.html.twig', [
            'diagnostico' => $diagnostico,
            'form' => $form,
        ]);
    }
        
    #[Route('/finden', name: 'app_diagnostico_findgen', methods: ['GET','POST'])]
    public function findgen(Request $request): Response
    {
    
        return $this->renderForm('diagnostico/buscador.html.twig', [
 
        ]);
    }


    #[Route('/{id}', name: 'app_diagnostico_show', methods: ['GET'])]
    public function show(Diagnostico $diagnostico): Response
    {
        return $this->render('diagnostico/show.html.twig', [
            'diagnostico' => $diagnostico,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_diagnostico_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Diagnostico $diagnostico, DiagnosticoRepository $diagnosticoRepository): Response
    {
        $form = $this->createForm(DiagnosticoType::class, $diagnostico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $diagnosticoRepository->save($diagnostico, true);

            return $this->redirectToRoute('app_diagnostico_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('diagnostico/edit.html.twig', [
            'diagnostico' => $diagnostico,
            'form' => $form,
        ]);
    }

    //generar pdf:


    #[Route('/{id}/pdfgen', name: 'app_diagnostico_pdfgen', methods: ['GET', 'POST'])]
    public function pdfgen(Request $request, Diagnostico $diagnostico): Response
    {
    //    $FechaInfo= new DateTime();
        $data = [
            'imageSrc'  => $this->imageToBase64($this->getParameter('kernel.project_dir') . '/public/images/sf.png'),
            'name'         =>$diagnostico->getPaciente(),
            'date'      => $diagnostico->getDate(),
            'patologias'=>$diagnostico->getPatologias(),
            'pruebas'=>$diagnostico->getPruebas(),
            'trats'=>$diagnostico->getTrats(),
            'medicos'=>$diagnostico->getMedico()
        ];
  
        $html =  $this->renderView('diagnostico/pdfdiagostico.html.twig', $data);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();
         
        return new Response (
            $dompdf->stream('resume', ["Attachment" => false]),
            Response::HTTP_OK,
            ['Content-Type' => 'application/pdf']
        );
    
    }
    
    private function imageToBase64($path) {
        $path = $path;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }
    
    #[Route('/{id}', name: 'app_diagnostico_delete', methods: ['POST'])]
    public function delete(Request $request, Diagnostico $diagnostico, DiagnosticoRepository $diagnosticoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$diagnostico->getId(), $request->request->get('_token'))) {
            $diagnosticoRepository->remove($diagnostico, true);
        }
        return $this->redirectToRoute('app_diagnostico_index', [], Response::HTTP_SEE_OTHER);
    }

    
}
