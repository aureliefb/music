<?php

namespace App\Form;

use App\Entity\Artists;
use App\Repository\MusicStylesRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtistType extends AbstractType
{
    private $repo;

    public function __construct(MusicStylesRepository $repo) {
        $this->repo =  $repo;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('artist', null, ['label' => 'Saisir un artiste'])
            ->add('id_music_styles', ChoiceType::class, [
                'label' => 'Choisir un style',
                'choices' => $this->repo->getChoices()
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Charger une image',
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
