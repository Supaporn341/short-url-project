<?php

namespace App\Http\Controllers;

use App\ShortUrll;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function index() {
        $urls = ShortUrll::all();
        return view('index',compact('urls'));
    }

    public function create() {
        $count = ShortUrll::count();
        if ($count >= 10){
            return 'เกินโควต้าที่ใช้ได้';
        }
        return view('create');
    }

    public function store(Request $request) {
        $long_url = $request->get('long_url');
        $short_url = $this->randString();
        ShortUrll::create([
            'long_url'=>$long_url,
            'short_url'=>$short_url
        ]);

        return redirect('/')->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
    }

    public function randString() {
        $charecters = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';

        $charLength = strlen($charecters);
        $numLength = strlen($numbers);
        $string = '341';
        for ($i=0;$i<3;$i++){
            $string.=$charecters[rand(0,$charLength-1)];
        }
        for ($i=0;$i<2;$i++){
            $string.=$numbers[rand(0,$numLength-1)];
        }

        return $string;
    }

    public function check($code) {
        $result = ShortUrll::Where('short_url',$code)->first();
        if ($result) {
            return redirect()->away($result->long_url);
        }
        return 'ไม่พบรหัส Short URL นี้';
    }
}
