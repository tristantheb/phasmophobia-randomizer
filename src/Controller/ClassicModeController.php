<?php

namespace App\Controller;

use App\Entity\Hunter;
use App\Form\ClassicModeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassicModeController extends AbstractController
{
    /**
     * @Route("/classic-mode", name="classic_mode")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $hunter = new Hunter();
        $classicForm = $this->createForm(ClassicModeType::class, $hunter);

        return $this->render('classic_mode/index.html.twig', [
            'page_title' => 'Classic - Phasmophobia Randomizer',
            'page_description' => 'Classic mode page description',
            'classicForm' => $classicForm->createView()
        ]);
    }

    /**
     * @Route("/classic-mode/rules", name="classic_mode_rules")
     */
    public function rules(): Response
    {
        return $this->render('classic_mode/rules.html.twig', [
            'page_title' => 'Rules of Classic Phasmophobia Randomizer',
            'page_description' => 'Rules page description'
        ]);
    }
}
