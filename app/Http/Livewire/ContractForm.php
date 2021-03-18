<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contract;
class ContractForm extends Component
{
    public $name;
    public $lastname;
    public $datebirth;
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

    public function submit()
    {
    $data = $this->validate([
       'name'=>'required|min:2',
        'lastname'=>'required',
        'pesel' =>'|min:9,max:9',
        'dateofbirth',
        'sex',
        'idcard' =>'|min:9,max:9',
        'contracttype'=>'required',
        'contractdate'=>'required',
        'corrcode' => 'required',
        'corrcountry' =>'required',
        'corrstate'=>'required',
        'corrcity' => 'required',
        'corrhouse' => 'required',
        'corrflat' => 'required',
        'code' => 'required',
        'country' => 'required',
        'state'=>'required',
        'city' => 'required',
        'street' => 'required',
        'house'=>'required',
        'flat'=>'required'
    ]);
    Contract::create($data);
    return redirect()->to('contract');
    }
    public function render()
    {
        return view('livewire.contract-form');
    }
}
