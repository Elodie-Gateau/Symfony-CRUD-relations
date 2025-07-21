<?php

namespace App\Form;

use App\Entity\Participant;
use App\Entity\Workshop;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class ParticipantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Nom du participant : ",
                'label_attr' => ['class' => 'mb-3'],
                'attr' => [
                    'class' => 'form-control mb-5',
                    'placeholder' => 'Nom'
                ]
            ])
            ->add('email', TextType::class, [
                'label' => "Email du participant : ",
                'label_attr' => ['class' => 'mb-3'],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Email'
                ]
            ])
            ->add('workshops', EntityType::class, [
                'class' => Workshop::class,
                'choice_label' => 'title',
                'query_builder' => function (EntityRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('w')
                        ->join('w.event', 'e')
                        ->addSelect('e')
                        ->orderBy('e.name', 'ASC')
                        ->addOrderBy('w.title', 'ASC');
                },
                'group_by' => function (Workshop $workshop) {
                    return $workshop->getEvent()->getName();
                },
                'multiple' => true,
                'expanded' => false,
                'required' => false,
                'label' => 'Ateliers sélectionnés : ',
                'label_attr' => ['class' => 'mb-3'],
                'attr' => ['class' => 'form-control mb-5 select2', 'multiple' => 'multiple', 'data-placeholder' => 'Choisissez un ou plusieurs ateliers'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
            'required' => false
        ]);
    }
}
