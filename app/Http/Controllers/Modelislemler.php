<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bilgiler;

class Modelislemler extends Controller
{
    public function list()
    {
        // $bilgi=Bilgiler::get();
        // $bilgitek=Bilgiler::where("id",2)->first();
        // $bilgitek=Bilgiler::whereId(2)->first();
        // $bilgitek=Bilgiler::whereMetin("Bu örnek 2 bir metin bilgisidir")->first();
        $bilgitek=Bilgiler::find(2);

        echo $bilgitek->metin;
    }

    public function ekle()
    {
        Bilgiler::create([
            "metin"=>"Bu metin modelekle ile eklenmiştir",
        ]);

        echo "eklendi!";
    }

    public function guncelle()
    {
        Bilgiler::find(5)->update([
            "metin"=>"Bu metin modelekle ile guncellenmistir",
        ]);

        echo "guncellendi!";
    }


    public function sil()
    {
        Bilgiler::find(4)->delete();

        echo "silindi!";
    }

}
