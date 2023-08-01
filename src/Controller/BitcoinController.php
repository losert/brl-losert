<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class BitcoinController extends AbstractController
{
    public function __construct(
        private HttpClientInterface $client
    ) {
    }

    /**
     * @return Response
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    #[Route('/', name: 'bitcoin_index')]
    public function index(): Response
    {
        try {
            $response_eur = $this->client->request('GET',$_ENV['COINDESK_URL']);
            $data = $response_eur->toArray();
            $rates = $data['bpi'];

            return $this->render('brilo/index.html.twig', [
                'rates' => $rates,
                'allowRates' => $_ENV['ALLOW_CURRENCIES']
            ]);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return $this->render('error.html.twig',
                ['message' => $e->getMessage()]
            );
        }
    }
}