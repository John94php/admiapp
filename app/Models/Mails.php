<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mails extends Model
{
    use HasFactory;
    protected $table = "mails";
    protected $fillable = [
      "mail_sender",
      "mail_recipient",
      "mail_title",
      "mail_body",
      'mail_attachmentflag',
        'mail_attachment1',
        'mail_attachment2',
        'mail_attachment3',
        'mail_attachment4',
        'mail_dw',
        'mail_udw',
        'mail_folder',
        'mail_status'
    ];
}
