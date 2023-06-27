<?php
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration{
        /**
         * Run the migrations.
         */
        public function up(): void{
            Schema::create('formulaires', function (Blueprint $table) {
                $table->collation = "utf8_general_ci";
                $table->charset = "utf8";
                $table->id("id_formulaire");
                $table->bigInteger("id_client")->unsigned()->nullable();
                $table->bigInteger("id_admin")->unsigned()->nullable();
                $table->bigInteger("id_produit")->unsigned()->nullable();
                $table->date("date_achat")->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->string("type_probleme", 800)->default("Aucun");
                $table->string("description_probleme", 999)->default("Aucun");
                $table->string("piece_deffectueuse", 999)->default("Aucun");
                $table->string("photo_probleme", 999)->default("Aucun");
                $table->boolean("is_traited")->default(false);
                $table->foreign("id_client")->references("id_user")->on("users")->onDelete("cascade")->onUpdate("cascade");
                $table->foreign("id_admin")->references("id_user")->on("users")->onDelete("cascade")->onUpdate("cascade");
                $table->foreign("id_produit")->references("id_produit")->on("produits")->onDelete("cascade")->onUpdate("cascade");
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void{
            Schema::dropIfExists('formulaires');
        }
    };
?>