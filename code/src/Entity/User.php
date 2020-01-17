<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * User Entity
 * @JMS\ExclusionPolicy("all")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @JMS\Expose()
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @JMS\Expose()
     *
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @JMS\Expose()
     *
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @JMS\Expose()
     * @JMS\Type("DateTime<'Y-m-d'>")
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthday;

    /**
     * @JMS\Expose()
     *
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @JMS\Expose()
     *
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(?\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }
}
