<?php

namespace App\Controller;

use App\Form\UserType;
use App\Entity\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends Controller
{
     /**
     * @Route("/register/{etat}")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder,$etat) {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        
        if ($etat=='assistant'){
           
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
      
        if ($form->isSubmitted() && $form->isValid()) {
            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            //on active par défaut
            $user->setIsActive(true);
           
            $user->addRole("ROLE_ASSISTANT");
            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $this->addFlash('success', 'Votre compte à bien été enregistré.');
            //return $this->redirectToRoute('login');
           return $this->redirectToRoute('professeur');
        }
        }
            
        else if ($etat=='directeur'){
     
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            //on active par défaut
            $user->setIsActive(true);
           
            $user->addRole("ROLE_DIRECTEUR");
            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $this->addFlash('success', 'Votre compte à bien été enregistré.');
            //return $this->redirectToRoute('login');
           return $this->redirectToRoute('login');
        }
        }
        
        else if ($etat=='mediateur'){
     
            // 2) handle the submit (will only happen on POST)
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                // 3) Encode the password (you could also do this via Doctrine listener)
                $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
                $user->setPassword($password);
                //on active par défaut
                $user->setIsActive(true);
               
                $user->addRole("ROLE_MEDIATEUR");
                // 4) save the User!
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
                $patient->setNomcomplet($user->getNomcomplet());
            $patient->setEmail($user->getEmail());
            $patient->setTel($user->getTel());
            $patient->setAdresse($user->getAdresse());
            $entityManager->persist($patient);
            $entityManager->flush();
                // ... do any other work - like sending them an email, etc
                // maybe set a "flash" success message for the user
                $this->addFlash('success', 'Votre compte à bien été enregistré.');
                //return $this->redirectToRoute('login');
                return $this->redirectToRoute('patient');
            }
            }
        else if ($etat=='financier'){
     
            // 2) handle the submit (will only happen on POST)
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                // 3) Encode the password (you could also do this via Doctrine listener)
                $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
                $user->setPassword($password);
                //on active par défaut
                $user->setIsActive(true);
               
                $user->addRole("ROLE_FINANCIER");
                // 4) save the User!
                //$this->redirectToRoute('patient');
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
               
                // ... do any other work - like sending them an email, etc
                // maybe set a "flash" success message for the user
                $this->addFlash('success', 'Votre compte à bien été enregistré.');
                //return $this->redirectToRoute('login');
            }
            }
        
        return $this->render('security/register.html.twig', ['form' => $form->createView(), 'mainNavRegistration' => true, 'title' => 'Inscription']);
}
  /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils) {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        //
        $form = $this->get('form.factory')
                ->createNamedBuilder(null)
                ->add('_username', null, ['label' => 'Email','attr'=> ['class'=>'form-control','style'=>'margin-bottom:10px;']])
                ->add('_password', \Symfony\Component\Form\Extension\Core\Type\PasswordType::class, ['label' => 'Mot de passe','attr'=> ['class'=>'form-control','style'=>'margin-bottom:10px;']])
                ->add('ok', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, ['label' => 'Ok', 'attr' => ['class' => 'btn btn-primary submit-btn btn-block']])
                ->getForm();
        return $this->render('security/login.html.twig', [
                    'mainNavLogin' => true, 'title' => 'Connexion',
                    'form' => $form->createView(),
                    'last_username' => $lastUsername,
                    'error' => $error,
        ]);
    }

}
