<?php

namespace App\Entity;

use App\Repository\DemandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandeRepository::class)]
class Demande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateDemande = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateConfirmation = null;

    #[ORM\Column(nullable: true)]
    private ?int $typeEchange = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $fraisTransport = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $modeTransport = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numSerieAeronef = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $modeleAeronef = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Piece $piece = null;

    #[ORM\ManyToOne(inversedBy: 'demandes')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDemande(): ?\DateTimeInterface
    {
        return $this->dateDemande;
    }

    public function setDateDemande(?\DateTimeInterface $dateDemande): self
    {
        $this->dateDemande = $dateDemande;

        return $this;
    }

    public function getDateConfirmation(): ?\DateTimeInterface
    {
        return $this->dateConfirmation;
    }

    public function setDateConfirmation(?\DateTimeInterface $dateConfirmation): self
    {
        $this->dateConfirmation = $dateConfirmation;

        return $this;
    }

    public function getTypeEchange(): ?int
    {
        return $this->typeEchange;
    }

    public function setTypeEchange(?int $typeEchange): self
    {
        $this->typeEchange = $typeEchange;

        return $this;
    }

    public function getFraisTransport(): ?string
    {
        return $this->fraisTransport;
    }

    public function setFraisTransport(?string $fraisTransport): self
    {
        $this->fraisTransport = $fraisTransport;

        return $this;
    }

    public function getModeTransport(): ?string
    {
        return $this->modeTransport;
    }

    public function setModeTransport(?string $modeTransport): self
    {
        $this->modeTransport = $modeTransport;

        return $this;
    }

    public function getNumSerieAeronef(): ?string
    {
        return $this->numSerieAeronef;
    }

    public function setNumSerieAeronef(?string $numSerieAeronef): self
    {
        $this->numSerieAeronef = $numSerieAeronef;

        return $this;
    }

    public function getModeleAeronef(): ?string
    {
        return $this->modeleAeronef;
    }

    public function setModeleAeronef(?string $modeleAeronef): self
    {
        $this->modeleAeronef = $modeleAeronef;

        return $this;
    }

    public function getPiece(): ?Piece
    {
        return $this->piece;
    }

    public function setPiece(?Piece $piece): self
    {
        $this->piece = $piece;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
