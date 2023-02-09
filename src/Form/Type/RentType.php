<?php
namespace App\Form\Type;

use App\Entity\PeopleRent;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class RentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('address', TextType::class)
            ->add('floor', NumberType::class)
            ->add('number', NumberType::class)
            ->add('square', NumberType::class)
            ->add('price', NumberType::class)
            ->add('save', SubmitType::class, ['label' => 'Внести в базу квартиру'])
            ;
    }
}
