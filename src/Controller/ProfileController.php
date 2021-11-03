<?php
    // src/Controller/ProfileController.php
    namespace App\Controller;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\Security\Core\User\UserInterface;

    use App\Entity\User;
    use App\Form\UserProfileType;
    //controller class ProfileController
    class ProfileController extends AbstractController
    {
        /**
         * @Route("/profile", name="profile")
         */
        //method that will respond with HTML
        public function fooAction(UserInterface $user)
        {

            $userId = $user->getId(); 
            

            $model=array('user'=>$user);
            $view='profile.html.twig';

            return $this -> render ($view, $model);
        }

        /** 
         * @Route("/update", name="update_profile")
         */
        public function update(UserInterface $user, Request $request) //default id value
        {

             $oldname=$user->getUsername();
             $oldemail=$user->getEmail();
             $password=$user->getPassword();

             $userProfile = new User(); //instance of our User
             $form = $this->createForm(UserProfileType::class, $userProfile); //creating a form using our formBuilder
             $form->handleRequest($request); //let this form we created handle our requests
             
 
             //HANDLE FORM SUBMISSION
             //isValid - checks the asserts in our entity
             if($form->isSubmitted() && $form->isValid()){
 
                 $userProfile = $form->getData(); //getData gets the data from the form

                 $newname=$userProfile->getUsername();
                 $newemail=$userProfile->getEmail();
                 $enteredpassword=$userProfile->getPassword();


                 if($enteredpassword===$password){
                    return new Response(
                        '<html><body><h1>wrong password</h1></body></html>'
                    );
                 }
                 else{
                    if($newname){
                        $user->setUsername($newname);  
                     }
                     else if(!$newname){
                        $user->setUsername($oldname);
                     }
                     if($newemail){
                        $user->setEmail($newemail);  
                     }
                     else if(!$newemail){
                        $user->setEmail($oldemail);
                     }
                     $entityManager = $this->getDoctrine()->getManager();
                     $entityManager->persist($user);
                     $entityManager->flush();
    
                     return $this->redirect("/profile");
    
                    }
                 }



                $view = 'update.html.twig'; //twig
                $model = array(
                    'user'=>$user,
                    'form' => $form->createView(),
                    'title' => "Edit Details"
                ); //create our form views
            

            return $this->render($view, $model);
        }


        /**
         * @Route("/logout", name="app_logout", methods={"GET"})
         */
        public function logout(): void
        {
            // controller can be blank: it will never be called!
            throw new \Exception('Don\'t forget to activate logout in security.yaml');
        }
    }
?>