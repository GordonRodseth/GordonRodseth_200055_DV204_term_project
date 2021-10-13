<?php
    // src/Controller/IntroController.php
    namespace App\Controller;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    //controller class IntroController
    class IntroController extends AbstractController
    {
        /**
         * @Route("/", name="index")
         */
        //method that will respond with HTML
        public function helloWorld()
        {

            return new Response(
                '<html><body><h1>Please <a href="/posts">Log In</a> or <a href="/signup">Sign Up</a></h1></body></html>'
            );
        }
    }
?>