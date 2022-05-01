<?php

namespace App\Form;

use App\Entity\Course;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'label' => 'Student Name',
                    'required' => true,
                    'attr' => [
                        'minlength' => 3,
                        'maxlength' => 30
                    ]
                ]
            )
            ->add('Gender', ChoiceType::class, [
                'choices'  => [
                    'Male' => 'Male',
                    'Female' => 'Female',
                    'Unknown' => 'Unknown'
                ],
                'label' => 'Student Gender',
                'required' => true,
            ])
            ->add(
                'age',
                TextType::class,
                [
                    'label' => 'Student Age',
                    'required' => true,
                ]
            )
            ->add(
                'phone',
                TextType::class,
                [
                    'label' => 'Phone number',
                    'required' => true,
                    'attr' => [
                        'minlength' => 3,
                        'maxlength' => 30
                    ]
                ]
            )
            ->add('image', TextType::class, [
                'label' => 'Student Image',
                'required' => true,
            ])
            ->add('grade', TextType::class, [
                'label' => 'Student Grade',
                'required' => true,
            ])

            ->add(
                'course',
                EntityType::class,
                [
                    'label' => 'Course Name',
                    'required' => true,
                    'class' => Course::class,
                    'choice_label' => 'name',
                    'multiple' => false, //many to one  nhieu hs co the hc cùng 1 khoa hc   
                    'expanded' => false
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
