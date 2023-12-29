<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormFields extends Model
{
    use HasFactory;

    public $table = 'form_fields';

    protected $fillable = [
        'form_id',
        'label',
        'type',
        'group_name',
        'order_by',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class, 'form_id');
    }

    public function fieldsData()
    {
        return $this->hasMany(FormFiledsData::class, 'form_fields_id');
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
}