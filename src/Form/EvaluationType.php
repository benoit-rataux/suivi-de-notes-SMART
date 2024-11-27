<?php

namespace App\Form;

use App\Entity\Evaluation;
use App\Entity\Skill;
use App\Entity\Student;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvaluationType extends AbstractType implements CRUDTypeInterface {

    public function buildForm(FormBuilderInterface $builder,
                              array                $options,
    ): void {
        $builder
            ->add('date', null, [
                'widget' => 'single_text',
            ],
            )
            ->add('student', EntityType::class, [
                'class'        => Student::class,
                'choice_label' => function(Student $student,
                ): string {
                    return $student->getFirstname() . ' ' . $student->getSurname();
                },
            ],
            )
            ->add('skill', EntityType::class, [
                'class'        => Skill::class,
                'choice_label' => 'name',
            ],
            )
            ->add('grade', ChoiceType::class, [
                'multiple' => false,
                'choices'  => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                ],
            ],
            );
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
                                   'data_class' => Evaluation::class,
                               ],
        );
    }

}
