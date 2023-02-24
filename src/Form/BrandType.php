<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class BrandType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('bname',TextType::class,['attr' => ['placeholder' => 'Enter brand name...']])
        ->add('add',SubmitType::class,[
            'label' => "SAVE"
        ]);
    }
}

?>