<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Client extends Model
{
    use HasFactory;

    /**
     * Run the migrations
     *
     * @return void
     */

    protected $fillable = [
        'contact_name',
        'contact_email',
        'contact_phone_number',
        'company_name',
        'company_address',
        'company_city',
        'company_zip',
        'company_tin'
    ];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('company_name', 'like', '%' . request('search') . '%')->orwhere('contact_name', 'like', '%' . request('search') . '%');
        }
    }

    public function setCompanyNameAttribute($value)
    {
        $this->attributes['company_name'] = ucfirst($value);
    }


    /**
     * Reverse the migrations
     *
     * @return void
     */

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}