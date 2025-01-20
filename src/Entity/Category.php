<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'categories')]
    private ?Domain $domain = null;

    /**
     * @var Collection<int, Skill>
     */
    #[ORM\OneToMany(targetEntity: Skill::class, mappedBy: 'category')]
    private Collection $skills;

    public function __construct() {
        $this->skills = new ArrayCollection();
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

    public function getDomain(): ?Domain {
        return $this->domain;
    }

    public function setDomain(?Domain $domain): static {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return Collection<int, Skill>
     */
    public function getSkills(): Collection {
        return $this->skills;
    }

    public function addSkill(Skill $skill): static {
        if(!$this->skills->contains($skill)) {
            $this->skills->add($skill);
            $skill->setCategory($this);
        }

        return $this;
    }

    public function removeSkill(Skill $skill): static {
        if($this->skills->removeElement($skill)) {
            // set the owning side to null (unless already changed)
            if($skill->getCategory() === $this) {
                $skill->setCategory(null);
            }
        }

        return $this;
    }

}
