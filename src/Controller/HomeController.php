<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\DiagnosticoRepository;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(DiagnosticoRepository $diagnosticoRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'diagnosticos' => $diagnosticoRepository->findAll()
        ]);
    }
}
