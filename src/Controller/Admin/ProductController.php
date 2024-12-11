<?php

namespace App\Controller\Admin;

use App\Controller\MyAbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends MyAbstractController
{

    #[Route('/admin/produits/tous', name: 'admin_product_all')]
    public function products(): Response
    {
        $products = $this->productRepository->findAll();

        return $this->render('admin/products/all.html.twig', [
            'products' => $products,
        ]);
    }
}
