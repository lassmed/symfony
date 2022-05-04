<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        $users=[
            ["name"=>'mohamed','surname'=>'lasswed','age'=>21],
            ['name'=>'oumayma','surname'=>'ouerfelli','age'=>20],
            ['name'=>'aymen','surname'=>'sellaouti','age'=>35]
        ];
        return $this->render('user/index.html.twig', [
            'users'=>$users
        ]);
    }
}
