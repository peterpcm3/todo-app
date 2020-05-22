<?php

namespace App\Repositories;

use App\Todo;
use App\User;
use App\Repositories\Interfaces\TodoRepositoryInterface;

class TodoRepository implements TodoRepositoryInterface
{
    /**
     * @var int PAGINATE_COUNT
     */
    const PAGINATE_COUNT = 10;

    /**
     * @inheritdoc
     */
    public function getAllByUser(int $user_id)
    {
        return Todo::where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->paginate(self::PAGINATE_COUNT);
    }

    /**
     * @inheritdoc
     */
    public function findByIdAndUserId(int $id, int $user_id)
    {
        return Todo::where('user_id', $user_id)
            ->where('id', $id)
            ->first();
    }
}
