<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\PanelUserType;
use App\Form\Admin_ChangePasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/admin")
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/panel", name="panel_admin")
     */
    public function panel()
    {
        return $this->render('admin/panel.html.twig');
    }

    /**
     * @Route("/panel_user", name="panel_admin_user")
     */
    public function panel_user()
    {
        $user = $this->getDoctrine()->getManager()->getRepository('App:User')->findall();
        return $this->render('admin/panel_user.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/panel_edit/{id}", methods="GET|POST", name="panel_admin_user_edit")
     */
    public function panel_edit(Request $request, User $user)
    {
        $form = $this->createForm(PanelUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'user.updated_successfully');

            return $this->redirectToRoute('panel_admin_user');
        }

        return $this->render('admin/panel_user/panel_edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/panel_change-password/{id}", methods="GET|POST", name="panel_admin_change_password")
     */
    public function panel_changePassword(Request $request, UserPasswordEncoderInterface $encoder, User $user)
    {

        $form = $this->createForm(Admin_ChangePasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($encoder->encodePassword($user, $form->get('newPassword')->getData()));

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('panel_admin_user');
        }

        return $this->render('admin/panel_user/panel_mdp.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }





}
