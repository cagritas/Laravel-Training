<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Represents demo text data used across the education project.
 */
class InformationEntry extends Model
{
    use HasFactory;

    /**
     * Explicitly define the table so examples stay predictable.
     *
     * @var string
     */
    protected $table = 'information_entries';

    /**
     * The attributes that are mass assignable for the examples.
     *
     * @var array<int,string>
     */
    protected $fillable = ['content', 'created_at', 'updated_at'];
}
