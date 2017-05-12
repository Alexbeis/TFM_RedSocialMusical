<?php

namespace myMelomanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use myDomain\DTO\LoginDTO;

class LoginController extends Controller
{

    public function loginAction(Request $request)
    {
        $loginDTO = new LoginDTO(null, $request->getSession());
        $loginUseCase = $this->get('app.application.usecases.login.login');
        $returnLoginDTO = $loginUseCase->execute($loginDTO);

        return $this->render('loginView/googleLogin.html.twig',
            array('authUrl' => $returnLoginDTO->getGoogleURL())
        );

    }

    public function validateAction(Request $request)
    {
        $code = $request->get('code');
        $loginDTO = new LoginDTO($code, $request->getSession());
        $loginUseCase = $this->get('app.application.usecases.login.login');
        $returnLoginDTO = $loginUseCase->execute($loginDTO);

        return $this->redirectToRoute($returnLoginDTO->getStatusCode());


    }

}