<?php
// src/Controller/AdvertController.php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Message;
use App\Entity\Post;
use App\Entity\Categorie;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
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
    $entityManager = $this->getDoctrine()->getManager();

        $product = new Message();
        $product->setContenu('Keyboard');

        $product->setUser(1);
        $product->setPost(1);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
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

  /**
   * @Route(name="newmessage")
   */
  public function addMessage(Request $request)
  {
    // On crée un objet 
    $message = new Message();

    // On crée le FormBuilder grâce au service form factory
    $form = $this->get('form.factory')->createBuilder(FormType::class, $message)
    // On ajoute les champs de l'entité que l'on veut à notre formulaire
      ->add('contenu',       TextareaType::class)
      ->add('date',       DateTimeType::class)
      ->add('user',       TextType::class)
      ->add('post',       TextType::class)
      ->add('submit',          SubmitType::class)
      ->getForm();

    // Si la requête est en POST
    if ($request->isMethod('POST')) {
      // On fait le lien Requête <-> Formulaire
      // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
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
        return $this->redirectToRoute('oc_advert_index');
      }
    }

    // À ce stade, le formulaire n'est pas valide car :
    // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
    // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
    return $this->render('Advert/test.html.twig', array(
      'form' => $form->createView(),
    ));
  }


  
}