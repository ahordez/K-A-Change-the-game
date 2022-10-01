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
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class AuthorizationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', TextType::class, ['help' => 'The ID of the authorization', 'disabled' => true])
            ->add('c3RecordId', IntegerType::class, ['help' => 'The ID of the associated C³ authorization', 'disabled' => true])
            ->add('mifareUid', TextType::class, ['help' => 'The Mifare UID', 'disabled' => true])
            ->add('startTimestamp', DateTimeType::class, ['help' => 'The start of authorization timestamp', 'disabled' => true])
            ->add('endTimestamp', DateTimeType::class, ['help' => 'The end of authorization timestamp', 'disabled' => true])
            ->add('amount', MoneyType::class, ['help' => 'The calculated parking amount in CHF', 'currency' => 'CHF', 'disabled' => true])
            ->add('parking', EntityType::class, ['class' => \POSD\Entity\Parking::class, 'choice_label' => 'name', 'disabled' => true, 'help' => 'The parking'])
            ->add('save', SubmitType::class)
        ;

        /* Add submit label depending on whether we're creating or updating */
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $authorization = $event->getData();
            $form = $event->getForm();
            if (!$authorization || null === $authorization->getId()) {
                $form->add('save', SubmitType::class, array('label' => 'Create authorization'));
                $form->add('savecontinue', SubmitType::class, array('label' => 'Create authorization & continue'));
            } else {
                $form->add('save', SubmitType::class, array('label' => 'Update authorization'));
            }
            $form->add('reset', ResetType::class, array('label' => 'Reset'));
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Authorization::class,
        ]);
    }
}
