<?php

namespace App\Repositories;

interface EventPaymentRepository
{
    public function getAll();

    public function store(array $data);
}