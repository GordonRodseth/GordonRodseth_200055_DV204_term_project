<?php
    // src/Controller/HomeController.php
    namespace App\Controller;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;

    use App\Entity\App\Entity\Post;
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
                    

            $model=array('posts' => $posts);
            $view='home.html.twig';

            return $this -> render ($view, $model);
        }
    }
?>