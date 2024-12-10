<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class MyAbstractController extends AbstractController
{
    public $userRepository;
    public $formFactory;
    public $passwordHasher;
    public $entityManager;


    public function __construct(
        UserRepository $userRepository,
        FormFactoryInterface $formFactory,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager
    )
    {
        $this->userRepository = $userRepository;
        $this->formFactory = $formFactory;
        $this->passwordHasher = $passwordHasher;
        $this->entityManager = $entityManager;
    }
}