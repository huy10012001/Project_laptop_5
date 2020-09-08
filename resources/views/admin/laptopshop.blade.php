@extends('layout.layout')
@section('title', 'cửa hàng laptop')
@section('content')

      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Lưu lượng cpu</span>
                <span class="info-box-number">
                  10
                  <small>%</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Tổng số lượt thích</span>
                <span class="info-box-number">500</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Tổng số đơn hàng </span>
                <span class="info-box-number">{{App\Order::where('status', 'not like','0')->count()}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Số Thành viên</span>
                <span class="info-box-number">{{App\User::all()->count()-1}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Thống kê hàng tháng</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Action</a>
                      <a href="#" class="dropdown-item">Another action</a>
                      <a href="#" class="dropdown-item">Something else here</a>
                      <a class="dropdown-divider"></a>
                      <a href="#" class="dropdown-item">Separated link</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">

      
                    <p class="text-center">
                       @if(App\Order::where('status','2')->orderBy('id', 'desc')->first())
                      <strong>1/1/2020-
                      {{date('d/m/Y', strtotime(App\Order::where('status','2')->orderBy('id', 'desc')->first()->date)) }}
                     </strong>
                    @endif
                     

                    <div class="chart">
                      <!-- Sales Chart Canvas -->
                      <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                    </div>
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <p class="text-center">
                      <strong>Mức độ hoàn thành mục tiêu</strong>
                    </p>

                    <div class="progress-group">
                      thêm sản phẩm vào giỏ hàng
                      <span class="float-right"><b>80</b>/200</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: 40%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      Số đơn hoàn thành
                      <span class="float-right"><b>{{App\Order::where('status','2')->count()}}</b>/100</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: <?= App\Order::where('status','2')->count()/100;?>%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">Lượng khách ghé</span>
                      <span class="float-right"><b>180</b>/360</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: 50%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                    Gửi liên hệ/Yêu cầu
                      <span class="float-right"><b>{{App\contact_user::all()->count()}}</b>/100</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width:  <?= App\contact_user::all()->count()/100;?>%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
               
                      <h5 class="description-header"> {{number_format(App\Order::where('status','2')->sum('total'),0,",",".")}} đ</h5>
                      <span class="description-text">tổng doanh thu</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">

                      <h5 class="description-header">{{number_format(App\Order::where('status','2')->sum('total')*85/100,0,",",".")}} đ</h5>
                      <span class="description-text">Tổng chi phí</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      
                      <h5 class="description-header">{{number_format(App\Order::where('status','2')->sum('total')*15/100,0,",",".")}} đ</h5>
                      <span class="description-text">tổng lợi nhuận</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                   
                    <!-- /.description-block -->
                  </div>
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-8">
            <!-- MAP & BOX PANE -->
            <div class="row">
              <div class="col-md-12">
                <!-- DIRECT CHAT -->
                <div class="card direct-chat direct-chat-warning">
                  <div class="card-header">
                    <h3 class="card-title">Bình luận gần đây</h3>
                    <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                   
                  </div>
                  <!-- /.card-header -->
                 
                  <div class="card-body">
                    @php $comment=App\comment::orderBy('id', 'desc')->get() @endphp
                 
                    <!-- Conversations are loaded here -->
                    <table id="product" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                             
                            <th>Tên Người dùng</th>
                            <th>Email</th>
                          
                               <th>Tên sản phẩm</th>
                               <th>Nội dung</th>
                                
                             
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comment->take(3) as $p)
                            <tr>
                               
                            <td>{{$p->user->name}}</td>
                            <td>{{$p->user->email}}</td>
                           
                                    <td>{{$p->product->name}}</td>
                                    <td>{{$p->content}}</td>
                                  
                            </tr>
                            @endforeach
                            </tbody>
                           
                        </table>
                        
                  
                    <!-- /.direct-chat-pane -->
                  </div>
                  <!-- /.card-body -->
                
                  <!-- /.card-footer-->
                </div>
                <!--/.direct-chat -->
              </div>
              <!-- /.col -->

             
              <!-- /.col -->
            </div>
            <!-- /.card -->
            <div class="row">
              <div class="col-md-12">
                <!-- DIRECT CHAT -->
                <div class="card direct-chat direct-chat-warning">
                  <div class="card-header">
                    <h3 class="card-title">Liên hệ gần đây</h3>
                 
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
             
                   
                  </div>
                  <!-- /.card-header -->
                 
                  <div class="card-body">
                    @php $contact=App\contact_user::orderBy('id', 'desc')->get() @endphp
                 
                    <!-- Conversations are loaded here -->
                    <table id="product" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                             
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Sđt</th>
                                <th>Tin nhắn</th>
                                
                             
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contact->take(3) as $p)
                            <tr>
                               
                                    <td>{{$p->name}}</td>
                                    <td>{{$p->email}}</td>
                                    <td>{{$p->phone}}</td>
                                   <td>{{$p->message}}</td>
                                  
                            </tr>
                            @endforeach
                            </tbody>
                           
                        </table>
                        
                  
                    <!-- /.direct-chat-pane -->
                  </div>
                  <!-- /.card-body -->
                
                  <!-- /.card-footer-->
                </div>
                <!--/.direct-chat -->
              </div>
              <!-- /.col -->

             
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Hóa đơn gần đây</h3>
                @php $orders=App\Order::where('status', 'not like','0')->orderBy('id', 'desc')->get() @endphp
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                    <th>Mã hóa đơn</th>
                    <th>Tên khách hàng</th>
                 <th>Tình trạng</th>
                    <th>Tổng tiền</th>
                    <th>Ngày đặt</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders->take(6) as $o)
                  
                            <tr>
                                <td>{{$o->id}}</td>
                                <td>{{$o->user->name}}
                                <td>@if($o->status=="1" )
                                <div class="alert alert-primary">
                                    đang xử lý
                                </div>
                                @else
                                <div class="alert alert-danger">
                                    đã hoàn thành
                                </div>
                                @endif</td>
                            <!--
                                @if($o->status=="1" )

                                <td class="status">
                             
                                    <select  style="padding-left: 15px;font-size:16px"  class="alert-primary custom-select mb-3">
                                
                                <option  value="{{$o->status}}"
                                     selected hidden > 
                                       đang  xử lý
                                </option>
                                
                                
                                 <option  value="1" >đang xử lý</option>
                                 <option value="2">đã hoàn thành</option>
                                 
                                </select></td>
                                @elseif($o->status=="2")
                                
                                <td><div class="alert alert-danger" role="alert">
                                 đã hoàn thành
                                </div></td>
                                @endif-->
                                <td>	{{number_format($o->total,0,",",".")}} đ</td>
                                <td>
                                {{date('d/m/Y', strtotime($o->date)) }}
                                </td>
                               
                                
                            </tr>
                          
                            @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
            
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-4">
            <!-- Info Boxes Style 2 -->
            <div class="info-box mb-3 bg-warning">
              <span class="info-box-icon"><i class="fas fa-tag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Hàng tồn kho</span>
                <span class="info-box-number">5,200</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-danger">
              <span class="info-box-icon"><i class="fas fa-cloud-download-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Lượng tải xuống</span>
                <span class="info-box-number">381</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-info">
              <span class="info-box-icon"><i class="far fa-comment"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Liên hệ</span>
                <span class="info-box-number">{{App\contact_user::all()->count()}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Trình duyệt sử dụng</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <div class="chart-responsive">
                      <canvas id="pieChart" height="150"></canvas>
                    </div>
                    <!-- ./chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <ul class="chart-legend clearfix">
                      <li><i class="far fa-circle text-danger"></i> Chrome</li>
                      <li><i class="far fa-circle text-success"></i> IE</li>
                      <li><i class="far fa-circle text-warning"></i> FireFox</li>
                      <li><i class="far fa-circle text-info"></i> Safari</li>
                      <li><i class="far fa-circle text-primary"></i> Opera</li>
                      <li><i class="far fa-circle text-secondary"></i> Navigator</li>
                    </ul>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
             
              <!-- /.footer -->
            </div>
            <!-- /.card -->

            <!-- PRODUCT LIST -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Sản phẩm vừa thêm</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                  @php
                    $Product=App\product::join('detail_product','detail_product.product_id','=','product.id')->
        where('product.status','1')->orderBy('product_id', 'desc')->get();
                  @endphp
                <ul class="products-list product-list-in-card pl-2 pr-2">
                    @foreach(  $Product->take(6) as $p)
                  <li class="item">
                    <div class="product-img">
                      <img src="{{ url('images/'.$p->image) }}" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title">{{$p->name}}
                        <span class="badge badge-warning float-right">{{number_format($p->price,0,",",".")}}  đ</span></a>
                     
                    </div>
                 @endforeach
                  <!-- /.item -->
                </ul>
              </div>
              <!-- /.card-body -->
            
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        
        <!-- /.row -->
        <div class="row">
        <div class="col-md-12">
        <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Thành viên mới đăng ký</h3>

                    <div class="card-tools">
                  
                      @if(App\User::all()->count()<8 && App\User::all()->count()>1) 
                      <span class="badge badge-danger">{{App\User::all()->count()-1}} thành viên mới</span>
                      @else
                      <span class="badge badge-danger">8 thành viên mới</span>
                      @endif
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                      </button>   
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <ul class="users-list clearfix">
                        @php  $users=App\User::where('id', 'not like', 1)->orderBy('id','desc')->get()@endphp
                        
                        @foreach($users->take(8) as $user)
                      <li>
                        
                        {{$user->name}}
                        <span class="users-list-date">{{$user->created_at->format('d/m/Y')}}</span>
                      </li>
                      @endforeach
                     
                    </ul>
                    <!-- /.users-list -->
                  </div>
                  <!-- /.card-body -->
                
                  <!-- /.card-footer -->
                </div>
                <!--/.card -->
              </div>
            </div><!--/.row -->
      </div><!--/. container-fluid -->
@endsection