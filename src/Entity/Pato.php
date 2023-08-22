<?php

namespace App\Entity;

use App\Repository\PatoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PatoRepository::class)]
class Pato
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $codcie = null;

    #[ORM\ManyToMany(targetEntity: Diagnostico::class, mappedBy: 'patologias')]
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

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getCodcie(): ?string
    {
        return $this->codcie;
    }

    public function setCodcie(?string $codcie): self
    {
        $this->codcie = $codcie;

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
            $diagnostico->addPatologia($this);
        }

        return $this;
    }

    public function removeDiagnostico(Diagnostico $diagnostico): self
    {
        if ($this->diagnosticos->removeElement($diagnostico)) {
            $diagnostico->removePatologia($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->titulo ;
    
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
