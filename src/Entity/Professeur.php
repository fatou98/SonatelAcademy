<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProfesseurRepository")
 */
class Professeur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=250)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $nom;
/**
     * @ORM\Column(type="string", nullable=true)
     */
    private $dateofbirth;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $lieunaissance;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     */
    private $numpiece;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mobileNumber;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fixNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Matiere", mappedBy="professeur", orphanRemoval=true)
     */
    private $matieres;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cours", mappedBy="prof")
     */
    private $cours;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\HeureProf", mappedBy="prof")
     */
    private $heureProfs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SalaireProf", mappedBy="Prof")
     */
    private $salaireProfs;

    public function __construct()
    {
        $this->matieres = new ArrayCollection();
        $this->cours = new ArrayCollection();
        $this->heureProfs = new ArrayCollection();
        $this->salaireProfs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }
    
    public function getDateofbirth(): ?string
    {
        return $this->dateofbirth;
    }

    public function setDateofbirth($dateofbirth): self
    {
        $this->dateofbirth = $dateofbirth;

        return $this;
    }

    public function getLieunaissance(): ?string
    {
        return $this->lieunaissance;
    }

    public function setLieunaissance(string $lieunaissance): self
    {
        $this->lieunaissance = $lieunaissance;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getNumpiece()
    {
        return $this->numpiece;
    }

    public function setNumpiece($numpiece): self
    {
        $this->numpiece = $numpiece;

        return $this;
    }

    public function getMobileNumber(): ?int
    {
        return $this->mobileNumber;
    }

    public function setMobileNumber($mobileNumber): self
    {
        $this->mobileNumber = $mobileNumber;

        return $this;
    }

    public function getFixNumber(): ?int
    {
        return $this->fixNumber;
    }

    public function setFixNumber($fixNumber): self
    {
        $this->fixNumber = $fixNumber;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection|Matiere[]
     */
    public function getMatieres(): Collection
    {
        return $this->matieres;
    }

    public function addMatiere(Matiere $matiere): self
    {
        if (!$this->matieres->contains($matiere)) {
            $this->matieres[] = $matiere;
            $matiere->setProfesseur($this);
        }

        return $this;
    }

    public function removeMatiere(Matiere $matiere): self
    {
        if ($this->matieres->contains($matiere)) {
            $this->matieres->removeElement($matiere);
            // set the owning side to null (unless already changed)
            if ($matiere->getProfesseur() === $this) {
                $matiere->setProfesseur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Cours[]
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCour(Cours $cour): self
    {
        if (!$this->cours->contains($cour)) {
            $this->cours[] = $cour;
            $cour->setProf($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): self
    {
        if ($this->cours->contains($cour)) {
            $this->cours->removeElement($cour);
            // set the owning side to null (unless already changed)
            if ($cour->getProf() === $this) {
                $cour->setProf(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|HeureProf[]
     */
    public function getHeureProfs(): Collection
    {
        return $this->heureProfs;
    }

    public function addHeureProf(HeureProf $heureProf): self
    {
        if (!$this->heureProfs->contains($heureProf)) {
            $this->heureProfs[] = $heureProf;
            $heureProf->setProf($this);
        }

        return $this;
    }

    public function removeHeureProf(HeureProf $heureProf): self
    {
        if ($this->heureProfs->contains($heureProf)) {
            $this->heureProfs->removeElement($heureProf);
            // set the owning side to null (unless already changed)
            if ($heureProf->getProf() === $this) {
                $heureProf->setProf(null);
            }
        }

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
            $salaireProf->setProf($this);
        }

        return $this;
    }

    public function removeSalaireProf(SalaireProf $salaireProf): self
    {
        if ($this->salaireProfs->contains($salaireProf)) {
            $this->salaireProfs->removeElement($salaireProf);
            // set the owning side to null (unless already changed)
            if ($salaireProf->getProf() === $this) {
                $salaireProf->setProf(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        $nomcomplet=$this->prenom.''.$this->nom; 
        return $nomcomplet;
        
    }

}
