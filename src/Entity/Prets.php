<?php

namespace App\Entity;

use App\Repository\PretsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PretsRepository::class)
 */
class Prets
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateFin;

    /**
     * @ORM\ManyToOne(targetEntity=Stagiaires::class, inversedBy="prets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $stagiaire;

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private $isReturned = false;

    /**
     * @ORM\Column(type="text")
     */
    private $commentaireDebut;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaireFin;

    /**
     * @ORM\Column(type="boolean")
     */
    private $validation;

    /**
     * @ORM\ManyToMany(targetEntity=Articles::class, inversedBy="prets")
     */
    private $articlesPretes;

    public function __construct()
    {
        $this->article = new ArrayCollection();
        $this->articlesPretes = new ArrayCollection();
        $this->dateDebut = new \DateTime();
        $this->isReturned = false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getStagiaire(): ?Stagiaires
    {
        return $this->stagiaire;
    }

    public function setStagiaire(?Stagiaires $stagiaire): self
    {
        $this->stagiaire = $stagiaire;

        return $this;
    }

    public function getIsReturned(): ?bool
    {
        return $this->isReturned;
    }

    public function setIsReturned(bool $isReturned): self
    {
        $this->isReturned = $isReturned;

        return $this;
    }

    public function getCommentaireDebut(): ?string
    {
        return $this->commentaireDebut;
    }

    public function setCommentaireDebut(string $commentaireDebut): self
    {
        $this->commentaireDebut = $commentaireDebut;

        return $this;
    }

    public function getCommentaireFin(): ?string
    {
        return $this->commentaireFin;
    }

    public function setCommentaireFin(string $commentaireFin): self
    {
        $this->commentaireFin = $commentaireFin;

        return $this;
    }

    public function getValidation(): ?bool
    {
        return $this->validation;
    }

    public function setValidation(bool $validation): self
    {
        $this->validation = $validation;

        return $this;
    }

    /**
     * @return Collection|Articles[]
     */
    public function getArticlesPretes(): Collection
    {
        return $this->articlesPretes;
    }

    public function addArticlesPrete(Articles $articlesPrete): self
    {
        if (!$this->articlesPretes->contains($articlesPrete)) {
            $this->articlesPretes[] = $articlesPrete;
        }
        return $this;
    }

    public function removeArticlesPrete(Articles $articlesPrete): self
    {
        $this->articlesPretes->removeElement($articlesPrete);

        return $this;
    }
}
