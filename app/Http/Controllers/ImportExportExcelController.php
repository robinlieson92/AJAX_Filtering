<?php

namespace App\Http\Controllers;
use Session, Excel;
use Illuminate\Support\Facades\Input;
use DB;
use App\Article;


use Illuminate\Http\Request;

class ImportExportExcelController extends Controller
{
    public function exportExcelArticles()
    {
    	$data = Article::get()->toArray();
    	return Excel::create('ExportArticles', function($excel) use ($data) {
    		$excel->sheet('sheetArticles', function($sheet) use ($data)
    		{
    			$sheet->fromArray($data);
    			$sheet->freezeFirstRow();
    		});
    	})->download('xls');
    }

    public function importExcelArticles()
    {
        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    $insert[] = [
                    'title' => $value->title, 
                    'content' => $value->content,
                    'writer' => $value->writer
                    ];
                }
                if(!empty($insert)){
                    DB::table('articles')->insert($insert);
                    dd('Insert Record successfully.');
                }
            }
        }
        return back();
    }
}
