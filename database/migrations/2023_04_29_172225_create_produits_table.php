<?php
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration{
        /**
         * Run the migrations.
         */
        public function up(): void{
            Schema::create('produits', function (Blueprint $table) {
                $table->collation = "utf8_general_ci";
                $table->charset = "utf8";
                $table->id("id_produit");
                $table->string("nom_produit", 999)->default("Aucun");
                $table->string("code_produit", 800)->default("Aucun");
                $table->string("image_produit", 999)->default("Aucun");
                $table->string("description_produit", 999)->default("Aucun");
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void{
            Schema::dropIfExists('produits');
        }
    };
?>