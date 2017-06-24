<?php

namespace myDomain\UseCases\User;


use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManagerInterface;
use myDomain\DTO\UserProfileDTO;
use myDomain\Entity\MusicalTaste;
use myDomain\Entity\User;
use myDomain\MusicalTasteInterface;
use myDomain\UserRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class UpdateUserUseCase
{
    /**
     * @var Registry
     */
    private $userRepository;
    private $musicalTasteRepository;
    private $entityManager;


    public function __construct(UserRepositoryInterface $userRepository,
                                MusicalTasteInterface $musicalTasteRepository,
                                EntityManagerInterface $entityManager
                               )
    {
        $this->userRepository           = $userRepository;
        $this->musicalTasteRepository   = $musicalTasteRepository;
        $this->entityManager            = $entityManager;

    }

    public function execute($userId, UserProfileDTO $userProfileDTO)
    {
        /**
         * @var User $user
         */
        $user = $this->userRepository->findOneBy(array('id' => $userId));
        $user->setAboutMe($userProfileDTO->getAboutMe());
        $user->setBirthDate($userProfileDTO->getBirth());
        $user->setMusicalTaste($this->getCurrentTastes($user, $userProfileDTO->getTastes()));
        $this->userRepository->update($user);
        $this->entityManager->flush($user);

        return $user;

    }

    private function getCurrentTastes($user, $rawTastes)
    {
        $tastes = [];

        foreach ($rawTastes as $rawTaste) {
            $taste =  new MusicalTaste();
            $taste->setName($rawTaste);
            if (in_array($taste,$user->getMusicalTaste()->getValues())) {
                $this->musicalTasteRepository->remove($taste);
            }

            $this->musicalTasteRepository->create($taste);
            $tastes[] = $taste;
        }

        return $tastes;
    }

}