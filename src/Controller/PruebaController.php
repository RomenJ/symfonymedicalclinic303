<?php

namespace App\Controller;

use App\Entity\Prueba;
use App\Form\PruebaType;
use App\Repository\PruebaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


#[Route('/prueba')]
class PruebaController extends AbstractController
{
    #[Route('/', name: 'app_prueba_index', methods: ['GET'])]
    public function index(PruebaRepository $pruebaRepository,Request $request,PaginatorInterface $paginator): Response
    {

        //findMyPruebas()

        $query=$pruebaRepository->findMyPruebas();
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            3 /*limit per page*/
        );

        return $this->render('prueba/index.html.twig', [
            'pruebas' => $pruebaRepository->findAll(),
            'pagination' => $pagination
        ]);
    }

    #[Route('/new', name: 'app_prueba_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PruebaRepository $pruebaRepository): Response
    {
        $prueba = new Prueba();
        $form = $this->createForm(PruebaType::class, $prueba);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pruebaRepository->save($prueba, true);

            return $this->redirectToRoute('app_prueba_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('prueba/new.html.twig', [
            'prueba' => $prueba,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_prueba_show', methods: ['GET'])]
    public function show(Prueba $prueba): Response
    {
        return $this->render('prueba/show.html.twig', [
            'prueba' => $prueba,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_prueba_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Prueba $prueba, PruebaRepository $pruebaRepository): Response
    {
        $form = $this->createForm(PruebaType::class, $prueba);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pruebaRepository->save($prueba, true);

            return $this->redirectToRoute('app_prueba_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('prueba/edit.html.twig', [
            'prueba' => $prueba,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_prueba_delete', methods: ['POST'])]
    public function delete(Request $request, Prueba $prueba, PruebaRepository $pruebaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$prueba->getId(), $request->request->get('_token'))) {
            $pruebaRepository->remove($prueba, true);
        }

        return $this->redirectToRoute('app_prueba_index', [], Response::HTTP_SEE_OTHER);
    }


    #[Route('/{id}/baneame', name: 'app_prueba_baneame', methods: ['GET', 'POST'])]
    public function baneame(Request $request, Prueba $prueba, PruebaRepository $pruebaRepository  ): Response
    {
        /**By ChatGP3 */
        $form = $this->createFormBuilder($prueba)
        ->add('borrado', ChoiceType::class, [
            'choices' => [
                'Sí' => true,
                'No' => false,
            ],
            'expanded' => true,
            'multiple' => false,
            'label' => '¿Está seguro/a de borrar esta prueba médica ?',
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
        $pruebaRepository->save($prueba, true);
    
        return $this->redirectToRoute('app_trat_index', [], Response::HTTP_SEE_OTHER);
        // redirect original: return $this->redirectToRoute('user_show', ['id' => $user->getId()]);
    
    }
    
    return $this->render('prueba/baneame.html.twig', [
        'form' => $form->createView(),
        'prueba' => $prueba,
    ]);
    
    }
}
