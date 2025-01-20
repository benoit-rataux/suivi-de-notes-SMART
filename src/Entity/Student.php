<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource]
#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student {

    #[Groups('student')]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups('student')]
    #[ORM\Column(length: 50)]
    private ?string $firstname = null;

    #[Groups('student')]
    #[ORM\Column(length: 50)]
    private ?string $surname = null;

    /**
     * @var Collection<int, Evaluation>
     */
    #[Groups('student')]
    #[ORM\OneToMany(targetEntity: Evaluation::class, mappedBy: 'student')]
    private Collection $evaluations;

    #[Groups('student')]
    #[ORM\ManyToOne(inversedBy: 'students')]
    private ?SchoolClass $schoolClass = null;

    public function __construct() {
        $this->evaluations = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getFirstname(): ?string {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static {
        $this->firstname = $firstname;

        return $this;
    }

    public function getSurname(): ?string {
        return $this->surname;
    }

    public function setSurname(string $surname): static {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @return Collection<int, Evaluation>
     */
    public function getEvaluations(): Collection {
        return $this->evaluations;
    }

    public function addEvaluation(Evaluation $evaluation): static {
        if(!$this->evaluations->contains($evaluation)) {
            $this->evaluations->add($evaluation);
            $evaluation->setStudent($this);
        }

        return $this;
    }

    public function removeEvaluation(Evaluation $evaluation): static {
        if($this->evaluations->removeElement($evaluation)) {
            // set the owning side to null (unless already changed)
            if($evaluation->getStudent() === $this) {
                $evaluation->setStudent(null);
            }
        }

        return $this;
    }

    public function getSchoolClass(): ?SchoolClass {
        return $this->schoolClass;
    }

    public function setSchoolClass(?SchoolClass $schoolClass): static {
        $this->schoolClass = $schoolClass;

        return $this;
    }

}
