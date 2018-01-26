<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PostController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function showAll()
    {
        $repo = $this->getDoctrine()->getRepository(Post::class);
        $posts = $repo->findAll([], ['data'=> 'DESC'], 3);
        return $this->render('default/index.html.twig', ['posts' => $posts]);
    }
    /**
     * @Route("/post/{id}", name="postOne")
     */
    public function showOne(Post $post)
    {
        return $this->render('post/index.html.twig', ['post' => $post]);
    }
    /**
     * @Route("/add", name="add_post")
     */
    public function addPost(Request $request, EntityManagerInterface $em)
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($post);
            $em->flush();
            $id = $post->getId();
            $this->addFlash('info', 'Пост добавлен!');
            return $this->redirectToRoute('postOne', ['id'=>$id]);
        }
        return $this->render('post/add.html.twig', ['form' => $form->createView()]);
    }
    /**
     * @Route("/redact/{id}", name="redact")
     */
    public function redact(Post $post, Request $request)
    {
        $redact = new Post();
        $form = $this->createForm(PostType::class, $redact);
        $form->handleRequest($request);
        return $this->render('post/redact.html.twig', ['form' => $form->createView()]);
    }
}