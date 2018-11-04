<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SalaireProfRepository")
 */
class SalaireProf
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Professeur", inversedBy="salaireProfs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Prof;

    /**
     * @ORM\Column(type="integer")
     */
    private $tauxHoraires;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\HeureProf", inversedBy="salaireProfs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $nbreheure;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProf(): ?Professeur
    {
        return $this->Prof;
    }

    public function setProf(?Professeur $Prof): self
    {
        $this->Prof = $Prof;

        return $this;
    }

    public function getTauxHoraires(): ?int
    {
        return $this->tauxHoraires;
    }

    public function setTauxHoraires(int $tauxHoraires): self
    {
        $this->tauxHoraires = $tauxHoraires;

        return $this;
    }

    public function getNbreheure(): ?HeureProf
    {
        return $this->nbreheure;
    }

    public function setNbreheure(?HeureProf $nbreheure): self
    {
        $this->nbreheure = $nbreheure;

        return $this;
    }
}
