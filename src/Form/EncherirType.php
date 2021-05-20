<?php

namespace App\Form;

use App\Entity\Encherir;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EncherirType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('prixPropose', IntegerType::class, array(
            'attr' => array('min' =>$options['bestEnchere'])))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Encherir::class,
            'bestEnchere' => 0,
        ]);
    }
}
