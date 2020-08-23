<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity
 */
class Categorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="categorie_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $categorieId;

    /**
     * @var string
     *
     * @ORM\Column(name="cat_name", type="string", length=50, nullable=false)
     */
    private $catName;

    /**
     * @var string
     *
     * @ORM\Column(name="cat_description", type="string", length=1000, nullable=false)
     */
    private $catDescription;

    public function getCategorieId(): ?int
    {
        return $this->categorieId;
    }

    public function getCatName(): ?string
    {
        return $this->catName;
    }

    public function setCatName(?string $catName): self
    {
        $this->catName = $catName;

        return $this;
    }

    public function getCatDescription(): ?string
    {
        return $this->catDescription;
    }

    public function setCatDescription(?string $catDescription): self
    {
        $this->catDescription = $catDescription;

        return $this;
    }


}
