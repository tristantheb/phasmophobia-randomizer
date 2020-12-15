<?php

namespace App\Controller;

use App\Entity\Room;
use App\Form\RoomType;
use App\Repository\RoomRepository;
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
            $roomID = $roomForm->getData();
            $result = $this->getDoctrine()->getRepository(Room::class)->findOneBy(["roomNumber" => $roomID]);
            if ($result) {
                return $this->redirectToRoute("room", ["roomId" => $roomID]);
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
     * @Route("/room/{roomId}", name="room")
     */
    public function room(): Response
    {
        return $this->render('room.html.twig', [
            'page_title' => 'Phasmophobia Randomizer',
            'page_description' => 'Your are entered inner a shared room !'
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
