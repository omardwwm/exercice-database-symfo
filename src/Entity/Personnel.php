<?php

namespace App\Entity;

use App\Repository\PersonnelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonnelRepository::class)
 */
class Personnel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $post;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="personnels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entreprise;

    /**
     * @ORM\ManyToOne(targetEntity=Personnel::class, inversedBy="sbires")
     */
    private $chef;

    /**
     * @ORM\OneToMany(targetEntity=Personnel::class, mappedBy="chef")
     */
    private $sbires;

    public function __construct()
    {
        $this->sbires = new ArrayCollection();
    }

    public function __toString(){
        return $this->getPrenom()." ".$this->getNom();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPost(): ?string
    {
        return $this->post;
    }

    public function setPost(?string $post): self
    {
        $this->post = $post;

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

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getChef(): ?self
    {
        return $this->chef;
    }

    public function setChef(?self $chef): self
    {
        $this->chef = $chef;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getSbires(): Collection
    {
        return $this->sbires;
    }

    public function addSbire(self $sbire): self
    {
        if (!$this->sbires->contains($sbire)) {
            $this->sbires[] = $sbire;
            $sbire->setChef($this);
        }

        return $this;
    }

    public function removeSbire(self $sbire): self
    {
        if ($this->sbires->removeElement($sbire)) {
            // set the owning side to null (unless already changed)
            if ($sbire->getChef() === $this) {
                $sbire->setChef(null);
            }
        }

        return $this;
    }
}
