<?php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AuthentificationController;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\ProfilController;
    use App\Http\Controllers\ChatbotController;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\ProduitController;
    use App\Http\Controllers\FormulaireController;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider and all of them will
    | be assigned to the "web" middleware group. Make something great!
    |
    */

    Route::controller(ChatBotController::class)->group(function() {
        Route::get('/liste-chatbot', 'index')->middleware("session_not_exist");
        Route::get('/ouvrir_cree_chatbot', 'ouvrir_cree')->middleware("session_not_exist");
        Route::post('/cree_qa_bot', 'create')->middleware("session_not_exist");
        Route::post('/modifier_qa_bot/{id}', 'update')->middleware("session_not_exist");
        Route::get('/edit_qa_bot/{id}', 'edit')->middleware("session_not_exist");

        Route::get('/supprimer_qa_bot/{id}', 'delete')->middleware("session_not_exist");


    });

    Route::controller(AuthentificationController::class)->group(function() {
        Route::get('/', 'ouvrirSignin')->middleware("session_exist");
        Route::post('/post-login', 'gestionLogin');
        Route::get('/forget-password', 'ouvrirForgetPassword')->middleware("session_exist");
        Route::post('/post-forget-password', 'gestionForgetPassword');
        Route::get('/update-password', 'ouvrirUpdatePassword')->middleware("session_exist");
        Route::post('/post-update-password-forget', 'gestionUpdatePasswordForget');
        Route::get('/logout', 'gestionLogout');
    });

    Route::controller(DashboardController::class)->group(function() {
        Route::get('/dashboard', 'ouvrirDashboard')->middleware("session_not_exist");
    });

    Route::controller(ProfilController::class)->group(function() {
        Route::get('/profil', 'ouvrirProfil')->middleware("session_not_exist");
        Route::get('/edit-photo-profil', 'ouvrirEditPhotoProfil')->middleware("session_not_exist");
        Route::post('/update-photo-profil', 'gestionUpdatePhotoDeProfil');
        Route::get('/update-status-profil', 'gestionUpdateStatusDeProfil');
        Route::get('/edit-informations-profil', 'ouvrirEditInformationsProfil')->middleware("session_not_exist");
        Route::post('/update-informations-profil', 'gestionUpdateInformationsDeProfil');
        Route::post('/update-password-profil', 'gestionUpdatePasswordDeProfil');
    });

    Route::controller(UserController::class)->group(function() {
        Route::get('/create-user', 'ouvrirCreateUser')->middleware("session_not_super_admin");
        Route::post('/create-user-product', 'creeUserProduits')->middleware("session_not_super_admin");
        Route::post('/delete-user-product', 'DeleteUserProduits')->middleware("session_not_super_admin");

        Route::post('/add-user', 'gestionAddUser');
        Route::get('/liste-users-table', 'ouvrirListeUsersTable')->middleware("session_not_super_admin");
        Route::get('/user', 'ouvrirUser')->middleware("session_not_super_admin");
        Route::get('/delete-user', 'gestionDeleteUser');
        Route::get('/edit-user', 'ouvrirEditUser')->middleware("session_not_super_admin");
        Route::post('/update-user', 'gestionUpdateUser');
        Route::get('/liste-users-grid', 'ouvrirListeUsersGrid')->middleware("session_not_super_admin");
    });

    Route::controller(ProduitController::class)->group(function() {
        Route::get('/create-produit', 'ouvrirCreateProduit')->middleware("session_not_super_admin");
        Route::post('/add-produit', 'gestionAddProduit');
        Route::get('/liste-produits', 'ouvrirListeProduits')->middleware("session_not_exist");
        Route::get('/delete-produit', 'gestionDeleteProduit');
        Route::get('/produit', 'ouvrirProduit')->middleware("session_not_exist");
        Route::get('/edit-produit', 'ouvrirEditProduit')->middleware("session_not_super_admin");
        Route::post('/update-produit', 'gestionUpdateProduit');
    });

    Route::controller(FormulaireController::class)->group(function() {
        Route::get('/liste-formulaires', 'ouvrirListeFormulaires')->middleware("session_not_super_admin");
        Route::post('/affect-admin', 'gestionAffectAdmin');
        Route::get('/formulaire', 'ouvrirFormulaire')->middleware("session_not_exist");
        Route::get('/liste-mes-formulaires', 'ouvrirListeMesFormulaires')->middleware("session_not_admin");
        Route::get('/update-is-traited', 'gestionUpdateIsTraited');
    });
?>



