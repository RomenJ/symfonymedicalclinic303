<?php

namespace App\Controller;

use App\Entity\Trat;
use App\Form\TratType;
use App\Repository\TratRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

#[Route('/trat')]
class TratController extends AbstractController
{
    #[Route('/', name: 'app_trat_index', methods: ['GET'])]
    public function index(TratRepository $tratRepository,Request $request,PaginatorInterface $paginator): Response
    {

        $query=$tratRepository->findMyTrats();
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            3 /*limit per page*/
        );
        return $this->render('trat/index.html.twig', [
            'trats' => $tratRepository->findAll(),
            'pagination' => $pagination
        ]);
    }

    #[Route('/new', name: 'app_trat_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TratRepository $tratRepository): Response
    {
        $trat = new Trat();
        $form = $this->createForm(TratType::class, $trat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tratRepository->save($trat, true);

            return $this->redirectToRoute('app_trat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('trat/new.html.twig', [
            'trat' => $trat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_trat_show', methods: ['GET'])]
    public function show(Trat $trat): Response
    {
        return $this->render('trat/show.html.twig', [
            'trat' => $trat,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_trat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Trat $trat, TratRepository $tratRepository): Response
    {
        $form = $this->createForm(TratType::class, $trat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tratRepository->save($trat, true);

            return $this->redirectToRoute('app_trat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('trat/edit.html.twig', [
            'trat' => $trat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_trat_delete', methods: ['POST'])]
    public function delete(Request $request, Trat $trat, TratRepository $tratRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trat->getId(), $request->request->get('_token'))) {
            $tratRepository->remove($trat, true);
        }

        return $this->redirectToRoute('app_trat_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/{id}/baneame', name: 'app_trat_baneame', methods: ['GET', 'POST'])]
    public function baneame(Request $request, Trat $trat, TratRepository $tratRepository  ): Response
    {
        /**By ChatGP3 */
        $form = $this->createFormBuilder($trat)
        ->add('borrado', ChoiceType::class, [
            'choices' => [
                'Sí' => true,
                'No' => false,
            ],
            'expanded' => true,
            'multiple' => false,
            'label' => '¿Está seguro/a de borrar este tratamiento ?',
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
        $tratRepository->save($trat, true);
    
        return $this->redirectToRoute('app_trat_index', [], Response::HTTP_SEE_OTHER);
        // redirect original: return $this->redirectToRoute('user_show', ['id' => $user->getId()]);
    
    }
    
    return $this->render('trat/baneame.html.twig', [
        'form' => $form->createView(),
        'trata' => $trat,
    ]);
    
    }
}
