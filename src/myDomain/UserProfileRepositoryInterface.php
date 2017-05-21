<?php

namespace myDomain;


interface UserProfileRepositoryInterface
{
    public function create ($userProfile);
    public function remove ($userProfile);


}