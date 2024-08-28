<?php

namespace App\Fixture;


use App\Entity\SupplierInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;
use Sylius\Bundle\FixturesBundle\Fixture\AbstractFixture;
use Sylius\Bundle\FixturesBundle\Fixture\FixtureInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class SupplierFixture extends AbstractFixture implements FixtureInterface
{

    /** @var FactoryInterface */
    private $supplierFactory;

    /** @var ObjectManager */
    private $supplierManager;

    /** @var Generator */
    private $generator;

    /**
     * @param FactoryInterface $supplierFactory
     * @param ObjectManager $supplierManager
     * @param Generator $generator
     */
    public function __construct(FactoryInterface $supplierFactory, ObjectManager $supplierManager, Generator $generator)
    {
        $this->supplierFactory = $supplierFactory;
        $this->supplierManager = $supplierManager;
        $this->generator = $generator;
    }


    public function load(array $options): void {
        for ($i = 0; $i < $options['count']; $i++) {
            /** @var SupplierInterface $supplier */
         $supplier = $this->supplierFactory->createNew();
         $supplier->setEmail($this->generator->companyEmail);
         $supplier->setName($this->generator->company);
         $this->supplierManager->persist($supplier);
        }
        $this->supplierManager->flush();
    }

    public function getName(): string{
      return 'supplier';
    }

    protected function configureOptionsNode(ArrayNodeDefinition $optionsNode): void
    {
        $optionsNode
            ->children()
            ->integerNode('count');
    }


}
