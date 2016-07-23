<?php

namespace SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SiteBundle\Repository\GoodRepository;
use SiteBundle\Entity\Book;
use SiteBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Knp\Component\Pager\Paginator;
use Knp\Bundle\PaginatorBundle\Pagination;

class SiteController extends Controller
{

    /**
     *
     * @Route("/library",  name="library")
     * @Route("/library/{category}", name="category")
     * @Route("/library/{category}/{page}", name="category_page", requirements={"page" = "[0-9]*"})
     */
    public function indexAction($category = false, $page = 1)
    {

        $categories = $this->getDoctrine()->getRepository('SiteBundle:Category')->getCategoriesIndexById();
        $books = $this->getDoctrine()->getRepository('SiteBundle:Book')->getBooksByCategory($category);

        /** @var $paginator Paginator*/
        $paginator = $this->get('knp_paginator');
        /** @var $pagination Pagination*/
        $pagination = $paginator->paginate($books, $page, 2);
        $pagination->setUsedRoute('category_page');
        $books = $pagination->getItems();


        $currentCategory = false;

        if (count($categories) && $category)
            /** @var $cat Category*/
            foreach ($categories as $cat) {
                if ($cat->getId() == $category) {
                    $currentCategory = $cat;
//                    $books = $currentCategory->getBooks();
                }
            }

        if($this->get('request')->isXmlHttpRequest()) {
            return $this->render('SiteBundle:Site:books.html.twig',
                array(
                    'currentCategory' => $currentCategory,
                    'books' => $books,
                    'pagination' => $pagination
                )
            );
        } else {
            return $this->render('SiteBundle:Site:index.html.twig',
                array(
                    'categories' => $categories,
                    'currentCategory' => $currentCategory,
                    'books' => $books,
                    'pagination' => $pagination
                )
            );
        }
    }
}
