<?php

namespace App\Repositories;

use App\Models\TeamMember;

class TeamMemberRepository extends BaseRepository
{
    public function __construct(TeamMember $model)
    {
        parent::__construct($model);
    }

    public function getActive()
    {
        return $this->model->active()->ordered()->get();
    }
}
