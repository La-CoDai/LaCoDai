<?php 
namespace App\Form;

use App\Entity\Brands;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType as FormAbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Conponent\Form\AbstractType;

class ProductType extends FormAbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('brand', EntityType::class,[
            'class'=>Brands::class,
            'choice_label'=>'bname'
        ])
        ->add('pname',TextType::class, ['attr' => ['placeholder' => 'Enter product name...']])
        ->add('pprice',TextType::class, ['attr' => ['placeholder' => 'Enter price...']])
        ->add('file',FileType::class,[
            'required'=>false,
            'mapped'=>false
        ])
        ->add('pimg',HiddenType::class,[
            'required'=>false
        ])
        ->add('pgender',ChoiceType::class, array(
            'choices'=>array(
                'Male' => '0',
                'Female' => '1'
            ),
            'multiple' => false
        ))
        ->add('pdes',TextType::class, ['attr' => ['placeholder' => 'Enter description...']])
        ->add('add',SubmitType::class, ['label' => 'SAVE']);
    }
}