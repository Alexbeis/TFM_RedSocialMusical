<?php

namespace myDomain\UseCases\UserProfile;


class GetMusicalTastes
{
    const TASTES  = [ '1'=>'rock', '2'=>'funk', '3'=>'techno', '4'=>'reggae', '5'=>'blues', '6'=>'mestizaje', '7'=>'edm', '8'=> 'drum&bass', '9'=>'hardrock', '10'=>'metal'];

    public function execute()
    {
        return self::TASTES;
    }
}