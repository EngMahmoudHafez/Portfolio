<?php

namespace App\Repositories;

use App\Models\Contact;
use Illuminate\Pagination\LengthAwarePaginator;

class ContactRepository extends BaseRepository
{
    public function __construct(Contact $model)
    {
        parent::__construct($model);
    }

    public function getPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->latest()->paginate($perPage);
    }

    public function getUnread()
    {
        return $this->model->unread()->latest()->get();
    }

    public function unreadCount(): int
    {
        return $this->model->unread()->count();
    }
}
