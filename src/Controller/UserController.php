<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository,PaginatorInterface $paginator,Request $request): Response
    {

        $query=$userRepository->findMyMedics();
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            2 /*limit per page*/
        );
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
           'pagination'=> $pagination
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/baneame', name: 'app_user_baneame', methods: ['GET', 'POST'])]
    public function baneame(Request $request,  User $user, UserRepository $userRepository): Response
    {
        /**By ChatGP3 */
        $form = $this->createFormBuilder($user)
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
        $userRepository->save($user, true);
      /*
      Generado por chatGP3 
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
       */
        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        // redirect original: return $this->redirectToRoute('user_show', ['id' => $user->getId()]);
    
    }
    
    return $this->render('user/baneame.html.twig', [
        'form' => $form->createView(),
        'user' => $user,
    ]);
    
    }

    
}
