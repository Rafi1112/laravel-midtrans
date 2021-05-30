<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function gem()
    {
        return $this->belongsTo(Gem::class, 'gems_id');
    }

    public function setStatusPending()
    {
        $this->attributes['status'] = 'pending';
        $this->save();
    }

    public function setStatusSuccess()
    {
        $this->attributes['status'] = 'success';
        $this->save();
    }

    public function setStatusFailed()
    {
        $this->attributes['status'] = 'failed';
        $this->save();
    }

    public function setStatusExpired()
    {
        $this->attributes['status'] = 'expired';
        $this->save();
    }
}
