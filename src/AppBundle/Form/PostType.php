<?php

namespace AppBundle\Form;

use AppBundle\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => array('autofocus' => true),
                'label' => 'Заголовок',
            ])
            ->add('body', TextareaType::class)
            ->add('author', EntityType::class,[
                'class' => 'AppBundle\Entity\Author',
                'choice_label' => 'name',
            ])
            ->add('category', EntityType::class,[
                'class' => Category::class ,
                'choice_label' => 'name',
            ])

            ->add('tags', EntityType::class,[
                'class' => 'AppBundle\Entity\Tag',
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Post',
            'required' => false,
        ]);
    }
}
