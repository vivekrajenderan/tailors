
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>SS Tailor Order Details</title>

        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style>
            /*! Invoice Templates @author: Invoicebus @email: info@invoicebus.com @web: https://invoicebus.com @version: 1.0.0 @updated: 2017-09-07 12:09:32 @license: Invoicebus */
            /* Reset styles */
            @import url("https://fonts.googleapis.com/css?family=PT+Sans:400,700&subset=latin,latin-ext,cyrillic,cyrillic-ext");
            html, body, div, span, applet, object, iframe,
            h1, h2, h3, h4, h5, h6, p, blockquote, pre,
            a, abbr, acronym, address, big, cite, code,
            del, dfn, em, img, ins, kbd, q, s, samp,
            small, strike, strong, sub, sup, tt, var,
            b, u, i, center,
            dl, dt, dd, ol, ul, li,
            fieldset, form, label, legend,
            table, caption, tbody, tfoot, thead, tr, th, td,
            article, aside, canvas, details, embed,
            figure, figcaption, footer, header, hgroup,
            menu, nav, output, ruby, section, summary,
            time, mark, audio, video {
                margin: 0;
                padding: 0;
                border: 0;
                font: inherit;
                font-size: 100%;
                vertical-align: baseline;
            }

            html {
                line-height: 1;
            }

            ol, ul {
                list-style: none;
            }

            table {
                border-collapse: collapse;
                border-spacing: 0;
            }

            caption, th, td {
                text-align: left;
                font-weight: normal;
                vertical-align: middle;
            }

            q, blockquote {
                quotes: none;
            }
            q:before, q:after, blockquote:before, blockquote:after {
                content: "";
                content: none;
            }

            a img {
                border: none;
            }

            article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary {
                display: block;
            }

            /* Invoice styles */
            /**
             * DON'T override any styles for the <html> and <body> tags, as this may break the layout.
             * Instead wrap everything in one main <div id="container"> element where you may change
             * something like the font or the background of the invoice
             */
            html, body {
                /* MOVE ALONG, NOTHING TO CHANGE HERE! */
            }

            /** 
             * IMPORTANT NOTICE: DON'T USE '!important' otherwise this may lead to broken print layout.
             * Some browsers may require '!important' in oder to work properly but be careful with it.
             */
            .clearfix {
                display: block;
                clear: both;
            }

            .hidden {
                display: none;
            }

            .separator {
                height: 15px;
            }
            .separator.less {
                height: 10px !important;
            }

            #container {
                font: normal 14px/1.4em 'PT Sans', Sans-serif;
                margin: 0 auto;
                padding: 50px 65px;
                min-height: 1058px;
                position: relative;
            }

            #memo {
                min-height: 100px;
            }
            #memo .logo {
                float: left;
                margin-right: 20px;
            }
            #memo .logo img {
                width: 150px;
                height: 100px;
            }
            #memo .company-info {
                float: left;
                margin-top: 8px;
                max-width: 515px;
            }
            #memo .company-info span {
                color: #888;
                display: inline-block;
                min-width: 15px;
            }
            #memo .company-info > span:first-child {
                color: black;
                font-weight: bold;
                font-size: 28px;
                line-height: 1em;
            }
            #memo:after {
                content: '';
                display: block;
                clear: both;
            }

            #invoice-info {
                float: left;
                margin-top: 50px;
            }
            #invoice-info > div {
                float: left;
            }
            #invoice-info > div > span {
                display: block;
                min-width: 100px;
                min-height: 18px;
                margin-bottom: 3px;
            }
            #invoice-info > div:last-child {
                margin-left: 10px;
            }
            #invoice-info:after {
                content: '';
                display: block;
                clear: both;
            }

            #client-info {
                float: right;
                margin-top: 9px;
                margin-right: 30px;
                min-width: 220px;
            }
            #client-info > div {
                margin-bottom: 3px;
            }
            #client-info span {
                display: block;
            }
            #client-info .client-name {
                font-weight: bold;
            }

            #invoice-title-number {
                float: left;
                margin: 60px 0 10px 0;
            }
            #invoice-title-number span {
                display: inline-block;
                min-width: 15px;
                line-height: 1em;
            }
            #invoice-title-number #title {
                font-size: 30px;
                color: #396E00;
            }
            #invoice-title-number #number {
                font-size: 20px;
            }

            table {
                table-layout: fixed;
            }
            table th, table td {
                vertical-align: top;
                word-break: keep-all;
                word-wrap: break-word;
            }

            #items {
                margin-top: 40px;
            }
            #items .first-cell, #items table th:first-child, #items table td:first-child {
                width: 100px;
                text-align: left;
            }
            #items table {
                border-collapse: separate;
                width: 100%;
            }
            #items table th span:empty, #items table td span:empty {
                display: inline-block;
            }
            #items table th {
                font-weight: bold;
                padding: 10px;
                text-align: right;
                border-bottom: 2px solid #898989;
            }
            #items table th:nth-child(2) {
                width: 30%;
                text-align: left;
            }
            #items table th:last-child {
                text-align: right;
            }
            #items table td {
                border-bottom: 1px solid #C4C4C4;
                padding: 10px;
                text-align: right;
            }
            #items table td:first-child {
                text-align: left;
            }
            #items table td:nth-child(2) {
                text-align: left;
            }

            #sums {
                float: right;
                margin-top: 10px;
                page-break-inside: avoid;
            }
            #sums table tr th, #sums table tr td {
                min-width: 100px;
                padding: 10px;
                text-align: right;
            }
            #sums table tr th {
                text-align: left;
                padding-right: 25px;
            }
            #sums table tr.amount-total th {
                text-transform: uppercase;
                color: #396E00;
            }
            #sums table tr.amount-total th, #sums table tr.amount-total td {
                font-weight: bold;
                font-size: 16px;
                border-top: 2px solid #898989;
            }
            #sums table tr:last-child th {
                text-transform: uppercase;
                color: #396E00;
            }
            #sums table tr:last-child th, #sums table tr:last-child td {
                font-size: 16px;
                font-weight: bold;
            }

            #terms {    
                padding: 12px 0px;
                page-break-inside: avoid;
            }
            #terms > h4 {
                font-weight: bold;
            }
            #terms > div {
                color: #396E00;
                font-size: 16px;
                min-height: 70px;
                width: 100%;
                max-width: 500px;
            }

            .payment-info {
                color: #888;
                font-size: 12px;
                margin-top: 20px;
                width: 100%;
                max-width: 440px;
            }
            .payment-info div {
                display: inline-block;
                min-width: 15px;
            }

            .bottom-circles {
                width: 310px;
                height: 215px;
                -moz-background-size: 384px auto;
                -o-background-size: 384px auto;
                -webkit-background-size: 384px auto;
                background-size: 384px auto;
                position: absolute;
                bottom: 0;
                right: 0;
                overflow: hidden;
            }
            .bottom-circles section {
                position: relative;
            }
            .bottom-circles section div {
                -moz-border-radius: 50%;
                -webkit-border-radius: 50%;
                border-radius: 50%;
                display: inline-block;
                position: absolute;
            }
            .bottom-circles section > div:first-child {
                background: #396E00;
                left: 3px;
                width: 125px;
                height: 125px;
                top: 117px;
            }
            .bottom-circles section > div:first-child > div {
                background: #88C213;
                width: 60px;
                height: 60px;
                top: 32px;
                left: 32px;
                position: relative;
            }
            .bottom-circles section > div:last-child {
                background: #396E00;
                right: -65px;
                width: 280px;
                height: 280px;
            }
            .bottom-circles section > div:last-child > div {
                background: #88C213;
                top: 24px;
                left: 24px;
                width: 230px;
                height: 230px;
            }
            .bottom-circles section > div:last-child > div > div {
                background: #396E00;
                top: 58px;
                left: 58px;
                width: 115px;
                height: 115px;
            }
            .bottom-circles section > div:last-child > div > div > div {
                background: #FFF;
                top: 12px;
                left: 12px;
                width: 90px;
                height: 90px;
            }

            .show-mobile {
                display: none !important;
            }

            /**
             * If the printed invoice is not looking as expected you may tune up
             * the print styles (you can use !important to override styles)
             */
            @media print {
                /* Here goes your print styles */
                .ib_invoicebus_fineprint {
                    text-align: left;
                    text-indent: 65px;
                }
            }
        </style>

    </head>
    <body>
        <div id="container">

            <section id="memo">
                <div class="logo">
                    <img src="<?php echo base_url() . 'assets/logo.png'; ?>" />
                </div>

                <div class="company-info">
                    <span>SS Tailor</span>

                    <div class="separator less"></div>

                    <span>67, South Western Road,</span>  
                    <br>
                    <span>Chennai</span>  
                    <br>
                    <span>Mobile No : 9878787877</span>
                </div>
            </section>

            <section id="invoice-title-number">

                <span id="title">Order Details</span>
                <div class="separator"></div>
                <span id="number"><?php echo isset($orders_list[0]['orderno']) ? $orders_list[0]['orderno'] : ""; ?></span>

            </section>

            <div class="clearfix"></div>

            <section id="invoice-info">
                <div>
                    <span>Order Date</span>
                    <span>Delivery Date</span>        
                </div>

                <div>
                    <span><?php echo isset($orders_list[0]['orderdate']) ? $orders_list[0]['orderdate'] : ""; ?></span>
                    <span><?php echo isset($orders_list[0]['deliverydate']) ? $orders_list[0]['deliverydate'] : ""; ?></span>          
                </div>
            </section>

            <section id="client-info">
                <span>Client Details</span>
                <div>
                    <span class="client-name"><?php echo isset($orders_list[0]['name']) ? $orders_list[0]['name'] : ""; ?></span>
                </div>

                <div>
                    <span><?php echo isset($orders_list[0]['address']) ? $orders_list[0]['address'] : ""; ?></span>
                </div>

                <div>
                    <span>Mobile No : <?php echo isset($orders_list[0]['mobileno']) ? $orders_list[0]['mobileno'] : ""; ?></span>
                </div>


            </section>

            <div class="clearfix"></div>

            <section id="items">

                <table cellpadding="0" cellspacing="0">

                    <tr>

                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>           
                    </tr>

                    <tr data-iterate="item">

                        <td><?php echo isset($orders_list[0]['productname']) ? $orders_list[0]['productname'] : ""; ?></td>
                        <td><?php echo isset($orders_list[0]['quantity']) ? $orders_list[0]['quantity'] : ""; ?></td>
                        <td><?php echo isset($orders_list[0]['price']) ? $orders_list[0]['price'] : ""; ?></td>
                        <td><?php echo isset($orders_list[0]['total_amount']) ? $orders_list[0]['total_amount'] : ""; ?></td>

                    </tr>

                </table>

            </section>

            <section id="sums">

                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <th>Paid Amount</th>
                        <td><?php echo isset($orders_list[0]['paid_amount']) ? $orders_list[0]['paid_amount'] : ""; ?></td>
                    </tr>

                    <tr data-iterate="tax">
                        <th>Balance Amount</th>
                        <td><?php echo isset($orders_list[0]['balance_amount']) ? $orders_list[0]['balance_amount'] : ""; ?></td>
                    </tr>

                </table>

            </section>

            <div class="clearfix"></div>

            <section id="terms">
                <?php if (count($typeresult)) { ?>
                    <h4>Product Types</h4><span>
                        <div>
                            <?php
                            foreach ($typeresult as $key => $value) {

                                echo $value['typename'] . ",";
                            }
                            ?>
                        </div>
                    <?php }
                    ?>  </section>
                        <section id="terms">
                    <?php if (count($measurements)) { ?>
                        <h4>Measurement Details</h4><span>
                            <div>
                                <?php
                                foreach ($measurements as $key => $value) {
                                    if($key%4==0)
                                    {
                                        echo "<br>";
                                    }
                                    echo '<b>' . $value['mname'] . '</b> - ' . $value['measurementvalue'] . ',';
                                }
                                ?>
                            </div>
                        <?php }
                        ?>

                        </section>


                        <div class="bottom-circles">
                            <section>
                                <div>
                                    <div></div>
                                </div>
                                <div>
                                    <div>
                                        <div>
                                            <div></div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        </div>


                        <script type="text/javascript">
                            window.print();
                        </script>
                        </body>

                        </html>