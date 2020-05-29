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
//Enviando alertas interactivas
use Illuminate\Support\Facades\Session; 
//use Illuminate\Support\Facades\Redirect;


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
        })->save('xlsx')->download('xlsx');
        //Por defecto guarda el archivo e storage/exports
    

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

    //Subir archivo. url:host/uploadfile
    public function page_upload_file()
    {
        return view('pages.subir_archivo');
    }

    //Archivo se guarda
    public function upload_file(Request $request)
    {
        //Recuerde que para acceder al storage, se debe ejecutar en la terminal
        // php artisan storage:link
        //obtenemos el campo file definido en el formulario
        $file = $request->file('archivo');
        //obtenemos el nombre del archivo
        $nombre = $file->getClientOriginalName();
        //Conocemos la extensión del archivo
        $extension = $file->extension();
        
        /* Forma 1 de guardado, se guarda el archivo desencriptado */
        //indicamos que queremos guardar un nuevo archivo en el disco local, en storage/public
        \Storage::disk('local')->put("public/".$nombre,  \File::get($file));

        /* Forma 2, se guarda de forma encriptada, descomentar siguiente línea */
        //$file->store('public');
        Session::flash('message', 'Éxito!!!');
        //return redirect()->back();
        return redirect()->route('pagina-subirArchivo');
        //return redirect()->route('pagina-subirArchivo')->with('message','Exito!!'); //Con este método se omite el Session

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
