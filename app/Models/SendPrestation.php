<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SendPrestation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'prix',
        'description',
        'surface',
        'total',
        'date1',
        'date2',
        'date3',
        'date4',
        'adress',
        'telephone'
    ];

    // العلاقة مع نموذج User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // إضافة الخاصية userName ديناميكيًا
    protected $appends = ['userName'];

    // دالة لتحديد كيفية الحصول على userName
    public function getUserNameAttribute()
    {
        return $this->user ? $this->user->name : 'غير موجود';
    }
}
