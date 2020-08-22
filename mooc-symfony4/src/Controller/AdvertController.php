<?php
// src/Controller/AdvertController.php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/advert")
 */
class AdvertController extends AbstractController
{
  /**
   * @Route("/{page}", name="oc_advert_index", requirements={"page" = "\d+"}, defaults={"page" = 1})
   */
  public function index($page)
  {
    // On ne sait pas combien de pages il y a
    // Mais on sait qu'une page doit être supérieure ou égale à 1
    if ($page < 1) {
      // On déclenche une exception NotFoundHttpException, cela va afficher
      // une page d'erreur 404 (qu'on pourra personnaliser plus tard d'ailleurs)
      throw $this->createNotFoundException('Page "'.$page.'" inexistante.');
    }

    // Ici, on récupérera la liste des annonces, puis on la passera au template

    // Mais pour l'instant, on ne fait qu'appeler le template
    return $this->render('Advert/index.html.twig');
  }

  /**
   * @Route("/post/{id}", name="oc_advert_post")
   */
  public function post($id) {
    
    // On récupère le repository
    $post = $this->getDoctrine()->getManager()->getRepository('App:Post')->find($id);
    $user = $this->getDoctrine()->getManager()->getRepository('App:User')->find($post->getUser());
    $message = $this->getDoctrine()->getManager()->getRepository('App:Message')->find($post->getMess());
    return $this->render('Advert/post.html.twig', ['post' => $post, 'user' => $user, 'message' => $message]);

  }

  
}