<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ThemeSettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('skincolor', ChoiceType::class, [
                'choices' => $this->getPossibleSkinColors(),
                'label' => 'Website Farbschema',
            ])
            ->add('smallsidebar')
            ->add('sidebarexpand', CheckboxType::class, ['required' => false])
            ->add('layout', ChoiceType::class, [
                'choices' => $this->getLayouts(),
                'label' => 'Website Farbschema',
            ])
            ->add('smalltext')
            ->add('shadow', ChoiceType::class, [
                'choices' => $this->getPossibleShadows(),
                'label' => 'Website Schatten für Boxen',
            ])
            ->add('save', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

    private function getPossibleSkinColors()
    {
        return array(
            'Dunkel' => 'dark',
            'Hell' => 'light',
        );
    }

    private function getLayouts()
    {
        return array(
            'Top Nav' => 'top-nav',
            'Boxed' => 'boxed',
            'Fixed' => 'fixed',
        );
    }

    private function getPossibleShadows()
    {
        return array(
            'keiner' => 'shadow-none',
            'klein' => 'shadow-sm',
            'mittel' => 'shadow',
            'gross' => 'shadow-lg',
        );
    }
}
