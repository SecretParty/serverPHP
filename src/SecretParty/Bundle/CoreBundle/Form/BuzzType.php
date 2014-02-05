<?php

namespace SecretParty\Bundle\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BuzzType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('buzzer','entity',array(
                'class' => 'SecretPartyCoreBundle:User',
                'property' => 'id'
            ))
            ->add('buzzee','entity',array(
                'class' => 'SecretPartyCoreBundle:User',
                'property' => 'id'
            ))
            ->add('secret','entity',array(
                'class' => 'SecretPartyCoreBundle:Secrets',
                'property' => 'id'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection'   => false));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'buzz';
    }
}
