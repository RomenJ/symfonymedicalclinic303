<?php

namespace App\Controller;

use App\Entity\Pato;
use App\Form\PatoType;
use App\Repository\PatoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

#[Route('/pato')]
class PatoController extends AbstractController
{
    #[Route('/', name: 'app_pato_index', methods: ['GET'])]
    public function index(PatoRepository $patoRepository,Request $request,PaginatorInterface $paginator): Response
    {
        $query=$patoRepository->findMyPathos();
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            3 /*limit per page*/
        );
        return $this->render('pato/index.html.twig', [
            'patos' => $patoRepository->findAll(),
            'pagination' => $pagination
        ]);
    }

    #[Route('/new', name: 'app_pato_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PatoRepository $patoRepository): Response
    {
        $pato = new Pato();
        $form = $this->createForm(PatoType::class, $pato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $patoRepository->save($pato, true);

            return $this->redirectToRoute('app_pato_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pato/new.html.twig', [
            'pato' => $pato,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pato_show', methods: ['GET'])]
    public function show(Pato $pato): Response
    {
        return $this->render('pato/show.html.twig', [
            'pato' => $pato,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_pato_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pato $pato, PatoRepository $patoRepository): Response
    {
        $form = $this->createForm(PatoType::class, $pato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $patoRepository->save($pato, true);

            return $this->redirectToRoute('app_pato_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pato/edit.html.twig', [
            'pato' => $pato,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pato_delete', methods: ['POST'])]
    public function delete(Request $request, Pato $pato, PatoRepository $patoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pato->getId(), $request->request->get('_token'))) {
            $patoRepository->remove($pato, true);
        }

        return $this->redirectToRoute('app_pato_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/baneame', name: 'app_pato_baneame', methods: ['GET', 'POST'])]
    public function baneame(Request $request,  Pato $pato, PatoRepository $patoRepository): Response
    {
        /**By ChatGP3 */
        $form = $this->createFormBuilder($pato)
        ->add('borrado', ChoiceType::class, [
            'choices' => [
                'Sí' => true,
                'No' => false,
            ],
            'expanded' => true,
            'multiple' => false,
            'label' => '¿Está seguro/a de borrar esta patología ?',
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
        $patoRepository->save($pato, true);
      /*
      Generado por chatGP3 
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
       */
        return $this->redirectToRoute('app_pato_index', [], Response::HTTP_SEE_OTHER);
        // redirect original: return $this->redirectToRoute('user_show', ['id' => $user->getId()]);
    
    }
    
    return $this->render('pato/baneame.html.twig', [
        'form' => $form->createView(),
        'pato' => $pato,
    ]);
    
    }
}
