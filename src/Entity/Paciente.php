<?php

namespace App\Entity;

use App\Repository\PacienteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PacienteRepository::class)]
class Paciente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateborn = null;

    #[ORM\Column(length: 255)]
    private ?string $dni = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $telefono = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $direccion = null;

    #[ORM\OneToMany(mappedBy: 'paciente', targetEntity: Diagnostico::class)]
    private Collection $diagnosticos;

    #[ORM\Column(nullable: true)]
    private ?bool $borrado = null;

    public function __construct()
    {
        $this->diagnosticos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getDateborn(): ?\DateTimeInterface
    {
        return $this->dateborn;
    }

    public function setDateborn(?\DateTimeInterface $dateborn): self
    {
        $this->dateborn = $dateborn;

        return $this;
    }

    public function getDni(): ?string
    {
        return $this->dni;
    }

    public function setDni(string $dni): self
    {
        $this->dni = $dni;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(?string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * @return Collection<int, Diagnostico>
     */
    public function getDiagnosticos(): Collection
    {
        return $this->diagnosticos;
    }

    public function addDiagnostico(Diagnostico $diagnostico): self
    {
        if (!$this->diagnosticos->contains($diagnostico)) {
            $this->diagnosticos->add($diagnostico);
            $diagnostico->setPaciente($this);
        }

        return $this;
    }

    public function removeDiagnostico(Diagnostico $diagnostico): self
    {
        if ($this->diagnosticos->removeElement($diagnostico)) {
            // set the owning side to null (unless already changed)
            if ($diagnostico->getPaciente() === $this) {
                $diagnostico->setPaciente(null);
            }
        }

        return $this;
    }
    
    public function __toString()
    {
        return $this->name.' '.$this->surname ;
    
    }

    public function isBorrado(): ?bool
    {
        return $this->borrado;
    }

    public function setBorrado(?bool $borrado): self
    {
        $this->borrado = $borrado;

        return $this;
    }
}
