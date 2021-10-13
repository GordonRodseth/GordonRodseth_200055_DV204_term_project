<?php
    // src/Controller/HomeController.php
    namespace App\Controller;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;

    use App\Entity\App\Entity\Post;
    use App\Entity\App\Entity\UserProfile;
    use App\Entity\App\Entity\Comment;
    use App\Form\CommentType;
    //controller class HomeController
    class CommentController extends AbstractController
    {

        /**
         * @Route("/makecomment", name="makecomment")
         */
        //method that will respond with HTML
        public function newComments(Request $request)
        {
            $Comment=new Comment();
            $form=$this->createForm(CommentType::class,$Comment);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $Comment = $form->getData();
                $Comment->setPoster(            
                    $UserProfile=$this->getDoctrine()
                    ->getRepository(UserProfile::class)
                    ->find('1'));

                $Comment->setParentPost(            
                    $UserProfile=$this->getDoctrine()
                    ->getRepository(Post::class)
                    ->find('1'));
                
                $entityManager=$this->getDoctrine()->getManager();
                $entityManager->persist($Comment);
                
                $entityManager->flush();
                $tempid=$Comment->getId();
                return $this->redirectToRoute("posts");

            }

            $view='signup.html.twig';
            $model=array('form'=>$form->createView());

            return $this->render($view,$model);
        }
    }
?>