@extends('master') @section('content')
<div class="container-full">
    <!-- Trang Chu -->
    <div class="container-fluid">
        <!-- fluid or full -->

        <div class="space30">&nbsp;</div>
        <!-- End SlideShow -->
        <div class="container-full">
            <!-- Sam pham va tim kiem nhanh -->
            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12  ">
                    <!-- Tim kiem nhanh san pham -->
                    <div id="navbar">
                        <!-- Menu -->
                        <div class="well">
                            <h5 class="text-left">Lọc Sản Phẩm Theo:</h5>
                            <form class="form-horizontal" action="#" method="">
                                <div class="form-group">
                                    <label for="priceto" class="control-label">Tên sản phẩm:</label>
                                    <input type="text" class="form-control" id="priceto" name="tensp" aria-describedby="basic-addon1"> </div>
                                <div class="form-group">
                                    <label for="location1" class="control-label">Loại sản phẩm:</label>
                                    <select class="form-control" name="" id="location1">
                                                <option value="#">Chọn loại sản phẩm</option>
                                                @foreach($lsp as $loai)
                                                    <option value="#">{{$loai->type_name}}</option>
                                                @endforeach
                                            </select>
                                </div>
                                <div class="form-group">
                                    <label for="priceto" class="control-label">Trạng thái:</label>
                                    <br>
                                    <div class="space10">&nbsp;</div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <a href="#">
                                                <div class="ribbon-trangthai sale">Sale</div>
                                            </a>
                                        </div>
                                        <div class="col-sm-4">
                                            <a href="#">
                                                <div class="ribbon-trangthai new">New</div>
                                            </a>
                                        </div>
                                        <div class="col-sm-4">
                                            <a href="#">
                                                <div class="ribbon-trangthai hot">Hot</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6"> <a href="#" class="search-price">Giá giảm dần <i class="fa fa-sort-amount-desc"></i></a> </div>
                                        <div class="col-sm-6"> <a href="#" class="search-price">Giá tăng dần <i class="fa fa-sort-amount-asc"></i></a> </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class='row'>
                                        <div style="width: 90%; margin-left: 5%">
                                            <label for="pricefrom" class="control-label">Giá:&nbsp;&nbsp;<b><span id="outputmin"></span> Đồng</b></label>
                                            <div class="input-group" style="width: 90%; margin-left: 5%; top: 10px;">
                                                <input id="pricefrom" type="text" class="span2" /> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="space10">&nbsp;</div>
                                <div class="form-group">
                                    <p class="text-center"><a href="#" class="btn btn-themvaogio" role="button">Tìm Kiếm </a></p>
                                </div>
                                <!-- Form tim kiem -->
                            </form>
                            <!-- Tim kiem -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12">
                   
                    <div class="space10">&nbsp;</div>
                    <div class="text-left" style="font-size: 25px; font-weight: 600"> Tìm Thấy {{count($product)}} Sản Phẩm </div>
                    <div class="space15">&nbsp;</div>
                    <div class="row">
                        @foreach($product as $pro) @foreach($detail_product as $anh) @if($pro->id_product == $anh->id_product)
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
                            <div class="single-item">
                                <div class="ribbon-wrapper">
                                    @if($pro->promotion_price != 0)
                                    <div class="ribbon1 sale">Sale</div>
                                    @elseif($pro->status == 1)
                                    <div class="ribbon1 new">New</div>
                                    @elseif($pro->status == 2)
                                    <div class="ribbon1 hot">Hot</div>
                                    @endif
                                </div>
                                <div class="thumbnail">
                                    <a href="{{ route('chitietsanpham', $pro->id_product) }}">
                                        <div class="containeroverlay">
                                            <img src="source/image/{{$anh->image}}" alt="Thumbnail Image 1" class="img-responsive" width="480px">
                                            <div class="overlay">
                                                <div class="text">Xem chi tiết</div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="caption">
                                        <div class="space5">&nbsp;</div>
                                        <b class="text-price">
                                                @if($pro->promotion_price == 0)
                                                    <span class="text-danger ">{{number_format($pro->unit_price)}} đ</span> &nbsp;
                                                @else
                                                    <span class="text-danger ">{{number_format($pro->promotion_price)}} đ</span> &nbsp;
                                                    <span class="flash-del">{{number_format($pro->unit_price)}} đ</span>
                                                @endif
                                                </b>
                                        <div class="space10">&nbsp;</div>
                                        <p class='text-left text-title'><b>{{$pro->name}}</b>&nbsp;</p>
                                        <button type="button" class="btn btn-buy btn-full button" data-toggle="modal" data-target="#{{$pro->id_product}}"><span>Mua Ngay </span></button>
                                        <button type="button" class="btn btn-themvaogio btn-full ">Thêm vào giỏ</button>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($anh->image == $anh->image )
                            @break
                        @endif
                        @endif @endforeach @endforeach
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.onscroll = function() {
        myFunction()
    };
    var navbar = document.getElementById("navbar");
    var sticky = navbar.offsetTop;

    function myFunction() {
        if (window.pageYOffset >= 180) {
            navbar.classList.add("sticky")
        } else {
            navbar.classList.remove("sticky");
        }

    }

</script>
@endsection