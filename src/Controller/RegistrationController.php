<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;

class RegistrationController extends AbstractController
{

    #[Route('/logintest', name: 'app_login_test')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encode the new users password
            $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));

            // Set their role
            $user->setRoles(['ROLE_USER']);

            // Save
            // $em = $this->doctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('app_home');
        }
        // dump($form);
        return $this->render('registration/index.html.twig', [
            'form' => $form->createView(),
        ]);
        
    }
//     public function buildForm(FormBuilderInterface $builder, array $options)
//     {
//         $builder
//             ->add('email', EmailType::class, [
//                 'label' => 'Email',
//                 'required' => true,
//             ])
//             ->add('emailIsPublic', CheckboxType::class, [
//                 'label' => 'Make e-mail public (can be seen by everyone)',
//                 'required' => false,
//                 'attr' => [
//                     'class' => 'switch',
//                 ]
//             ])
//             ->add('submit', SubmitType::class, [
//                 'label' => 'Save changes',
//                 'attr' => [
//                     'class' => 'btn btn-outline-primary float-right'
//                 ]      
//             ])
//         ;}

}

