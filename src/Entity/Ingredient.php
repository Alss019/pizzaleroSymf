<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $name_ingredient;

    #[ORM\Column(type: 'text')]
    private $desc_ingredient;

    #[ORM\Column(type: 'string', length: 50)]
    private $img_ingredient;

    #[ORM\ManyToMany(targetEntity: Pizza::class, mappedBy: 'ingredient')]
    private $pizzas;

    public function __construct()
    {
        $this->pizzas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameIngredient(): ?string
    {
        return $this->name_ingredient;
    }

    public function setNameIngredient(string $name_ingredient): self
    {
        $this->name_ingredient = $name_ingredient;

        return $this;
    }

    public function getDescIngredient(): ?string
    {
        return $this->desc_ingredient;
    }

    public function setDescIngredient(string $desc_ingredient): self
    {
        $this->desc_ingredient = $desc_ingredient;

        return $this;
    }

    public function getImgIngredient(): ?string
    {
        return $this->img_ingredient;
    }

    public function setImgIngredient(string $img_ingredient): self
    {
        $this->img_ingredient = $img_ingredient;

        return $this;
    }

    /**
     * @return Collection<int, Pizza>
     */
    public function getPizzas(): Collection
    {
        return $this->pizzas;
    }

    public function addPizza(Pizza $pizza): self
    {
        if (!$this->pizzas->contains($pizza)) {
            $this->pizzas[] = $pizza;
            $pizza->addIngredient($this);
        }

        return $this;
    }

    public function removePizza(Pizza $pizza): self
    {
        if ($this->pizzas->removeElement($pizza)) {
            $pizza->removeIngredient($this);
        }

        return $this;
    }
}
