<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\DomainRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity(repositoryClass: DomainRepository::class)]
class Domain {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    private ?string $name = null;

    /**
     * @var Collection<int, Category>
     */
    #[ORM\OneToMany(targetEntity: Category::class, mappedBy: 'domain')]
    private Collection $categories;

    public function __construct() {
        $this->categories = new ArrayCollection();
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
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection {
        return $this->categories;
    }

    public function addCategory(Category $category): static {
        if(!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->setDomain($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): static {
        if($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if($category->getDomain() === $this) {
                $category->setDomain(null);
            }
        }

        return $this;
    }

}
