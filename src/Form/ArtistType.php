<?php

namespace App\Form;

use App\Entity\Artists;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('artist')
            ->add('id_music_styles', null, ['label' => 'Style'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Artists::class,
            'translation_domain' => 'forms'
        ]);
    }
}
