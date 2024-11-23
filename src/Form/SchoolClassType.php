<?php

namespace App\Form;

use App\Entity\SchoolClass;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SchoolClassType extends AbstractType implements CRUDTypeInterface {
    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('name')//            ->add('students')
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
                                   'data_class' => SchoolClass::class,
                               ]);
    }
}
