<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;
use App\Traits\ApiTrait;
use Auth;

class DemandeController extends Controller
{
    use ApiTrait;
    //Create Demande
    public function createDemande(Request $request){
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
		$demande = Demande::create($input);
		return $this->apiSuccess($demande);
    }
    //Get all Demandes
    public function getDemandes(){
        return $this->apiSuccess(['demandes' => Demande::orderBy('created_at','desc')->paginate(9)]);
    }
    //Get user demandes
    public function userDemandes(){
        return $this->apiSuccess(['dmandes' => Demande::where('user_id', Auth::user()->id)->orderBy('created_at','desc')->get()]);
    }

}
