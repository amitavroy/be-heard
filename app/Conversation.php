<?php

namespace App;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Conversation extends BaseModel
{
    public function creator()
    {
        return $this->belongsTo(User::class);
    }
}
