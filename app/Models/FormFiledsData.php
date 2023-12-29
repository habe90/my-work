<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormFiledsData extends Model
{
    use HasFactory;

    public $table = 'form_fileds_data';

    protected $fillable = [
        'form_fields_id',
        'input_id',
        'input_name',
        'is_required',
        'input_encoded',
        'classes',
        'input_validation',
        'is_disabled',
        'default_value',
        'input_placeholder',
        'input_style',
        'info_text',
        'get_info_from',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function formField()
    {
        return $this->belongsTo(FormFields::class, 'form_fields_id');
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