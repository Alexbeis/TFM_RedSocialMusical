<?php

namespace myDomain;


interface PublicationRepositoryInterface
{
    public function create($publication);
    public function update($publication);
    public function remove($publication);

}