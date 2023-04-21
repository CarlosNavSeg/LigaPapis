<?php

namespace App\Entity;

use App\Repository\PublicacionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PublicacionRepository::class)]
class Publicacion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'publicacions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $User = null;

    #[ORM\Column(length: 255)]
    private ?string $Image = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Fecha = null;

    #[ORM\Column(length: 255)]
    private ?string $PieDeFoto = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->Fecha;
    }

    public function setFecha(\DateTimeInterface $Fecha): self
    {
        $this->Fecha = $Fecha;

        return $this;
    }

    public function getPieDeFoto(): ?string
    {
        return $this->PieDeFoto;
    }

    public function setPieDeFoto(string $PieDeFoto): self
    {
        $this->PieDeFoto = $PieDeFoto;

        return $this;
    }
}
