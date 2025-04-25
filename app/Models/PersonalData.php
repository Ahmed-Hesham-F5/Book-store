<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalData extends Model
{
    use HasFactory;
    public $table = "personalData";
    protected $fillable = [
        'firstName',
        'lastName',
        'userName',
        'email',
        'address',
        // 'phone',
        'state',
        'country',
        'ChooseTheDay',
        'nameOnCard',
        'creditCardNumber',
        'Payment'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];  
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
