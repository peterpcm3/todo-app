<?php

namespace App\Repositories\Interfaces;

use App\User;

interface TodoRepositoryInterface
{
    /**
     * Get all todos by user_id
     *
     * @param int $user_id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllByUser(int $user_id);

    /**
     * Fetch todo record by id and user_id
     *
     * @param $id
     * @param $user_id
     *
     * @return \App\Todo
     */
    public function findByIdAndUserId(int $id, int $user_id);
}
