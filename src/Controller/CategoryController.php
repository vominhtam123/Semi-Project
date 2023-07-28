<?php

namespace App\Controller;


use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;


class CategoryController extends AbstractController
{
    #[Route('/category', name: 'category_list')]
public function listAction(ManagerRegistry $doctrine): Response
{
// $categoryName = $products->getCategory()->getCatName()->toArray();
$categories = $doctrine->getRepository('App\Entity\Category')->findAll();
return $this->render('category/index.html.twig', [
'categories'=>$categories
]);
}
}
?>