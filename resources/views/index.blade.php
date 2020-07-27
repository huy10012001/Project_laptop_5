
<?php
use Illuminate\Support\Facades\DB;
use App\Order;
use App\order_product;
use App\User;

$cars=Order::find(19);

echo $cars->user;
