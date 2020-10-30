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

    public function growFromSpecification(string $specification): Dinosaur
    {
        //defaults
        $codeName = 'InG-'.random_int(1,99999);
        $length = $this->getLengthFromSpecification($specification);
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


    private function getLengthFromSpecification(string $specification): int
    {
        $availableLengths = [
            'huge' => ['min' => Dinosaur::HUGE, 'max' => 100],
            'omg' => ['min' => Dinosaur::HUGE, 'max' => 100],
            '😱' => ['min' => Dinosaur::HUGE, 'max' => 100],
            'large' => ['min' => Dinosaur::LARGE, 'max' => Dinosaur::HUGE - 1],
        ];
        $minLength = 1;
        $maxLength = Dinosaur::LARGE - 1;

        foreach (explode(' ', $specification) as $keyword) {
            $keyword = strtolower($keyword);

            if (array_key_exists($keyword, $availableLengths)) {
                $minLength = $availableLengths[$keyword]['min'];
                $maxLength = $availableLengths[$keyword]['max'];

                break;
            }
        }

        return random_int($minLength, $maxLength);
    }

}