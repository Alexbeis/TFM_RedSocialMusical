<?php

namespace myDomain;

interface LikesRepositoryInterface
{
    public function create($llike);
    public function remove($like);
}