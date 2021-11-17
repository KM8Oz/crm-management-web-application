<?php

namespace App\Repositories;

interface EventRepository
{
    public function getAll();

    public function store(array $data);
//
//    public function getAllForCustomer($company_id);
//
//    public function getAllForUser($customer_id);
}