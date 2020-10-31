<?php


namespace AppBundle\Service;


use AppBundle\Entity\Dinosaur;
use AppBundle\Entity\Enclosure;
use AppBundle\Factory\DinosaurFactory;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;


class EnclosureBuilderServiceProphecyTest extends TestCase
{
    public function testItBuildsAndsPersistsEnclosure()
    {
        $em = $this->prophesize(EntityManagerInterface::class);

        $em->persist(Argument::type(Enclosure::class))
        ->shouldBeCalledTimes(1);

        $em->flush()->shoudBeCalled();

        $dinoFactory = $this->prophesize(DinosaurFactory::class);

        $dinoFactory->growFromSpecification(Argument::type('string'))
            ->shouldBeCalledTimes(2)
            ->willReturn(new Dinosaur());

        $builder = new EnclosureBuilderService($em->reveal(),$dinoFactory->reveal());
        $enclosure = $builder->buildEnclosure(1,2);

        $this->assertCount(1, $enclosure->getSecurities());
        $this->assertCount(2, $enclosure->getDinosaurs());

    }
}