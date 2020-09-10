<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\PanelUserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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





}
