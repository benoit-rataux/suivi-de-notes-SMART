<?php

namespace App\Entity;

use App\Repository\EvaluationRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: EvaluationRepository::class)]
class Evaluation {
    #[Groups('student')]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[Groups('student')]
    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?DateTimeImmutable $date = null;
    
    #[ORM\ManyToOne(inversedBy: 'evaluations')]
    private ?Student $student = null;
    
    #[Groups('student')]
    #[ORM\ManyToOne(inversedBy: 'evaluations')]
    private ?Skill $skill = null;
    
    #[Groups('student')]
    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $grade = null;
    
    public function getId(): ?int {
        return $this->id;
    }
    
    public function getDate(): ?DateTimeImmutable {
        return $this->date;
    }
    
    public function setDate(DateTimeImmutable $date): static {
        $this->date = $date;
        
        return $this;
    }
    
    public function getStudent(): ?Student {
        return $this->student;
    }
    
    public function setStudent(?Student $student): static {
        $this->student = $student;
        
        return $this;
    }
    
    public function getSkill(): ?Skill {
        return $this->skill;
    }
    
    public function setSkill(?Skill $skill): static {
        $this->skill = $skill;
        
        return $this;
    }
    
    public function getGrade(): ?int {
        return $this->grade;
    }
    
    public function setGrade(int $grade): static {
        $this->grade = $grade;
        
        return $this;
    }
}
