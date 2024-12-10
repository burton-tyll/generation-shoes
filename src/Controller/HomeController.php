<?php

namespace App\Controller;

use App\Repository\PictureRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{

    private $productRepository;
    private $pictureRepository;

    public function __construct(ProductRepository $productRepository, PictureRepository $pictureRepository)
    {
        $this->productRepository = $productRepository;
        $this->pictureRepository = $pictureRepository;
    }

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $user = ['name' => 'Burton', 'role' => 'ROLE_ADMIN'];

        $latestProducts = $this->productRepository->findLatestProducts();

        $pictures = [];
        foreach ($latestProducts as $product) {
          $picture = $this->pictureRepository->findOneBy(['itemId' => $product->getId()]);
          $pictures[$product->getId()] = $picture;
        }

        return $this->render('home/index.html.twig', [
            'user' => $user,
            'latestProducts' => $latestProducts,
            'pictures' => $pictures
        ]);
    }
}
