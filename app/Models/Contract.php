<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $table = "contracts";
    protected $fillable = [
      "name",
      "lastname",
      "pesel",
      "dateofbirth",
      "sex",
      "idcard",
      "contracttype",
      "contractdate",
      "corrcode",
      "corrcountry",
      "corrstate",
      "corrcity",
      "corrstreet",
      "corrhouse",
      "corrflat",
      "code",
      "country",
      "state",
      "city",
      "street",
      "house",
      "flat"
        ];
}
