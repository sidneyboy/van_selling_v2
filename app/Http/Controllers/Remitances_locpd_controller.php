<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Collection;
use Illuminate\Http\Request;

class Remitances_locpd_controller extends Controller
{
    public function index()
    {
    	$agent = User::find(auth()->user()->id);
    	return view('remitances_locpd')
    		->with('active','remitances_locpd')
    		->with('agent', $agent);
    }

    public function remitances_locpd_generate_report(Request $request)
    {
    	$var = explode('-', $request->input('date_range'));
        $date_from = date('Y-m-d',strtotime($var[0]));
        $date_to = date('Y-m-d',strtotime($var[1]));
        $collection = Collection::whereBetween('date_collected', [$date_from, $date_to])->get();

        if (count($collection) != 0) {
            return view('remitances_locpd_generate_report',[
                'collection' => $collection
            ])->with('agent',$request->input('agent'))
              ->with('date_from',$date_from)
              ->with('date_to',$date_to);
        }else{
            return 'NO_DATA';
        }

    }

    public function remitances_locpd_generate_excel(Request $request)
    {
        
        // include 'vendor/autoload.php';
        // use PhpOffice\PhpSpreadsheet\IOFactory;

        // if(isset($_POST["file_content"]))
        // {
        //  $temporary_html_file = './tmp_html/' . time() . '.html';

        //  file_put_contents($temporary_html_file, $_POST["file_content"]);

        //  $reader = IOFactory::createReader('Html');

        //  $spreadsheet = $reader->load($temporary_html_file);

        //  $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

        //  $filename = time() . '.xlsx';

        //  $writer->save($filename);

        //  header('Content-Type: application/x-www-form-urlencoded');

        //  header('Content-Transfer-Encoding: Binary');

        //  header("Content-disposition: attachment; filename=\"".$filename."\"");

        //  readfile($filename);

        //  unlink($temporary_html_file);

        //  unlink($filename);

        //  exit;
        // }
    }
}
