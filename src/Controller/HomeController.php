<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function index(HttpClientInterface $client): Response
    {
        $response = $client->request(
            'GET',
            'https://api.github.com/users'
        );
        $users = $response->toArray();
        return $this->render('home/index.html.twig', [
            'users' => $users,
        ]);
    }
}
