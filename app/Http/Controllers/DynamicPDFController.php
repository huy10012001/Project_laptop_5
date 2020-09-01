<?php

namespace App\Http\Controllers;

use App\Order;
use PDF;
use App;
use App\order_product;
use Illuminate\Http\Request;
USE Dompdf\Dompdf;
class DynamicPDFController extends Controller
{
    //
    function index()
    {
        
        $p=Order::find(21);
        return view('dynamic_pdf')->with(['p'=>$p]);
    }

    function pdf($id)
    {
        $order=Order::find($id);
        $dompdf = new Dompdf();        
        //GET OFFER DATA
        
        $dompdf->loadHtml(view('dynamic_pdf', ['p'=>$order]));
        $dompdf->render();
        return $dompdf->stream('chitiethoadon.pdf');
       // $pdf=App::make('dompdf.wrapper');
        //$pdf->loadHTML($this->convert_customer_data_to_html($id));
      //  $pdf->loadHTML('dynamic_pdf',['p'=>$order]); 
       // return $pdf->download('test.pdf');
      ////  $pdf=App::make('dompdf.wrapper');
    
      //return $pdf->stream(); 
    }
    function convert_customer_data_to_html($id)
    {
        $order=Order::find($id);
        $output=view('dynamic_pdf')->with(['p'=>$order])->render();
        return $output;
       // $order=Order::find($id);
       // $pdf = PDF::loadView('dynamic_pdf',['p'=>$order]); 
        //return $pdf->download('test.pdf');
       // return $pdf->stream();
       // $output="";
      /*  $output.='<table style="font-family: DejaVu Sans;border-collapse:collapse">
        <thead>
          <tr>
          <th>Ảnh sản phẩm</th>
          <th>Tên sản phẩm</th>
          <th>Giá</th>
          <th>Số lượng</th>
          <th>Thành tiền</th>
         
          </tr>
        </thead>
        <tbody>';
        foreach ($order->product as $product) {
           
            $output .= 
            '<tr>
            <td >'. $product->name.'</td>
            <td  style="white-space: nowrap;">'. number_format($product->pivot->price,0,",",".") . " đ".'</td>
            <td  style="white-space: nowrap;">'. $product->pivot->qty . " đ".'</td>
            <td style="white-space: nowrap;">'. number_format($product->pivot->amount,0,",",".") . " đ".'</td>
            
            ';
      
      }
      $output.='</tbody></table>';*/
        
      //  return $output;
    }
}
