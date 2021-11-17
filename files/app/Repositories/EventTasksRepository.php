<?php

namespace App\Repositories;

interface EventTasksRepository
{
    public function getAll();

    public function store(array $data);
}