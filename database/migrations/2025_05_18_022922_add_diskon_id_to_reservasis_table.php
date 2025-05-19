<!-- use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->foreignId('diskon_id')
                  ->nullable()
                  ->constrained('diskon')
                  ->after('id_paket'); // Tambahkan setelah kolom id_paket
        });
    }

    public function down()
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->dropForeign(['diskon_id']);
            $table->dropColumn('diskon_id');
        });
    }
}; -->