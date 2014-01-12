<?php

namespace SecretParty\Bundle\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ThematicType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('secrets', 'collection', array(
                'type' => new SecretsType(),
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'attr'=>array(
                    'class'=>'secret'
                ))
            )
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SecretParty\Bundle\CoreBundle\Entity\Thematic',
            'cascade_validation' => true
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'secretparty_bundle_corebundle_thematic';
    }
}
