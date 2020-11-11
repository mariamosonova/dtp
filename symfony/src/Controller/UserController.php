<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(): Response
    {
        $value = '';
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $value = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $value = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
            $value = $_SERVER['REMOTE_ADDR'];
        }

        $user = $this->getByName($value);
        if($user instanceof User){
            $response = 'Nice too meet you again, '.$user->getName().' !';
        } else {
            $response = $this->createUser($value);
        }

        return $this->json([
            'greeting' => $response,
        ]);
    }

    /**
     * @param string $name
     * @return Response
     */
    public function createUser(string $name): string
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = new User();
        $user->setName($name);

        $entityManager->persist($user);
        $entityManager->flush();

        return 'Welcome '.$user->getName().'!';
    }

    /**
     * @param string $name
     * @return User|null
     */
    public function getByName(string $name): ?User
    {
        return $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['name'=>$name]);

    }
}
