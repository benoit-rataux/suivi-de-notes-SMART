<?php

namespace App\Entity;

use App\Repository\SkillRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: SkillRepository::class)]
class Skill {
    #[Groups('student')]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[Groups('student')]
    #[ORM\Column(length: 50)]
    private ?string $name = null;
    
    /**
     * @var Collection<int, Evaluation>
     */
    #[ORM\OneToMany(targetEntity: Evaluation::class, mappedBy: 'skill')]
    private Collection $evaluations;
    
    #[ORM\ManyToOne(inversedBy: 'skills')]
    private ?Category $category = null;
    
    public function __construct() {
        $this->evaluations = new ArrayCollection();
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
     * @return Collection<int, Evaluation>
     */
    public function getEvaluations(): Collection {
        return $this->evaluations;
    }
    
    public function addEvaluation(Evaluation $evaluation): static {
        if(!$this->evaluations->contains($evaluation)) {
            $this->evaluations->add($evaluation);
            $evaluation->setSkill($this);
        }
        
        return $this;
    }
    
    public function removeEvaluation(Evaluation $evaluation): static {
        if($this->evaluations->removeElement($evaluation)) {
            // set the owning side to null (unless already changed)
            if($evaluation->getSkill() === $this) {
                $evaluation->setSkill(null);
            }
        }
        
        return $this;
    }
    
    public function getCategory(): ?Category {
        return $this->category;
    }
    
    public function setCategory(?Category $category): static {
        $this->category = $category;
        
        return $this;
    }
}
