<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>


	@php
    $products=App\product::where(['category_id'=>'1','status'=>"1"])
    ->join('detail_product','detail_product.product_id','=','product.id');
	$products=$products->paginate(2);
	
 	 @endphp
	  @foreach($products as $p)
	  
	<br/>
		 {{$p->name}}
		
	@endforeach
	{{$products->links()}}
	<br/>

	@foreach($category as $c)
	danh muc {{$c->id}}:


	@php
    $products[$c->id]=App\product::where(['category_id'=>$c->id,'status'=>"1"])
    ->join('detail_product','detail_product.product_id','=','product.id');
	$products[$c->id]=$products[$c->id]->paginate(2);
	
 	 @endphp
	  @foreach($products[$c->id] as $p[$c->id])
	  
	<br/>
		 {{$p[$c->id]->name}}
		
	@endforeach
	{{$products[$c->id]->links()}}
	<br/>
	@endforeach
	
</body>
</html>