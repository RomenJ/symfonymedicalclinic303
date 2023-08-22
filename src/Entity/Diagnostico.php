<?php

namespace App\Entity;

use App\Repository\DiagnosticoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
#[ORM\Entity(repositoryClass: DiagnosticoRepository::class)]
class Diagnostico
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'diagnosticos')]
    private ?Paciente $paciente = null;

    #[ORM\ManyToMany(targetEntity: Pato::class, inversedBy: 'diagnosticos')]
    private Collection $patologias;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notas = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'diagnosticos')]
    private Collection $medico;

    #[ORM\ManyToMany(targetEntity: Prueba::class, inversedBy: 'diagnosticos')]
    private Collection $Pruebas;

    #[ORM\ManyToMany(targetEntity: Trat::class, inversedBy: 'diagnosticos')]
    private Collection $trats;

    #[ORM\Column(nullable: true)]
    private ?bool $borrado = null;
    
    public function __construct()
    {
        $this->patologias = new ArrayCollection();
        $this->date = new DateTime();
        $this->medico = new ArrayCollection();
        $this->Pruebas = new ArrayCollection();
        $this->trats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPaciente(): ?Paciente
    {
        return $this->paciente;
    }

    public function setPaciente(?Paciente $paciente): self
    {
        $this->paciente = $paciente;

        return $this;
    }

    /**
     * @return Collection<int, Pato>
     */
    public function getPatologias(): Collection
    {
        return $this->patologias;
    }

    public function addPatologia(Pato $patologia): self
    {
        if (!$this->patologias->contains($patologia)) {
            $this->patologias->add($patologia);
        }

        return $this;
    }

    public function removePatologia(Pato $patologia): self
    {
        $this->patologias->removeElement($patologia);

        return $this;
    }

    public function getNotas(): ?string
    {
        return $this->notas;
    }

    public function setNotas(?string $notas): self
    {
        $this->notas = $notas;

        return $this;
    }
    
    public function __toString()
    {
        return $this->date;
    
    }

    /**
     * @return Collection<int, User>
     */
    public function getMedico(): Collection
    {
        return $this->medico;
    }

    public function addMedico(User $medico): self
    {
        if (!$this->medico->contains($medico)) {
            $this->medico->add($medico);
        }

        return $this;
    }

    public function removeMedico(User $medico): self
    {
        $this->medico->removeElement($medico);

        return $this;
    }

    /**
     * @return Collection<int, Prueba>
     */
    public function getPruebas(): Collection
    {
        return $this->Pruebas;
    }

    public function addPrueba(Prueba $prueba): self
    {
        if (!$this->Pruebas->contains($prueba)) {
            $this->Pruebas->add($prueba);
        }

        return $this;
    }

    public function removePrueba(Prueba $prueba): self
    {
        $this->Pruebas->removeElement($prueba);

        return $this;
    }

    /**
     * @return Collection<int, Trat>
     */
    public function getTrats(): Collection
    {
        return $this->trats;
    }

    public function addTrat(Trat $trat): self
    {
        if (!$this->trats->contains($trat)) {
            $this->trats->add($trat);
        }

        return $this;
    }

    public function removeTrat(Trat $trat): self
    {
        $this->trats->removeElement($trat);

        return $this;
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
