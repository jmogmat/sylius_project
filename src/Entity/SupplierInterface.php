<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Sylius\Component\Resource\Model\ResourceInterface;

interface SupplierInterface extends ResourceInterface
{
    public function getName(): ?string;

    public function setName(?string $name): void;

    public function getEmail(): ?string;

    public function setEmail(?string $email): void;

    public function getState(): string;
    public function setState(string $state): void;

    public function getProducts(): ArrayCollection;
}
