<?php
    // src/Controller/HomeController.php
    namespace App\Controller;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    //controller class HomeController
    class HomeController extends AbstractController
    {
        /**
         * @Route("/", name="index")
         */
        //method that will respond with HTML
        public function helloWorld()
        {

            return new Response(
                '<html><body><h1>Welcome to The Hive. Please sign in or make a new account</h1></body></html>'
            );
        }
    }
?>