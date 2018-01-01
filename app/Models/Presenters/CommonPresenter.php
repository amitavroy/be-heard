<?php

namespace App\Models\Presenters;

use Carbon\Carbon;

trait CommonPresenter
{
    public function timeAgo()
    {
        return $this->created_at->diffForHumans();
    }
}
