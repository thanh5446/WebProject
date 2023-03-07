<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrdersRepository::class)
 */
class Orders
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $Date;

    /**
     * @ORM\Column(type="integer")
     */
    private $Quantity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Total;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="orders", cascade={"persist", "remove"})
     */
    private $User;

    /**
     * @ORM\ManyToMany(targetEntity=Shoes::class, inversedBy="orders")
     */
    private $Shoes;

    public function __construct()
    {
        $this->Shoes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->Quantity;
    }

    public function setQuantity(int $Quantity): self
    {
        $this->Quantity = $Quantity;

        return $this;
    }

    public function getTotal(): ?string
    {
        return $this->Total;
    }

    public function setTotal(string $Total): self
    {
        $this->Total = $Total;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    /**
     * @return Collection<int, Shoes>
     */
    public function getShoes(): Collection
    {
        return $this->Shoes;
    }

    public function addShoe(Shoes $shoe): self
    {
        if (!$this->Shoes->contains($shoe)) {
            $this->Shoes[] = $shoe;
        }

        return $this;
    }

    public function removeShoe(Shoes $shoe): self
    {
        $this->Shoes->removeElement($shoe);

        return $this;
    }
}
