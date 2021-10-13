<?php print $sidebar_left; ?>

<div class="col-md-9">
  <div class="right_contant dashboard_right">
    <div class="top_right_content">
      <h1>Stockist Product Delevery</h1>
      <hr />
      <div class="product_delevery_aera">
        <div class="invoice_search_area">
          <input class="search_box" id="sale_inv" placeholder="Search Invoice" type="text" name="">
          <input class="search_btn" type="submit" name="" value="" onclick="invoice_details()">
          <script type="text/javascript">
                    function invoice_details() {
                        var inv = $('#sale_inv').val();
                        $('#inv_dtls_btn').val('Searching');
                        if (inv=='') {
                            creat_message_forhtml('','Invalid Invoice','');
                            $('#inv_dtls_btn').val('View Details');
                        } else {
                            jx.load('http://aponjonint.com/ajax/supplier_product_delevery/'+inv,function(data) {
                                var rData = data.split('|');
                                $('#inv_dtls').html(rData[1]);
                            });
                        }
                    }
                </script> 
        </div>
        <br>
        <center id="inv_dtls">
          Invalid invoice.
        </center>
      </div>
    </div>
  </div>
</div>
