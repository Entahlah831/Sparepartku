<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Transaction extends Model {
    // Penting: ID kita pakai huruf (UUID), bukan angka
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];

    public function details() { return $this->hasMany(TransactionDetail::class); }
}