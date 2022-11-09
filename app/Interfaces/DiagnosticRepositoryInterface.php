<?php
namespace App\Interfaces;

interface DiagnosticRepositoryInterface extends EloquentRepositoryInterface {
    public function findByName($description);
    //public function findbyIdSpecialty($id);
}


