<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormAttribute extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    const UPDATED_AT = null;

    const CREATED_AT = null;
}
