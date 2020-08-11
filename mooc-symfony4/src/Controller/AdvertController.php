<?php
// src/Controller/AdvertController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * @Route("/advert")
 */
class AdvertController
{
  /**
   * @Route( "/{page}", name="oc_advert_index", requirements={ "page" = "\d+"}, defaults={"page" = 1})
   */
  public function index(Environment $twig)
  {
    $content = $twig->render('Advert/index.html.twig');

    return new Response($content);
  }

  /**
   * @Route("/view/{id}", name="oc_advert_view" requierements={ "id" = "\d+"})
   */
  public function view($id, Request $request)
  {
    // $id vaut 5 si l'URL appelée est /advert/view/5
    
    return new Response("Affichage de l'annonce d'id : ".$id);
  }

  /**
   * @Route("/add", name="oc_advert_add")
   */
   public function add()
  {
  }

  /**
   * @Route("/edit/{id}", name="oc_advert_edit", requirements={"id" = "\d+"})
   */
  public function edit($id)
  {
  }

  /**
   * @Route("/delete/{id}", name="oc_advert_delete", requirements={"id" = "\d+"})
   */
  public function delete($id)
  {
  }
}