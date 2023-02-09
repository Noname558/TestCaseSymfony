<?php
namespace App\Form\Type;

use App\Entity\Message;
use App\Entity\PeopleRent;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ArendaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('people', EntityType::class,[
                'class'=> PeopleRent::class,
                'choice_label' => 'username',
            ])
            ->add('start', DateType::class)
            ->add('finish', DateType::class)
            ->add('save', SubmitType::class, ['label' => 'Поиск свободных квартир'])
        ;
    }
}
