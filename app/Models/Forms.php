<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forms extends Model
{
    use HasFactory;

    public $table = 'forms';

  
    protected $fillable = [
        'name',
        'data_table',
        'redirect',
        'created_by',
        'updated_by',
        'deleted_by',
        'category_id',
    ];

    public function formField()
    {
        return $this->belongsTo(FormFields::class, 'form_fields_id');
    }

    public function formFields()
    {
        return $this->hasMany(FormFields::class, 'form_id')->orderBy('order_by', 'asc');
    }

    
    public function creator()
    {
        return $this->belongsTo(UserInfo::class, 'created_by');
    }
  
    public function updater()
    {
        return $this->belongsTo(UserInfo::class, 'updated_by');
    }

    public function deleter()
    {
        return $this->belongsTo(UserInfo::class, 'deleted_by');
    }

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    /**
 * Metoda za napredno filtriranje rezultata.
 *
 * @param  \Illuminate\Database\Eloquent\Builder  $query
 * @param  array  $filterOptions
 * @return \Illuminate\Database\Eloquent\Builder
 */
public function scopeAdvancedFilter($query, $filterOptions)
{
    if ($filterOptions['s']) {
        $query->where('name', 'like', '%' . $filterOptions['s'] . '%'); // Primjer filtriranja po imenu
    }

    if ($filterOptions['order_column']) {
        $query->orderBy($filterOptions['order_column'], $filterOptions['order_direction']);
    }

    // Dodajte dodatne uslove filtriranja ako je potrebno

    return $query;
}


   
}
