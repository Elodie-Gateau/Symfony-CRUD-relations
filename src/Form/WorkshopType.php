<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Participant;
use App\Entity\Workshop;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class WorkshopType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => "Nom de l'atelier : ",
                'label_attr' => ['class' => 'mb-3'],
                'attr' => [
                    'class' => 'form-control mb-5',
                    'placeholder' => 'Intitulé'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => "Description : ",
                'label_attr' => ['class' => 'mb-3'],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Description'
                ]
            ])
            ->add('participants', EntityType::class, [
                'class' => Participant::class,
                'choice_label' => 'name',
                'query_builder' => function (EntityRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.name', 'ASC');
                },
                'multiple' => true,
                'expanded' => false,
                'required' => false,
                'label' => 'Participants inscrits : ',
                'label_attr' => ['class' => 'mb-3'],
                'attr' => [
                    'class' => 'form-control mb-5 select2',
                    'multiple' => 'multiple',
                    'data-placeholder' => 'Choisissez un ou plusieurs participants'
                ]
            ])
            ->add('event', EntityType::class, [
                'class' => Event::class,
                'choice_label' => 'name',
                'label' => 'Événement concerné : ',
                'label_attr' => ['class' => 'mb-3'],
                'attr' => [
                    'class' => 'form-control mb-5 select2',
                    'data-placeholder' => 'Choisissez un événement'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Workshop::class,
            'required' => false
        ]);
    }
}
