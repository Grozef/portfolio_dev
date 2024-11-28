<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route(['/home', '/'], name: 'app_home')]
    public function index(): Response
    {
        return $this->render('pages/home.html.twig');
    }
    #[Route('/confidentialite', 'legals_confidentialite', methods: ['GET'])]
    public function confidentialite(): Response
    {
        return $this->render('pages/legals/confidentialite.html.twig');
    }

    #[Route('/mentions', 'legals_mentions', methods: ['GET'])]
    public function mentions(): Response
    {
        return $this->render('pages/legals/mentions.html.twig');
    }

    #[Route('/erreur', 'legals_erreur', methods: ['GET'])]
    public function erreur(): Response
    {
        return $this->render('pages/legals/erreur.html.twig');
    }
}
