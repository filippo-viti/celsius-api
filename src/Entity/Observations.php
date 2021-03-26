<?php

namespace App\Entity;

use App\Repository\ObservationsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ObservationsRepository::class)
 */
class Observations
{
    /**
     * 
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank
     * @Assert\Type("DateTime")
     * @ORM\Column(type="datetime")
     */
    private $time;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="decimal", precision=4, scale=2, nullable=true)
     */
    private $A_temp;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="integer", nullable=true)
     */
    private $A_hum;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="decimal", precision=4, scale=2, nullable=true)
     */
    private $B_temp;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="integer", nullable=true)
     */
    private $B_hum;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="decimal", precision=4, scale=2, nullable=true)
     */
    private $EXT_temp;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="integer", nullable=true)
     */
    private $EXT_hum;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getATemp(): ?string
    {
        return $this->A_temp;
    }

    public function setATemp(?string $A_temp): self
    {
        $this->A_temp = $A_temp;

        return $this;
    }

    public function getAHum(): ?int
    {
        return $this->A_hum;
    }

    public function setAHum(?int $A_hum): self
    {
        $this->A_hum = $A_hum;

        return $this;
    }

    public function getBTemp(): ?string
    {
        return $this->B_temp;
    }

    public function setBTemp(?string $B_temp): self
    {
        $this->B_temp = $B_temp;

        return $this;
    }

    public function getBHum(): ?int
    {
        return $this->B_hum;
    }

    public function setBHum(?int $B_hum): self
    {
        $this->B_hum = $B_hum;

        return $this;
    }

    public function getEXTTemp(): ?string
    {
        return $this->EXT_temp;
    }

    public function setEXTTemp(?string $EXT_temp): self
    {
        $this->EXT_temp = $EXT_temp;

        return $this;
    }

    public function getEXTHum(): ?int
    {
        return $this->EXT_hum;
    }

    public function setEXTHum(?int $EXT_hum): self
    {
        $this->EXT_hum = $EXT_hum;

        return $this;
    }
}
