<?php

namespace App\Http\Controllers;

use App\Models\ModelProduct;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ControllerVerification;

class ControllerProduct extends Controller
{
    static public function getAll(Request $request){
        try{
            $id_category = ControllerVerification::check_number($request->id_category);

            $all = DB::table('furniture_product')
            ->leftJoin('furniture_dict_category', 'furniture_product.id_category', '=', 'furniture_dict_category.id')
            ->leftJoin('furniture_dict_manufacturer', 'furniture_product.id_manufacturer', '=', 'furniture_dict_manufacturer.id')
            ->leftJoin('furniture_dict_coverage', 'furniture_product.id_coverage', '=', 'furniture_dict_coverage.id')
            ->leftJoin('furniture_dict_locktype', 'furniture_product.id_locktype', '=', 'furniture_dict_locktype.id')
            ->leftJoin('furniture_dict_purpose', 'furniture_product.id_purpose', '=', 'furniture_dict_purpose.id')
            ->leftJoin('furniture_dict_shape', 'furniture_product.id_shape', '=', 'furniture_dict_shape.id')

            ->leftJoin('furniture_dict_color as colorFacade', 'furniture_product.id_color_facade', '=', 'colorFacade.id')
            ->leftJoin('furniture_dict_color as colorBody', 'furniture_product.id_color_body', '=', 'colorBody.id')
            ->leftJoin('furniture_dict_color as colorFrame', 'furniture_product.id_color_frame', '=', 'colorFrame.id')
            ->leftJoin('furniture_dict_color as colorWorkingsurface', 'furniture_product.id_color_workingsurface', '=', 'colorWorkingsurface.id')
            ->leftJoin('furniture_dict_material as materialFacade', 'furniture_product.id_material_facade', '=', 'materialFacade.id')
            ->leftJoin('furniture_dict_material as materialBody', 'furniture_product.id_material_body', '=', 'materialBody.id')
            ->leftJoin('furniture_dict_material as materialFrame', 'furniture_product.id_material_frame', '=', 'materialFrame.id')
            ->leftJoin('furniture_dict_material as materialWorkingsurface', 'furniture_product.id_material_workingsurface', '=', 'materialWorkingsurface.id')
            
            ->select(
                'furniture_product.id as id', 
                'furniture_product.name as productName',
                
                'furniture_product.length as productLength',
                'furniture_product.width as productWidth',
                'furniture_product.height as productHeight',
                'furniture_product.depth as productDepth',

                'furniture_product.id_category as id_category', 
                'furniture_product.id_manufacturer as id_manufacturer', 
                'furniture_product.id_coverage as id_coverage', 
                'furniture_product.id_locktype as id_locktype', 
                'furniture_product.id_purpose as id_purpose', 
                'furniture_product.id_shape as id_shape', 

                'furniture_product.id_color_facade as id_color_facade', 
                'furniture_product.id_color_body as id_color_body', 
                'furniture_product.id_color_frame as id_color_frame', 
                'furniture_product.id_color_workingsurface as id_color_workingsurface', 
                'furniture_product.id_material_facade as id_material_facade', 
                'furniture_product.id_material_body as id_material_body', 
                'furniture_product.id_material_frame as id_material_frame', 
                'furniture_product.id_material_workingsurface as id_material_workingsurface', 

                'furniture_dict_category.name as categoryName',
                'furniture_dict_manufacturer.name as manufacturerName',
                'furniture_dict_coverage.name as coverageName',
                'furniture_dict_locktype.name as locktypeName',
                'furniture_dict_purpose.name as purposeName',
                'furniture_dict_shape.name as shapeName',

                'colorFacade.name as colorFacadeName',
                'colorBody.name as colorBodyName',
                'colorFrame.name as colorFrameName',
                'colorWorkingsurface.name as colorWorkingsurfaceName',
                'materialFacade.name as materialFacadeName',
                'materialBody.name as materialBodyName',
                'materialFrame.name as materialFrameName',
                'materialWorkingsurface.name as materialWorkingsurfaceName',

                'furniture_product.filePath as filePath',
            )

            ->where(
                'furniture_product.id_category', 
                $id_category!=0 ? '=':'!=', 
                $id_category!=0 ? $id_category:0
            )

            ->get();

            return $all;
        }catch(Exception $err){
            return $err->getMessage();
        }
    }
    static public function getAllparameters(Request $request){
        try{
            $id_category = ControllerVerification::check_number($request->id_category);

            $manufacturersFilter = ControllerVerification::check_array($request->manufacturersFilter);
            $coveragesFilter = ControllerVerification::check_array($request->coveragesFilter);
            $purposesFilter = ControllerVerification::check_array($request->purposesFilter);
            $shapesFilter = ControllerVerification::check_array($request->shapesFilter);

            $colors_facadeFilter = ControllerVerification::check_array($request->colors_facadeFilter);
            $colors_bodyFilter = ControllerVerification::check_array($request->colors_bodyFilter);
            $colors_frameFilter = ControllerVerification::check_array($request->colors_frameFilter);
            $colors_workingsurfaceFilter = ControllerVerification::check_array($request->colors_workingsurfaceFilter);
            $materials_facadeFilter = ControllerVerification::check_array($request->materials_facadeFilter);
            $materials_bodyFilter = ControllerVerification::check_array($request->materials_bodyFilter);
            $materials_frameFilter = ControllerVerification::check_array($request->materials_frameFilter);
            $materials_workingsurfaceFilter = ControllerVerification::check_array($request->materials_workingsurfaceFilter);


            $str_filter_id_category = $id_category!=0 ? " furniture_product.id_category = $id_category " : " 1 ";

            $str_filter_manufacturers = count($manufacturersFilter)>0 ?
            " furniture_product.id_manufacturer in (".ControllerVerification::array_to_string($manufacturersFilter).") " : " 1 ";
            $str_filter_coverages = count($coveragesFilter)>0 ?
            " furniture_product.id_coverage in (".ControllerVerification::array_to_string($coveragesFilter).") " : " 1 ";
            $str_filter_purposes = count($purposesFilter)>0 ?
            " furniture_product.id_purpose in (".ControllerVerification::array_to_string($purposesFilter).") " : " 1 ";
            $str_filter_shapes = count($shapesFilter)>0 ?
            " furniture_product.id_shape in (".ControllerVerification::array_to_string($shapesFilter).") " : " 1 ";
            
            $str_filter_colors_facade = count($colors_facadeFilter)>0 ?
            " furniture_product.id_color_facade in (".ControllerVerification::array_to_string($colors_facadeFilter).") " : " 1 ";
            $str_filter_colors_body = count($colors_bodyFilter)>0 ?
            " furniture_product.id_color_body in (".ControllerVerification::array_to_string($colors_bodyFilter).") " : " 1 ";
            $str_filter_colors_frame = count($colors_frameFilter)>0 ?
            " furniture_product.id_color_frame in (".ControllerVerification::array_to_string($colors_frameFilter).") " : " 1 ";
            $str_filter_colors_workingsurface = count($colors_workingsurfaceFilter)>0 ?
            " furniture_product.id_color_workingsurface in (".ControllerVerification::array_to_string($colors_workingsurfaceFilter).") " : " 1 ";
            
            $str_filter_materials_facade = count($materials_facadeFilter)>0 ?
            " furniture_product.id_color_facade in (".ControllerVerification::array_to_string($materials_facadeFilter).") " : " 1 ";
            $str_filter_materials_body = count($materials_bodyFilter)>0 ?
            " furniture_product.id_color_body in (".ControllerVerification::array_to_string($materials_bodyFilter).") " : " 1 ";
            $str_filter_materials_frame = count($materials_frameFilter)>0 ?
            " furniture_product.id_color_frame in (".ControllerVerification::array_to_string($materials_frameFilter).") " : " 1 ";
            $str_filter_materials_workingsurface = count($materials_workingsurfaceFilter)>0 ?
            " furniture_product.id_color_workingsurface in (".ControllerVerification::array_to_string($materials_workingsurfaceFilter).") " : " 1 ";


            $all = DB::select("
            SELECT 

            furniture_product.id as id, 
            furniture_product.name as productName,

            furniture_product.length as productLength,
            furniture_product.width as productWidth,
            furniture_product.height as productHeight,
            furniture_product.depth as productDepth,

            furniture_product.id_category as id_category, 
            furniture_product.id_manufacturer as id_manufacturer, 
            furniture_product.id_coverage as id_coverage, 
            furniture_product.id_locktype as id_locktype, 
            furniture_product.id_purpose as id_purpose, 
            furniture_product.id_shape as id_shape, 

            furniture_product.id_color_facade as id_color_facade, 
            furniture_product.id_color_body as id_color_body, 
            furniture_product.id_color_frame as id_color_frame, 
            furniture_product.id_color_workingsurface as id_color_workingsurface, 
            furniture_product.id_material_facade as id_material_facade, 
            furniture_product.id_material_body as id_material_body, 
            furniture_product.id_material_frame as id_material_frame, 
            furniture_product.id_material_workingsurface as id_material_workingsurface, 

            furniture_dict_category.name as categoryName,
            furniture_dict_manufacturer.name as manufacturerName,
            furniture_dict_coverage.name as coverageName,
            furniture_dict_locktype.name as locktypeName,
            furniture_dict_purpose.name as purposeName,
            furniture_dict_shape.name as shapeName,

            colorFacade.name as colorFacadeName,
            colorBody.name as colorBodyName,
            colorFrame.name as colorFrameName,
            colorWorkingsurface.name as colorWorkingsurfaceName,
            materialFacade.name as materialFacadeName,
            materialBody.name as materialBodyName,
            materialFrame.name as materialFrameName,
            materialWorkingsurface.name as materialWorkingsurfaceName,

            furniture_product.filePath as filePath,

            furniture_pricechange.price


            
            FROM furniture_product 

            left join furniture_dict_category on furniture_dict_category.id = furniture_product.id_category
            left join furniture_dict_manufacturer on furniture_dict_manufacturer.id = furniture_product.id_manufacturer
            left join furniture_dict_coverage on furniture_dict_coverage.id = furniture_product.id_coverage
            left join furniture_dict_locktype on furniture_dict_locktype.id = furniture_product.id_locktype
            left join furniture_dict_purpose on furniture_dict_purpose.id = furniture_product.id_purpose
            left join furniture_dict_shape on furniture_dict_shape.id = furniture_product.id_shape

            left join furniture_dict_color as colorFacade on colorFacade.id = furniture_product.id_color_facade
            left join furniture_dict_color as colorBody on colorBody.id = furniture_product.id_color_body
            left join furniture_dict_color as colorFrame on colorFrame.id = furniture_product.id_color_frame
            left join furniture_dict_color as colorWorkingsurface on colorWorkingsurface.id = furniture_product.id_color_workingsurface

            left join furniture_dict_material as materialFacade on materialFacade.id = furniture_product.id_material_facade
            left join furniture_dict_material as materialBody on materialBody.id = furniture_product.id_material_body
            left join furniture_dict_material as materialFrame on materialFrame.id = furniture_product.id_material_frame
            left join furniture_dict_material as materialWorkingsurface on materialWorkingsurface.id = furniture_product.id_material_workingsurface

            left join (
                select t1.price, t1.id_product, t1.date_price_change
                from
                furniture_pricechange t1,
                (
                    select id_product,max(date_price_change) as date_price_change
                    from furniture_pricechange 
                    group by id_product
                )t2
                where t1.id_product=t2.id_product and t1.date_price_change=t2.date_price_change
            ) as furniture_pricechange on furniture_pricechange.id_product = furniture_product.id 


            WHERE  
            $str_filter_id_category and 

            $str_filter_manufacturers and 
            $str_filter_coverages and 
            $str_filter_purposes and 
            $str_filter_shapes and 
            
            $str_filter_colors_facade and 
            $str_filter_colors_body and 
            $str_filter_colors_frame and 
            $str_filter_colors_workingsurface  and 
            
            $str_filter_materials_facade and 
            $str_filter_materials_body and 
            $str_filter_materials_frame and 
            $str_filter_materials_workingsurface 

            "); 


            return $all;
        }catch(Exception $err){
            return $err->getMessage();
        }
    }

    static public function getProductCount(Request $request){
        try{
            $id_product = ControllerVerification::check_number($request->id_product);
            $id_branch = ControllerVerification::check_number($request->id_branch);

            $get = DB::select("
            SELECT(
            (select SUM(product_count) 
            from furniture_delivery 
            where id_product=".$id_product." and id_branch=".$id_branch.")
            -
            (SELECT 
            case 
            when sum(furniture_purchaseitem.product_count) is null
            then 0 else sum(furniture_purchaseitem.product_count) 
            end
 
            FROM furniture_purchase 
            left join furniture_purchaseitem on furniture_purchaseitem.id_purchase=furniture_purchase.id
            where furniture_purchase.id_branch=".$id_branch." and furniture_purchaseitem.id_product=".$id_product.")
            ) as count
            
            ");

            return $get;
        }catch(Exception $err){
            return $err->getMessage();
        }
    }


    static public function getOne(Request $request){
        try{
            //$one = ModelProduct::find($id);
            $id = ControllerVerification::check_number($request->id);

            $one = DB::select("
            SELECT 

            furniture_product.id as id, 
            furniture_product.name as productName,

            furniture_product.length as productLength,
            furniture_product.width as productWidth,
            furniture_product.height as productHeight,
            furniture_product.depth as productDepth,

            furniture_product.id_category as id_category, 
            furniture_product.id_manufacturer as id_manufacturer, 
            furniture_product.id_coverage as id_coverage, 
            furniture_product.id_locktype as id_locktype, 
            furniture_product.id_purpose as id_purpose, 
            furniture_product.id_shape as id_shape, 

            furniture_product.id_color_facade as id_color_facade, 
            furniture_product.id_color_body as id_color_body, 
            furniture_product.id_color_frame as id_color_frame, 
            furniture_product.id_color_workingsurface as id_color_workingsurface, 
            furniture_product.id_material_facade as id_material_facade, 
            furniture_product.id_material_body as id_material_body, 
            furniture_product.id_material_frame as id_material_frame, 
            furniture_product.id_material_workingsurface as id_material_workingsurface, 

            furniture_dict_category.name as categoryName,
            furniture_dict_manufacturer.name as manufacturerName,
            furniture_dict_coverage.name as coverageName,
            furniture_dict_locktype.name as locktypeName,
            furniture_dict_purpose.name as purposeName,
            furniture_dict_shape.name as shapeName,

            colorFacade.name as colorFacadeName,
            colorBody.name as colorBodyName,
            colorFrame.name as colorFrameName,
            colorWorkingsurface.name as colorWorkingsurfaceName,
            materialFacade.name as materialFacadeName,
            materialBody.name as materialBodyName,
            materialFrame.name as materialFrameName,
            materialWorkingsurface.name as materialWorkingsurfaceName,

            furniture_product.filePath as filePath,

            furniture_pricechange.price


            
            FROM furniture_product 

            left join furniture_dict_category on furniture_dict_category.id = furniture_product.id_category
            left join furniture_dict_manufacturer on furniture_dict_manufacturer.id = furniture_product.id_manufacturer
            left join furniture_dict_coverage on furniture_dict_coverage.id = furniture_product.id_coverage
            left join furniture_dict_locktype on furniture_dict_locktype.id = furniture_product.id_locktype
            left join furniture_dict_purpose on furniture_dict_purpose.id = furniture_product.id_purpose
            left join furniture_dict_shape on furniture_dict_shape.id = furniture_product.id_shape

            left join furniture_dict_color as colorFacade on colorFacade.id = furniture_product.id_color_facade
            left join furniture_dict_color as colorBody on colorBody.id = furniture_product.id_color_body
            left join furniture_dict_color as colorFrame on colorFrame.id = furniture_product.id_color_frame
            left join furniture_dict_color as colorWorkingsurface on colorWorkingsurface.id = furniture_product.id_color_workingsurface

            left join furniture_dict_material as materialFacade on materialFacade.id = furniture_product.id_material_facade
            left join furniture_dict_material as materialBody on materialBody.id = furniture_product.id_material_body
            left join furniture_dict_material as materialFrame on materialFrame.id = furniture_product.id_material_frame
            left join furniture_dict_material as materialWorkingsurface on materialWorkingsurface.id = furniture_product.id_material_workingsurface

            left join (
                select t1.price, t1.id_product, t1.date_price_change
                from
                furniture_pricechange t1,
                (
                    select id_product,max(date_price_change) as date_price_change
                    from furniture_pricechange 
                    group by id_product
                )t2
                where t1.id_product=t2.id_product and t1.date_price_change=t2.date_price_change
            ) as furniture_pricechange on furniture_pricechange.id_product = furniture_product.id 


            WHERE furniture_product.id = ".$id."

            "); 


            return $one;
        }catch(Exception $err){
            return $err->getMessage();
        }
    }
    static public function create(Request $request){
        try{
            ModelProduct::create([
                "name" => ControllerVerification::check_string($request->name),
                "length" => ControllerVerification::check_number($request->length),
                "width" => ControllerVerification::check_number($request->width),
                "height" => ControllerVerification::check_number($request->height),
                "depth" => ControllerVerification::check_number($request->depth),
                
                "id_category" => ControllerVerification::check_number($request->id_category),
                "id_manufacturer" => ControllerVerification::check_number($request->id_manufacturer),
                "id_coverage" => ControllerVerification::check_number($request->id_coverage),
                "id_locktype" => ControllerVerification::check_number($request->id_locktype),
                "id_purpose" => ControllerVerification::check_number($request->id_purpose),
                "id_shape" => ControllerVerification::check_number($request->id_shape),

                "id_color_facade" => ControllerVerification::check_number($request->id_color_facade),
                "id_color_body" => ControllerVerification::check_number($request->id_color_body),
                "id_color_frame" => ControllerVerification::check_number($request->id_color_frame),
                "id_color_workingsurface" => ControllerVerification::check_number($request->id_color_workingsurface),
                "id_material_facade" => ControllerVerification::check_number($request->id_material_facade),
                "id_material_body" => ControllerVerification::check_number($request->id_material_body),
                "id_material_frame" => ControllerVerification::check_number($request->id_material_frame),
                "id_material_workingsurface" => ControllerVerification::check_number($request->id_material_workingsurface),

                "filePath" => ControllerVerification::check_string($request->filePath),
            ]);

            return response()->json(['message' => 'Row created'], 200);
        }catch(Exception $err){
            return $err->getMessage();
        }
    }
    public function update(Request $request, $id){
        try{
            if(is_null($id) || empty($id) || !is_numeric($id)){
                return response()->json(['message' => 'id not found'], 400);
            }

            $one = ModelProduct::find($id);

            if (is_null($one)) {
                return response()->json(['message' => 'row in table with id='.$id.' does not exist'], 400);
            } else {
                $one->name = ControllerVerification::check_string($request->name);
                $one->length = ControllerVerification::check_number($request->length);
                $one->width = ControllerVerification::check_number($request->width);
                $one->height = ControllerVerification::check_number($request->height);
                $one->depth  = ControllerVerification::check_number($request->depth);

                $one->id_category = ControllerVerification::check_number($request->id_category);
                $one->id_manufacturer = ControllerVerification::check_number($request->id_manufacturer);
                $one->id_coverage = ControllerVerification::check_number($request->id_coverage);
                $one->id_locktype = ControllerVerification::check_number($request->id_locktype);
                $one->id_purpose = ControllerVerification::check_number($request->id_purpose);
                $one->id_shape = ControllerVerification::check_number($request->id_shape);

                $one->id_color_facade = ControllerVerification::check_number($request->id_color_facade);
                $one->id_color_body = ControllerVerification::check_number($request->id_color_body);
                $one->id_color_frame = ControllerVerification::check_number($request->id_color_frame);
                $one->id_color_workingsurface = ControllerVerification::check_number($request->id_color_workingsurface);
                $one->id_material_facade = ControllerVerification::check_number($request->id_material_facade);
                $one->id_material_body = ControllerVerification::check_number($request->id_material_body);
                $one->id_material_frame = ControllerVerification::check_number($request->id_material_frame);
                $one->id_material_workingsurface = ControllerVerification::check_number($request->id_material_workingsurface);

                if(!is_null($request->filePath) && !empty($request->filePath)){
                    $one->filePath = $request->filePath;
                }
                
                $one->save();

                return response()->json(['message' => 'Row updated'], 200);
            }
        }catch(Exception $err){
            return $err->getMessage();
        }
    }
    public function delete($id){
        try{
            if(is_null($id) || empty($id) || !is_numeric($id)){
                return response()->json(['message' => 'id not found'], 400);
            }

            $one = ModelProduct::find($id);

            if (is_null($one)) {
                return response()->json(['message' => 'row in table with id='.$id.' does not exist'], 400);
            } else {
                $one->delete();

                return response()->json(['message' => 'Row deleted'], 200);
            }
        }catch(Exception $err){
            return $err->getMessage();
        }
    }
}
