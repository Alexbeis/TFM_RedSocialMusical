<?php

namespace myDomain\UseCases\UserProfile;

use Symfony\Component\HttpFoundation\Request;

class GetCheckedTastes
{
    private $getmusicalTastes;

    public function __construct(GetMusicalTastes $getMusicalTastes)
    {
        $this->getmusicalTastes = $getMusicalTastes;
    }

    public function execute(Request $request)
    {
        $currentTastes = [];
        $tastes = $this->getmusicalTastes->execute();

        foreach ($tastes as $key => $taste) {

            if ($request->request->get($taste) == 'on') {
                $currentTastes[$key] =  $taste;
            }
        }
        return $currentTastes;

    }

}