<?php


namespace AppBundle\Factory;


use AppBundle\Entity\Dinosaur;
use AppBundle\Service\DinosaurLengthDeterminator;

/**
 * Class DinosaurFactory
 * @package AppBundle\Factory
 */
class DinosaurFactory
{
    /**
     * @var DinosaurLengthDeterminator
     */
    private $dinosaurLengthDeterminator;

    /**
     * DinosaurFactory constructor.
     * @param DinosaurLengthDeterminator $dinosaurLengthDeterminator
     */
    public function __construct(DinosaurLengthDeterminator $dinosaurLengthDeterminator)
    {
        $this->dinosaurLengthDeterminator = $dinosaurLengthDeterminator;
    }


    /**
     * @param int $length
     * @return Dinosaur
     */
    public function growVelociraptor(int $length): Dinosaur
    {
        return $this->createDinossaur('Velociraptor',true,$length);
    }

    public function growFromSpecification(string $specification): Dinosaur
    {
        //defaults
        $codeName = 'InG-'.random_int(1,99999);
        $length = $this->dinosaurLengthDeterminator->getLengthFromSpecification($specification);
        $isCarnivorous = false;

        if (stripos($specification, 'carnivorous') !== false){
            $isCarnivorous = true;
        }

        $dinosaur = $this->createDinossaur($codeName, $isCarnivorous, $length);

        return $dinosaur;

    }

    /**
     * @param string $genus
     * @param bool $isCarnovorous
     * @param int $length
     * @return Dinosaur
     */
    private function createDinossaur(string $genus, bool $isCarnovorous, int $length): Dinosaur
    {
        $dinosaur = new Dinosaur($genus, $isCarnovorous);
        $dinosaur->setLength($length);

        return $dinosaur;
    }




}