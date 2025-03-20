<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(type: 'string', length: 255)]
  private ?string $name = null;

  #[ORM\OneToMany(targetEntity: Product::class, mappedBy: 'category')]
  private Collection $product;

  public function __construct()
  {
    $this->product = new ArrayCollection();
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

  /**
   * @return Collection|Product[]
   */
  public function getProduct(): Collection
  {
    return $this->product;
  }

  public function addProduct(Product $product): self
  {
    if (!$this->product->contains($product)) {
      $this->product[] = $product;
      $product->setCategory($this);
    }

    return $this;
  }

  public function removeProduct(Product $product): self
  {
    if ($this->product->removeElement($product)) {
          // set the owning side to null (unless already changed)
      if ($product->getCategory() === $this) {
        $product->setCategory(null);
      }
    }

    return $this;
  }
}
