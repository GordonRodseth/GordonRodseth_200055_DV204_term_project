<?php

    namespace App\Form;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\FileType;
    use Symfony\Component\Form\Extension\Core\Type\EmailType;
    use Symfony\Component\Form\Extension\Core\Type\PasswordType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

    //Controller that builds our Register Form
    class AvatarType extends AbstractType 
    {
        //function that executes the build
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->add('pic', FileType::class, ['mapped'=>false, 'required'=>false])
               
                ->add('submit', SubmitType::class, ['label' => "Set Avatar"]);
        }
    }

?>