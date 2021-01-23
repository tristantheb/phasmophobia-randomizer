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
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class GameModeController extends AbstractController
{
    /**
     * @Route("/classic-mode", name="classic_mode")
     * @param Request $request
     * @param SessionInterface $session
     * @return Response
     * @throws Exception
     */
    public function indexClassic(Request $request, SessionInterface $session): Response
    {
        $room = $session->get('roomId', null);
        if ($room === null) {
            $room = $this->roomCreate();
            $session->set('roomId', $room->getRoomId());
        } else {
            $room = $this->getDoctrine()->getRepository(Room::class)->findOneBy(["roomId" => $room]);
            if ($room === null) {
                $session->remove('roomId');
                $this->redirectToRoute('classic_mode');
            }
        }

        $hunter = new Hunter();
        $classicForm = $this->createForm(ClassicModeType::class, $hunter);

        return $this->render('classic_mode/index.html.twig', [
            'page_title' => 'Classic - Phasmophobia Randomizer',
            'page_description' => 'Classic mode page description',
            'classicForm' => $classicForm->createView(),
            'roomNumber' => $room->getRoomId(),
            'gameType' => 'classic-mode'
        ]);
    }

    /**
     * @Route("/classic-mode/rules", name="classic_mode_rules")
     */
    public function rulesClassic(): Response
    {
        return $this->render('classic_mode/rules.html.twig', [
            'page_title' => 'Rules of Classic Phasmophobia Randomizer',
            'page_description' => 'Rules page description'
        ]);
    }

    /**
     * @Route("/safari-mode", name="safari_mode")
     * @param Request $request
     * @param SessionInterface $session
     * @return Response
     * @throws Exception
     */
    public function indexSafari(Request $request, SessionInterface $session): Response
    {
        $room = $session->get('roomId', null);
        if ($room === null) {
            $room = $this->roomCreate();
            $room = $session->set('roomId', $room->getRoomId());
        }

        $hunter = new Hunter();
        $safariForm = $this->createForm(SafariModeType::class, $hunter);

        return $this->render('safari_mode/index.html.twig', [
            'page_title' => 'Safari - Phasmophobia Randomizer',
            'page_description' => 'Safari mode page description',
            'safariForm' => $safariForm->createView(),
            'roomNumber' => $room->getRoomId(),
            'gameType' => 'safari-mode'
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
     * @Route("/close-game/{roomId<^\d{6}$>}/{gameMode}", name="close_game")
     * @param string $roomId
     * @param string $gameMode
     * @return Response
     */
    public function closeRoom(string $roomId, string $gameMode): Response
    {
        $response = $this->roomRemove($roomId);
        if ($response) {
            return $this->redirectToRoute('index');
        }
        return $this->redirect($gameMode);
    }

    /**
     * @Route("/room/{roomId<^\d{6}$>}", name="room")
     * @param int $roomId
     * @return Response
     */
    public function room(int $roomId): Response
    {
        $room = $this->getDoctrine()->getRepository(Room::class)->findOneBy(["roomId" => $roomId]);

        if (!$room) {
            throw new NotFoundHttpException("The room does not exist");
        }

        return $this->render('room/index.html.twig', [
            'page_title' => 'Phasmophobia Randomizer',
            'page_description' => 'Your are entered inner a shared room !',
            "roomNumber" => $roomId
        ]);
    }

    /**
     * @Route("/room-closed", name="room_closed")
     */
    public function roomClosed(): Response
    {
        return $this->render('/room/room_closed.html.twig', [
            'page_title' => 'Phasmophobia Randomizer',
            'page_description' => 'Server connection failed'
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
        $room->setRoomId(0);
        while ($room->getRoomId() === 0) {
            $nb = random_int(100000, 999999);
            if (!in_array($nb, $roomList)) {
                $manager = $this->getDoctrine()->getManager();
                $room->setRoomId($nb);
                $manager->persist($room);
                $manager->flush();
            }
        }
        return $room;
    }

    /**
     * @param string $roomId
     * @return bool
     */
    private function roomRemove(string $roomId): bool
    {
        $em = $this->getDoctrine()->getManager();
        $room = $em->getRepository(Room::class)->findOneBy(["roomId" => $roomId]);

        if ($room) {
            $em->remove($room);
            $em->flush();
            return true;
        }

        return false;
    }
}
