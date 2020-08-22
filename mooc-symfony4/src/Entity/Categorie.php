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


}
