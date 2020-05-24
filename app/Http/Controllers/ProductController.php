<?php

namespace App\Http\Controllers;

use App\Product;
//Llamando al modleo books
use App\Book;
use DB;
use Illuminate\Http\Request;
//Para usar Excel
use Maatwebsite\Excel\Facades\Excel;
//Para usar PDF
use Barryvdh\DomPDF\Facade as PDF;


class ProductController extends Controller
{

    //Leyendo archivo
    public function lectura_csv()
    {
        //Esto también funciona con archivos de tipo xlsx o xls.
    	Excel::load('files\books.csv', function($reader) {

            foreach($reader->get() as $book){
                $libro = new Book();
                $libro->name    = $book->title;
                $libro->author   = $book->author;
                $libro->year    = $book->publication_year;


                if(!empty($libro))
                    $libro->save();

                unset($libro);
            }

        });      

        echo "Exito";
    }

    //Generando un archivo xlsx
    public function generar_xlsx()
    {

        //Buscamos los productos
        $data = Product::all();

        Excel::create('archivo_ejemplo', function ($excel) use ($data) {
            
            /** La hoja se llamará products, esto si se pretende usar una vista blade.php */
             $excel->sheet('products', function ($sheet) {
                //El método loadView nos carga la vista blade a utilizar 
                $sheet->loadView('pages.products');
            }); 
            
            //Leyendo desde la base de datos los productos
            /** Agregará una segunda hoja y se llamará Productos */
            $excel->sheet('Productos', function ($sheet) use ($data) {
                    $sheet->with($data,null,'A1',false,false);           
            });
        })->download('xlsx');
    

        echo "Exito 2";
    }

    //Creando un pdf
    public function pdf()
    {
        //Se puede usar análogo a las vistas de Excel
        $pdf = PDF::loadView('pages.products');

        return $pdf->download('listado.pdf');

    }

    public function pdf2()
    {
        //Se puede usar análogo a las vistas de Excel, pasando variables
        $products = Product::all();
        $pdf = PDF::loadView('pages.productspdf', compact('products'));

        return $pdf->download('listado2.pdf');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
