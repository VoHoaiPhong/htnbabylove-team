<?php

namespace App\Providers;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\ProductType;
use App\Product;
use App\ProductDetail;
use App\Bill;
use App\ProductImage;
use App\ProductColor;
use DB;
use Cart;
use Session;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        
        view()->composer('header',function($view){
            $loai_sanpham = ProductType::all();
            $view->with('loai_sanpham',$loai_sanpham);
        });

        view()->composer('master',function($view){
            // $product_color = DB::select(DB::raw('SELECT color FROM product_color WHERE id_detail in (SELECT id FROM product_detail WHERE id_product in (SELECT id FROM products ))'));

            $product_color = DB::table('products as sp')
                        ->Join('product_detail as detail','sp.id','=','detail.id_product')
                        ->Join('product_color as color','detail.id','=','color.id_detail')
                        ->select('color.id_detail','color.id','color.color')
                        ->distinct()
                        ->get();
            // dd($product_color);

            $view->with('product_color',$product_color);
        });


        view()->composer('master',function($view){
            $promotion_product = Product::where('promotion_price', '<>', '0')->get();
            $view->with('promotion_product',$promotion_product);
        });

        view()->composer('master',function($view){
            $new_product = Product::where('status', 1)->get();
            $view->with('new_product',$new_product);
        });

        view()->composer('master',function($view){
            $hot_product = Product::where('status', 2)->get();
            $view->with('hot_product',$hot_product);
        });

        view()->composer('master',function($view){
            $detail_product = ProductDetail::all();
            $view->with('detail_product',$detail_product);
        });
        view()->composer('master',function($view){
            $product_image = ProductImage::all();
            $view->with('product_image',$product_image);
        });

        view()->composer('Admin.pageadmin.admindanhgia', function($view){
            $loai_sp = ProductType::all();
            $view->with('loai_sp',$loai_sp);
        });

        view()->composer('Admin.pageadmin.admindanhgia', function($view){
            $loai_sp = ProductType::all();
            $view->with('loai_sp',$loai_sp);
        });  

        view()->composer('Admin.pageadmin.adminnav',function($view){
            $confirm_bill = Bill::where('status', 4)->get();
            $view->with('confirm_bill',$confirm_bill);
        });

        view()->composer('Admin.master',function($view){
                $takesp = DB::table('products as sp')
                    ->leftjoin('product_type as lsp', 'sp.id_type' , '=', 'lsp.id')
                    ->select('sp.id as spid', 'lsp.type_name' , 'sp.name' , 'sp.unit_price' , 'sp.promotion_price' ,'sp.size' , 'sp.description' , 'sp.status')
                    ->get();            
                // dd($takesp);
                $view->with('takesp',$takesp);
        });
        view()->composer('Admin.master',function($view){
            $detail_product = ProductDetail::all();
            $view->with('detail_product',$detail_product);
        });
        view()->composer('Admin.master',function($view){
            $product_image = ProductImage::all();
            $view->with('product_image',$product_image);
        });

        view()->composer('Admin.master',function($view){
            $product_color = ProductColor::all();
            $view->with('product_color',$product_color);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
