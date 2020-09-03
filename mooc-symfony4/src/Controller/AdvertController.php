<?php
// src/Controller/AdvertController.php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Message;
use App\Entity\Post;
use App\Entity\Categorie;
use App\Form\MessageType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
    $entityManager = $this->getDoctrine()->getManager();
    $categorie = $this->getDoctrine()->getManager()->getRepository('App:Categorie')->findAll();
    return $this->render('Advert/index.html.twig', ['categorie' => $categorie]);
  }

  /**
   * @Route("/post/{id}", name="oc_advert_post")
   */
  public function post($id) {
    
    $post = $this->getDoctrine()->getManager()->getRepository('App:Post')->find($id);
    $message = $this->getDoctrine()->getManager()->getRepository('App:Message')->findby(array('post' => $id));
    return $this->render('Advert/post.html.twig', ['post' => $post, 'message' => $message]);

  }

  /**
   * @Route("/annonces/{id}", name="oc_advert_annonces")
   */
  public function showannonces($id) {

    $post = $this->getDoctrine()->getManager()->getRepository('App:Post')->findby(array('categorie' => $id));
    $categorie = $this->getDoctrine()->getManager()->getRepository('App:Categorie')->find($id);
    return $this->render('Advert/annonces.html.twig', ['post' => $post, 'categorie' => $categorie]);

  }

  /**
   * @Route("/message/{postId}/new", methods="POST", name="newmessage")
   * @ParamConverter("post", options={"mapping": {"postId": "postId"}})
   */
  public function addMessage(Request $request, Post $post)
  {

    // On crée un objet 
    $message = new Message();
    $message->setUser($this->getDoctrine()->getManager()->getRepository('App:User')->find(1));
    $message->setPost($this->getDoctrine()->getManager()->getRepository('App:Post')->find($post));

    // On crée le FormBuilder grâce au service form factory
    $form = $this->createForm(MessageType::class, $message);

    // Si la requête est en POST
    if ($request->isMethod('POST')) {
      // On fait le lien Requête <-> Formulaire
      // À partir de maintenant, la variable $form contient les valeurs entrées dans le formulaire par le visiteur
      $form->handleRequest($request);

      // On vérifie que les valeurs entrées sont correctes
      // (Nous verrons la validation des objets en détail dans le prochain chapitre)
      if ($form->isValid()) {
        // On enregistre notre objet $advert dans la base de données, par exemple
        $em = $this->getDoctrine()->getManager();
        $em->persist($message);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

        // On redirige vers la page de visualisation de l'annonce nouvellement créée
        return $this->redirectToRoute('oc_advert_post', ['id' => $post->getPostId()]);
      }
    }

    // À ce stade, le formulaire n'est pas valide car :
    // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
    // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
    return $this->render('Advert/test.html.twig', array(
      'form' => $form->createView(),
    ));
  }

  public function MessageForm(Request $request, Post $post) {

    $form = $this->createForm(MessageType::class);

    return $this->render('Advert/test.html.twig', [
        'post' => $post,
        'form' => $form->createView(),
      ]);
  }


  
}