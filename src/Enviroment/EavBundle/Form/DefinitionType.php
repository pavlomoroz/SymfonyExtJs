<?php

namespace Enviroment\EavBundle\Form;

use Enviroment\EavBundle\Entity\Definition;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DefinitionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', array(
        ));
//        $builder->add('description', 'textarea', array(
//            'required' => false
//        ));
        $builder->add('type', 'choice', array(
            'choices' => array(
                'text'      => 'Text',
                'textarea'  => 'Textarea',
                'choice'    => 'Select',
                'checkbox'  => 'Checkbox',
                'radio'     => 'Radio'
            )
        ));
//        $builder->add('unit', 'text', array(
//            'required' => false
//        ));
        $builder->add('required', 'checkbox', array(
            'required' => false
        ));

        $builder->add('options', 'collection', array(
            'type' => new OptionType(),
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Enviroment\EavBundle\Entity\Definition',
        ));
    }

    public function getName()
    {
        return 'definition';
    }
}
