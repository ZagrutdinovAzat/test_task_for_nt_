<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Order;
use Symfony\Component\HttpClient\HttpClient;


class OrderService
{
    private $entityManager;
    private $httpClient;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->httpClient = HttpClient::create();
    }

    public function createOrder(
        int $eventId,
        string $eventDate,
        int $ticketAdultPrice,
        int $ticketAdultQuantity,
        int $ticketKidPrice,
        int $ticketKidQuantity
    ): string {
        $barcode = $this->generateUniqueBarcode();
        $order = new Order();
        $order->setEventId($eventId);
        $order->setEventDate(new \DateTime($eventDate));
        $order->setTicketAdultPrice($ticketAdultPrice);
        $order->setTicketAdultQuantity($ticketAdultQuantity);
        $order->setTicketKidPrice($ticketKidPrice);
        $order->setTicketKidQuantity($ticketKidQuantity);
        $order->setBarcode($barcode);
        $order->setEqualPrice(
            ($ticketAdultPrice * $ticketAdultQuantity) + ($ticketKidPrice * $ticketKidQuantity)
        );
        $order->setCreated(new \DateTime());

        $response = $this->httpClient->request('POST', 'http://nginx/book', [
            'json' => [
                'event_id' => $eventId,
                'event_date' => $eventDate,
                'ticket_adult_price' => $ticketAdultPrice,
                'ticket_adult_quantity' => $ticketAdultQuantity,
                'ticket_kid_price' => $ticketKidPrice,
                'ticket_kid_quantity' => $ticketKidQuantity,
                'barcode' => $barcode,
            ],
        ]);

//        $responseData = json_decode($response->getContent(), true);

        if ($response->getStatusCode() == 400) {
            return $this->createOrder($eventId, $eventDate, $ticketAdultPrice, $ticketAdultQuantity, $ticketKidPrice, $ticketKidQuantity);
        }

        $approveResponse = $this->httpClient->request('POST', 'http://nginx/approve', [
            'json' => ['barcode' => $barcode],
        ]);

        $approveResponseData = json_decode($approveResponse->getContent(), true);


        if ($approveResponse->getStatusCode() == 200 ) {
            $this->entityManager->persist($order);
            $this->entityManager->flush();
            return 'Order successfully saved';
        }

        return $approveResponseData['message'];
    }

    private function generateUniqueBarcode(): string
    {
        do {
            $barcode = random_int(10000000, 99999999);
        } while ($this->entityManager->getRepository(Order::class)->findOneBy(['barcode' => $barcode]));

        return (string)$barcode;
    }
}