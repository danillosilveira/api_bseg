<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfParser extends Controller
{
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
//    public function store(Request $request)
//    {
//        // 1º - receber o arquivo PDF e salvar em algum buraco
//        $file_named = md5(time() . rand(0, 666)) . '.' . request()->policy->getClientOriginalExtension();
//        request()->policy->move(public_path('policies_pdf'), $file_named);
//
//        $filename = public_path('policies_pdf/') . $file_named;
//        //2º - parsear os PDF pra HTML
//
//        $command = 'pdf2htmlEX ' . $filename . ' --dest-dir policies_html';
//        shell_exec($command);
//
//        //3º - Buscar as paradas no arquivo html
//        \phpQuery::newDocumentFileHTML($filename);
//
//        dd(pq('div .y52'));
//    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $file = public_path('policies_html/70f11db19faff6e05f7737bd55c40bf6.html');
        \phpQuery::newDocumentFileHTML($file);

        $titleElement = pq('.y12:first');
        $title = $titleElement->html();
        echo '<h2>Seguradora:</h2>';
        echo  $title;

//        $titleElement = pq('.y42:first');
//        $title = $titleElement->html();
//        echo '<h2>Apolice:</h2>';
//        echo  $title;
//
//        $titleElement = pq('.y49:last ');
//        $title = $titleElement->html();
//        echo '<h2>Marca / Modelo:</h2>';
//        echo  $title;
//
//        $titleElement = pq('.y9a');
//        $title = $titleElement->html();
//        echo '<h2>Combustivel:</h2>';
//        echo '<p>' . htmlentities( $title) . '</p>';
//
//        $titleElement = pq('.y8c:first ');
//        $title = $titleElement->html();
//        echo '<h2>Segurado:</h2>';
//        echo  $title;
        //echo '<p>' . htmlentities( $title) . '</p>';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}