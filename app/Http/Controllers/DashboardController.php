<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Model\Product;
use Illuminate\Routing\Route;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $styles = [
            '0'=> 'assets/backend/assets/vendor/charts/chartist-bundle/chartist.css',
            '1'=> 'assets/backend/assets/vendor/charts/morris-bundle/morris.css',
            '2'=> 'assets/backend/assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css',
            '3'=> 'assets/backend/assets/vendor/charts/c3charts/c3.css',
            '4'=> 'assets/backend/assets/vendor/fonts/flag-icon-css/flag-icon.min.css'
        ];
        $scripts = [
            '0'=> 'assets/backend/assets/vendor/charts/chartist-bundle/chartist.min.js',
            '1'=> 'assets/backend/assets/vendor/charts/sparkline/jquery.sparkline.js',
            '2'=> 'assets/backend/assets/vendor/charts/morris-bundle/raphael.min.js',
            '3'=> 'assets/backend/assets/vendor/charts/morris-bundle/morris.js',
            '4'=> 'assets/backend/assets/vendor/charts/c3charts/c3.min.js',
            '5'=> 'assets/backend/assets/vendor/charts/c3charts/d3-5.4.0.min.js',
            '6'=> 'assets/backend/assets/vendor/charts/c3charts/C3chartjs.js',
            '7'=> 'assets/backend/assets/libs/js/dashboard-ecommerce.js'
        ];
       
        return view('dashboard.index')->with(['scripts'=> $scripts, 'styles'=> $styles]);
    }

   
    

    public function categoryAdd(){
        return view('dashboard.category_add')->with(['styles'=>$this->styleScriptAdd('styles'), 'scripts'=> $this->styleScriptAdd('scripts') ]);
    }
    public function subCategoryAdd(){
        return view('dashboard.sub_category_add')->with(['styles'=>$this->styleScriptAdd('styles'), 'scripts'=> $this->styleScriptAdd('scripts') ]);
    }
    public function attributeAdd(){
        return view('dashboard.attribute_add')->with(['styles'=>$this->styleScriptAdd('styles'), 'scripts'=> $this->styleScriptAdd('scripts') ]);
    }
    public function unitAdd(){
        return view('dashboard.unit_add')->with(['styles'=>$this->styleScriptAdd('styles'), 'scripts'=> $this->styleScriptAdd('scripts') ]);
    }
    public function userAdd(){

        $rolls = DB::select('select * from rolls');
        $users = User::all();
        $styles =[]; $scripts=[];
        return view('dashboard.user_add')->with(['styles'=>$styles, 'scripts'=> $scripts, 'rolls'=> $rolls , 'users'=>$users ]);
    }

    protected function styleScriptAdd($value){
        if($value == 'styles'){
            $styles = [
                '0'=> 'assets/backend/assets/vendor/datatables/css/dataTables.bootstrap4.css',
                '1'=> 'assets/backend/assets/vendor/datatables/css/buttons.bootstrap4.css',
                '2'=> 'assets/backend/assets/vendor/datatables/css/select.bootstrap4.css',
                '3'=> 'assets/backend/assets/vendor/datatables/css/fixedHeader.bootstrap4.css',
    
            ];
            return $styles;
        }
        if($value == 'scripts'){
            $scripts = [
                '0'=>  'assets/backend/assets/vendor/datatables/js/dataTables.bootstrap4.min.js',
                '1'=>  'https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                '2'=>  'assets/backend/assets/vendor/datatables/js/dataTables.bootstrap4.min.js',
                '3'=>  'https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js',
                '4'=>  'assets/backend/assets/vendor/datatables/js/buttons.bootstrap4.min.js',
                '5'=>  'assets/backend/assets/vendor/datatables/js/data-table.js',
                
                '6'=>  'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js',
                '7'=>  'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js',
                '8'=>  'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js',
                '9'=>  'https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js',
                '10'=>  'https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js',
                '11'=>  'https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js',
                '12'=>  'assets/backend/assets/libs/js/product_add.js',
                '13'=>  'assets/backend/assets/vendor/parsley/parsley.js',
                
            ];
            return $scripts;
        }
        
    }
}
