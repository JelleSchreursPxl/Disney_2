<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Director
 *
 * @ORM\Table(name="director")
 * @ORM\Entity
 */
class Director
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
     * @ORM\Column(name="director", type="string", length=19, nullable=true)
     */
    private $director;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDirector(): ?string
    {
        return $this->director;
    }

    public function setDirector(?string $director): self
    {
        $this->director = $director;

        return $this;
    }


}
