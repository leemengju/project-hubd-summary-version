@extends('layouts.app')

@section('title', '結帳')
@section('meta_description', '結帳')
@section('meta_keywords', '結帳')

@section('content')
<section class="mt-[150px]">
  <x-breadcrumb :items="[
             ['name' => '首頁', 'url' => route('home')],
             ['name' => '購物車', 'url' => route('cart')],
             ['name' => '結帳'],
         ]" />
  <div
    class="flex flex-wrap gap-10 items-start pt-10 pr-24 pb-20 pl-32 max-md:px-5 lg:mx-[120px] md:mx-[60px] sm:mx-[20px]">
    <!-- 確認地址與付款方式 -->
    <section class="grow shrink min-w-60 w-[495px] max-md:max-w-full">
      <div class="w-full max-md:max-w-full">
        <header
          class="flex flex-wrap gap-10 justify-between items-center w-full whitespace-nowrap max-md:max-w-full">
          <h2 class="gap-2.5 self-stretch my-auto text-3xl text-zinc-700">
            確認收件人地址
          </h2>
          <a href="{{ route('user.address') }}"
            class=" self-stretch pt-2.5 my-auto text-base font-bold tracking-wide leading-none  text-gray-500 underline  underline-offset-auto">
            變更收件人與地址
          </a>
        </header>

        <select class="mt-4 py-4 w-full text-base text-zinc-500 max-md:max-w-full flex flex-wrap gap-5 justify-between max-md:px-5">
          <option class="flex w-full truncate" value="1">台中市北區崇德路一段163號1樓 - 劉尚廉 (+886) 939022222</option>
          <option class="flex w-full truncate" alue="2">台南市東區大同路二段50巷12號 - 謝武言 (+886) 939357229</option>
          <option class="flex w-full truncate" value="3">新北市板橋區文化路二段168號 - 陳玉文 (+886) 946325598</option>
        </select>
      </div>

      <section class="mt-12 max-w-full max-md:mt-10">
        <header
          class="flex flex-wrap gap-10 justify-between items-center w-full whitespace-nowrap max-md:max-w-full">
          <h2 class="gap-2.5 self-stretch my-auto text-3xl text-zinc-700">
            付款方式
          </h2>
          <a href="{{ route('user.payment') }}"

            class="overflow-hidden justify-end self-stretch pt-2.5  text-base font-bold  leading-none  text-gray-500 underline  underline-offset-auto ">
            變更付款方式
          </a>
        </header>
        <select class="mt-4 w-full max-md:max-w-full text-base text-zinc-500">


          <option class="payment_type" value="信用卡付款">信用卡付款 - 劉尚廉-**** **** **** 5678</option>
          <option class="payment_type" value="信用卡付款">信用卡付款 - 陳文宣-**** **** **** 3764</option>
          <option class="payment_type" value="ATM轉帳">ATM轉帳</option>

        </select>
      </section>

      <a href="{{ route('successful_transaction') }}"
     

        class="makeOrder flex justify-center items-center px-10 py-4 mt-12 w-full text-2xl font-bold tracking-normal leading-none text-center text-white  bg-red-500 rounded-md max-md:px-5 max-md:mt-10 max-md:max-w-full">
        一鍵下訂
      </a>
    </section>
    <!------- 訂單商品明細 ------>
    <section
      class=" flex flex-col grow shrink rounded min-w-60 w-[448px] max-md:max-w-full">
      <!-- productDetail -->
      <article class="productDetail">
        <!-- <div
        class="flex gap-5 items-center self-stretch my-auto text-sm min-w-60 text-zinc-700">
        <div class="flex gap-6 items-center self-stretch my-auto min-w-60">
          <div
            class="flex shrink-0 self-stretch my-auto bg-zinc-700 h-[104px] w-[104px]"></div>
          <div class="self-stretch my-auto w-[214px]">
            <h3 class="text-lg leading-none text-neutral-700">
              LCD MonitorLCD Monitor
            </h3>
            <div
              class="flex flex-col items-start mt-1 max-w-full whitespace-nowrap w-[191px]">
              <div class="self-stretch py-1 w-40 rounded max-w-40">
                淺粉-100
              </div>
            </div>
            <p class="mt-1 leading-6">X 1</p>
          </div>
        </div>
      </div>
      <div class="flex  items-center self-stretch my-auto text-base">
        <div class="flex flex-col justify-center self-stretch my-auto">
          <p class="text-red-700">$650</p>
        </div>
      </div> -->
      </article>
      <!-- countDetail -->
      <section
        class="checkoutDetail overflow-hidden self-center py-8 w-full rounded max-w-[560px] max-md:px-5 max-md:max-w-full">
        <!-- <div
        class="flex flex-wrap gap-10 justify-between items-start w-full text-base whitespace-nowrap text-zinc-700 max-md:max-w-full">
        <p class="gap-1 self-stretch w-[171px]">商品金額</p>
        <p>$1750</p>
      </div>
      <div
        class="flex flex-wrap gap-10 justify-between items-start mt-5 w-full text-base whitespace-nowrap max-md:max-w-full">
        <p class="text-zinc-700">活動特惠</p>
        <p class="text-red-700">-$100</p>
      </div>
      <div
        class="flex flex-wrap gap-10 justify-between items-start mt-5 w-full text-base whitespace-nowrap text-zinc-700 max-md:max-w-full">
        <p class="gap-2.5 self-stretch w-16">運費</p>
        <p class="text-right">Free</p>
      </div>
      <div
        class="mt-5 w-full rotate-[8.742277657347563e-8rad] max-md:max-w-full">
        <hr
          class="z-10 shrink-0 h-px border border-solid bg-zinc-700 border-zinc-700 max-md:max-w-full" />
      </div>
      <div
        class="flex flex-wrap gap-10 justify-between items-start mt-5 w-full text-base whitespace-nowrap max-md:max-w-full">
        <p class="gap-2.5 self-stretch w-16 text-zinc-700">小計</p>
        <p class="text-red-700">$1650</p>
      </div> -->
      </section>
  </div>

</section>
@endsection
@push('scripts')
<!-- jQuery 內容 -->
<script>
  // <------------------------------------display-data-from-localstorage-------------------------------------------->
  function displayDataFromLocalStorage() {
    // 讀取 localStorage 中儲存的資料
    let productList = JSON.parse(localStorage.getItem("productList"));
    let cartPrice = JSON.parse(localStorage.getItem("cartPrice"));

    // 顯示商品資料
    for (let i = 0; i < productList.length; i++) {
      // console.log(i);
      let resultHTML = "";

      // Add the initial empty string before each HTML element
      resultHTML += ``;
      resultHTML += `<article class=" flex overflow-hidden flex-wrap gap-4 justify-between items-center px-6 py-4 w-full bg-white rounded border border-solid border-[color:var(--grey-light-hover,#E4E4E4)] max-md:px-5 max-md:max-w-full">`;

      resultHTML += `<div class="flex gap-5 items-center self-stretch my-auto text-sm min-w-60 text-zinc-700 ">`;

      resultHTML += `<div class="flex gap-6 items-center self-stretch my-auto min-w-60">`;

      resultHTML += `<img class="flex shrink-0 self-stretch my-auto h-[104px] w-[104px]" src=${(productList[i].product_img)}></img>`;

      resultHTML += `<div class="self-stretch my-auto w-[214px]">`;

      resultHTML += `<h3 class="text-lg leading-none text-neutral-700">${(productList[i].product_name)}</h3>`;

      resultHTML += `<div class="flex flex-col items-start mt-1 max-w-full whitespace-nowrap w-[191px]">`;

      resultHTML += `<div class="self-stretch py-1 w-40 rounded max-w-40">${(productList[i]. product_color)} - ${(productList[i]. product_size)}</div>`;

      resultHTML += `</div>`; // Closing the flex column container

      resultHTML += `<p class="mt-1 leading-6">X ${(productList[i].quantity)}</p>`;
      resultHTML += `</div>`; // Closing the inner div for product description
      resultHTML += `</div>`; // Closing the flex container for product details
      resultHTML += `</div>`; // Closing the container for the entire product section

      resultHTML += `<div class="flex gap-10 items-center self-stretch my-auto text-base">`;

      resultHTML += `<div class="flex flex-col justify-center self-stretch my-auto">`;

      // resultHTML += `<p class="text-red-700">$${(productList[i].discountPrice)}</p>`;

      resultHTML += `<p class="mt-3 text-zinc-700">`;

      resultHTML += `<span >$${(productList[i].product_price)}</span>`;

      resultHTML += `</p>`; // Closing the price and discount section
      resultHTML += `</div>`; // Closing the flex container for price details
      resultHTML += `</div>`; // Closing the outer div for product
      resultHTML += `</article>`;

      $(".productDetail").append(resultHTML); // Append the generated HTML to the container
    }


    //     <-------------------------------------------checkoutDetail---------------------------------------------------->
    let result_checkoutDetail = "";


    result_checkoutDetail += `<section >`;

    result_checkoutDetail += `<div class="flex flex-wrap gap-10 justify-between items-start w-full text-base whitespace-nowrap text-zinc-700 max-md:max-w-full">`;

    result_checkoutDetail += `<p class="gap-1 self-stretch w-[171px]">商品金額</p>`;

    result_checkoutDetail += `<p>$${(cartPrice.totalPrice)}</p>`;

    result_checkoutDetail += `</div>`; // Closing the item price section

    result_checkoutDetail += `<div class="flex flex-wrap gap-10 justify-between items-start mt-5 w-full text-base whitespace-nowrap max-md:max-w-full">`;

    result_checkoutDetail += `<p class="text-zinc-700">活動特惠</p>`;

    result_checkoutDetail += `<p class="text-red-700">${cartPrice.festivalMinus < 0 ? `-$${Math.abs(cartPrice.festivalMinus)}` :`$${cartPrice.festivalMinus}`}</p>`;

    result_checkoutDetail += `</div>`; // Closing the festivalMinus section
    result_checkoutDetail += `<div class="flex flex-wrap gap-10 justify-between items-start mt-5 w-full text-base whitespace-nowrap max-md:max-w-full">`;

    result_checkoutDetail += `<p class="text-zinc-700">優惠券折扣</p>`;

    result_checkoutDetail += `<p class="text-red-700">${cartPrice.couponMinus < 0 ? `-$${Math.abs(cartPrice.couponMinus)}` :`$${cartPrice.couponMinus}`}</p>`;

    result_checkoutDetail += `</div>`; // Closing the CouponMinus section

    result_checkoutDetail += `<div class="flex flex-wrap gap-10 justify-between items-start mt-5 w-full text-base whitespace-nowrap text-zinc-700 max-md:max-w-full">`;

    result_checkoutDetail += `<p class="gap-2.5 self-stretch w-16">運費</p>`;

    result_checkoutDetail += `<p class="text-right">Free</p>`;

    result_checkoutDetail += `</div>`; // Closing the shipping section

    result_checkoutDetail += `<div class="mt-5 w-full rotate-[8.742277657347563e-8rad] max-md:max-w-full">`;

    result_checkoutDetail += `<hr class="z-10 shrink-0 h-px border border-solid bg-zinc-700 border-zinc-700 max-md:max-w-full" />`;

    result_checkoutDetail += `</div>`; // Closing the divider

    result_checkoutDetail += `<div class="flex flex-wrap gap-10 justify-between items-start mt-5 w-full text-base whitespace-nowrap max-md:max-w-full">`;

    result_checkoutDetail += `<p class="gap-2.5 self-stretch w-16 text-zinc-700">小計</p>`;

    result_checkoutDetail += `<p class="text-red-700">$${(cartPrice.totalPriceWithDiscount)}</p>`;

    result_checkoutDetail += `</div>`; // Closing the subtotal section

    $(".checkoutDetail").append(result_checkoutDetail);
  }
  // 頁面加載時顯示資料
  displayDataFromLocalStorage();

  // <-----------------------------get-user_id-from-database--------------------------------->
  $(document).ready(function() {
  $.ajax({
      url: "{{ route('getCartData') }}", // 修改為正確的 URL
      method: 'GET',
      success: function(e) {
        // <---------------------將資料存入 localStorage-------------------------> 
        localStorage.setItem("user_id", JSON.stringify(e.user_id));
        let storedUserId = localStorage.getItem("user_id");
        if (storedUserId) {
          console.log("從 localStorage 讀取的 user_id:", JSON.parse(storedUserId));
        }
      
       
      }, //end of success
      error: function(error) {
        console.log(error); // 如果有錯誤，顯示錯誤訊息
      } //end of error
    }) //end of Ajax

  // <-----------------------------post-data-to-database--------------------------------->


    $(".makeOrder").on("click", function() {
      // Generate random trade_No ( digits) and order_id (8 digits)
      const order_id = Math.floor(Math.random() * 900 + 100); // Random 3 digits
      const trade_No = Math.floor(Math.random() * 90000000 + 10000000); // Random 8 digits

      // Get data from localstorage & views
      const id = localStorage.getItem("user_id");
      // console.log(id);
      const payment_type = $(".payment_type:selected").val();
      // console.log(payment_type)
      const trade_status = "交易成功"; // Default value
      const productList = JSON.parse(localStorage.getItem("productList"));
      const cartPrice = JSON.parse(localStorage.getItem("cartPrice"));
      // console.log(productList)
      // console.log(cartPrice)

      // <------------------------------給OrderMain資料表的資料Prepare data for InsertOrderMain API------------------------------>
      const orderMainData = {
        trade_No: trade_No,
        id: id,
        total_price_with_discount: cartPrice.totalPriceWithDiscount,
        payment_type: payment_type,
        trade_status: trade_status,
        order_id: order_id,
      };
      // console.log(orderMainData);

      // <------------------------------Insert order main data (InsertOrderMain)<------------------------------>
      $.ajax({
        url: 'http://localhost/client-side/public/InsertOrderMain',
        method: 'POST',
        contentType: "application/json", // 以 JSON 格式發送資料
        data: JSON.stringify({
          orderMainData: orderMainData
        }), // 傳遞 JSON 格式的購物車資料
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // 取得 CSRF Token
        },
        success: function(response) {
          console.log("Order Main Inserted Successfully:", response);
        },
        error: function(error) {
          console.error("Error inserting order main:", error);
        }
      });
      //  <-----------------------------給Orderdetail資料表的資料Prepare data for InsertOrderDetail API------------------------------>
      const orderDetailData = {
        order_id: order_id,
        products: productList.map(product => ({
          product_name: product.product_name,
          product_size: product.product_size,
          product_color: product.product_color,
          quantity: product.quantity,
          product_price: product.product_price
        }))
      };
      // console.log(orderDetailData);
      // <------------------------------Insert order details (InsertOrderDetail)--------------------------->
      $.ajax({
        url: 'http://localhost/client-side/public/InsertOrderDetail',
        method: 'POST',
        contentType: "application/json", // 以 JSON 格式發送資料
        data: JSON.stringify({
          productList: orderDetailData
        }), // 傳遞 JSON 格式的購物車資料
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // 取得 CSRF Token
        },
        success: function(response) {
          console.log("Success inserting order details::", response);
        },
        error: function(error) {
          console.error("Error inserting order details:", error);
        }
      });


      // <------------------------------Delete cart items (DeleteCart)--------------------------->
     
      const product_ids = {
        id: id, 
        products: productList.map(product => ({
          product_id: product.product_id,
          quantity: product.quantity
        }))
      };


      $.ajax({
        url: 'http://localhost/client-side/public/DeleteCart',
        method: 'POST',
        contentType: "application/json", // 以 JSON 格式發送資料
        data: JSON.stringify({
          product_ids: product_ids,
          _token: $('meta[name="csrf-token"]').attr('content') // CSRF token 用於保護

        }), // 傳遞 JSON 格式的購物車資料
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // 取得 CSRF Token
        },
        success: function(response) {
          console.log("Cart Items Deleted Successfully:", response);
        },
        error: function(error) {
          console.error("Error deleting cart items:", error);
        }
      }); //end of ajax_DeleteCart




      // <------------------------------update product stock (UpdateProductStock)--------------------------->

      const product_stock = {
        products: productList.map(product => ({
          product_id: product.product_id,
          quantity: product.quantity
        }))
      };

      $.ajax({
        url: 'http://localhost/client-side/public/UpdateProductStock',
        method: 'POST',
        contentType: "application/json", // 以 JSON 格式發送資料
        data: JSON.stringify({
          product_stock: product_stock,
          _token: $('meta[name="csrf-token"]').attr('content') // CSRF token 用於保護

        }), // 傳遞 JSON 格式的購物車資料
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // 取得 CSRF Token
        },
        success: function(response) {
          console.log("Cart Items Deleted Successfully:", response);
        },
        error: function(error) {
          console.error("Error deleting cart items:", error);
        }
      }); //end of ajax_UpdateProductStock
    }); //end of makeOrder
  }); //end of document.ready
  // <------------------------------renew cart SQLCommand --------------------------->

  //     INSERT INTO cart (product_id, product_name, product_size, product_color, quantity, id)
  // VALUES 
  //     ("ps001", "女裝百褶拼接寬鬆上衣", "S", "Black", 3, 19),
  //     ("ps002", "女裝不對稱異素材上衣", "L", "Black", 3, 19)
</script>
@endpush