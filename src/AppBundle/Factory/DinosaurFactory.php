<?php


namespace AppBundle\Factory;


use AppBundle\Entity\Dinosaur;

/**
 * Class DinosaurFactory
 * @package AppBundle\Factory
 */
class DinosaurFactory
{
    /**
     * @param int $length
     * @return Dinosaur
     */
    public function growVelociraptor(int $length): Dinosaur
    {
        return $this->createDinossaur('Velociraptor',true,$length);
    }

    /**
     * @param string $genus
     * @param bool $isCarnovorous
     * @param int $length
     * @return Dinosaur
     */
    public function createDinossaur(string $genus, bool $isCarnovorous, int $length): Dinosaur
    {
        $dinosaur = new Dinosaur($genus, $isCarnovorous);
        $dinosaur->setLength($length);

        return $dinosaur;
    }
}