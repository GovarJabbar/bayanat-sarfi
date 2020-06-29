<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/get_ayah/{surah}/{ayah}', function ($surah,$ayah) {
    $text_ayah = \DB::table('quran')->where('surah',$surah)->where('ayah',$ayah)->get();
    $sarf = \DB::table('sarf')->where('surah',intval($surah))->where('ayah',intval($ayah))->get();

    return  [
        'ayah' => $text_ayah,
        'sarf' => $sarf,
    ];
});