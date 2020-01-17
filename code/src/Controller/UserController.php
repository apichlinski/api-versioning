<?php


namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use FOS\RestBundle\Controller\Annotations as FOSRestAnnotations;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

/**
 * User controller
 * @FOSRestAnnotations\Route("/api/user")
 */
class UserController extends FOSRestController
{
    private $userRepository;

    /**
     * @required
     *
     * @param UserRepository $userRepository
     */
    public function setReservationRepository(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get one user.
     *
     * @FOSRestAnnotations\Get("/{user}")
     *
     * @param User $user
     * @return \FOS\RestBundle\View\View
     */
    public function getAction(User $user)
    {
        return $this->view($user, Response::HTTP_OK);
    }
}