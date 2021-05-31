<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce;
use App\Http\Requests\AnnonceRequest;
use App\Traits\ApiTrait;
use Auth ;

class AnnonceController extends Controller
{
    use ApiTrait;

    public function createAnnonce(AnnonceRequest $request)
	{
		$input = $request->all();
        $input['user_id'] = Auth::user()->id;
		$annonce = Annonce::create($input);
		return $this->apiSuccess($annonce);
	}

    public function getAnnonces() {
        return $this->apiSuccess(['annonces' => Annonce::orderBy('created_at', 'desc')->paginate(9)]);
    }

    public function userAnnonces() {
        return $this->apiSuccess(['annonces' => Annonce::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get()]);
    }

    public function updateAnnonce(AnnonceRequest $request, Annonce $annonce) {

        if($annonce->user_id === Auth::user()->id) {
            $annonce->update($request->all());
            return $this->apiSuccess(true);
        }
        return $this->apiError(false);
    }

    public function getAnnonce(Annonce $annonce) {

        if($annonce->user_id === Auth::user()->id) {
            return $this->apiSuccess(['annonce' => $annonce]);
        }
        return $this->apiError(false);
    }

    public function deleteAnnonce(Annonce $annonce) {

        if($annonce->user_id === Auth::user()->id) {
            $annonce->delete();
            return $this->apiSuccess(true);
            
        }
        return $this->apiError(false);
    }
    
}
