<?php

namespace App\Controller;

use App\Entity\Paciente;
use App\Form\PacienteType;
use App\Repository\PacienteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


#[Route('/paciente')]
class PacienteController extends AbstractController
{
    #[Route('/', name: 'app_paciente_index', methods: ['GET'])]
    public function index(PacienteRepository $pacienteRepository,Request $request,PaginatorInterface $paginator): Response
    {

        $query=$pacienteRepository->findMyPatients();
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            3 /*limit per page*/
        );


        return $this->render('paciente/index.html.twig', [
            'pacientes' => $pacienteRepository->findAll(),
            'pagination' => $pagination
        ]);
    }

    #[Route('/new', name: 'app_paciente_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PacienteRepository $pacienteRepository): Response
    {
        $paciente = new Paciente();
        $form = $this->createForm(PacienteType::class, $paciente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pacienteRepository->save($paciente, true);

            return $this->redirectToRoute('app_paciente_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('paciente/new.html.twig', [
            'paciente' => $paciente,
            'form' => $form,
        ]);
    }

    
    //Buscar por título y autor de canción 
    #[Route('/findsong2', name: 'app_paciente_findsong2', methods: ['GET','POST'])]
    public function findsong2(Request $request,PacienteRepository $pacienteRepository ): Response
    {
        //Extrae el valor del formulario html 
        $nombre=$request->get('nombresong2');
        //consulta exitosa:
        //SELECT * FROM `temazo` WHERE temazo.titulo like ('%Mr%') or temazo.autor like ('%Oz%');
        $busquedaCanciones= $pacienteRepository ->findByTitleAuthor($nombre);
        return $this->renderForm('paciente/resultadosBusqueda.html.twig', [
            'busquedaConaciones'=>$busquedaCanciones,
            'nombre'=>$nombre,
           
        ]);
    }

    
    #[Route('/{id}', name: 'app_paciente_show', methods: ['GET'])]
    public function show(Paciente $paciente): Response
    {
        return $this->render('paciente/show.html.twig', [
            'paciente' => $paciente,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_paciente_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Paciente $paciente, PacienteRepository $pacienteRepository): Response
    {
        $form = $this->createForm(PacienteType::class, $paciente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pacienteRepository->save($paciente, true);

            return $this->redirectToRoute('app_paciente_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('paciente/edit.html.twig', [
            'paciente' => $paciente,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_paciente_delete', methods: ['POST'])]
    public function delete(Request $request, Paciente $paciente, PacienteRepository $pacienteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$paciente->getId(), $request->request->get('_token'))) {
            $pacienteRepository->remove($paciente, true);
        }

        return $this->redirectToRoute('app_paciente_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/baneame', name: 'app_paciente_baneame', methods: ['GET', 'POST'])]
    public function baneame(Request $request,  Paciente $paciente, PacienteRepository $pacienteRepository): Response
    {
        /**By ChatGP3 */
        $form = $this->createFormBuilder($paciente)
        ->add('borrado', ChoiceType::class, [
            'choices' => [
                'Sí' => true,
                'No' => false,
            ],
            'expanded' => true,
            'multiple' => false,
            'label' => '¿Está seguro/a de realizar la operación?',
        ])
        //->add('save', SubmitType::class, ['label' => 'Guardar cambios'])
    
        ->add('save', SubmitType::class, [
            'label' => 'Guardar cambios',
            'attr' => [
                'class' => 'btn btn-primary reducido',
            ],
        ])
    
        ->getForm();
    
    $form->handleRequest($request);
    
    if ($form->isSubmitted() && $form->isValid()) {
        $pacienteRepository->save($paciente, true);
      /*
      Generado por chatGP3 
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
       */
        return $this->redirectToRoute('app_paciente_index', [], Response::HTTP_SEE_OTHER);
        // redirect original: return $this->redirectToRoute('user_show', ['id' => $user->getId()]);
    
    }
    
    return $this->render('paciente/baneame.html.twig', [
        'form' => $form->createView(),
        'paciente' => $paciente,
    ]);
    
    }

    
}
