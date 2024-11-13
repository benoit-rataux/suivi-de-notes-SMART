<?php

namespace App\Entity;

use App\Repository\EvaluationRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvaluationRepository::class)]
class Evaluation {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?DateTimeImmutable $date = null;
    
    #[ORM\ManyToOne(inversedBy: 'evaluations')]
    private ?Student $student = null;
    
    #[ORM\ManyToOne(inversedBy: 'evaluations')]
    private ?Category $category = null;
    
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
    
    public function getCategory(): ?Category {
        return $this->category;
    }
    
    public function setCategory(?Category $category): static {
        $this->category = $category;
        
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
