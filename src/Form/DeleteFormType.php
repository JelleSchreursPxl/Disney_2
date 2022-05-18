<?php

namespace App\Form;

use App\Entity\VoiceActor;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
class DeleteFormType extends AbstractType
{
  /**
   * @var ManagerRegistry
   */
  protected $manager;
  /**
   * MyType constructor.
   * @param ManagerRegistry $manager
   */
  public function __construct(ManagerRegistry $manager)
  {
    $this->manager = $manager;
  }
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $entityManager = $this->manager->getManager();
    $voiceActors = $entityManager->getRepository(VoiceActor::class)->findAll();
    $builder
      ->add('voiceActors', ChoiceType::class, [
        'label' => 'Choose a voice actor',
        'placeholder' => ' ',
        'choices' => $voiceActors,
        'choice_label' => function ($value) {
          if (is_object($value)) {
            return $value->getVoiceActor();
          } else {
            return 0;
          }
        }
      ])
      ->add('delete', SubmitType::class, array('label' => 'Delete',
        'attr' => array(
          'onclick' => 'return confirm("Are you sure you want to delete this Voice Actor?")')));
  }
}
