<?php

namespace App\Form;

use App\Entity\Hunter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SafariModeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('hunter-1', TextType::class, ['label' => 'First hunter', 'mapped' => false])
            ->add('hunter-2', TextType::class, ['label' => 'Second hunter', 'mapped' => false])
            ->add('hunter-3', TextType::class, ['label' => 'Third hunter', 'mapped' => false])
            ->add('hunter-4', TextType::class, ['label' => 'Fourth hunter', 'mapped' => false])
            ->add('submit', SubmitType::class, ['label' => 'Generate the game'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Hunter::class,
        ]);
    }
}
