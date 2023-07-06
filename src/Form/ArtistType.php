<?php

namespace App\Form;

use App\Entity\Artists;
use App\Repository\StyleRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtistType extends AbstractType
{
    private $repo;

    public function __construct(StyleRepository $repo) {
        $this->repo =  $repo;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('artist', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Saisir nouveau groupe ou artiste'
                ]
            ])
            ->add('style', ChoiceType::class, [
                'label' => false,
                'choices' => $this->repo->getChoices(),
                'placeholder' => 'Choisir un style'
            ])
            ->add('filename', FileType::class, [
                'label' => 'Charger une image',
                'mapped' => false,
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Artists::class,
            'translation_domain' => 'forms'
        ]);
    }


}
