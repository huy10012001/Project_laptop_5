@extends('layout_home')
@section('contact')

<!-- breadcrumbs area end -->
<!-- contact-details start -->
<div class="main-contact-area">
    <div class="container">
        <h2 class="title text-center">Liên  Hệ Với Chúng Tôi </h2>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="contact-us-area">
                    <!-- google-map-area start -->
                    <div class="row">
                        <div class="google-map-area">
                            <!--  Map Section -->

                            <div id="contacts" class="col-sm-7 col-md-6">
                                <div class="row">
                                    <h4 class="title text-center">liên hệ trực tiếp </h4>
                                <h5>Nếu bạn cần liên hệ trực tiếp với chúng tôi, vui lòng theo thông tin bên dưới:</h5>
                                </div>
                                <div class="row">
                                    <div class="infof-icon">
                                      <p style="line-height: 35px;">  <i class="fa fa-map-marker"></i> 590 Cách Mạng Tháng 8, Phường 11, Quận 3, Hồ Chí Minh</p>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="infof-icon">
                                       <p style="line-height: 35px;"><i class="fa fa-phone"> </i>+84 123 456 789</p>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="infof-icon">
                                          <p style="line-height: 35px;"><i class="fa fa-envelope"></i>laptopshop@gmail.com</p>
                                    </div>

                                </div>
                                <div class="row" style="padding-top: 20px">
                                        <h4>LIÊN HỆ QUA HỆ THỐNG WEBSITE</h4>
                                        <h5>Chúng tôi luôn đón nhận mọi góp ý về website, chất lượng sản phẩm, chăm sóc khách hàng,....</h5>
                                        <h5>mọi thắc mắc chi tiết vui lòng liên hệ với chúng tôi qua các địa chỉ trên<i class="fa fa-smile-o"></i><i class="fa fa-smile-o"></i><i class="fa fa-smile-o"></i>.<h5>
                                        <h5>hoặc Để thực hiện việc liên hệ các bạn vui lòng điền vào theo form bên dưới.</h5>
                                </div>
                            </div>
                            <div id="contacts" class="map-area col-sm-5 col-md-6">
                                <div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="400" id="gmap_canvas" src="https://maps.google.com/maps?q=590%20C%C3%A1ch%20M%E1%BA%A1ng%20Th%C3%A1ng%208%2C%20Ph%C6%B0%E1%BB%9Dng%2011%2C%20Qu%E1%BA%ADn%203&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div></div>
                            </div>

                        </div>
                    </div>
                    <!-- google-map-area end -->
                    <!-- contact us form start -->
                    <div class="row">
                        <div class="contact-us-form">
                            <div class="contact-form">
                                <span class="legend">Mời bạn điền thông tin liên hệ</span>
                                <form action="{{ url('postContact') }}" method="post">
                                {{ csrf_field() }}
                                    <div class="form-top">
                                        <div class="form-group col-sm-6 col-md-6">
                                            <label>Họ tên <sup>*</sup></label>
                                            <input type="text" name="ct_name" class="form-control">
                                            @if($errors->has('ct_name'))
                                            <div class="has-error">
                                                <p class="help-block">
                                                    {{$errors->first('ct_name')}}
                                                </p>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group col-sm-6 col-md-6">
                                            <label>Email <sup>*</sup></label>
                                            <input type="text" name="ct_email" class="form-control">
                                            @if($errors->has('ct_email'))
                                            <div class="has-error">
                                                <p class="help-block">
                                                    {{$errors->first('ct_email')}}
                                                </p>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group col-sm-6 col-md-6">
                                            <label>Số điện thoại <sup>*</sup></label>
                                            <input type="text" name="ct_phone" class="form-control">
                                            @if($errors->has('ct_phone'))
                                            <div class="has-error">
                                                <p class="help-block">
                                                    {{$errors->first('ct_phone')}}
                                                </p>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group col-sm-6 col-md-6">
                                            <label>Tiêu đề <sup>*</sup></label>
                                            <input type="text" name="ct_title" class="form-control">
                                            @if($errors->has('ct_title'))
                                            <div class="has-error">
                                                <p class="help-block">
                                                    {{$errors->first('ct_title')}}
                                                </p>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group col-sm-12 col-md-12" >
                                            <label>Nội dung <sup>*</sup></label>
                                            <textarea class="yourmessage" name="ct_ " style=" border-radius: 5px;"></textarea>
                                            @if($errors->has('ct_content'))
                                            <div class="has-error">
                                                <p class="help-block">
                                                    {{$errors->first('ct_content')}}
                                                </p>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="submit-form form-group col-sm-12 submit-review">
                                        <p><sup>*</sup> Bắt buộc nhập</p>
                                        <div class="actions-log">
                                            <input type="submit" class="button" value="Gửi liên hệ" style=" border-radius: 5px;;">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- contact us form end -->
                </div>
            </div>
    </div>
</div>
@endsection
