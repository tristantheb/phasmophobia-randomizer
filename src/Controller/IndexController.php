<?php

namespace App\Controller;

use App\Entity\Room;
use App\Form\RoomType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $room = new Room();
        $roomForm = $this->createForm(RoomType::class, $room);

        $roomForm->handleRequest($request);
        if ($roomForm->isSubmitted() && $roomForm->isValid()) {
            /** @var Room $data */
            $data = $roomForm->getData();
            $result = $this->getDoctrine()->getRepository(Room::class)->findOneBy(["roomNumber" => $data->getRoomNumber()]);
            if ($result) {
                return $this->redirectToRoute("room", ["roomId" => $data->getRoomNumber()]);
            } else {
                throw new NotFoundHttpException("The room does not exist");
            }
        }

        return $this->render('index.html.twig', [
            'page_title' => 'Phasmophobia Randomizer',
            'page_description' => 'Index page description',
            'roomEnter' => $roomForm->createView()
        ]);
    }

    /**
     * @Route("/room/{roomId<^\d{6}$>}", name="room")
     * @param int $roomId
     * @return Response
     */
    public function room(int $roomId): Response
    {
        $room = $this->getDoctrine()->getRepository(Room::class)->findOneBy(["roomNumber" => $roomId]);

        if (!$room) {
            throw new NotFoundHttpException("The room does not exist");
        }

        return $this->render('room.html.twig', [
            'page_title' => 'Phasmophobia Randomizer',
            'page_description' => 'Your are entered inner a shared room !',
            "roomNumber" => $roomId
        ]);
    }

    /**
     * @Route("/tracker", name="tracker")
     */
    public function tracker(): Response
    {
        return $this->render('tracker.html.twig', [
            'page_title' => 'Tracker of Phasmophobia Randomizer',
            'page_description' => 'Tracker page description'
        ]);
    }
}
