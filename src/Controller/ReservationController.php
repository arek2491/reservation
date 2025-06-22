<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Reservation;
use App\Entity\Room;
use Doctrine\ORM\EntityManagerInterface;

class ReservationController extends AbstractController
{
    #[Route('/api/reservation', name: 'create_reservation', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        $room = $em->getRepository(Room::class)->find($data['room_id']);
        if (!$room) {
            return new JsonResponse(['error' => 'Room not found'], 404);
        }

        $reservation = new Reservation();
        $reservation->setRoom($room);
        $reservation->setFromDate(new \DateTime($data['start_date']));
        $reservation->setToDate(new \DateTime($data['end_date']));
        $reservation->setGuestName($data['guest_name']);
        $reservation->setPrice24($data['price24']);

        $em->persist($reservation);
        $em->flush();

        return new JsonResponse(['status' => 'Reservation created'], 201);
    }

    #[Route('/api/reservations', name: 'get_all_reservations', methods: ['GET'])]
public function getAll(EntityManagerInterface $em): JsonResponse
{
    $reservations = $em->getRepository(Reservation::class)->findAll();

    $data = [];

    foreach ($reservations as $reservation) {
        $data[] = [
            'id' => $reservation->getId(),
            'room' => $reservation->getRoom()?->getNumber(),
            'guest_name' => $reservation->getGuestName(),
            'from_date' => $reservation->getFromDate()->format('Y-m-d'),
            'to_date' => $reservation->getToDate()->format('Y-m-d'),
            'price24' => $reservation->getPrice24(),
        ];
    }

    return new JsonResponse($data);
}
}