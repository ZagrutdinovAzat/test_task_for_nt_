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

        $errors = [];

        if (!is_int($eventId) || $eventId <= 0) {
            $errors[] = 'Invalid event ID';
        }

        $eventDateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $eventDate);
        if (!$eventDateTime) {
            $errors[] = 'Invalid event date format';
        } else {
            $today = new \DateTime();
            if ($eventDateTime < $today) {
                $errors[] = 'Event date cannot be in the past';
            }
        }

        if (!is_int($ticketAdultPrice) || $ticketAdultPrice <= 0) {
            $errors[] = 'Invalid adult ticket price';
        }

        if (!is_int($ticketAdultQuantity) || $ticketAdultQuantity < 0) {
            $errors[] = 'Invalid adult ticket quantity';
        }

        if (!is_int($ticketKidPrice) || $ticketKidPrice <= 0) {
            $errors[] = 'Invalid kid ticket price';
        }

        if (!is_int($ticketKidQuantity) || $ticketKidQuantity < 0) {
            $errors[] = 'Invalid kid ticket quantity';
        }

        if (!empty($errors)) {
            return new JsonResponse(['errors' => $errors]);
        }

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