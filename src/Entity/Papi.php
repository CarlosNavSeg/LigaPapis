<?php

namespace App\Entity;

use App\Repository\PapiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Expr\Cast\Double;

#[ORM\Entity(repositoryClass: PapiRepository::class)]
class Papi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $User = null;

    #[ORM\Column]
    private ?float $PuntosTotales = null;

    #[ORM\OneToMany(mappedBy: 'Papi', targetEntity: EntradasTabla::class)]
    private Collection $entradasTablas;

    #[ORM\Column(length: 255)]
    private ?string $Mensaje = null;

    public function __construct()
    {
        $this->entradasTablas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getPuntosTotales(): ?int
    {
        return $this->PuntosTotales;
    }

    public function setPuntosTotales(int $Puntos): self
    {
        $this->PuntosTotales = $Puntos;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->Fecha;
    }

    public function setFecha(?\DateTimeInterface $Fecha): self
    {
        $this->Fecha = $Fecha;

        return $this;
    }

    /**
     * @return Collection<int, EntradasTabla>
     */
    public function getEntradasTablas(): Collection
    {
        return $this->entradasTablas;
    }

    public function addEntradasTabla(EntradasTabla $entradasTabla): self
    {
        if (!$this->entradasTablas->contains($entradasTabla)) {
            $this->entradasTablas->add($entradasTabla);
            $entradasTabla->setPapi($this);
        }

        return $this;
    }

    public function removeEntradasTabla(EntradasTabla $entradasTabla): self
    {
        if ($this->entradasTablas->removeElement($entradasTabla)) {
            // set the owning side to null (unless already changed)
            if ($entradasTabla->getPapi() === $this) {
                $entradasTabla->setPapi(null);
            }
        }

        return $this;
    }

    public function getMensaje(): ?string
    {
        return $this->Mensaje;
    }

    public function setMensaje(string $Mensaje): self
    {
        $this->Mensaje = $Mensaje;

        return $this;
    }

    
}
