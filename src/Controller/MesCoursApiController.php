<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route("/api3")
*/
class MesCoursApiController extends AbstractController
{
    /**
     * @Route("/formation/{id}", name="formation_by_user", methods={"GET"})
     */
    public function getFormation(User $user)
    {
        /**
         * @var User $user
         */
        $user = $this->getDoctrine()->getRepository(User::class)->find($user);
        $formations = $user->getFormations();
        $UserChoisi = array();

        foreach($formations as $forma){
            $userx["id"] = $forma->getId();
           // $userx["titre"] = $forma->getTitre();
            $UserChoisi[] = $userx;
        }
        return new JsonResponse($UserChoisi);
    }

}
