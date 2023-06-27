<?php
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration{
        /**
         * Run the migrations.
         */
        public function up(): void{
            Schema::create('users', function (Blueprint $table) {
                $table->collation = "utf8_general_ci";
                $table->charset = "utf8";
                $table->id("id_user");
                $table->string('nom', 900)->default("Aucun");
                $table->string('prenom', 900)->default("Aucun");
                $table->string('email', 999)->unique()->default("Aucun");
                $table->string('password', 999)->default("Aucun");
                $table->string('genre', 700)->default("Non spécifié");
                $table->string("role", 700)->default("Admin");
                $table->integer("mobile")->default(0);
                $table->boolean('status_compte')->default(true);
                $table->string("image", 999)->default("Profils_pictures/user.png");
                $table->datetime("date_time_creation_user")->default(DB::raw('CURRENT_TIMESTAMP'))->setTimezone('GMT');
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void{
            Schema::dropIfExists('users');
        }
    };
?>