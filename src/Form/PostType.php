<?php

namespace App\Form;

use App\Entity\Post;
use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Post::class,
            'data_class' => Comment::class,
        ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')
            ->add('text')
        ;
    }


    public function addForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('comment')
            ->add('name')
            ->add('email')
            ->add('message')
        ;
    }
}