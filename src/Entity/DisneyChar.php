<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * DisneyChar
 *
 * @ORM\Table(name="disney_char", indexes={@ORM\Index(name="director_id", columns={"director_id"}), @ORM\Index(name="movie_gross_id", columns={"movie_gross_id"})})
 * @ORM\Entity
 */
class DisneyChar // implements FormTypeInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="disney_movie_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $disneyMovieId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="movie_title", type="string", length=38, nullable=true)
     */
    private $movieTitle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="release_date", type="string", length=10, nullable=true)
     */
    private $releaseDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="hero", type="string", length=26, nullable=true)
     */
    private $hero;

    /**
     * @var string|null
     *
     * @ORM\Column(name="villian", type="string", length=36, nullable=true)
     */
    private $villian;

    /**
     * @var string|null
     *
     * @ORM\Column(name="song", type="string", length=34, nullable=true)
     */
    private $song;

    /**
     * @var int|null
     *
     * @ORM\Column(name="voice_actor_id", type="integer", nullable=true)
     */
    private $voiceActorId;

    /**
     * @var \Director
     *
     * @ORM\ManyToOne(targetEntity="Director")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="director_id", referencedColumnName="id")
     * })
     */
    private $director;

    /**
     * @var \MovieGross
     *
     * @ORM\ManyToOne(targetEntity="MovieGross")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="movie_gross_id", referencedColumnName="id")
     * })
     */
    private $movieGross;

    public function getDisneyMovieId(): ?int
    {
        return $this->disneyMovieId;
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

    public function getReleaseDate(): ?string
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(?string $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getHero(): ?string
    {
        return $this->hero;
    }

    public function setHero(?string $hero): self
    {
        $this->hero = $hero;

        return $this;
    }

    public function getVillian(): ?string
    {
        return $this->villian;
    }

    public function setVillian(?string $villian): self
    {
        $this->villian = $villian;

        return $this;
    }

    public function getSong(): ?string
    {
        return $this->song;
    }

    public function setSong(?string $song): self
    {
        $this->song = $song;

        return $this;
    }

    public function getVoiceActorId(): ?int
    {
        return $this->voiceActorId;
    }

    public function setVoiceActorId(?int $voiceActorId): self
    {
        $this->voiceActorId = $voiceActorId;

        return $this;
    }

    public function getDirector(): ?Director
    {
        return $this->director;
    }

    public function setDirector(?Director $director): self
    {
        $this->director = $director;

        return $this;
    }

    public function getMovieGross(): ?MovieGross
    {
        return $this->movieGross;
    }

    public function setMovieGross(?MovieGross $movieGross): self
    {
        $this->movieGross = $movieGross;

        return $this;
    }
}
