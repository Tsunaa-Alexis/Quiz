<?php

namespace App\Controller;

use App\Form\UserType;
use App\Form\ChangePasswordType;
use App\Form\AvatarType;
use App\Entity\Avatar;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/user")
 * @IsGranted("ROLE_USER")
 */
class UserController extends AbstractController
{

    /**
     * @Route("/profile", name="profile")
     */
    public function profile()
    {
        $user = $this->getUser();
        return $this->render('user/profil.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/edit", methods="GET|POST", name="user_edit")
     */
    public function edit(Request $request)
    {
        $user = $this->getUser();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'user.updated_successfully');

            return $this->redirectToRoute('profile');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/change-password", methods="GET|POST", name="user_change_password")
     */
    public function changePassword(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = $this->getUser();

        $form = $this->createForm(ChangePasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($encoder->encodePassword($user, $form->get('newPassword')->getData()));

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profile');
        }

        return $this->render('user/changepassword.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/image", methods="GET|POST", name="user_image")
     */
    public function image(Request $request)
    {
        $user = $this->getUser();
        $avatar = new Avatar();

        $form = $this->createForm(AvatarType::class, $avatar);


        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($avatar);
            $user->setUrl_img($avatar->getAlt());
            $em->flush();

            return $this->redirectToRoute('profile');
        }

        return $this->render('user/image.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
