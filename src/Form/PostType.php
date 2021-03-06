<?php
    namespace App\Form;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

    class PostType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
            ->add('title',TextType::class,['label' => 'Post Title'])
            ->add('content',TextType::class,['label' => 'Details'])
            ->add('submit',SubmitType::class, ['label'=>'Post']);
            ;

        }
    }
?>