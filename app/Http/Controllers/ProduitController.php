<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Produit;

    class ProduitController extends Controller{
        public function ouvrirCreateProduit(){
            return view("Produits.create_produit");
        }

        public function gestionAddProduit(Request $request){
            if($this->checkProduitExist($request->code_produit)){
                return back()->with("erreur_code", "Nous sommes désolés de vous informer que ce code est utilisé pour créer un autre produit.");
            }

            else if($this->creerProduit($request->nom_produit, $request->code_produit, $request, $request->description_produit)){
                return back()->with("success", "Nous sommes très heureux de vous informer que ce nouveau produit a été créé avec succès.");
            }

            else{
                return back()->with("erreur", "Pour des raisons techniques, vous ne pouvez pas créer ce nouveau produit pour le moment. Veuillez réessayer plus tard.");
            }
        }

        public function checkProduitExist($code_produit){
            return Produit::where("code_produit", "=", $code_produit)->exists();
        }

        public function creerProduit($nom, $code, $request, $description){
            $filename = time().$request->file('file')->getClientOriginalName();
            $path = $request->file->move('Produits_pictures', $filename);

            $produit = new Produit();
            $produit->nom_produit = $nom;
            $produit->code_produit = $code;
            $produit->image_produit = $path;
            $produit->description_produit = $description;

            return $produit->save();
        }

        public function ouvrirListeProduits(){
            return view("Produits.liste_produits");
        }

        public function gestionDeleteProduit(Request $request){
            if($this->deleteProduit($request->input("id_produit"))){
                return back()->with("success", "Nous sommes très heureux de vous informer que ce produit a été supprimé avec succès.");
            }

            else{
                return back()->with("erreur", "Pour des raisons techniques, vous ne pouvez pas supprimer ce produit pour le moment. Veuillez réessayer plus tard.");
            }
        }

        public function deleteProduit($id_produit){
            return Produit::where("id_produit", "=", $id_produit)->delete();
        }

        public function ouvrirProduit(Request $request){
            $produit = $this->getInformationsProduit($request->input("id_produit"));
            return view("Produits.produit", compact("produit"));
        }

        public function getInformationsProduit($id_produit){
            return Produit::where("id_produit", "=", $id_produit)->first();
        }

        public function ouvrirEditProduit(Request $request){
            $produit = $this->getInformationsProduit($request->input("id_produit"));
            return view("Produits.edit_produit", compact("produit"));
        }

        public function gestionUpdateProduit(Request $request){
            if($this->verifierProduirExisteNotActuel($request->code_produit, $request->input("id_produit"))){
                return back()->with("erreur_code", "Nous sommes désolés de vous informer que ce code est utilisé pour créer un autre produit.");
            }

            elseif($this->updateProduit($request->nom_produit, $request->code_produit, $request, $request->description_produit, $request->input("id_produit"))){
                return back()->with("success", "Nous sommes très heureux de vous informer que ce produit a été modifié avec succès.");
            }

            else{
                return back()->with("erreur", "Pour des raisons techniques, vous ne pouvez pas modifier ce produit pour le moment. Veuillez réessayer plus tard.");
            }
        }

        public function verifierProduirExisteNotActuel($code_produit, $id_produit){
            return Produit::where("code_produit", "=", $code_produit)->where("id_produit", "<>", $id_produit)->exists();
        }

        public function updateProduit($nom_produit, $code_produit, $request, $description_produit, $id_produit){
            if(is_null($request->file)){
                return Produit::where("id_produit", "=", $id_produit)->update([
                    "nom_produit" => $nom_produit,
                    "code_produit" => $code_produit,
                    "description_produit" => $description_produit
                ]);
            }

            else{
                $filename = time().$request->file('file')->getClientOriginalName();
                $path = $request->file->move('Produits_pictures', $filename);

                return Produit::where("id_produit", "=", $id_produit)->update([
                    "nom_produit" => $nom_produit,
                    "code_produit" => $code_produit,
                    "description_produit" => $description_produit,
                    "image_produit" => $path
                ]);
            }
        }
    }
?>