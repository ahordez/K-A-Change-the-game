<?php

namespace POSD\Form;

use POSD\Entity\Parking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ParkingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['help' => 'The name of the parking'])
            ->add('amountOfSpace', IntegerType::class, ['help' => 'The number of spaces'])
            ->add('hourlyRate', NumberType::class, ['help' => 'The hourly rate in CHF'])
            ->add('maximumDuration', IntegerType::class, ['help' => 'The maximum authorized duration in seconds'])
            ->add('hikApiKey', TextType::class, ['help' => 'The API key of the HIK Reader'])
            ->add('hikEntryLegacyGroupSectorId', TextType::class, ['help' => 'String returned by the HIK Reader in the LegacyGroupSectorId field upon entry'])
            ->add('hikExitLegacyGroupSectorId', TextType::class, ['help' => 'String returned by the HIK Reader in the LegacyGroupSectorId field upon exit'])
            ->add('hikLegacyGroupServiceId', TextType::class, ['help' => 'String returned by the HIK Reader in the LegacyGroupServiceId field'])
            ->add('c3SectorId', IntegerType::class, ['help' => 'C³ Sector ID'])
            ->add('C3ServiceId', IntegerType::class, ['help' => 'C³ Service ID'])
            ->add('C3ApiKey', TextType::class, ['help' => 'C³ API key'])
        ;

        /* Add submit label depending on whether we're creating or updating */
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $parking = $event->getData();
            $form = $event->getForm();
            if (!$parking || null === $parking->getId()) {
                $form->add('save', SubmitType::class, array('label' => 'Create parking'));
                $form->add('savecontinue', SubmitType::class, array('label' => 'Create parking & continue'));
            } else {
                $form->add('save', SubmitType::class, array('label' => 'Update parking'));
            }
            $form->add('reset', ResetType::class, array('label' => 'Reset'));
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Parking::class,
        ]);
    }
}
