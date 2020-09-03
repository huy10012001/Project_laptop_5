<style>
    .logo img
    {
        height: 300px;
    }
</style>
@extends('layout_home')

@section( 'news')
    <h4 style="text-align: center;">Thông tin về Shop-laptop</h4>
    <h6><b>giới thiệu về shop-laptop</b></h6>
    <p>_ Cửa hàng laptop hoạt động trong lĩnh vực kinh doanh các sản phẩm laptop , laptop xách tay tại TPHCM đã hơn 5 năm.</p>
    <p>_ Bắt đầu bằng mô hình phân phối sỉ các sản phẩm laptop cũ giả rẻ cho các đại lý trong và ngoài TPHCM. Hai năm trở lại đây, nắm bắt được nhu cầu của thj trường nên chúng tôi bắt đầu mở rộng mô hình bán lẻ tại TPHCM.</p>
    <p>_ Đến nay đã có rất nhiều sản phẩm laptop cũ giá rẻ đến tai người tiêu dùng với chất lượng tốt nhất kèm theo chính sách bảo hành uy tín 1 đổi 1 của shop-Laptop</p>
    <h4>Tại sao nên chon mua Laptop cũ tại shop-laptop ?</h4>
    <p>_ Trên thị trường hiên nay có rất nhiều đơn vị kinh doanh sản phẩm laptop và laptop xách tay. Để khách hàng có thể lựa chọ được 1 địa chỉ uy tín có vẻ là 1 điều ko hề dễ.</p>
    <p>Vậy lý do khách hàng tìm đến chúng tôi là vì điều gì?</p>
    <p>1/ Chúng tôi có chính sách bảo hành chất lượng nhất cho bạn ( Chính sách bảo hành 5 Sao)</p>
    <p>2/ Giá cả luôn nằm trong Top những của hàng laptop giá rẻ nhất tại TPHCM</p>
    <p>3/ Chính sách phân phối sỉ rộng khắp toàn Quốc.</p>
    <p>4/ Luôn có quà tặng + chương trình khuyến mãi đặp biệt cho khách hàng.</p>
    <p>5/ Kỹ thuật viên chuyên nghiệp sẽ giúp bạn chon lựa được những sản phẩm phù họp nhất với mình.</p>
    <p>6/ Chính sách hậu mãi chu đáo ( hỗ trợ bảo hàng phần mềm trọn đời)</p>

    <h2 class="text-center">Nhà phát triển</h2>
    <div class="row">
        <div class="col-md-3">
            <div class="card text-center">
            <div class="logo"><img src="{{ asset('images/hoan.png') }}"
            class="image-fluid img-thumbnail rounded-circle" height="auto">
            <div class="card-contact" style="height: 100px;">
                <div class="text-contain">
                    <h5 class="card-text" style="font-family:Cambria;">Hoàn</h5>
                    <p><i class="fas fa-envelope-open" >FPTAptech@gmail.com</i></p>                </div>
            </div>
            </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
            <div class="logo"><img src="{{ asset('images/an.png') }}"
            class="image-fluid img-thumbnail rounded-circle" width="100%" height="auto">
            <div class="card-contact" style="height: 100px;">
                <div class="text-contain">
                   <h5 class="card-text" style="font-family:Cambria;">Nguyễn Thành An</h5>
                   <p><i class="fas fa-envelope-open" >FPTAptech@gmail.com</i></p>
                </div>
            </div>
            </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
            <div class="logo"><img src="{{ asset('images/dat.png') }}"
            class="image-fluid img-thumbnail rounded-circle" width="100%" height="auto">
            <div class="card-contact" style="height: 100px;">
                <div class="text-contain">
                   <h5 class="card-text" style="font-family:Cambria;">Trần Kim Đạt</h5>
                   <p><i class="fas fa-envelope-open" >FPTAptech@gmail.com</i></p>
                </div>
            </div>
            </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
            <div class="logo"><img src="{{URL::asset('images/huy.png')}}"
            class="image-fluid img-thumbnail rounded-circle" width="100%" height="auto">
            <div class="card-contact" style="height: 100px;">
                <div class="text-contain">
                   <h5 class="card-text" style="font-family:Cambria;">Nguyễn Thanh HUy</h5>
                   <p><i class="fas fa-envelope-open" >FPTAptech@gmail.com</i></p>
                </div>
            </div>
            </div>
            </div>
        </div>
        <h4 style="text-align: center;color:rgb(170, 210, 250);">Đến với shop-laptop -quý khách sẽ luôn hài lòng!</h4>




@endsection
