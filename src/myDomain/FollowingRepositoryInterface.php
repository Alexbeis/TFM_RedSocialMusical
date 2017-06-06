<?php


namespace myDomain;


interface FollowingRepositoryInterface
{
    public function create($following);
    public function delete($following);

}