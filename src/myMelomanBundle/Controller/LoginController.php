<?php

namespace myMelomanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use myDomain\DTO\LoginDTO;

class LoginController extends Controller
{

    public function loginAction(Request $request)
    {
        if ($request->getSession()->get('user')) {
            $userid = $request->getSession()->get('user');
            $publications = $this->get('app.application.usecases.publication.get')->execute($userid, $request);
            return $this->render('homeView/homeView.html.twig',
                array(
                    'pagination' => $publications
                ));
        }

        $loginDTO       = new LoginDTO(null, $request->getSession());
        $loginUseCase   = $this->get('app.application.usecases.login.login');
        $returnLoginDTO = $loginUseCase->execute($loginDTO);

        return $this->render('loginView/googleLogin.html.twig',
            array(
                'authUrl' => $returnLoginDTO->getGoogleURL()
            )
        );
    }

    public function validateAction(Request $request)
    {
        $code           = $request->get('code');
        $loginDTO       = new LoginDTO($code, $request->getSession());
        $loginUseCase   = $this->get('app.application.usecases.login.login');
        $returnLoginDTO = $loginUseCase->execute($loginDTO);
        $request->getSession()->set('user', $returnLoginDTO->getUserId());

        return $this->redirectToRoute($returnLoginDTO->getStatusCode());


    }

    public function logoutAction(Request $request)
    {
        if (!$request->getSession()->get('user')) {
            return $this->redirectToRoute('login');
        }

        $request->getSession()->clear();
        $request->getSession()->invalidate();

        return $this->redirectToRoute('login');

    }

}