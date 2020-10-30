<?php


namespace Tests\AppBundle\Service;


use AppBundle\Factory\DinosaurFactory;
use AppBundle\Service\EnclosureBuilderService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class EnclosureBuilderServiceTest extends TestCase
{
    public function testItBuildsAndPersistsEnclosure()
    {
        $em = $this->createMock(EntityManagerInterface::class);
        $dinoFactory = $this->createMock(DinosaurFactory::class);
        $dinoFactory->expects($this->exactly(2))
        ->method('growFromSpecification')
        ->with($this->isType('string'))
        ;
        $builder = new EnclosureBuilderService($em,$dinoFactory);
        $enclosur = $builder->buildEnclosure(1,2);

        $this->assertCount(1, $enclosur->getSecurities());
        $this->assertCount(2, $enclosur->getDinosaurs());
    }
}