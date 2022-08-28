<?php

namespace App\Http\Controllers;

use App\Models\ObjectTest;
use App\Models\ObjectTestMongo;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    public function test(){

        echo "hello lumen docker, execute order 66";
        
    }

    /**
     * save Eloquent mongodb jessenbers
     *
     * @return void
     */
    public function testSaveMongoModel(){

        $Test = new ObjectTestMongo();

        $Test->attribute_test = "hola";

        $Test->save();
    }

    /**
     * save Eloquent mongodb jessenbers
     *
     * @return void
     */
    public function testSaveEloquent(){

        $Test = new ObjectTest();

        $Test->attribute_test = "hola";

        $Test->save();
    }
    //
}
