<?php
// src/Controller/AdvertController.php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/index")
 */
class AdvertController extends AbstractController
{
  /**
   * @Route("/{page}", name="oc_advert_index", requirements={"page" = "\d+"}, defaults={"page" = 1})
   */
  public function index($page)
  {
    $categorie = $this->getDoctrine()->getManager()->getRepository('App:Categorie')->findAll();
    return $this->render('Advert/index.html.twig', ['categorie' => $categorie]);
  }

  /**
   * @Route("/post/{id}", name="oc_advert_post")
   */
  public function post($id) {
    
    $post = $this->getDoctrine()->getManager()->getRepository('App:Post')->find($id);
    return $this->render('Advert/post.html.twig', ['post' => $post]);

  }

  /**
   * @Route("/annonces/{id}", name="oc_advert_annonces")
   */
  public function showannonces($id) {

    $post = $this->getDoctrine()->getManager()->getRepository('App:Post')->findby(array('categorie' => $id));
    $categorie = $this->getDoctrine()->getManager()->getRepository('App:Categorie')->find($id);
    return $this->render('Advert/annonces.html.twig', ['post' => $post, 'categorie' => $categorie]);

  }


  
}