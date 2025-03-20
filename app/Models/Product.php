<?php
// filepath: c:\Users\zaour\source\web1a\project\project-4-test\socks\app\Models\Product.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory, Searchable;
    protected $table = 'producten';
    protected $fillable = [
        'naam',
        'omschrijving',
        'prijs',
        'afbeelding',
    ];
    public $timestamps = false; // Disable timestamps

}