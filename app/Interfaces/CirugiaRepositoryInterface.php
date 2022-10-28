<?php
namespace App\Interfaces;

interface CirugiaRepositoryInterface extends EloquentRepositoryInterface {
    public function findbyIdSpecialty($id);
}


