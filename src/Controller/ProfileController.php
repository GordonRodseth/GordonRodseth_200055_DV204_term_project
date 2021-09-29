<?php
    // src/Controller/HomeController.php
    namespace App\Controller;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;

    use App\Entity\User;
    //controller class HomeController
    class ProfileController extends AbstractController
    {
        /**
         * @Route("/profile/{id}", name="profile_view")
         */
        //method that will respond with HTML
        public function viewProfile($id=null)
        {

            if($id==null){
                return $this -> redirectToRoute('index');

            }

            $userId=(int) $id;

            $user1=new User();
            $user1->setId(1);
            $user1->setName("HoneyBee420");

            $user1->setPosts("Honey tastes Bad. Why?");

            $users=[$user1];

            $model=array();
            $view='profile.html.twig';

            foreach($users as $user){
                if($userId == $user-> getId()){
                    $model['user']=$user;
                }
            }

            return $this -> render ($view, $model);
        }
    }
?>