<?php

namespace Modules\Media\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Platform\Core\Http\Controllers\AppBaseController;

class MediaController extends AppBaseController
{
    public function index()
    {
        return view('media::index');
    }

    public function data()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "http://192.168.44.127/xibo-cms/web/api/display",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer hKG9AqOUXoRm71GhnKlDVioUrodeItEBtPzoXbjl",
            "Cookie: PHPSESSID=0bbvrfn1d4r73hl3osh1qe9evq"
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        dd($response);
    }

    public function store()
    {
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://192.168.44.127/xibo-cms/web/api/library",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array('files'=> new CURLFILE('/C:/Users/thena/Pictures/banana.jpg'),'name' => 'API UPLOAD'),
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer YS2HFRMUOFvIdiITv0o8g19yNznDmR0MOOhkhbml",
                "Cookie: PHPSESSID=0bbvrfn1d4r73hl3osh1qe9evq"
            ),
        ));
          
        $response = curl_exec($curl);
        
        curl_close($curl);
        echo $response;
    }

    public function patch()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://192.168.44.127/xibo-cms/web/api/library/157",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => "name=jagung&duration=10&retired=0&tags=0&updateInLayouts=0",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer YS2HFRMUOFvIdiITv0o8g19yNznDmR0MOOhkhbml",
                "Content-Type: application/x-www-form-urlencoded",
                "Cookie: PHPSESSID=0bbvrfn1d4r73hl3osh1qe9evq"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public function delete()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "http://192.168.44.127/xibo-cms/web/api/library/156",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "DELETE",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer YS2HFRMUOFvIdiITv0o8g19yNznDmR0MOOhkhbml",
            "Cookie: PHPSESSID=0bbvrfn1d4r73hl3osh1qe9evq"
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public function main()
    {
        return response()->json(["status" => "ok"]);
    }
}
