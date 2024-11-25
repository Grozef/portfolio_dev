<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: JoliDessin::class, mappedBy: 'categorie')]
    private Collection $joliDessins;

    public function __construct()
    {
        $this->joliDessins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection<int, JoliDessin>
     */
    public function getJoliDessins(): Collection
    {
        return $this->joliDessins;
    }

    public function addJoliDessin(JoliDessin $joliDessin): static
    {
        if (!$this->joliDessins->contains($joliDessin)) {
            $this->joliDessins->add($joliDessin);
            $joliDessin->addCategorie($this);
        }

        return $this;
    }

    public function removeJoliDessin(JoliDessin $joliDessin): static
    {
        if ($this->joliDessins->removeElement($joliDessin)) {
            $joliDessin->removeCategorie($this);
        }

        return $this;
    }
}
