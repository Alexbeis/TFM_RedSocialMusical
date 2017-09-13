<?php

namespace myDomain;

interface LikesRepositoryInterface
{
    public function create($like);
    public function remove($like);
}