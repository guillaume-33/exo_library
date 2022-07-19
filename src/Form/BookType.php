<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Sodium\add;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('nbPages')
            ->add('publishedAt', DateType::class,[
                        'widget'=>'single_text'
            ])
            ->add('author',EntityType::class,[
                "class" =>Author::class, // pris depuis l'entité, ne pas taper trop vite au clavier !!!
                'choice_label'=>'firstName',
        ])
            ->add('image',FileType::class,[
                'mapped'=> false,
            ])
        ->add('Confirmer',SubmitType::class);



    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
