<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */

#[ApiResource()]
class Objects
{
    /** id space 
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /** it's a title 
     * @ORM\Column(type="string")
     */
    public string $title = "";

    /** it's a summary 
     * @ORM\Column(type="string")
     */
    public string $summary = "";

    /** it's a latitude 
     * @ORM\Column(type="float")
     */
    public float $lat;

    /** it's a longitude 
     * @ORM\Column(type="float")
     */
    public float $lon;




    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }



    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}
