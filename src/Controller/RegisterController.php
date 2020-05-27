<?php

namespace App\Controller;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\HttpFoundation\JsonResponse;


class RegisterController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function register( Request $request, UserPasswordEncoderInterface $passEncoder){
        $form = $this->createFormBuilder()

            ->add('email')
            ->add('nameU')

            ->add('password', RepeatedType::class,[
            'type' => PasswordType::class,
            'required' => true,
            'first_options' => ['label' => 'Password'],
            'second_options' => ['label' => 'Confirm Password']

        ])

        ->add('pays')
        ->add('region')

        ->add('register', SubmitType::class,[
            'attr' =>[
                'class' =>'btn btn-success float-right'
            ]
        ])
        ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted()){
           
            $data = $form->getData();
            $user = new User();
            $user->setEmail( $data['email']);
            $user->setNameU( $data['nameU']);


            $user->setPassword(
                $passEncoder->encodePassword($user, $data['password'])
            );
            $user->setPays($data['pays']);
            $user->setRegion($data['region']);

           $em = $this->getDoctrine() -> getManager();
           $em->persist($user);
           $em->flush();
           return $this->redirect($this->generateUrl('app_login'));
                
        }
        
    
        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/api/login", name="api_login", methods="POST")
     */
    public function Login( Request $request, UserPasswordEncoderInterface $passEncoder){

            // 1 lire les parametres reçu
            $email = $request->request->get('email');
            $password = $request->request->get('password');


            // 2 rechercher l'utilisateur dans la table user

            $em = $this->getDoctrine() -> getManager();

            $user = $em->getRepository(User::class)->findOneBy(array('email'=>$email));
            if($user!=null){
                // tester si le mdp est correcte
               /* $encoded = $passEncoder->encodePassword($user, $password);
                dump($encoded);
                dump($user->getPassword());die();*/
                if(true){
                    return new JsonResponse(['status'=>"success","user"=>["email"=>$user->getEmail()]],200);
                }

                return new JsonResponse(['status'=>"failure"],401);
            }else{
                // retourner erreur
                return new JsonResponse(['status'=>$email],404);
            }


    }

    /**
     * @Route("/api/userinfo/{id}", name="api_userinfo", methods="GET")
     */
    public function userinfo(User $user){
        return $this->json(['info'=>$user]);
    }
}