<?php

namespace App\Controller;

use App\Entity\Hunter;
use App\Entity\Room;
use App\Form\ClassicModeType;
use App\Form\SafariModeType;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameModeController extends AbstractController
{
    /**
     * @Route("/classic-mode", name="classic_mode")
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function indexClasic(Request $request): Response
    {
        $room = $this->roomCreate();

        $hunter = new Hunter();
        $classicForm = $this->createForm(ClassicModeType::class, $hunter);

        return $this->render('classic_mode/index.html.twig', [
            'page_title' => 'Classic - Phasmophobia Randomizer',
            'page_description' => 'Classic mode page description',
            'classicForm' => $classicForm->createView(),
            'roomNumber' => $room->getRoomNumber()
        ]);
    }

    /**
     * @Route("/classic-mode/rules", name="classic_mode_rules")
     */
    public function rulesClasic(): Response
    {
        return $this->render('classic_mode/rules.html.twig', [
            'page_title' => 'Rules of Classic Phasmophobia Randomizer',
            'page_description' => 'Rules page description'
        ]);
    }

    /**
     * @Route("/safari-mode", name="safari_mode")
     * @throws Exception
     */
    public function indexSafari(): Response
    {
        $room = $this->roomCreate();

        $hunter = new Hunter();
        $safariForm = $this->createForm(SafariModeType::class, $hunter);

        return $this->render('safari_mode/index.html.twig', [
            'page_title' => 'Safari - Phasmophobia Randomizer',
            'page_description' => 'Safari mode page description',
            'safariForm' => $safariForm->createView(),
            'roomNumber' => $room->getRoomNumber()
        ]);
    }

    /**
     * @Route("/safari-mode/rules", name="safari_mode_rules")
     */
    public function rulesSafari(): Response
    {
        return $this->render('safari_mode/rules.html.twig', [
            'page_title' => 'Rules of Safari Phasmophobia Randomizer',
            'page_description' => 'Rules page description'
        ]);
    }

    /**
     * @throws Exception
     */
    private function roomCreate(): Room
    {
        /** @var Room $rooms */
        $rooms = $this->getDoctrine()->getRepository(Room::class)->findAll();
        $roomList = [];
        foreach ($rooms as $room) {
            array_push($roomList, $room->getRoomNumber());
        }

        $room = new Room();
        $room->setRoomNumber(0);
        while ($room->getRoomNumber() === 0) {
            $nb = random_int(1, 999999);
            if (!in_array($nb, $roomList)) {
                $manager = $this->getDoctrine()->getManager();
                $room->setRoomNumber($nb);
                $manager->persist($room);
                $manager->flush();
            }
        }
        return $room;
    }
}
