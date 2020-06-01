<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'current_menu'=> 'user',
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'current_menu'=> 'user',

            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}", name="user_edit", methods={"PUT"})
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        // 1- if password actuel === password fil base --> Ok
        // ---> save new user
            // Si non throw error 'Password not match'

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', [
            'current_menu'=> 'user',

            'user' => $user,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/front/{id}", name="user_front_edit", methods={"PUT"})
     */
    public function editFront(Request $request, User $user)
    {

        // 1- if password actuel === password fil base --> Ok
        // ---> save new user
        // Si non throw error 'Password not match'


        if ($request->request->get('nameU') === ''){
            throw new \Exception("Empty name");
        }

        if ($request->request->get('password') !== $user->getPassword()){
            throw new \Exception("Password not match");
        }

        $user->setNameU($request->request->get('nameU'));
        $user->setEmail($request->request->get('email'));
        $user->setRegion($request->request->get('region'));
        $user->setPays($request->request->get('pays'));
        $user->setPassword($request->request->get('newPassword'));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse(['status'=>$user, 'message'=> 'Utilisateur modifié'],200);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}
