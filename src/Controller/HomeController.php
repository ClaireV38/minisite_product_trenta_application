<?php


namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param HttpClientInterface $client
     * @param ProductRepository $productRepository
     * @param Request $request
     * @return Response
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function index(HttpClientInterface $client, ProductRepository $productRepository, Request $request): Response
    {
        $data = new SearchData();
        $searchForm = $this->createForm(SearchType::class, $data);
        $searchForm->handleRequest($request);

        $response = $client->request(
            'GET',
            'https://api.github.com/users'
        );
        if ($data->category) {
            $products = $productRepository->findBy(['category' => $data->category], ['createdAt' => 'DESC']);
        } else {
            $products = $productRepository->findBy([], ['createdAt' => 'DESC']);
        }
        $users = $response->toArray();
        return $this->render('home/index.html.twig', [
            'users' => $users,
            'products' => $products,
            'form' => $searchForm->createView(),
        ]);
    }
}
