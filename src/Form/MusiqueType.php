<?php

namespace App\Form;

use App\Entity\Musique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Vich\UploaderBundle\Form\Type\VichFileType;

class MusiqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('album')
            ->add('songFile', VichFileType::class, [
                'label' => 'Song file',
                'required' => false,
                'allow_delete' => true,
                'download_uri' => false,
                'asset_helper' => true,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'audio/*',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid song file',
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Musique::class,
        ]);
    }
}
