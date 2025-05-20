<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('diskons', function (Blueprint $table) {
            $table->id();
            $table->string('nama_promo');
            $table->string('kode')->unique();
            $table->text('detail_promo')->nullable();
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->integer('minimal_transaksi')->default(0);
            $table->enum('jenis_diskon', ['persentase', 'nominal']);
            $table->decimal('nilai_diskon', 10, 2);
            $table->integer('maksimal_diskon')->nullable();
            $table->integer('kuota')->nullable();
            $table->integer('digunakan')->default(0);
            $table->timestamps();
        });

        // Modifikasi tabel reservasis
        Schema::table('reservasis', function (Blueprint $table) {
            $table->foreignId('diskon_id')
                  ->nullable()
                  ->constrained('diskons')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->dropForeign(['diskon_id']);
            $table->dropColumn('diskon_id');
        });

        Schema::dropIfExists('diskons');
    }
};