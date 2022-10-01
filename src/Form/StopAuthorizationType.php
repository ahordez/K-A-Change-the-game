<?php

namespace POSD\Form;

use POSD\Entity\Authorization;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class StopAuthorizationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mifareUid', TextType::class, ['help' => 'The Mifare UID', 'attr' => array('readonly' => true)])
            ->add('startTimestamp', TextType::class, ['help' => 'The start of authorization timestamp', 'attr' => array('hidden' => "hidden")])
            ->add('endTimestamp', DateTimeType::class, ['help' => 'The end of authorization timestamp', 'data' => new \DateTime(date("Y-m-d H:i:s"))])
          // TODO Il faudrait mettre le parking en disabled et rajouter un champ hidden parkingid avec l'ID
            ->add('parking', EntityType::class, ['class' => \POSD\Entity\Parking::class, 'choice_label' => 'name', 'attr' => array ('readonly' => true), 'help' => 'The parking'])
            ->add('stop', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        ]);
    }
}
