<?php

namespace App\Form;

use App\Entity\Artists;
use App\Repository\StyleRepository;
use App\Repository\CountryRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtistType extends AbstractType
{
    private $style_repo;
    private $country_repo;

    public function __construct(StyleRepository $style_repo, CountryRepository $country_repo) {
        $this->style_repo =  $style_repo;
        $this->country_repo =  $country_repo;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('artist', TextType::class, [
                'required' => true,
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Saisir groupe ou artiste'
                ]
            ])
            ->add('style', ChoiceType::class, [
                'required' => false,
                'label' => 'Style',
                'choices' => $this->style_repo->getChoices(),
                'placeholder' => 'Choisir un style'
            ])
            ->add('country', ChoiceType::class, [
                'label' => 'Pays',
                'choices' => $this->country_repo->getChoices(),
                'placeholder' => 'Choisir un pays'
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
