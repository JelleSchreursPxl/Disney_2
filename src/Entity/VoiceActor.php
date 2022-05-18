<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * VoiceActor
 *
 * @ORM\Entity(repositoryClass="App\Repository\VoiceActorRepository")
 * @ORM\Table(name="voice_actor", indexes={@ORM\Index(name="disney_movie_id", columns={"disney_movie_id"})})
 *
 */
class VoiceActor
{
  /**
   *
   * @var int
   *
   * @ORM\Column(name="character_id", type="integer", nullable=false)
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="IDENTITY")
   */


  private $characterId;

  /**
   * @var string|null
   *
   * @ORM\Column(name="character_name", type="string", length=31, nullable=true)
   */
  private ?string $characterName;

  /**
   * @var string|null
   *
   * @ORM\Column(name="voice_actor", type="string", length=34, nullable=true)
   */
  private $voiceActor;

  /**
   * @var string|null
   *
   * @ORM\Column(name="movie_title", type="string", length=45, nullable=true)
   */
  private $movieTitle;

  /**
   * @var DisneyChar
   *
   * @ORM\ManyToOne(targetEntity="DisneyChar")
   * @ORM\JoinColumns({
   *   @ORM\JoinColumn(name="disney_movie_id", referencedColumnName="disney_movie_id")
   * })
   */
  private $disneyMovie;

  public function getCharacterId(): ?int
  {
    return $this->characterId;
  }

  public function getCharacterName(): ?string
  {
    return $this->characterName;
  }

  public function setCharacterName(?string $characterName): self
  {
    $this->characterName = $characterName;

    return $this;
  }

  public function getVoiceActor(): ?string
  {
    return $this->voiceActor;
  }

  public function setVoiceActor(?string $voiceActor): self
  {
    $this->voiceActor = $voiceActor;

    return $this;
  }

  public function getMovieTitle(): ?string
  {
    return $this->movieTitle;
  }

  public function setMovieTitle(?string $movieTitle): self
  {
    $this->movieTitle = $movieTitle;

    return $this;
  }

  public function getDisneyMovie(): ?DisneyChar
  {
    return $this->disneyMovie;
  }

  public function setDisneyMovie(?DisneyChar $disneyMovie): self
  {
    $this->disneyMovie = $disneyMovie;

    return $this;
  }


}
