<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HeureProfRepository")
 */
class HeureProf
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbreheure;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Professeur", inversedBy="heureProfs")
     */
    private $prof;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $mois;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SalaireProf", mappedBy="nbreheure")
     */
    private $salaireProfs;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    public function __construct()
    {
        $this->salaireProfs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbreheure(): ?int
    {
        return $this->nbreheure;
    }

    public function setNbreheure(int $nbreheure): self
    {
        $this->nbreheure = $nbreheure;

        return $this;
    }

    public function getProf(): ?Professeur
    {
        return $this->prof;
    }

    public function setProf(?Professeur $prof): self
    {
        $this->prof = $prof;

        return $this;
    }

    public function getMois(): ?string
    {
        return $this->mois;
    }

    public function setMois(string $mois): self
    {
        $this->mois = $mois;

        return $this;
    }

    /**
     * @return Collection|SalaireProf[]
     */
    public function getSalaireProfs(): Collection
    {
        return $this->salaireProfs;
    }

    public function addSalaireProf(SalaireProf $salaireProf): self
    {
        if (!$this->salaireProfs->contains($salaireProf)) {
            $this->salaireProfs[] = $salaireProf;
            $salaireProf->setNbreheure($this);
        }

        return $this;
    }

    public function removeSalaireProf(SalaireProf $salaireProf): self
    {
        if ($this->salaireProfs->contains($salaireProf)) {
            $this->salaireProfs->removeElement($salaireProf);
            // set the owning side to null (unless already changed)
            if ($salaireProf->getNbreheure() === $this) {
                $salaireProf->setNbreheure(null);
            }
        }

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = new \DateTime('now');

        return $this;
    }
}
