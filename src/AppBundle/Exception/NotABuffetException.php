<?php


namespace AppBundle\Exception;


use Exception;

class NotABuffetException extends Exception
{
    protected $message = 'Please do not mixthe carnivorous and no carnivorous dinosaurs!';
}