@extends('layout_home')
@section( 'cart_detail')

	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Giỏ hàng</a></li>
				  <li class="active">chi tiết giỏ hàng</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu" style="color: black;">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">giá</td>
							<td class="quantity">số lượng</td>
							<td class="total">tổng tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="cart_product">
								<a href=""><img src="" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href=""></a></h4>

							</td>
							<td class="cart_price">
								<p></p>
							</td>
							<td class="">
								<div class="buttons_added">

                                    <input aria-label="quantity" class="input-qty" max="10" min="1" name="" type="number" value="">


								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price"></p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
							</td>
						</tr>


					</tbody>
				</table>
			</div>
        </div>

            <script>//<![CDATA[
$('input.input-qty').each(function() {
  var $this = $(this),
    qty = $this.parent().find('.is-form'),
    min = Number($this.attr('min')),
    max = Number($this.attr('max'))
  if (min == 0) {
    var d = 0
  } else d = min
  $(qty).on('click', function() {
    if ($(this).hasClass('minus')) {
      if (d > min) d += -1
    } else if ($(this).hasClass('plus')) {
      var x = Number($this.val()) + 1
      if (x <= max) d += 1
    }
    $this.attr('value', d).val(d)
  })
})
//]]></script>

    </section> <!--/#cart_items-->



@endsection