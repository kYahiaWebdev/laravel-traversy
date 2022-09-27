<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class tagController extends Controller
{
    public function suggest(Request $req){
        $search = $req->name;
        $tags = Tag::all()->toArray();
        // dd($tags);
        
        $suggest = [];
        foreach($tags as $tag){
            if(stristr($search, substr($tag['name'], 0, strlen($search)))){
                    $suggest[] = $tag;
            }
        }
        // dd($suggest);
        
        $res = "";
        foreach ($suggest as $key => $value) {
            if ($key == 0){
                $res .= '"' . $value['id'] . '":"' . $value['name'] . '"';
            } else {
                $res .= ',"' . $value['id'] . '":"' . $value['name'] . '"';
            }
        }
        // dd($res);
        return "{" . $res . "}";
    }

    // public function destroy(Tag $id){
    //     $id->delete();
    //     // dd($id);
    //     return redirect('/')->with('message', 'User deleted succesfully');
    // }

}
