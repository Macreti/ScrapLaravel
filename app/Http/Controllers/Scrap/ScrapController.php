<?php

namespace App\Http\Controllers\Scrap;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PHPHtmlParser\Dom;

class ScrapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url = 'https://jabeas.com/';

        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url
        ));

        $response = curl_exec($ch);
        curl_close( $ch );
        //$html = htmlspecialchars($response); //To visualise html code.
        //echo $html;
        $start = stripos($response, 'class="resp-slider-container"');
        //dd($start);
        $end = stripos($response, 'class="vc_row-full-width vc_clearfix"', $offset = $start);
        $length = $end - $start;
        $htmlSection = substr($response, $start, $length);
        $dom = new Dom;
        $test = $dom->loadStr($htmlSection);
        $a = $test->find('.item.product.clearfix');
        //echo count($a);

        foreach ($a as $content)
        {
            // do something with the html
            $html = htmlspecialchars($content->innerHtml);

            echo "{$html}";
        }
        /*preg_match_all('@<div class="item product clearfix">(.+)</div>@', htmlspecialchars($htmlSection), $matches);
        $listItems = $matches[1];

        foreach ($listItems as $item) {
            echo "{$item}\n\n";
        }*/

        //return htmlspecialchars($htmlSection);
    }

    public function getHtml(){
        $html = file_get_contents('https://jabeas.com/');
        $html = htmlspecialchars($html);

        echo $html;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
