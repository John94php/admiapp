<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Contract;
class ContractForm extends Component
{
    public $name;
    public $lastname;
    public $dateofbirth;
    public $pesel;
    public $sex;
    public $idcard;
    public $contracttype;
    public $contractdate; // start date of contract
    public $corrcode;
    public $corrcountry;
    public $corrstate;
    public $corrcity;
    public $corrstreet;
    public $corrhouse;
    public $corrflat;
    public $code;
    public $country;
    public $state;
    public $city;
    public $street;
    public $house;
    public $flat;
protected $rules = [
    'name' =>'required',
    'lastname'=>'required',
    'sex'=>'required',
    'idcard' => 'required',
    'contracttype' => 'required',
    'contractdate' => 'required',
    'corrcode' => 'required',
    'corrcountry' => 'required',
    'corrstate' =>'required',
    'corrcity' =>'required',
    'corrstreet'=>'required',
    'corrhouse'=>'required',
    'corrflat' =>'required',
    'code' =>'required',
    'country'=>'required',
    'street'=>'required',
    'state' =>'required',
    'city' => 'required',
    'house'=>'required',
    'flat'=>'required'
];
    public function submit()
    {

     $this->validate();
     Contract::create([
         'name'=>$this->name,
         'lastname' =>$this->lastname,
         'dateofbirth' =>$this->dateofbirth,
         'pesel' =>$this->pesel,
         'sex' =>$this->sex,
         'idcard' =>$this->idcard,
         'contracttype' =>$this->contracttype,
         'contractdate' =>$this->contractdate,
         'corrcode' =>$this->corrcode,
         'corrcountry' =>$this->corrcountry,
         'corrstate' =>$this->corrstate,
         'corrcity'=>$this->corrcity,
         'corrstreet' =>$this->corrstreet,
         'corrhouse'=>$this->corrhouse,
         'corrflat'=> $this->corrflat,
         'code'=>$this->code,
         'country' =>$this->country,
         'state'=>$this->state,
         'city' =>$this->city,
         'street'=>$this->street,
         'house'=>$this->house,
         'flat'=>$this->flat,
     ]);
        session()->flash('message', 'Contract successfully added.');
    }
    public function render()
    {
        $states = DB::table('states')->get();
        $types = DB::table('types')->get();
        return view('livewire.contract-form',['states'=>$states,'types'=>$types]);
    }
}
