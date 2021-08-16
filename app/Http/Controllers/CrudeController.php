<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Models\Video;
use App\Traits\UploadTrait;
// use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use LaravelLocalization;

class CrudeController extends Controller
{
    // use OfferTrait;
    use UploadTrait;
    public function __construct()
    {
        
    }
    public function getOffers()
    {
        return Offer::get();
    }
    // public function store()
    // {
    //     Offer::create([
    //         'name' => 'offer3',
    //         'price' => '5000',
    //         'detailes' => 'offer detailes',
    //     ]);
    //     return 'Coulmn added into table ';
    // }
    public function create()
    {
        return view('offers/create');
    }
    public function store(OfferRequest $req)
    {
        /*
        $rules = $this->getRules();
        $messages = $this->getMessages();
        // validate data before inseret to database
        
        $validator = Validator::make($req->all(),$rules,$messages);
        if ($validator -> fails()) {
            return redirect()->back()->withErrors($validator)->withInputs($req->all());
        }
        */


        //save photo in folder
        // $file_extension = $req['photo']->getClientOriginalExtension();
        // $file_name = time().'.'.$file_extension;
        // $path = 'images/offers';
        // $req['photo']->move($path,$file_name);

        $file_name = $this->saveImage('offers','offer',$req['photo']);
        // insert the data
        Offer::create([
            'photo' => $file_name,
            'name_ar' => $req['name_ar'],
            'name_en' => $req['name_en'],
            'price' => $req['price'],
            'detailes_ar' => $req['detailes_ar'],
            'detailes_en' => $req['detailes_en']
        ]);
        return redirect()->back()->with(['success'=>__('messages.data entered successfully')]);
    }
    // protected function getRules(){
    //     $rules = [
    //         'name' => 'required|max:100|unique:offers,name',
    //         'price' => 'required|numeric',
    //         'detailes' => 'required'
    //     ];
    //     return $rules;
    // }
    // protected function getMessages(){
    //     $messages = [
    //         'name.required' => __('messages.offer name required'),
    //         'name.max' => __('messages.offer name must be less than 100 charachter'),
    //         'name.unique' => __('messages.offer name is already exist'),
    //         'price.required' => __('messages.price is required'),
    //         'price.numeric' => __('messages.price must be a number'),
    //         'detailes.required' => __('messages.offer detailes is required')
    //     ];
    //     return $messages;
    // }

    public function getAllOffers()
    {
        $offers = Offer::select(
        'id',
        'name_'.LaravelLocalization::getCurrentLocale().' as name',
        'price',
        'detailes_'.LaravelLocalization::getCurrentLocale().' as detailes',
        'photo'
        ) -> get(); // rerturn collection
        return view('offers.all',compact('offers'));
    }
    public function editOffer($offer_id){
        // Offer::findOrFail($offer_id);  
        $check = Offer::find($offer_id);
        if(!$check)
            return redirect()->back(); 
        
        $offer = Offer::select('id','name_ar','name_en','price','detailes_ar','detailes_en') -> find($offer_id);
        return view('offers.edit',compact('offer'));
        return $offer_id;
    }
    public function updateOffer(OfferRequest $req, $offer_id){
        //Validation 
        //Check if offer exist
        $offer = Offer::select('id','name_ar','name_en','price','detailes_ar','detailes_en') -> find($offer_id);
        if (!$offer) {
            return redirect()->back();
        }
        //update data
        $offer -> update($req->all());
        /*$offer->update([
            "name_ar" => $req['name_ar'],
            "name_en" => $req['name_en'],
            "price" => $req['price'],
            "detailes_ar" => $req['detailes_ar'],
            "detailes_en" => $req['detailes_en'],
        ])*/
        return redirect()->back()->with(['success'=>__('messages.edit done')]);
    }
    // protected function saveImage($photo,$folder){
    //     $file_extension = $photo->getClientOriginalExtension();
    //     $file_name = time().'.'.$file_extension;
    //     $path = $folder;
    //     $photo->move($path,$file_name);
    //     return $file_name;
    // }

    public function delete($offer_id){
        //check if offer id exist 
        $offer = Offer::find($offer_id);
        if (!$offer) {
            return redirect()->back()->with(['error'=>__('messages.offer does not exist')]);
        }
        $offer->delete();
        return redirect()
        ->route('Offer.all')
        ->with(['success'=>__('messages.deleted successfully')]);
    }
    public function getVideo(){
        $video = Video::first();
        // return view('video',compact('video'));
        event(new VideoViewer($video));
        return view('video')->with(['video'=>$video]);
    }


}