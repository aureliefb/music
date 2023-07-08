<?php

namespace App\Form;

use App\Entity\Country;
use App\Repository\CountryRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CountryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('country', null, ['label' => 'Saisir un pays'])
            ->add('shortname', null, ['label' => 'Saisir les initiales'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Country::class,
        ]);
    }
}
