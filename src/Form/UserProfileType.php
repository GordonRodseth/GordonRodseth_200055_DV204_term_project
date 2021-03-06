<?php
    namespace App\Form;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\EmailType;
    use Symfony\Component\Form\Extension\Core\Type\PasswordType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

    class UserProfileType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
            ->add('username',TextType::class, ['required' => false,])
            ->add('email',EmailType::class, ['required' => false,])
            ->add('password',PasswordType::class)
            ->add('submit',SubmitType::class, ['label'=>'Enter!']);
            ;

        }
    }
?>
