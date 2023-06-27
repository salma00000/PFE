<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Produit extends Model{
        use HasFactory;
        protected $table = "produits";
        protected $primaryKey = "id_produit";
        public $timestamps = false;
        public $incrementing = false;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'id_produit',
            "nom_produit",
            "code_produit",
            'image_produit',
            'description_produit'
        ];
    }
?>