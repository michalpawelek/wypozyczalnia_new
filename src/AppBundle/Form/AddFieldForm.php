<?php

namespace AppBundle\Form;

use AppBundle\Entity\Boiska;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddFieldForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('ulica', TextType::class, array(
            'label' => 'Podaj ulice'
        ))->add('numer', TextType::class, array(
            'label' => 'Podaj numer'
        ))->add('miejscowosc', TextType::class, array(
            'label' => 'Podaj miejscowosc'
        ))->add('cenaGodzina', TextType::class, array(
            'label' => 'Cena/h'
        ))->add('typ', TextType::class, array(
            'label' => 'Podaj typ'
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Boiska::class
        ]);
    }
}
