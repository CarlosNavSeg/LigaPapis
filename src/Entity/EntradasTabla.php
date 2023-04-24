<?php

namespace App\Entity;

use App\Repository\EntradasTablaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntradasTablaRepository::class)]
class EntradasTabla
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $puntos = null;

    #[ORM\ManyToOne(inversedBy: 'entradasTablas')]
    private ?Papi $Papi = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Fecha = null;

    #[ORM\Column(length: 255)]
    private ?string $Descripcion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPuntos(): ?float
    {
        return $this->puntos;
    }

    public function setPuntos(float $puntos): self
    {
        $this->puntos = $puntos;

        return $this;
    }

    public function getPapi(): ?Papi
    {
        return $this->Papi;
    }

    public function setPapi(?Papi $Papi): self
    {
        $this->Papi = $Papi;

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

    public function getDescripcion(): ?string
    {
        return $this->Descripcion;
    }

    public function setDescripcion(string $Descripcion): self
    {
        $this->Descripcion = $Descripcion;

        return $this;
    }
}
