<?php

namespace App\Http\Controllers;
use App\Customer;
use Illuminate\Http\Request;
use App\Product;
use App\ProductDetail;
use App\ProductType;
use App\Feedback;
use App\Bill;
use App\BillDetail;
use App\ProductColor;
use App\ProductImage;
use Illuminate\Console\Scheduling\Schedule;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Mail;
use App\Mail\MyMail;

class PageController extends Controller
{
    public function getIndex(){
        $promotion_product = Product::join('product_detail as ctsp', 'products.id', '=', 'ctsp.id_product')
                            ->join('product_image as asp', 'ctsp.id', '=', 'asp.id_detail')
                            ->where('promotion_price', '<>', '0')
                            ->groupBy('products.id')
                            ->get();
        $new_product = Product::join('product_detail as ctsp', 'products.id', '=', 'ctsp.id_product')
                            ->join('product_image as asp', 'ctsp.id', '=', 'asp.id_detail')
                            ->where('status', 1)
                            ->groupBy('products.id')
                            ->get();
        $hot_product = Product::join('product_detail as ctsp', 'products.id', '=', 'ctsp.id_product')
                            ->join('product_image as asp', 'ctsp.id', '=', 'asp.id_detail')
                            ->where('status', 2)
                            ->groupBy('products.id')
                            ->get();


        $lsp = ProductType::all();
        return view('page.trangchu',compact('new_product','hot_product','promotion_product','detail_product','lsp','product','product_image','product_color'));
    }

    public function getLoaiSP($type){
        $lsp = ProductType::all();
        $sp_theoloai = Product::where('id',$type)->get();
        $detail_product = ProductDetail::all();
        // $products = Product::all();
        $product_image = ProductImage::all();
        $product_color = ProductColor::all();
        $loai_ssp = ProductType::where('id',$type)->first();

        $product = Product::join('product_detail as ctsp', 'products.id', '=', 'ctsp.id_product')
                            ->join('product_image as asp', 'ctsp.id', '=', 'asp.id_detail')
                            ->join('product_type as ty', 'products.id_type', '=', 'ty.id')
                            ->where('ty.id','=',$type)
                            ->groupBy('products.id')
                            ->get();

        return view('page.loai_sanpham',compact('lsp','sp_theoloai','detail_product','product','loai_ssp','product_color','product_image'));
    }

    public function getDetail($id){
        $detail_product = ProductDetail::all();

        $sanpham = Product::where('id', $id)->first();

        $feedback = Feedback::leftjoin('products as sp', 'feedbacks.id_product', '=' ,'sp.id')
                            ->where('sp.id', $id)
                            ->select('sp.id as spid', 'feedbacks.id as fbid', 'feedbacks.stars', 'feedbacks.reviewer', 'feedbacks.tel', 'feedbacks.review', 'feedbacks.created_at')
                            ->get();

        $type_name = ProductType::join('products as sp', 'product_type.id', '=', 'sp.id_type')
                            ->where('sp.id', $id)
                            ->value('type_name');

        $id_lsp = Product::join('product_type as lsp', 'products.id_type', '=', 'lsp.id')
                            ->where('products.id', $id)
                            ->value('id_type');

        $same_product = Product::leftjoin('product_detail as ctsp', 'products.id', '=', 'ctsp.id_product')
                            ->leftjoin('product_image as asp', 'ctsp.id', '=', 'asp.id_detail')
                            ->leftjoin('product_type as lsp' , 'lsp.id', '=', 'products.id_type')
                            ->where('products.id_type', $id_lsp)
                            ->groupBy('products.id')
                            ->take(6)
                            ->get();

        $get1_proimg = ProductImage::leftjoin('product_detail as ctsp', 'product_image.id_detail', '=', 'ctsp.id')
                            ->join('products as sp', 'ctsp.id_product', '=', 'sp.id')
                            ->where('sp.id', $id)
                            ->value('image');

        $new_product = Product::join('product_detail as ctsp', 'products.id', '=', 'ctsp.id_product')
                            ->join('product_image as asp', 'ctsp.id', '=', 'asp.id_detail')
                            ->where('status', 1)
                            ->groupBy('products.id')
                            ->get();

        $hot_product = Product::join('product_detail as ctsp', 'products.id', '=', 'ctsp.id_product')
                            ->join('product_image as asp', 'ctsp.id', '=', 'asp.id_detail')
                            ->where('status', 2)
                            ->groupBy('products.id')
                            ->get();

        $getcl = ProductColor::leftjoin('product_detail as ctsp', 'product_color.id_detail', '=' , 'ctsp.id')
                            ->leftjoin('products as sp', 'ctsp.id_product', '=', 'sp.id')
                            ->where('sp.id', $id)
                            ->select('sp.id as spid', 'product_color.color')
                            ->get();

        $getimg = ProductImage::leftjoin('product_detail as ctsp', 'product_image.id_detail', '=' , 'ctsp.id')
                            ->leftjoin('products as sp', 'ctsp.id_product', '=', 'sp.id')
                            ->where('sp.id', $id)
                            ->select('sp.id as spid', 'product_image.image')
                            ->get();

        return view('page.chitiet_sanpham', compact('detail_product', 'sanpham','feedback','type_name', 'id_lsp', 'same_product', 'get1_proimg', 'hot_product','new_product','getcl', 'getimg'));
    }

    public function postDanhGia(Request $req, $id){
        $fb = new Feedback;

        $fb->id_product = $id;
        $fb->stars = $req->ratingValue;
        $fb->reviewer = $req->name;
        $fb->review = $req->review;
        $fb->tel = $req->phone;
        $fb->save();

        return redirect()->back();
    }

    public function getAbout(){
        $lsp = ProductType::all();
        return view('page.gioithieu', compact('lsp'));
    }

    public function getPolicy(){
        return view('page.chinhsachbaomat');
    }

    public function getTerms(){
        return view('page.dieukhoan');
    }

    public function postCheckout(Request $req){
        $cus = new Customer;
        $cus->name = $req->cusname;
        $cus->email = $req->email;
        $cus->address = $req->address;
        $cus->phone = $req->phone;
        $cus->save();

        $bill = new Bill;
        $bill->id_customer = $cus->id;
        $bill->total_product = $req->qty;
        $bill->total_price = $req->tongtien;
        $bill->address = $req->address;
        $bill->status = 4;
        $bill->save();

        $bill_detail = new BillDetail;
        $bill_detail->id_bill = $bill->id;
        $bill_detail->product_name = $req->proname;
        $bill_detail->color = $req->color;
        $bill_detail->quantity = $req->qty;
        $bill_detail->size = $req->size;
        $bill_detail->price = $req->price;
        $bill_detail->image = $req->img;
        $bill_detail->save();

        // dd($req->tongtien);

        return redirect()->action('PageController@getIndex')->with('success', 'Cám ơn bạn đã đặt hàng');
    }

    public function postChitietsp($id, Request $req){
        $spmua = Product::leftjoin('product_detail as ctsp', 'products.id', '=', 'ctsp.id_product')
                        ->leftjoin('product_image as asp', 'ctsp.id', '=', 'asp.id_detail')
                        ->where('products.id', $id)
                        ->select('products.id as spid', 'products.name', 'products.unit_price', 'products.promotion_price', 'products.size', 'asp.image')
                        ->groupBy('products.id')
                        ->get();
        $qtymua = $req->qtyspbuy;
        $colormua = $req->colorbuy;

        return view('page.thanhtoan', compact('spmua','qtymua', 'colormua'));
    }

    public function getTimkiem(Request $req){
        $tensp =$req->search;
        $value = $req->members;
        $product = Product::join('product_detail as ctsp', 'products.id', '=', 'ctsp.id_product')
                            ->join('product_image as asp', 'ctsp.id', '=', 'asp.id_detail')
                            ->where('name','like','%'.$req->search.'%')->orWhere('unit_price',$req->search)
                            ->groupBy('products.id')
                            ->get();

        // $product = Product::where('name','like','%'.$req->search.'%')->orWhere('unit_price',$req->search)->get();

        //cắt chuỗi của giá tiền
        
        $giatien = explode(',', $req->price);
        
        // dd($giatien[0]);

        //tìm kiếm theo các tuỳ chọn
        if(!empty($req->price)){
            switch(  $tensp || $giatien || $value)  {
                case $tensp :
                    $product = Product::join('product_detail as ctsp', 'products.id', '=', 'ctsp.id_product')
                            ->join('product_image as asp', 'ctsp.id', '=', 'asp.id_detail')
                            ->where('name','like','%'.$req->search.'%')->orWhere('unit_price',$req->search)
                            ->groupBy('products.id')
                            ->get();
                break;

                case $value ;
                    $product = Product::join('product_detail as ctsp', 'products.id', '=', 'ctsp.id_product')
                            ->join('product_image as asp', 'ctsp.id', '=', 'asp.id_detail')
                            ->join('product_type as ty', 'products.id_type', '=', 'ty.id')
                            ->where('ty.id','=',$value)
                            ->groupBy('products.id')
                            ->get();

                    

                break;

                case $giatien :
                    $product = Product::join('product_detail as ctsp', 'products.id', '=', 'ctsp.id_product')
                            ->join('product_image as asp', 'ctsp.id', '=', 'asp.id_detail')
                            ->whereBetween('unit_price', [$giatien[0],$giatien[1]] )
                            ->groupBy('products.id')
                            ->get();

                break;

                case ($tensp && $value) :
                    $product = Product::join('product_detail as ctsp', 'products.id', '=', 'ctsp.id_product')
                            ->join('product_image as asp', 'ctsp.id', '=', 'asp.id_detail')
                            ->join('product_type as ty', 'products.id_type', '=', 'ty.id')
                            ->Where('sp.name','like','%'.$tensp.'%')
                            ->orwhere('ty.id','=',$value)
                            ->groupBy('products.id')
                            ->get();
                            dd($product);

                   
                break;

                case ($tensp && $giatien) :
                    $product = Product::join('product_detail as ctsp', 'products.id', '=', 'ctsp.id_product')
                            ->join('product_image as asp', 'ctsp.id', '=', 'asp.id_detail')
                            ->whereBetween('sp.unit_price', [$giatien[0],$giatien[1]] )
                            ->orWhere('sp.name','like','%'.$tensp.'%')
                            ->groupBy('products.id')
                            ->get();

                    
                break;

                case ($value && $giatien) :
                    $product = Product::join('product_detail as ctsp', 'products.id', '=', 'ctsp.id_product')
                            ->join('product_image as asp', 'ctsp.id', '=', 'asp.id_detail')
                            ->join('product_type as ty', 'products.id_type', '=', 'ty.id')
                            ->whereBetween('sp.unit_price', [$giatien[0],$giatien[1]] )
                            ->orwhere('ty.id','=',$value)
                            ->groupBy('products.id')
                            ->get();


               
                break;

                case ($tensp && $value && $giatien) :
                    $product = Product::join('product_detail as ctsp', 'products.id', '=', 'ctsp.id_product')
                            ->join('product_image as asp', 'ctsp.id', '=', 'asp.id_detail')
                            ->join('product_type as ty', 'products.id_type', '=', 'ty.id')
                            ->Where('sp.name','like','%'.$tensp.'%')
                            ->whereBetween('sp.unit_price', [$giatien[0],$giatien[1]] )
                            ->orwhere('ty.id','=',$value)
                            ->groupBy('products.id')
                            ->get();

                   
                break;
                default:

            }
        }

    
     // dd($product);
    
        
        $lsp = ProductType::all();

        return view('page.timkiem',compact('lsp','product'));
       
       
    }


    public function getTimkiemloai(Request $req){
        $product = Product::join('product_detail as ctsp', 'products.id', '=', 'ctsp.id_product')
                            ->join('product_image as asp', 'ctsp.id', '=', 'asp.id_detail')
                            ->groupBy('products.id')
                            ->get();

        if($req->pro === 'sale'){
            $product = Product::join('product_detail as ctsp', 'products.id', '=', 'ctsp.id_product')
                            ->join('product_image as asp', 'ctsp.id', '=', 'asp.id_detail')
                            ->where('promotion_price', '<>', '0')
                            ->groupBy('products.id')
                            ->get();

        }
        if($req->pro === 'new'){
            $product = Product::join('product_detail as ctsp', 'products.id', '=', 'ctsp.id_product')
                            ->join('product_image as asp', 'ctsp.id', '=', 'asp.id_detail')
                            ->where('status', 1)
                            ->groupBy('products.id')
                            ->get();

        }
        if($req->pro === 'hot'){
            $product = Product::join('product_detail as ctsp', 'products.id', '=', 'ctsp.id_product')
                            ->join('product_image as asp', 'ctsp.id', '=', 'asp.id_detail')
                            ->where('status', 2)
                            ->groupBy('products.id')
                            ->get();

        }
        if($req->pro === 'giagiam'){
            $product = Product::join('product_detail as ctsp', 'products.id', '=', 'ctsp.id_product')
                            ->join('product_image as asp', 'ctsp.id', '=', 'asp.id_detail')
                            ->orderByRaw('unit_price  DESC')
                            ->groupBy('products.id')
                            ->get();
            // $product = DB::table('products')
            //     ->orderByRaw('unit_price  DESC')
            //     ->get();

        }
        if($req->pro === 'giatang'){
            $product = Product::join('product_detail as ctsp', 'products.id', '=', 'ctsp.id_product')
                            ->join('product_image as asp', 'ctsp.id', '=', 'asp.id_detail')
                            ->orderByRaw('unit_price  ASC')
                            ->groupBy('products.id')
                            ->get();
            // $product = DB::table('products')
            //     ->orderByRaw('unit_price  ASC')
            //     ->get();

        }
        
        $lsp = ProductType::all();
        return view('page.timkiemloai',compact('lsp','product'));
    }

    //Admin
    public function getAdminIndex(){
        return view('Admin.pageadmin.admindangnhap');
    }
    public function getadminCanhan(){
        
        return view('Admin.pageadmin.admincanhan');
    }

    public function getadminDanhgia(){
        $getlsp = ProductType::all();

        $getsp = Product::leftjoin('product_detail as ctsp', 'products.id', '=', 'ctsp.id_product')
                        ->leftjoin('product_image as asp', 'ctsp.id', '=', 'asp.id_detail')
                        ->select('products.id as spid', 'products.name', 'asp.image')
                        ->groupBy('spid')
                        ->get();

        $getnumfb = Feedback::all();
        // dd($getnumfb);

        return view('Admin.pageadmin.admindanhgia', compact('getlsp','getsp', 'getnumfb'));

    }

    public function getadminChitietDanhgia($idfb){
        $getlsp = ProductType::all();

        $getsp = Product::where('id', '=', $idfb)->value('name') ;
        // dd($getsp);

        $fbsp = Feedback::where('id_product','=',$idfb)->get();

        return view('Admin.pageadmin.adminchitietdanhgia', compact('fbsp', 'getlsp', 'getsp'));
    }

    public function getadminDanhgiatheoloai($fbtype){
        $getlsp = ProductType::all();

        $fb_theoloai = Product::where('id_type', $fbtype)->get();

        return view('Admin.pageadmin.admindanhgiatheoloai', compact('getlsp','fb_theoloai'));
    }

    public function getadminXoadanhgia($fb){
        Feedback::find($fb)->delete();
        return redirect()->back();
    }

    public function getadminSanpham(){
        $takesp = DB::table('products as sp')
                    ->leftjoin('product_type as lsp', 'sp.id_type' , '=', 'lsp.id')
                    ->select('sp.id as spid', 'lsp.type_name' , 'sp.name' , 'sp.unit_price' , 'sp.promotion_price' ,'sp.size' , 'sp.description' , 'sp.status')
                    ->get();

        return view('Admin.pageadmin.adminsanpham', compact('takesp'));
    }

    public function getadminThemsanpham(){
        $addlsp = ProductType::all();
        return view('Admin.pageadmin.adminthemsanpham', compact('addlsp'));
    }

    public function postadminThemsanpham(Request $req){
        $sanpham = new Product;
        $ctsanpham = new ProductDetail;
        if($req->hasfile('images')){
            foreach($req->file('images') as $image){
                $name=date('Y-m-d-H-i-s')."-".$image->getClientOriginalName();
                $image->move('storage/product', $name);  
                $img[] = $name;  
            }
        }

        $sanpham->name = $req->ten;
        $sanpham->unit_price = $req->giagoc;
        $sanpham->promotion_price = $req->giakhuyenmai;
        $sanpham->size = $req->kichthuoc;
        $sanpham->status = $req->trangthai;
        $sanpham->description = $req->mota;
        $id_type = $req->loaisanpham;
        $sanpham->id_type = $id_type;
        $sanpham->save();

        $ctsanpham->id_product = $sanpham->id;
        $ctsanpham->save();

        foreach ($req->mausp as $key) {
            $colorsp = new ProductColor;
            $colorsp->id_detail = $ctsanpham->id;
            $colorsp->color = $key;
            $colorsp->save();
        }
        foreach($img as $i){
            ProductImage::insert( [
                'id_detail'=>$ctsanpham->id,
                'image'=>$i,
            ]);
        }
        return redirect()->back();    }

    public function getadminSuasanpham($idsp){
        $product_type = ProductType::all();
        $id_product_edit = Product::where('id', $idsp)->get();
        $product_name = Product::where('id', $idsp)->value('name');

        $id_type = Product::where('id',$idsp)->value('id_type');
        $type_name = ProductType::where('id',$id_type)->value('type_name');

        $adminlsp = ProductType::all();

        $editsp = Product::where('id', $idsp)->get();

        $getcl = ProductColor::leftjoin('product_detail as ctsp', 'product_color.id_detail', '=', 'ctsp.id')
                            ->leftjoin('products as sp', 'ctsp.id_product', '=' , 'sp.id')
                            ->where('sp.id', '=', $idsp)
                            ->select('product_color.color')
                            ->get();
        // dd($id_type_edit);
        return view('Admin.pageadmin.adminsuasanpham', compact('product_type', 'id_product_edit', 'product_name', 'id_type', 'type_name','not_type_name', 'adminlsp', 'editsp', 'getcl'));
    }

    public function postadminSuasanpham($idsp, Request $req){
        $id_product = Product::find($idsp);
        Product::where('id',$idsp)->update([
            'name'=>$req->newname,
            'id_type'=>$req->newtype,
            'unit_price'=>$req->new_unit_price,
            'promotion_price'=>$req->new_promotion_price,
            'size'=>$req->newsize,
            'description'=>$req->newdesc
        ]);
        $id_product->save();
        $ctsanpham = ProductDetail::find($idsp);
        $ctsanpham->id_product = $id_product->id;
        $ctsanpham->save();

        $id_detail = ProductDetail::where('id_product',$idsp)->value('id');
        $id_color = ProductColor::where('id',$id_detail)->value('id');
        $id_image = ProductImage::where('id_detail',$id_detail)->get();
        foreach ($id_image as $idi) {
            $idim[] = $idi->id;
        }
        foreach ($req->newcolor as $key) {
            $colorsp = ProductColor::find($idsp);
            $colorsp->id_detail = $ctsanpham->id;
            $colorsp->color = $key;
            $colorsp->save();
        }
        if($req->hasfile('newimage')){
            foreach($req->file('newimage') as $image){
                $name=date('Y-m-d-H-i-s')."-".$image->getClientOriginalName();
                $image->move('storage/product', $name);  
                $img[] = $name;  
            }
        }
        $i=0; 
        foreach($idim as $idm){
            ProductImage::where('id',$idm)->update([
                'image'=>$img[$i]
            ]);
            $i++;
        }
        return redirect()->back();
    }

    public function getadminXoasanpham($idsp){
        $cl = ProductColor::leftjoin('product_detail as ctsp', 'product_color.id_detail', '=', 'ctsp.id')
                            ->leftjoin('products as sp', 'ctsp.id_product', '=', 'sp.id')
                            ->where('sp.id', $idsp)
                            ->select('product_color.id')
                            ->get();

        $img = ProductImage::leftjoin('product_detail as ctsp', 'product_image.id_detail', '=', 'ctsp.id')
                            ->leftjoin('products as sp', 'ctsp.id_product', '=', 'sp.id')
                            ->where('sp.id', $idsp)
                            ->select('product_image.id')
                            ->get();

        $dt = ProductDetail::leftjoin('products as sp', 'product_detail.id_product', '=', 'sp.id')
                            ->where('sp.id', $idsp)
                            ->select('product_detail.id')
                            ->get();

        if($cl){
            foreach($cl as $key){
                $key->delete();
            }
        }
        
        if($img){
            foreach($img as $key){
                $key->delete();
            }
        }

        if($dt){
            foreach($dt as $key){
                $key->delete();
            }
        }
        
        Product::find($idsp)->delete();
        return redirect()->back();
    }

    public function getadminLoaisanpham(){
        $adminlsp = ProductType::all();

        return view('Admin.pageadmin.adminloaisanpham', compact('adminlsp'));
    }

    public function postThemloaisanpham(Request $req){
        $producttype = new ProductType;
        $producttype->type_name = $req->categoriename;
        $producttype->save();

        $adminlsp = ProductType::all();
        return redirect()->back();
    }

    public function postadminSualoaisanpham($idtype, Request $req){
        $edittype = ProductType::find($idtype);
        $edittype->type_name  = $req->newtypename;
        $edittype->save();

        return redirect()->back();
    }

    public function getadminXoaloaisanpham($idtype){
        ProductType::find($idtype)->delete();
        return redirect()->back();
    }
    
    public function getadminKhachhang(){
        $table  = Customer::all();
        return view('Admin.pageadmin.adminkhachhang',compact('table'));
    }

    public function getadminDonhang(){
        $customers = Customer::all();
        $bills = Bill::all();
        $bill_detail = BillDetail::all();

        $get_bill = DB::select(DB::raw('SELECT bd.id as bdid, b.id as bid, b.total_price, bd.product_name, bd.color, bd.image, bd.size, bd.quantity, bd.price, c.name FROM bill_detail as bd, customers as c, bills as b WHERE bd.id_bill in (SELECT b.id FROM bills WHERE b.id_customer in (SELECT c.id FROM customers))'));
        // dd($get_bill);
                        // dd($get_bill);
        return view('Admin.pageadmin.admindonhang', compact('get_bill','bills','customers','bill_detail'));
    }

    public function completedUpdate($id){
        DB::table('bills')->where('id', $id)->update(['status' => 2]);
		$customers = Customer::all();
        $bills = Bill::all();

        $e = Customer::join('bills as b','customers.id','=','b.id_customer')->where('b.id',$id)->value('email');
        // $to =  $customers->email;
        $subject = 'Đơn Hàng Đã Được Xác Nhận';
        $data = array(
            'contents' => ''
        );
        

        Mail::send('email.xacnhan', $data, function($message) use ($e, $subject) {
            $message->from('ngodangdt@gmail.com', 'HTN_BabyLove');
            $message->to($e,'')->subject($subject);
        });
        return redirect()->back();
    }

    public function cancelUpdate($id){
        DB::table('bills')->where('id', $id)->update(['status' => 3]);
		$customers = Customer::all();
        $bills = Bill::all();

        $e = Customer::join('bills as b','customers.id','=','b.id_customer')->where('b.id',$id)->value('email');
        // $to =  $customers->email;
        $subject = 'Đơn Hàng Bị Huỷ';
        $data = array(
            'contents' => ''
        );
        

        Mail::send('email.huydonhang', $data, function($message) use ($e, $subject) {
            $message->from('ngodangdt@gmail.com', 'HTN_BabyLove');
            $message->to($e,'')->subject($subject);
        });
        return redirect()->back();
    }

    public function getadminDoanhthu(){
        $getmonth = DB::select(DB::raw('SELECT month(created_at) as month FROM bills'));
        $getdate = DB::select(DB::raw('SELECT day(created_at) as day FROM bills'));
        $gettprice = Bill::all();
        
        return view('Admin.pageadmin.admindoanhthu', compact('getmonth', 'getdate','gettprice'));
    }
}
