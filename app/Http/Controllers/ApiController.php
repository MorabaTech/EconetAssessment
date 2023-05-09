<?php

namespace App\Http\Controllers;

use App\Enum\StatusCode;
use App\Http\Resources\ShopCollection;
use App\Http\Resources\ShopResource;
use App\Models\Area;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Exception;


class ApiController extends Controller
        {
            /*
             *
              * @bodyParam   shop_name    string  required    The name of the  shop.      Example: ECONET MASASA
              * @bodyParam   area_id    int  required    The area id of the  area.   Example: 1
             *
                * @response {
                *  "status": "Success",
                *  "message": "Shop created Successfully",
                * }
                 *
                 * /
                 */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'shop_name'=>'required|string|',
            'area_id' => 'required'
        ]);

        if ($validator->fails()) {
            $message = "Bad Request, Please check all the requirements";
            return response([
                'status'=>'Error',
                'message' => $message
            ], 400);

        } else {

            try {

                if(is_null(Area::find($request->area_id)))
                {
                    return response([
                        'status'=>'Error',
                        'message' => 'Area id doesnt exist'
                    ], 400);

                }

                Shop::insert([
                    'created_at'=> Carbon::now(),
                    'updated_at'=>Carbon::now(),
                    'shop_name'=>strtoupper($request->shop_name),
                    'area_id' =>$request->area_id
                ]);

                $message = "Shop inserted Successfully";

                return response([
                    'status'=>'Success',
                    'message' => $message
                ], 200);

            }catch (Exception $exception )

            {
                return response([
                    'status'=>'Error',
                    'message' => $exception->getMessage()
                ], 400);
            }

        }
    }

    public function getShopsByArea($id)
    {

        try
        {
            $area = Area::findOrFail($id);

            return response([
                'status'=>'Success',
                new  ShopCollection($area->shops)
            ], 200);

        }
        catch(\Exception $e)
        {
            $message = "No Query Results for this area";
            return response([
                'status'=>'Error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /*
             *
              * @bodyParam   area_name    string  required    The name of the  area. Example: HARARE CBD

             *
                * @response {
                *  "status": "Success",
                *  "message": "Area created Successfully",
                * }
                 *
                 * /
                 */
    public function createArea(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'area_name'=>'required|string|'
        ]);

        if($validator->fails())
        {
            return response([
                'status'=>'Error',
                'message'=>"Something went wrong"
            ], 400);
        }else
        {
            Area::insert([
                'created_at'=> Carbon::now(),
                'updated_at'=>Carbon::now(),
                'area_name'=>$request->area_name
            ]);

            return response([
                'status'=>'Success',
                'message'=>"Area created Successfull"
            ], 200);
        }
    }

    public function getArea()
    {
        return response([
            'status'=>'Success',
            'data'=>Area::all()
        ], 200);

    }
}
