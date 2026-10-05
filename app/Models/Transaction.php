<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * Menentukan kolom yang dilindungi dari mass-assignment.
     * Mengosongkan $guarded berarti semua kolom dalam tabel transactions boleh diisi.
     */
    protected $guarded = [];

    /**
     * Relasi ke detail transaksi (One-to-Many)
     * Satu transaksi memiliki banyak item detail belanja
     */
    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    /**
     * Relasi ke user / kasir (Belongs-to)
     * Menghubungkan transaksi dengan akun kasir yang mencatatnya
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}