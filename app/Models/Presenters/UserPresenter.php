<?php

namespace App\Models\Presenters;

trait UserPresenter
{
    public function profilePic(): string
    {
        $string = ucfirst(substr($this->name, 0, 1));
        $markup = "<div class='profile-pic'>{$string}</div>";
        return '';
    }
}