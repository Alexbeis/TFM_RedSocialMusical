<?php

namespace myDomain\UseCases\Follow;

use Doctrine\ORM\EntityManagerInterface;
use myDomain\DTO\FollowingDTO;
use myDomain\Entity\Following;
use myDomain\FollowingRepositoryInterface;
use myDomain\UserRepositoryInterface;
use myMelomanBundle\Repository\UserRepository;
use Symfony\Component\Config\Definition\Exception\Exception;

class DeleteFollowUseCase
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    private $entityManager;
    private $followingRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        EntityManagerInterface $entityManager,
        FollowingRepositoryInterface $followingRepository)
    {
        $this->userRepository       = $userRepository;
        $this->entityManager        = $entityManager;
        $this->followingRepository  = $followingRepository;
    }

    public function execute(FollowingDTO $followingDTO)
    {
        try {
            $user = $this->userRepository->findOneBy(
                array(
                    'id' => $followingDTO->getUserId()
                )
            );

            $friend = $this->userRepository->findOneBy(
                array(
                    'id' => $followingDTO->getFriendId()
                )
            );

            if (!$user || !$friend) {
                return false;
            }

            $following = $this->followingRepository->findOneBy(
                array(
                    'user' => $user,
                    'friend'=> $friend
                )
            );
            //\Doctrine\Common\Util\Debug::dump($following);

            if ($following) {
                $this->followingRepository->delete($following);
                $this->entityManager->flush();

                return true;
            } else{
                return false;
            }

        } catch (Exception $e) {
            return false;
        }
    }

}