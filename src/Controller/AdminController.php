<?php
    // src/Controller/AdminController.php
    namespace App\Controller;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;

    use App\Entity\App\Entity\UserProfile;
    //controller class AdminController
    class AdminController extends AbstractController
    {
        /**
         * @Route("/admin", name="admin")
         */
        //method that will respond with HTML
        public function viewUsers()
        {

            $users=$this->getDoctrine()
                    ->getRepository(UserProfile::class)
                    ->findAll();
                    

            $model=array('users' => $users);
            $view='admin.html.twig';

            return $this -> render ($view, $model);
        }
    }
?>