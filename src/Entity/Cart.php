<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartRepository::class)]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private $date_cart;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'carts')]
    private $util;

    #[ORM\ManyToMany(targetEntity: Drink::class, inversedBy: 'carts')]
    private $drink;

    #[ORM\ManyToMany(targetEntity: Menu::class, inversedBy: 'carts')]
    private $menu;

    #[ORM\ManyToMany(targetEntity: Pizza::class, inversedBy: 'carts')]
    private $pizza;

    public function __construct()
    {
        $this->drink = new ArrayCollection();
        $this->menu = new ArrayCollection();
        $this->pizza = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCart(): ?\DateTimeImmutable
    {
        return $this->date_cart;
    }

    public function setDateCart(?\DateTimeImmutable $date_cart): self
    {
        $this->date_cart = $date_cart;

        return $this;
    }

    public function getUtil(): ?User
    {
        return $this->util;
    }

    public function setUtil(?User $util): self
    {
        $this->util = $util;

        return $this;
    }

    /**
     * @return Collection<int, Drink>
     */
    public function getDrink(): Collection
    {
        return $this->drink;
    }

    public function addDrink(Drink $drink): self
    {
        if (!$this->drink->contains($drink)) {
            $this->drink[] = $drink;
        }

        return $this;
    }

    public function removeDrink(Drink $drink): self
    {
        $this->drink->removeElement($drink);

        return $this;
    }

    /**
     * @return Collection<int, Menu>
     */
    public function getMenu(): Collection
    {
        return $this->menu;
    }

    public function addMenu(Menu $menu): self
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
     * @return Collection<int, Pizza>
     */
    public function getPizza(): Collection
    {
        return $this->pizza;
    }

    public function addPizza(Pizza $pizza): self
    {
        if (!$this->pizza->contains($pizza)) {
            $this->pizza[] = $pizza;
        }

        return $this;
    }

    public function removePizza(Pizza $pizza): self
    {
        $this->pizza->removeElement($pizza);

        return $this;
    }
}
