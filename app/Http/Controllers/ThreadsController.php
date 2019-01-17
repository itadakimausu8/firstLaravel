<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

use App\Http\Requests\HelloRequest;

use Illuminate\Support\Facades\DB;

global $head, $style, $body, $end;


$head = '<html><head>';
$style = <<<EOF
<style>
body {font-size:16pt; color:#999; }
h1 { font-size:100pt; text-align:right; color:#eee;
   margin:-40px 0px -50px 0px; }
</style>
EOF;
$body = '</head><body>';
$end = '</body></head>';

function tag($tag, $txt) {
   return "<{$tag}>" . $txt . "</{$tag}>";
}

class ThreadsController extends Controller
{
  

public function index(Request $request,$keyword = null,$search = null)
    {
        // $user = Auth::user();
        $keyword = $request->input('keyword');
        $search = $request->input('search');
        
        $table_name = "sample";
        if($search == "ユーザー検索")
        {
            $search = "user_name";
        }
        elseif($search =="内容検索"){
            $search = "content";
        }
        elseif($search == "チャンネル名検索"){
            $search = "channel";
        }
        else{
            $search = "content";
        }
        
        $queries= "select * from " .strval($table_name) ." where " . strval($search). " LIKE \"%" . strval($keyword) . "%\" and id > 1 and user_name != \"チャンネルの参加\"";
        $items = DB::select($queries);

        $data = ['msg' => 'これはコントローラーから渡されたメッセージです。',
                 'items' => $items,
                 'keyword' => $keyword,
                 'search' => $search];

        return view('threads.index', $data);
    }

    public function csv(Request $request)
    {

        // $user = Auth::user();
        $keyword = $request->input('keyword');
        $search = $request->input('search');
        
        $table_name = "sample";
        if($search == "ユーザー検索")
        {
            $search = "user_name";
        }
        elseif($search =="内容検索"){
            $search = "content";
        }
        elseif($search == "チャンネル名検索"){
            $search = "channel";
        }
        else{
            $search = "content";
        }
        
        $queries= "select * from " .strval($table_name) ." where " . strval($search). " LIKE \"%" . strval($keyword) . "%\" and id > 1 and user_name != \"チャンネルの参加\"";
        $items = DB::select($queries);


        //csv

        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=cpsSlackThreads.csv");
        header("Content-Transfer-Encoding: binary");
        $csv = null;

        // 1行目のラベルを作成
        $csv = '"id","user_name","content","time","channel"' . "\n";

        // 出力データ生成
        foreach( $items as $item ) {
            $csv .= '"' . strval($item -> id) . '","' . strval($item -> user_name) . '", "' . strval($item -> content) . '","' . strval($item -> time) . '","' . strval($item -> channel).'"' . "\n";
        }

        // CSVファイル出力
        echo $csv;

        $data = ['msg' => 'これはコントローラーから渡されたメッセージです。',
                 'csv' => $csv,
                 'items' => $items,
                 'keyword' => $keyword,
                 'search' => $search];

        
        return view('threads.index', $data);
    }

    private function wrapCSV($_str){  
      return '"'.mb_ereg_replace('"', '""', $_str).'"';
    }
}