<?php

namespace App\Repositories;

interface EventNotesRepository
{
    public function getAll();

    public function store(array $data);
}