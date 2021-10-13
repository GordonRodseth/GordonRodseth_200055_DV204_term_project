<?php
    // src/Controller/ProfileController.php
    namespace App\Controller;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;

    use App\Entity\App\Entity\UserProfile;
    use App\Form\UserProfileType;
    //controller class ProfileController
    class ProfileController extends AbstractController
    {
        /**
         * @Route("/profile/{id}", name="profile")
         */
        //method that will respond with HTML
        public function viewProfile($id=null)
        {

            if($id==null){
                return $this -> redirectToRoute('index');

            }

            $userId=(int) $id;

            $user=$this->getDoctrine()
                ->getRepository(UserProfile::class)
                ->find($userId);

            $model=array('user'=>$user);
            $view='profile.html.twig';

            return $this -> render ($view, $model);
        }
        /**
         * @Route("/signup", name="profile_new")
         */
        //method that will respond with HTML
        public function newProfile(Request $request)
        {
            $userProfile=new UserProfile();
            $form=$this->createForm(UserProfileType::class,$userProfile);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $userProfile = $form->getData();
                
                $entityManager=$this->getDoctrine()->getManager();
                $entityManager->persist($userProfile);
                
                $entityManager->flush();
                $tempid=$userProfile->getId();
                return $this->redirect("/profile/$tempid");

            }

            $view='signup.html.twig';
            $model=array('form'=>$form->createView());

            return $this->render($view,$model);
        }
    }
?>