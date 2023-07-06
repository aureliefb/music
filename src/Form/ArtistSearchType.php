<?php

namespace App\Form;

use App\Entity\ArtistSearch;
use App\Repository\MusicStylesRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class ArtistSearchType extends AbstractType
{

    public function __construct(MusicStylesRepository $repo) {
        $this->repo =  $repo;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('artistName', TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Nom artiste ou groupe'
                ]
            ])
            ->add('musicStyle', ChoiceType::class, [
                'required' => false,
                'label' => false,
                'choices' => $this->repo->getChoices(),
                'placeholder' => 'Choisir un style'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ArtistSearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix() {
        return '';
    }
}
