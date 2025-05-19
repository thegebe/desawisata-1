<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('diskons', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('nama_promo');
            $table->text('deskripsi')->nullable();
            $table->decimal('nilai', 10, 2);
            $table->enum('tipe', ['persen', 'nominal']);
            $table->integer('min_transaksi')->nullable();
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_berakhir');
            $table->integer('kuota')->nullable();
            $table->integer('digunakan')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('diskons');
    }
};