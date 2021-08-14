<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrudeController extends Controller
{
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
    public function store(Request $req)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        // validate data before inseret to database
        
        $validator = Validator::make($req->all(),$rules,$messages);
        if ($validator -> fails()) {
            return redirect()->back()->withErrors($validator)->withInputs($req->all());
        }
        // insert the data
        Offer::create([
            'name' => $req['name'],
            'price' => $req['price'],
            'detailes' => $req['detailes']
        ]);
        return redirect()->back()->with(['success'=>'تم ادخال بيانات العرض بنجاح']);
    }
    protected function getRules(){
        $rules = [
            'name' => 'required|max:100|unique:offers,name',
            'price' => 'required|numeric',
            'detailes' => 'required'
        ];
        return $rules;
    }
    protected function getMessages(){
        $messages = [
            'name.required' => __('messages.offer name required'),
            'name.max' => __('messages.offer name must be less than 100 charachter'),
            'name.unique' => __('messages.offer name is already exist'),
            'price.required' => __('messages.price is required'),
            'price.numeric' => __('messages.price must be a number'),
            'detailes.required' => __('messages.offer detailes is required')
        ];
        return $messages;
    }
}
