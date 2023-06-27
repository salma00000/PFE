<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class PasswordResetToken extends Model{
        use HasFactory;
        protected $table = "password_reset_tokens";
        protected $primaryKey = "id_password_reset";
        public $timestamps = false;
        public $incrementing = false;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'id_password_reset',
            "token",
            "id_user",
            'date_time_creation_link'
        ];
    }
?>