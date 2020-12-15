<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SafariModeController extends AbstractController
{
    /**
     * @Route("/safari-mode", name="safari_mode")
     */
    public function index(): Response
    {
        return $this->render('safari_mode/index.html.twig', [
            'page_title' => 'Safari - Phasmophobia Randomizer',
            'page_description' => 'Safari mode page description'
        ]);
    }
    
    /**
     * @Route("/safari-mode/rules", name="safari_mode_rules")
     */
    public function rules(): Response
    {
        return $this->render('safari_mode/rules.html.twig', [
            'page_title' => 'Rules of Safari Phasmophobia Randomizer',
            'page_description' => 'Rules page description'
        ]);
    }
}
