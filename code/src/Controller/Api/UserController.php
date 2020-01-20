<?php

namespace App\Controller\Api;

use App\Entity\User;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as FOSRestAnnotations;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Response;

/**
 * User controller.
 *
 * @FOSRestAnnotations\Route("/api/{version}")
 * @FOSRestAnnotations\Version({"1", "2"})
 */
class UserController extends AbstractFOSRestController
{
    /**
     * REST action which returns user by id.
     *
     * @FOSRestAnnotations\Get("/user/{user}")
     *
     * @SWG\Response(
     *     response=200,
     *     description="REST action which returns user by id",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=User::class))
     *     )
     * )
     *
     * @return \FOS\RestBundle\View\View
     */
    public function getAction(User $user)
    {
        return $this->view($user, Response::HTTP_OK);
    }
}
