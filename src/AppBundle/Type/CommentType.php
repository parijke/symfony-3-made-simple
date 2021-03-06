<?php

namespace AppBundle\Type;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CommentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('author',
                $options['connected'] ? HiddenType::class : TextType::class,
                [
                    'label'=>false,
                    'attr'=>[
                        'placeholder'=>'Your name'
                    ]
                ]
            )
            ->add('email',
                $options['connected']  ? HiddenType::class : EmailType::class,
                [
                    'label'=>false,
                    'attr'=>[
                        'placeholder'=>'Your email'
                    ]
                ]
            )
            ->add('text',TextareaType::class,
                [
                    'label'=>false,
                    'attr'=>[
                        'placeholder'=>'Your comment'
                    ]
                ]
            )
            ->add('parentId',HiddenType::class)
            ->add('parentClass',HiddenType::class)
            ->add('userId',HiddenType::class);

        $builder->add('Send',SubmitType::class);
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundlke\Entity\Comment',
            'method'     =>  'Post'
        ));
    }

    public function configureOptions( OptionsResolver $resolver ) {
        $resolver->setDefaults( [
            'connected' => null
        ] );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'app_bundle_image';
    }
}