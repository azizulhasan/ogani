<?php

namespace App\Http\Controllers\Traits;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

trait StyleScriptTrait
{
    private function styleScriptAdd($value){
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
                
                '12'=>  'assets/backend/assets/vendor/parsley/parsley.js',
                
                
            ];
            return $scripts;
        }
        
    }
}
