<?php

namespace App\Controller;

namespace App\Controller;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class OrderController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function bookOrder(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $eventId = $data['event_id'];
        $eventDate = $data['event_date'];
        $ticketAdultPrice = $data['ticket_adult_price'];
        $ticketAdultQuantity = $data['ticket_adult_quantity'];
        $ticketKidPrice = $data['ticket_kid_price'];
        $ticketKidQuantity = $data['ticket_kid_quantity'];
        $barcode = $data['barcode'];

        $existingOrder = $this->entityManager->getRepository(Order::class)->findOneBy(['barcode' => $barcode]);

        if ($existingOrder) {
            return new JsonResponse(['error' => 'barcode already exists'], 400);
        }

        return new JsonResponse(['message' => 'order successfully booked']);
    }

    public function approveOrder(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $barcode = $data['barcode'];


        $randomError = random_int(1, 4);
        switch ($randomError) {
            case 1:
                return new JsonResponse(['error' => 'Random error 1'], 400);
            case 2:
                return new JsonResponse(['error' => 'Random error 2'], 400);
            case 3:
                return new JsonResponse(['error' => 'Random error 3'], 400);
            case 4:
                return new JsonResponse(['message' => 'order successfully approved'], 200);
        }

        return new JsonResponse(['message' => 'order successfully approved'], 200);
    }
}