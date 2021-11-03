<?php 

    namespace App\Controller;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\String\Slugger\SluggerInterface;
    use Symfony\Component\Security\Core\User\UserInterface;
    //using the form builder
    use App\Form\AvatarType;

    //userprofile entity 
    use App\Entity\User;
    use App\Entity\Avatar;

    //class controller for homeController
    class AvatarController extends AbstractController 
    {
        /** 
         * @Route("/avatar", name="profile_pic")
         */
        public function newAvatar(UserInterface $user, Request $request)
        {
            $entityManager = $this->getDoctrine()->getManager();
            $currentAvatar=$user->getProfPic();
            
            if($currentAvatar){
                
                $user->setProfPic(null);
                $entityManager->remove($currentAvatar);

                $entityManager->flush();
            }
            

            $newAvatar = new Avatar(); //instance of our Profile Pic
            $form = $this->createForm(AvatarType::class, $newAvatar); //creating a form using our formBuilder
            $form->handleRequest($request); //let this form we created handle our requests

            //HANDLE FORM SUBMISSION
            //isValid - checks the asserts in our entity
            if($form->isSubmitted() && $form->isValid()){
                
                $newAvatar = $form->getData(); //getData gets the data from the form
                
                $picfile=$form->get('pic')->getData();

                
                
                if ($picfile) {
                    $originalFilename = pathinfo($picfile->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                   // $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $originalFilename.'-'.uniqid().'.'.$picfile->guessExtension();
    
                    // Move the file to the directory where brochures are stored
                    try {
                        $picfile->move(
                            $this->getParameter('pics_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }
    
                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents
                    $newAvatar->setPicture($newFilename);
                }

                $user->setProfPic($newAvatar);

                

                
                $entityManager->persist($newAvatar);
                $entityManager->flush();
                return $this->redirect("/profile");

            }

            

            //ELSE SHOW FORM
            $view = 'avatar.html.twig'; //twig
            $model = array(
                'form' => $form->createView(),
                'title' => "Register Here"
            ); //create our form views

            return $this->render($view, $model);
        }

    }

?>