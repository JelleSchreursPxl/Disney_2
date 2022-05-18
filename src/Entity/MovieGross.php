<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MovieGross
 *
 * @ORM\Table(name="movie_gross")
 * @ORM\Entity
 */
class MovieGross
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="movie_title", type="string", length=40, nullable=true)
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
     * @ORM\Column(name="genre", type="string", length=19, nullable=true)
     */
    private $genre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mpaa_rating", type="string", length=9, nullable=true)
     */
    private $mpaaRating;

    /**
     * @var int|null
     *
     * @ORM\Column(name="total_gross", type="integer", nullable=true)
     */
    private $totalGross;

    /**
     * @var int|null
     *
     * @ORM\Column(name="inflation_adjusted_gross", type="bigint", nullable=true)
     */
    private $inflationAdjustedGross;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getMpaaRating(): ?string
    {
        return $this->mpaaRating;
    }

    public function setMpaaRating(?string $mpaaRating): self
    {
        $this->mpaaRating = $mpaaRating;

        return $this;
    }

    public function getTotalGross(): ?int
    {
        return $this->totalGross;
    }

    public function setTotalGross(?int $totalGross): self
    {
        $this->totalGross = $totalGross;

        return $this;
    }

    public function getInflationAdjustedGross(): ?string
    {
        return $this->inflationAdjustedGross;
    }

    public function setInflationAdjustedGross(?string $inflationAdjustedGross): self
    {
        $this->inflationAdjustedGross = $inflationAdjustedGross;

        return $this;
    }


}
