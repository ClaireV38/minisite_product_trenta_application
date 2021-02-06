<?php


namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param HttpClientInterface $client
     * @param ProductRepository $productRepository
     * @return Response
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function index(HttpClientInterface $client, ProductRepository $productRepository): Response
    {
        $response = $client->request(
            'GET',
            'https://api.github.com/users'
        );
        $products = $productRepository->findBy([], ['createdAt' => 'DESC']);
        $users = $response->toArray();
        return $this->render('home/index.html.twig', [
            'users' => $users,
            'products' => $products
        ]);
    }
}
