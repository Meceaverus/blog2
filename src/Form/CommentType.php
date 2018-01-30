<?php
/**
 * Created by PhpStorm.
 * User: Olf
 * Date: 30.01.2018
 * Time: 11:19
 */

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Comment::class,
        ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dataComment')
            ->add('name')
            ->add('text')
        ;
    }
}