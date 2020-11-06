<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function index(){
//        $email = new \SendGrid\Mail\Mail();
//        $email->setFrom("no-reply@driedsponge.net", "DriedSponge.net");
//        $email->setSubject("This is a test email");
//        $email->addTo("jortuck0810@gmail.com", "Example User");
//        $email->addTo("walruskinggaming@gmail.com", "Example User");
//        $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
//        $email->addContent(
//            "text/html", "<strong>This is a test email</strong>"
//        );
//        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
//        try {
//            $response = $sendgrid->send($email);
//            print $response->statusCode() . "\n";
//            print_r($response->headers());
//            print $response->body() . "\n";
//        } catch (Exception $e) {
//            echo 'Caught exception: '. $e->getMessage() ."\n";
//        }
        return view('pages.index');

    }
    public function webprojects(){

        return view('pages.webprojects');
    }
    public function about(){
        $title = 'About us';
        return view('pages.about')->with('title',$title);
    }
    public function services(){
        $data = array(
            'title'=>'Services',
            'services'=>['Web design','prgramming','SEO']
        );
        return view('pages.services')->with($data);
    }
}
