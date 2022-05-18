<?php

namespace App\Form;

use App\Entity\DisneyChar;
use App\Entity\VoiceActor;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class FormType extends AbstractType
{
  /**
   * @var ManagerRegistry
   */
  protected ManagerRegistry $manager;
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
    $choices = $entityManager->getRepository(DisneyChar::class)->findAll();
    $builder
      ->add('characterName', TextType::class)
      ->add('voiceActor', TextType::class)
      ->add('disneyMovie', ChoiceType::class, [
        'placeholder' => 'Choose a movie',
        'choices' => $choices,
        'choice_label' => function ($value) {
          if (is_object($value)) {
            return $value->getMovieTitle();
          } else {
            return 0;
          }
        }
      ])
      ->add('save', SubmitType::class);
  }
  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => VoiceActor::class,
    ]);
  }
}