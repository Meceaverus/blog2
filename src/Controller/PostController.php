<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Comment;
use App\Form\PostType;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PostController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function showAll()
    {
        $repo = $this->getDoctrine()->getRepository(Post::class);
        $posts = $repo->findBy([], ['data'=> 'DESC'], 3);

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
            $this->addFlash('info', 'Добавлено');
            return $this->redirectToRoute('postOne', ['id'=>$id]);
        }
        return $this->render('post/add.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/redact/{id}", name="redact")
     */
    public function redact(Post $post, Request $request, EntityManagerInterface $em)
    {
        $repo = $this->getDoctrine()->getRepository(Post::class);
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($post);
            $em->flush();
            $id = $post->getId();
            $this->addFlash('info', 'Сохранено');
            return $this->redirectToRoute('postOne', ['id'=>$id]);
        }
        return $this->render('post/redact.html.twig',
            ['form' => $form->createView(), 'post' => $post]);
    }

    /**
     * @Route("/addComm/{id}", name="add_comment")
     */
    public function addComment(Post $post, Request $request, EntityManagerInterface $em)
    {
        $comm = new Comment();
        $comm->setPost($post);
        $form = $this->createForm(CommentType::class, $comm);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($comm);
            $em->flush();
            $id = $comm->getId();
            $this->addFlash('comment', 'Добавлено');
            return $this->redirectToRoute('postOne', ['id'=>$post->getId()]);
        }
        return $this->render('post/addComment.html.twig', ['form' => $form->createView()]);
    }


}