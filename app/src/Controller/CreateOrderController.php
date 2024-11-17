<?php

namespace App\Controller;

use App\Service\OrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CreateOrderController extends AbstractController
{
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function createOrder(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $eventId = $data['event_id'];
        $eventDate = $data['event_date'];
        $ticketAdultPrice = $data['ticket_adult_price'];
        $ticketAdultQuantity = $data['ticket_adult_quantity'];
        $ticketKidPrice = $data['ticket_kid_price'];
        $ticketKidQuantity = $data['ticket_kid_quantity'];

        $result = $this->orderService->createOrder(
            $eventId,
            $eventDate,
            $ticketAdultPrice,
            $ticketAdultQuantity,
            $ticketKidPrice,
            $ticketKidQuantity
        );

        return new JsonResponse(['message' => $result]);
    }

}