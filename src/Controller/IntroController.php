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

            return $this->redirectToRoute('posts');
        }
    }
?>