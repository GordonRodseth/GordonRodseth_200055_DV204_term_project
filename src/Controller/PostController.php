<?php
    // src/Controller/HomeController.php
    namespace App\Controller;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\Security\Core\User\UserInterface;

    use App\Entity\Post;
    use App\Entity\User;
    use App\Form\PostType;
    //controller class HomeController
    class PostController extends AbstractController
    {
        /**
         * @Route("/post/{id}", name="post")
         */
        //method that will respond with HTML
        public function viewPosts($id=null, UserInterface $user)
        {

            $postId=(int) $id;
            $post=$this->getDoctrine()
                    ->getRepository(Post::class)
                    ->find($postId);
                    

            $model=array('post' => $post, 'user'=>$user);
            $view='post.html.twig';

            return $this -> render ($view, $model);
        }

        /**
         * @Route("/newpost", name="newpost")
         */
        //method that will respond with HTML
        public function newPost(UserInterface $user, Request $request)
        {
            $Post=new Post();
            $form=$this->createForm(PostType::class,$Post);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $Post = $form->getData();
                $Post->setPoster($user);
                $Post->setVotes(0);
                $entityManager=$this->getDoctrine()->getManager();
                $entityManager->persist($Post);
                
                $entityManager->flush();
                $tempid=$Post->getId();
                return $this->redirect("/post/$tempid");

            }

            $view='makepost.html.twig';
            $model=array('form'=>$form->createView());

            return $this->render($view,$model);
        }

        /** 
         * @Route("/delete", name="delete")
         */
        public function delete(Request $request)
        {
            //if it is a POST
            if($request->isXmlHttpRequest()) { //if we are receiving a HTTP request
                //get the POST data - id
                $postId = $_POST['id'];

                $entityManager = $this->getDoctrine()->getManager();
                //get the mood that was liked
                $post = $entityManager->getRepository(Post::class)->find($postId);
                //check if vote count is null with getter
                

                //$post->removeDownvote($post->getDownvotes());
                //$post->removeUpvote($post->getUpvotes());
                //$post->removeComment($post->getComments());
                $entityManager->remove($post);

                //$entityManager->persist($post);

                $entityManager->flush();

                return $this->redirectToRoute('profile');

            }
        }
    }
?>