<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SchoolClassRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource]
#[ORM\Entity(repositoryClass: SchoolClassRepository::class)]
class SchoolClass {

    #[Groups('student')]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups('student')]
    #[ORM\Column(length: 50)]
    private ?string $name = null;

    /**
     * @var Collection<int, Student>
     */
    #[ORM\OneToMany(targetEntity: Student::class, mappedBy: 'schoolClass')]
    private Collection $students;

    public function __construct() {
        $this->students = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(string $name): static {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Student>
     */
    public function getStudents(): Collection {
        return $this->students;
    }

    public function addStudent(Student $student): static {
        if(!$this->students->contains($student)) {
            $this->students->add($student);
            $student->setSchoolClass($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): static {
        if($this->students->removeElement($student)) {
            // set the owning side to null (unless already changed)
            if($student->getSchoolClass() === $this) {
                $student->setSchoolClass(null);
            }
        }

        return $this;
    }

}
