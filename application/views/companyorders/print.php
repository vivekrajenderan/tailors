
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>SS Tailor Order Details</title>

        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style>

            * { margin: 0; padding: 0; }
            body { font: 14px/1.4 Georgia, serif; }
            #page-wrap { width: 800px; margin: 0 auto; }

            textarea { border: 0; font: 14px Georgia, Serif; overflow: hidden; resize: none; }
            table { border-collapse: collapse; }
            table td, table th { border: 1px solid black; padding: 5px; }

            #header { height: 15px; width: 100%; margin: 20px 0; background: #222; text-align: center; color: white; font: bold 15px Helvetica, Sans-Serif; text-decoration: uppercase; letter-spacing: 4px; padding: 8px 0px; }

            #address { width: 250px; height: 150px; float: left; }
            #customer { overflow: hidden; }

            #logo { text-align: right; float: right; position: relative; margin-top: 25px; border: 1px solid #fff; max-width: 540px; max-height: 100px; overflow: hidden; }
            #logo:hover, #logo.edit { border: 1px solid #000; margin-top: 0px; max-height: 125px; }
            #logoctr { display: none; }            
            #logohelp { text-align: left; display: none; font-style: italic; padding: 10px 5px;}
            #logohelp input { margin-bottom: 5px; }
            .edit #logohelp { display: block; }
            .edit #save-logo, .edit #cancel-logo { display: inline; }
            .edit #image, #save-logo, #cancel-logo, .edit #change-logo, .edit #delete-logo { display: none; }
            #customer-title { font-size: 20px; font-weight: bold; float: left; }

            #meta { margin-top: 1px; width: 300px; float: right; }
            #meta td { text-align: right;  }
            #meta td.meta-head { text-align: left; background: #eee; }
            #meta td textarea { width: 100%; height: 20px; text-align: right; }

            #items { clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black; }
            #items th { background: #eee; }
            #items textarea { width: 80px; height: 50px; }
            #items tr.item-row td { border: 0; vertical-align: top; text-align: center;}
            #items td.description { width: 300px; }
            #items td.item-name { width: 175px; }
            #items td.description textarea, #items td.item-name textarea { width: 100%; }
            #items td.total-line { border-right: 0; text-align: right; }
            #items td.total-value { border-left: 0; padding: 10px; text-align: center;}
            #items td.total-value textarea { height: 20px; background: none; }
            #items td.balance { background: #eee; }
            #items td.blank { border: 0; }

            #terms { text-align: center; margin: 20px 0 0 0; }
            #terms h5 { text-transform: uppercase; font: 13px Helvetica, Sans-Serif; letter-spacing: 10px; border-bottom: 1px solid black; padding: 0 0 8px 0; margin: 0 0 8px 0; }
            #terms textarea { width: 100%; text-align: center;}

            textarea:hover, textarea:focus, #items td.total-value textarea:hover, #items td.total-value textarea:focus, .delete:hover { background-color:#EEFF88; }

            .delete-wpr { position: relative; }
            .delete { display: block; color: #000; text-decoration: none; position: absolute; background: #EEEEEE; font-weight: bold; padding: 0px 3px; border: 1px solid; top: -6px; left: -22px; font-family: Verdana; font-size: 12px; }
        </style>

    </head>
    <body>

        <div id="page-wrap">

            <div id="header">ORDER DETAILS</div>

            <div id="identity">

                <div id="address">
                    <?php echo isset($orders_list[0]['address']) ? $orders_list[0]['address'] : ""; ?>
                    <br>
                    Phone: <?php echo isset($orders_list[0]['mobileno']) ? $orders_list[0]['mobileno'] : ""; ?></div>

                <div id="logo">



                    <div id="logohelp">                
                        (max width: 540px, max height: 100px)
                    </div>
                    <img id="image" src="<?php echo base_url() . 'assets/logo.png'; ?>" alt="logo" />
                </div>

            </div>

            <div style="clear:both"></div>

            <div id="customer">

                <h6 id="customer-title"><?php echo isset($orders_list[0]['name']) ? $orders_list[0]['name'] : ""; ?></h6>

                <table id="meta">
                    <tr>
                        <td class="meta-head">Invoice #</td>
                        <td><?php echo isset($orders_list[0]['orderno']) ? $orders_list[0]['orderno'] : ""; ?></td>
                    </tr>
                    <tr>

                        <td class="meta-head">Order Date</td>
                        <td><?php echo isset($orders_list[0]['orderdate']) ? $orders_list[0]['orderdate'] : ""; ?></td>
                    </tr>
                    <tr>

                        <td class="meta-head">Order Date</td>
                        <td><?php echo isset($orders_list[0]['deliverydate']) ? $orders_list[0]['deliverydate'] : ""; ?></td>
                    </tr>
                    <tr>
                        <td class="meta-head">Amount Due</td>
                        <td><div class="due"><?php echo isset($orders_list[0]['balance_amount']) ? number_format($orders_list[0]['balance_amount'],2) : ""; ?></div></td>
                    </tr>

                </table>

            </div>

            <table id="items">

                <tr>
                    <th>Product Name</th>
                    <th>Size</th>           
                    <th>Meter</th>           
                    <th>Quantity</th>
                    <th>Price</th>
                  
                </tr>

                <tr class="item-row">                    
                    <td class="item-name"><?php echo isset($orders_list[0]['productname']) ? $orders_list[0]['productname'] : ""; ?></td>
                    <td><?php echo isset($orders_list[0]['psize']) ? $orders_list[0]['psize'] : ""; ?></td>
                    <td><?php echo isset($orders_list[0]['meter']) ? $orders_list[0]['meter'] : ""; ?></td>
                    <td><?php echo isset($orders_list[0]['quantity']) ? $orders_list[0]['quantity'] : ""; ?></td>
                    <td class="price"><?php echo isset($orders_list[0]['price']) ? number_format($orders_list[0]['price'],2) : ""; ?></td>                    
                </tr>		  


                
                <tr>

                    <td colspan="2" class="blank"> </td>
                    <td colspan="2" class="total-line">Total</td>
                    <td class="total-value"><div id="total"><?php echo isset($orders_list[0]['total_amount']) ? number_format($orders_list[0]['total_amount'],2) : ""; ?></div></td>
                </tr>
                <tr>
                    <td colspan="2" class="blank"> </td>
                    <td colspan="2" class="total-line">Amount Paid</td>

                    <td class="total-value"><?php echo isset($orders_list[0]['paid_amount']) ? number_format($orders_list[0]['paid_amount'],2) : ""; ?></td>
                </tr>
                <tr>
                    <td colspan="2" class="blank"> </td>
                    <td colspan="2" class="total-line balance">Balance Due</td>
                    <td class="total-value balance"><div class="due"><?php echo isset($orders_list[0]['balance_amount']) ? number_format($orders_list[0]['balance_amount'],2) : ""; ?></div></td>
                </tr>

            </table>

            <div id="terms">
                <h5>Terms</h5>
                NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.
            </div>

        </div>

        <script type="text/javascript">
            window.print();
        </script>
    </body>

</html>