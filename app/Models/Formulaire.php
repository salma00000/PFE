<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Formulaire extends Model{
        use HasFactory;
        protected $table = "formulaires";
        protected $primaryKey = "id_formulaire";
        public $timestamps = false;
        public $incrementing = false;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'id_formulaire',
            "id_client",
            "id_admin",
            'nom_produit',
            'date_achat',
            "type_probleme",
            "description_probleme",
            "piece_deffectueuse",
            "photo_probleme",
            "is_traited"
        ];
    }
?>
