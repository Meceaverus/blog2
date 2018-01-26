<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PostController extends Controller
{
    /**
    * @Route("/", name="homepage")
    */
    public function showAll(Post $post){
        return $this->render('default/index.html.twig', ['post' => $post]);
    }

    /**
     * @Route("/post/{id}", name="postOne")
     * @param $id
     * @param $post
     */
    public function showOne(Post $post, $id = '')
    {
        return $this->render('post/show.html.twig', ['post' => $post]);
    }

    /**
     * @Route("/redact", name="redact")
     * @param Request $request
     */
    public function redact(Request $request)
    {
        $redact = new Post();
        $form = $this->createForm(PostType::class, $redact);
        $form->handleRequest($request);
        return $this->render('post/redact.html.twig', ['form' => $form->createView()]);
    }

}