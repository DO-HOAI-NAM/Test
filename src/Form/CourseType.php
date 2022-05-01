<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CourseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'label' => 'Course Name',
                    'required' => true,
                    'attr' => [
                        'minlength' => 3,
                        'maxlength' => 30
                    ]
                ]
            )
            ->add(
                'price',
                TextType::class,
                [
                    'label' => 'Price',
                    'required' => true,
                ]
            )
            ->add(
                'image',
                TextType::class,
                [
                    'label' => 'Course Image',
                    'required' => true,
                ]
            )
            ->add('Save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
