<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Observations
 *
 * @ORM\Table(name="observations")
 * @ORM\Entity(repositoryClass="App\Repository\ObservationsRepository")
 */
class Observations
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="time", type="string", length=19, nullable=false)
     */
    private $time;

    /**
     * @var string|null
     *
     * @ORM\Column(name="A_temp", type="decimal", precision=4, scale=2, nullable=true)
     */
    private $aTemp;

    /**
     * @var string|null
     *
     * @ORM\Column(name="A_hum", type="decimal", precision=4, scale=2, nullable=true)
     */
    private $aHum;

    /**
     * @var string|null
     *
     * @ORM\Column(name="B_temp", type="decimal", precision=4, scale=2, nullable=true)
     */
    private $bTemp;

    /**
     * @var string|null
     *
     * @ORM\Column(name="B_hum", type="decimal", precision=4, scale=2, nullable=true)
     */
    private $bHum;

    /**
     * @var string|null
     *
     * @ORM\Column(name="EXT_temp", type="decimal", precision=4, scale=2, nullable=true)
     */
    private $extTemp;

    /**
     * @var string|null
     *
     * @ORM\Column(name="EXT_hum", type="decimal", precision=4, scale=2, nullable=true)
     */
    private $extHum;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setTime(string $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getATemp(): ?string
    {
        return $this->aTemp;
    }

    public function setATemp(?string $aTemp): self
    {
        $this->aTemp = $aTemp;

        return $this;
    }

    public function getAHum(): ?string
    {
        return $this->aHum;
    }

    public function setAHum(?string $aHum): self
    {
        $this->aHum = $aHum;

        return $this;
    }

    public function getBTemp(): ?string
    {
        return $this->bTemp;
    }

    public function setBTemp(?string $bTemp): self
    {
        $this->bTemp = $bTemp;

        return $this;
    }

    public function getBHum(): ?string
    {
        return $this->bHum;
    }

    public function setBHum(?string $bHum): self
    {
        $this->bHum = $bHum;

        return $this;
    }

    public function getExtTemp(): ?string
    {
        return $this->extTemp;
    }

    public function setExtTemp(?string $extTemp): self
    {
        $this->extTemp = $extTemp;

        return $this;
    }

    public function getExtHum(): ?string
    {
        return $this->extHum;
    }

    public function setExtHum(?string $extHum): self
    {
        $this->extHum = $extHum;

        return $this;
    }
}