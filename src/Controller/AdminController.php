<?php
    // src/Controller/AdminController.php
    namespace App\Controller;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\Security\Core\User\UserInterface;

    use App\Entity\User;
    //controller class AdminController
    class AdminController extends AbstractController
    {
        /**
         * @Route("/admin", name="admin")
         */
        //method that will respond with HTML
        public function viewUsers()
        {

            $allusers=$this->getDoctrine()
                    ->getRepository(User::class)
                    ->findAll();
                    
            $admins= [];
            $bannedusers=[];
            $unbannedusers=[];

            foreach ($allusers as $user) {
                $roles=$user->getRoles();
                foreach ($roles as $role) {
                    if($role=="ROLE_ADMIN")
                    {
                        array_push($admins,$user);
                        $user=null;
                    }
                    else if($role=="ROLE_BANNED"){
                        array_push($bannedusers,$user);
                        $user=null;
                    }
                    
                }
            }

            foreach($allusers as $user){
                if($user){
                    array_push($unbannedusers, $user);
                }
            }

            $model=array(
                'users' => $unbannedusers,
                'admins' => $admins,
                'banned'=>$bannedusers,
            );
            $view='admin.html.twig';

            return $this -> render ($view, $model);
        }
        /**
         * @Route("/ban", name="ban")
         */
        //method that will respond with HTML
        public function banUser(Request $request){
            //get the POST data - id
            $userId = $_POST['id'];
            $entityManager = $this->getDoctrine()->getManager();

            $user = $entityManager->getRepository(User::class)->find($userId);

            $user->setRoles(["ROLE_BANNED"]);

            
            $entityManager->persist($user);
                
            $entityManager->flush();

            return $this->redirect("/admin");

        }
        /**
         * @Route("/unban", name="unban")
         */
        //method that will respond with HTML
        public function unbanUser(Request $request){
            //get the POST data - id
            $userId = $_POST['id'];
            $entityManager = $this->getDoctrine()->getManager();

            $user = $entityManager->getRepository(User::class)->find($userId);

            $user->setRoles(["ROLE_USER"]);

            
            $entityManager->persist($user);
                
            $entityManager->flush();

            return $this->redirect("/admin");

        }
    }
?>