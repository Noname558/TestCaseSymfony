<?php
namespace App\Form\Type;

use Doctrine\DBAL\Types\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use function Sodium\add;

class TenantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) : void
    {
        $builder
            ->add('surname', TextType::class)
            ->add('username', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Внести в базу сьемщика'])
            ;
    }
}
