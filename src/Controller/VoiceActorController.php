<?php

namespace App\Controller;

use App\Entity\VoiceActor;
use App\Form\DeleteFormType;
use App\Form\EditFormType;
use App\Form\FormType;
use App\Form\SearchFormType;
use App\Form\VoiceActorFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoiceActorController extends AbstractController
{
  private int $voiceActorId;

  public function listAction(EntityManagerInterface $em, PaginatorInterface $paginator, Request $request): Response
  {
    $dql = "SELECT actor FROM App:VoiceActor actor";
    $query = $em->createQuery($dql);

    $pagination = $paginator->paginate(
      $query, /* query NOT result */
      $request->query->getInt('page', 1), 12
    );

    // parameters to template
    return $this->render('voice_actors/index.html.twig', ['pagination' => $pagination]);
  }


  #[Route('/voice_actors/search', name: 'app_voice_actors_search', methods: "{GET}")]
  public function searchBy(EntityManagerInterface $entityManager, PaginatorInterface $paginator, Request $request): Response
  {
    $voiceActor = ['characterName' => null, 'voiceActor' => null, 'movieTitle' => null];
    $form = $this->createForm(SearchFormType ::class, $voiceActor);
    $form->handleRequest($request);
    if ($form->isSubmitted()) {
      $dataValue = $form->getData();
      $query = $entityManager->getRepository(VoiceActor::class)->findAllByInput($dataValue);

      $pagination = $paginator->paginate(
        $query, /* query NOT result */
        $request->query->getInt('page', 1), 12
      );

      // parameters to template
      return $this->render('voice_actors/index.html.twig', ['pagination' => $pagination]);
    }
    return $this->render('actions/index.html.twig', array('form' => $form->createView()));
  }

  #[Route('/voice_actors/add', name: 'app_voice_actors_add', methods: "{POST}")]
  public function add(EntityManagerInterface $entityManager, Request $request): Response
  {
    $voiceActor = new VoiceActor();
    $form = $this->createForm(FormType::class, $voiceActor);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $voiceActor->setMovieTitle($voiceActor->getDisneyMovie()->getMovieTitle());
      echo $voiceActor->getMovieTitle();
      $entityManager->persist($voiceActor);
      $entityManager->flush();
      $this->addFlash('voiceActors', $voiceActor);
      return $this->redirectToRoute('voice_actors');
    } else {
      return $this->render('actions/index.html.twig', array('form' => $form->createView()));
    }
  }

  #[Route('/voice_actors/select', name: 'app_voice_actors_select', methods: "{GET}")]
  public function select(ManagerRegistry $doctrine, Request $request): Response
  {
    $entityManager = $doctrine->getManager();
    $defaultData = ['voiceActors' => null];
    $edit_form = $this->createForm(EditFormType::class, $defaultData);
    $edit_form->handleRequest($request);

    if ($edit_form->isSubmitted() && $edit_form->isValid()) {
      $dataValue = $edit_form->getData();
      foreach ($dataValue as $value) {
        $this->voiceActorId = $value->getCharacterId();
        echo $this->voiceActorId;
      }
      $voiceActor = $entityManager->getRepository(VoiceActor::class)->find($this->voiceActorId);
      setcookie('voiceActor', serialize($voiceActor));
      return $this->redirectToRoute('update');
    }
    return $this->render('actions/index.html.twig', array('form' => $edit_form->createView()));
  }

  #[Route('/voice_actor/update', name: 'app_voice_actors_update', methods: "{PATCH}")]
  public function updateVoiceActor(ManagerRegistry $doctrine, Request $request): Response
  {
    if (isset($_COOKIE['voiceActor'])) {
      $voiceActorToUpdate = unserialize($_COOKIE['voiceActor']);
      unset($_COOKIE['voiceActor']);

      $entityManager = $doctrine->getManager();
      $voiceActor = $entityManager->getRepository(VoiceActor::class)->find($voiceActorToUpdate->getCharacterId());
      $form = $this->createForm(VoiceActorFormType::class, $voiceActor);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
        $voiceActor->setMovieTitle($voiceActor->getDisneyMovie()->getMovieTitle());
        $entityManager->persist($voiceActor);
        $entityManager->flush();
        $this->addFlash('voiceActors', $voiceActor);
        return $this->redirectToRoute('voice_actors');
      } else {
        return $this->render('actions/index.html.twig', array('form' => $form->createView()));
      }
    }
    return $this->render('actions/index.html.twig');
  }

  #[Route('/voice_actors/delete', name: 'app_voice_actors_delete', methods: "{DELETE}")]
  public function delete(ManagerRegistry $doctrine, Request $request): Response
  {
    $entityManager = $doctrine->getManager();
    $defaultData = ['voiceActors' => null];
    $delete_form = $this->createForm(DeleteFormType::class, $defaultData);
    $delete_form->handleRequest($request);
    if ($delete_form->isSubmitted() && $delete_form->isValid()) {
      $data = $delete_form->getData();
      foreach ($data as $d) {
        $this->voiceActorId = $d->getCharacterId();
      }
      $voiceActor = $entityManager->getRepository(VoiceActor::class)->find($this->voiceActorId);
      $entityManager->remove($voiceActor);
      $entityManager->flush();
      return $this->redirectToRoute('voice_actors');
    } else {
      return $this->render('actions/index.html.twig', array('form' => $delete_form->createView()));
    }
  }
}
