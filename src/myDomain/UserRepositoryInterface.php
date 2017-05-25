<?php

namespace myDomain;


interface UserRepositoryInterface
{
    public function create($user);
    public function update($user);
    public function remove($user);

}