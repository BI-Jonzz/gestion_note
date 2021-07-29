<?php

namespace App\Entity;

use App\Repository\NotesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NotesRepository::class)
 */
class Notes
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
    private $note;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity=Etudiant::class, inversedBy="notes")
     */
    private $etudiantId;

    /**
     * @ORM\ManyToOne(targetEntity=Matiere::class, inversedBy="notes")
     */
    private $matiereId;

    /**
     * @ORM\ManyToOne(targetEntity=Professeur::class, inversedBy="notes")
     */
    private $professeurId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getEtudiantId(): ?Etudiant
    {
        return $this->etudiantId;
    }

    public function setEtudiantId(?Etudiant $etudiantId): self
    {
        $this->etudiantId = $etudiantId;

        return $this;
    }

    public function getMatiereId(): ?Matiere
    {
        return $this->matiereId;
    }

    public function setMatiereId(?Matiere $matiereId): self
    {
        $this->matiereId = $matiereId;

        return $this;
    }

    public function getProfesseurId(): ?Professeur
    {
        return $this->professeurId;
    }

    public function setProfesseurId(?Professeur $professeurId): self
    {
        $this->professeurId = $professeurId;

        return $this;
    }
}
