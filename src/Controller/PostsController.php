<?php
    // src/Controller/HomeController.php
    namespace App\Controller;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\Security\Core\User\UserInterface;

    use App\Entity\Post;
    use App\Entity\Upvotes;
    use App\Entity\Downvote;
    use App\Entity\User;
    //controller class HomeController
    class PostsController extends AbstractController
    {
        /**
         * @Route("/posts", name="posts")
         */
        //method that will respond with HTML
        public function viewPosts()
        {


            $posts=$this->getDoctrine()
                    ->getRepository(Post::class)
                    ->findAll();
                    
            usort($posts, function($a, $b) {
                return $b->getVotes() <=> $a->getVotes();
            });
            $model=array('posts' => $posts);
            $view='home.html.twig';

            return $this -> render ($view, $model);
        }

        /** 
         * @Route("/like", name="like")
         */
        public function upVotes(UserInterface $user, Request $request)
        {
            //if it is a POST
            if($request->isXmlHttpRequest()) { //if we are receiving a HTTP request
                //get the POST data - id
                $postId = $_POST['id'];
                $likes = 0; //default

                $entityManager = $this->getDoctrine()->getManager();
                //get the mood that was liked
                $post = $entityManager->getRepository(Post::class)->find($postId);
                //check if vote count is null with getter
                if($post->getVotes()){
                    $likes = $post->getVotes();
                }
                else{
                    $likes = 0;
                }

                $upvote=new Upvotes();
                $upvote->setUser($user);
                $upvote->setPost($post);

                $poster= $post->getPoster();
                $reputation=$poster->getReputation();
                $poster->setReputation($reputation+1);

                $likes = $post->getVotes();
                //update our entity using the setter
                $post->setVotes($likes + 1);
                $entityManager->persist($post);
                $entityManager->persist($poster);
                $entityManager->persist($upvote);
                $entityManager->flush();

                return $this->redirectToRoute('posts');

            }
        }
        /** 
         * @Route("/dislike", name="dislike")
         */
        public function downVotes(UserInterface $user, Request $request)
        {
            //if it is a POST
            if($request->isXmlHttpRequest()) { //if we are receiving a HTTP request
                //get the POST data - id
                $postId = $_POST['id'];
                $likes = 0; //default

                $entityManager = $this->getDoctrine()->getManager();
                //get the mood that was liked
                $post = $entityManager->getRepository(Post::class)->find($postId);
                //check if vote count is null with getter
                if($post->getVotes()){
                    $likes = $post->getVotes();
                }
                else{
                    $likes = 0;
                }

                $downvote=new Downvote();
                $downvote->setUser($user);
                $downvote->setPost($post);

                $poster= $post->getPoster();
                $reputation=$poster->getReputation();
                $poster->setReputation($reputation-1);

                $likes = $post->getVotes();
                //update our entity using the setter
                $post->setVotes($likes - 1);
                $entityManager->persist($post);
                $entityManager->persist($poster);
                $entityManager->persist($downvote);
                $entityManager->flush();

                return $this->redirectToRoute('profile');

            }
        }
    }

?>