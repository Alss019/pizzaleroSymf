<?php

namespace App\Entity;

use App\Repository\PizzaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PizzaRepository::class)]
class Pizza
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50, nullable:true)]
    private $name_pizza;

    #[ORM\Column(type: 'text',nullable:true)]
    private $desc_pizza;

    #[ORM\Column(type: 'float', nullable:true)]
    private $price_pizza;

    #[ORM\Column(type: 'string', length: 50, nullable:true)]
    private $img_pizza;

    #[ORM\ManyToMany(targetEntity: Ingredient::class, inversedBy: 'pizzas')]
    private $ingredient;

    #[ORM\ManyToMany(targetEntity: Menu::class, inversedBy: 'pizzas')]
    private $menu;

    #[ORM\ManyToMany(targetEntity: Cart::class, inversedBy: 'pizzas')]
    private $cart;

    public function __construct()
    {
        $this->ingredient = new ArrayCollection();
        $this->menu = new ArrayCollection();
        $this->cart = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamePizza(): ?string
    {
        return $this->name_pizza;
    }

    public function setNamePizza(string $name_pizza): self
    {
        $this->name_pizza = $name_pizza;

        return $this;
    }

    public function getDescPizza(): ?string
    {
        return $this->desc_pizza;
    }

    public function setDescPizza(string $desc_pizza): self
    {
        $this->desc_pizza = $desc_pizza;

        return $this;
    }

    public function getPricePizza(): ?float
    {
        return $this->price_pizza;
    }

    public function setPricePizza(float $price_pizza): self
    {
        $this->price_pizza = $price_pizza;

        return $this;
    }

    public function getImgPizza(): ?string
    {
        return $this->img_pizza;
    }

    public function setImgPizza(string $img_pizza): self
    {
        $this->img_pizza = $img_pizza;

        return $this;
    }

    /**
     * @return Collection<int, ingredient>
     */
    public function getIngredient(): Collection
    {
        return $this->ingredient;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->ingredient->contains($ingredient)) {
            $this->ingredient[] = $ingredient;
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self
    {
        $this->ingredient->removeElement($ingredient);

        return $this;
    }

    /**
     * @return Collection<int, menu>
     */
    public function getMenu(): Collection
    {
        return $this->menu;
    }

    public function addMenu(menu $menu): self
    {
        if (!$this->menu->contains($menu)) {
            $this->menu[] = $menu;
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        $this->menu->removeElement($menu);

        return $this;
    }

    /**
     * @return Collection<int, cart>
     */
    public function getCart(): Collection
    {
        return $this->cart;
    }

    public function addCart(Cart $cart): self
    {
        if (!$this->cart->contains($cart)) {
            $this->cart[] = $cart;
        }

        return $this;
    }

    public function removeCart(Cart $cart): self
    {
        $this->cart->removeElement($cart);

        return $this;
    }
    public function __toString()
    {
        return $this->name_pizza;
    }
}
