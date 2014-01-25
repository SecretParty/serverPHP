<?php

namespace SecretParty\Bundle\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class JoinUserType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('secret','entity', array(
                'class' => 'SecretPartyCoreBundle:Secrets',
                'property' => 'id'
            ))
            ->add('party','entity', array(
                'class' => 'SecretPartyCoreBundle:Party',
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
            'data_class' => 'SecretParty\Bundle\CoreBundle\Entity\User',
            'csrf_protection'   => false,
            'cascade_validation' => true
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'user';
    }
}
