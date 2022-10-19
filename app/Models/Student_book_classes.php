<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_book_classes extends Model
{
    use HasFactory;
    protected $table="student_book_classes";


    /**
     * Get the user that owns the Student_book_classes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function classes()
    {
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }

    /**
     * Get the user that owns the Student_book_classes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modules()
    {
        return $this->belongsTo(Module::class, 'module_id', 'id');
    }

    /**
     * Get the user that owns the Student_book_classes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
}
