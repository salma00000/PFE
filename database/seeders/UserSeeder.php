<?php
    namespace Database\Seeders;
    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use App\Models\User;
    use Hash;

    class UserSeeder extends Seeder{
        /**
         * Run the database seeds.
         */
        public function run(): void{
            $super_admin = new User();
            $super_admin->nom = "Admin";
            $super_admin->prenom = "Super";
            $super_admin->email = "super_admin@gmail.com";
            $super_admin->password = Hash::make("0000");
            $super_admin->genre = "Non spécifié";
            $super_admin->role = "Super Admin";
            $super_admin->mobile = 12345678;
            $super_admin->status_compte = true;
            $super_admin->image  = "Profils_pictures/user.png";
            $super_admin->save();
        }
    }
?>