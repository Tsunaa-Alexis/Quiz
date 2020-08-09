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
   * @Route( name="oc_advert_index")
   */
  public function index(Environment $twig)
  {
    $content = $twig->render('Advert/index.html.twig');

    return new Response($content);
  }

  /**
   * @Route("/view/{id}", name="oc_advert_view")
   */
  public function view($id)
  {
    // $id vaut 5 si l'URL appelée est /advert/view/5
    
    return new Response("Affichage de l'annonce d'id : ".$id);
  }

  /**
   * @Route("/view/{year}/{slug}.{format}", name="oc_advert_view_slug", requirements={
   *   "year"   = "\d{4}",
   *   "format" = "html|xml"
   * }, defaults={"format" = "html"})
   */
  public function viewSlug($slug, $year, $format)
  {
    return new Response("On pourrait afficher l'annonce correspondant au
    slug '".$slug."', créée en ".$year." et au format ".$format.".");
  }
}