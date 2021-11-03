<?php
    // src/Controller/HomeController.php
    namespace App\Controller;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\Security\Core\User\UserInterface;

    use App\Entity\Post;
    use App\Entity\UserProfile;
    use App\Entity\Comment;
    use App\Form\CommentType;
    //controller class HomeController
    class CommentController extends AbstractController
    {

        /**
         * @Route("/makecomment/{id}", name="makecomment")
         */
        //method that will respond with HTML
        public function newComments(UserInterface $user, Request $request,$id)
        {
            $postId=(int) $id;
            $post=$this->getDoctrine()
                    ->getRepository(Post::class)
                    ->find($postId);

            $Comment=new Comment();
            $form=$this->createForm(CommentType::class,$Comment);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $Comment = $form->getData();
                $Comment->setPoster($user);

                $Comment->setParentPost(            
                    $Post=$this->getDoctrine()
                    ->getRepository(Post::class)
                    ->find($id));
                
                

                $entityManager=$this->getDoctrine()->getManager();
                $entityManager->persist($Comment);
                
                $entityManager->flush();
                $tempid=$Comment->getId();
                return $this->redirect("/post/$postId");

            }

            $view='comment.html.twig';
            $model=array('form'=>$form->createView(),'post' => $post,'parentcomment'=>null,'user'=>$user);

            return $this->render($view,$model);
        }

        /**
         * @Route("/makechildcomment/{id}", name="makechildcomment")
         */
        //method that will respond with HTML
        public function newchildComments(UserInterface $user, Request $request,$id)
        {
            $parentId=(int) $id;
            $Parentcomment=$this->getDoctrine()
                    ->getRepository(Comment::class)
                    ->find($parentId);

            $Parentpost=$Parentcomment->getParentpost();
            $postId=$Parentpost->getId();
            $Comment=new Comment();
            $form=$this->createForm(CommentType::class,$Comment);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $Comment = $form->getData();
                $Comment->setPoster($user);

                $Comment->setParentPost($Parentpost);
                $Comment->setParentComment($Parentcomment);
                
                

                $entityManager=$this->getDoctrine()->getManager();
                $entityManager->persist($Comment);
                
                $entityManager->flush();
                $tempid=$Comment->getId();
                return $this->redirect("/post/$postId");

            }

            $view='comment.html.twig';
            $model=array('form'=>$form->createView(),'post' => $Parentpost, 'parentcomment'=>$Parentcomment,'user'=>$user);

            return $this->render($view,$model);
        }

        /**
         * @Route("/star", name="star")
         */
        //method that will respond with HTML
        public function star(UserInterface $user, Request $request)
        {
            $entityManager = $this->getDoctrine()->getManager();

            $commentId = $_POST['id'];
            $comment = $entityManager->getRepository(Comment::class)->find($commentId);

            $comment->setStatus(1);

            $entityManager->persist($comment);
            $entityManager->flush();

            return;
        }
        /**
         * @Route("/unstar", name="unstar")
         */
        //method that will respond with HTML
        public function unstar(UserInterface $user, Request $request)
        {
            $entityManager = $this->getDoctrine()->getManager();

            $commentId = $_POST['id'];
            $comment = $entityManager->getRepository(Comment::class)->find($commentId);

            $comment->setStatus(0);

            $entityManager->persist($comment);
            $entityManager->flush();

            return;
        }
    }
?>