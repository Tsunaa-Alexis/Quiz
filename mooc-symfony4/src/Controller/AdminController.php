<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Categorie;
use App\Entity\Post;
use App\Form\PanelUserType;
use App\Form\CategorieType;
use App\Form\Admin_ChangePasswordType;
use App\Form\NewAnnonceType;
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

    /**
     * @Route("/panel_categorie", methods="GET|POST", name="panel_admin_categorie")
     */
    public function panel_categorie(Request $request)
    {
        $categorie = $this->getDoctrine()->getManager()->getRepository('App:Categorie')->findall();
        return $this->render('admin/panel_categorie.html.twig', ['categorie' => $categorie]);
    }

    /**
     * @Route("/panel_categorie_add", methods="GET|POST", name="panel_admin_categorie_add")
     */
    public function panel_categorie_add(Request $request)
    {
        $categorie = new Categorie();

        $form = $this->createForm(CategorieType::class, $categorie);

        if ($request->isMethod('POST')) {

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');


            return $this->redirectToRoute('panel_admin_categorie');
        }
        }
        return $this->render('admin/panel_categorie/panel_add_cat.html.twig', array(
        'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/panel_categorie_edit/{id}", methods="GET|POST", name="panel_admin_categorie_edit")
     */
    public function panel_categorie_edit(Request $request, Categorie $categorie)
    {
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'user.updated_successfully');

            return $this->redirectToRoute('panel_admin_categorie');
        }

        return $this->render('admin/panel_categorie/panel_add_cat.html.twig', [
            'form' => $form->createView(),
        ]);
    } 
    
    /**
     * @Route("/panel_categorie_del/{id}", name="panel_admin_categorie_del")
     */
    public function panel_categorie_del(Request $request, Categorie $categorie)
    {
        if (!$categorie) {
            throw $this->createNotFoundException('No guest found');
        }
    
        $em = $this->getDoctrine()->getManager();
        $em->remove($categorie);
        $em->flush();

        return $this->redirectToRoute('panel_admin_categorie');
        
    }
    
    /**
     * @Route("/panel_annonce", methods="GET|POST", name="panel_admin_annonce")
     */
    public function panel_annonce(Request $request)
    {
        $post = $this->getDoctrine()->getManager()->getRepository('App:Post')->findall();
        return $this->render('admin/panel_annonce.html.twig', ['post' => $post]);
    }

    /**
     * @Route("/panel_annonce_add", methods="GET|POST", name="panel_admin_annonce_add")
     */
    public function panel_cannonce_add(Request $request)
    {
        $post = new Post();
        $post->setUser($this->getUser());

        $form = $this->createForm(NewAnnonceType::class, $post);

        if ($request->isMethod('POST')) {

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');


            return $this->redirectToRoute('panel_admin_annonce');
        }
        }
        return $this->render('admin/panel_annonce/panel_add_post.html.twig', array(
        'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/panel_annonce_edit/{id}", methods="GET|POST", name="panel_admin_annonce_edit")
     */
    public function panel_annonce_edit(Request $request, Post $post)
    {
        $form = $this->createForm(NewAnnonceType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'user.updated_successfully');

            return $this->redirectToRoute('panel_admin_annonce');
        }

        return $this->render('admin/panel_annonce/panel_add_post.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/panel_annonce_del/{id}", name="panel_admin_annonce_del")
     */
    public function panel_annonce_del(Request $request, Post $post)
    {
        if (!$post) {
            throw $this->createNotFoundException('No guest found');
        }
    
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('panel_admin_annonce');
        
    }





}
