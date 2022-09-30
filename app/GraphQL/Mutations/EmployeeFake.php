<?php

namespace App\GraphQL\Mutations;
use App\Models\Employee;
final class EmployeeFake
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $employees = Employee::factory($args['count'])->make();

        $chunks = $employees->chunk(200);
        
        $chunks->each(function ($chunk) {
            Employee::insert($chunk->toArray());
        });
        // Employee::factory(100000)->create();
        return "success";
    }
}
