<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserCtrollerController extends AbstractController
{
    #[Route('/user', name: 'user_list')]
    public function listAction(ManagerRegistry $doctrine): Response
    {
        $username = $doctrine->getRepository('App\Entity\User')->findAll();
        return $this->render('user/index.html.twig', [
            'username' => 'username',
        ]);
    }

}
