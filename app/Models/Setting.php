<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'HeaderLogo',
        'herobgimage',
        'heading',
        'SubHeading',
        'ButtonLink',
        'FooterLogo',
        'FooterDescription',
        'Footerfb',
        'Footeryt',
        'Footerinsta',
        'copyright',
    ];
}
