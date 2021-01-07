<script src="/vendor/jquery/jquery.min.js"></script>

<script>
    $('.page-header').text("Invoice");
</script>
<div id="page-wrapper" style="position: relative ;height:92.2%;">
    <div class="container-fluid">

    </div>
    <form id="mainn">
        <hr style="margin-top: 20px">
        <div class="row">
            <div class="col-lg-11">
                <label for="" style="COLOR: #0275d8;">Main Service</label>
            </div>
            <div class="dropdownn col-lg-6">
                <input type="text" placeholder="Search main services.." id="myInput" onclick="showList()" onkeyup="filterFunction()" autocomplete="off">
                <div id="myDropdown" class="dropdown-contentt" style="height:400px;width: 313px;overflow-y: auto">
                </div>
            </div>
            <div CLASS="col-lg-10" style="margin-top: 10px;">
                <div id="tablePrint" class="panel panel-primary">
                    <div class="panel-heading">
                        Chosen Service
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive" style="overflow-x: hidden;overflow-y: hidden;">
                            <table id="tablePrinttt" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Machine Type</th>
                                        <th>Tool</th>
                                        <th>Collet</th>
                                        <th>Tool Holder</th>
                                        <th>Stock</th>
                                        <th>Stock Quantity</th>
                                        <th>Customer</th>
                                        <th>Cost</th>
                                        <th>Price</th>
                                        <th>Date Of Selling</th>
                                    </tr>
                                </thead>
                                <tbody class="service">
                                </tbody>
                            </table>
                            <table id="tablePrintttt" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Machine Type</th>
                                        <th>Electrode</th>
                                        <th>Nozzle</th>
                                        <th>Shield</th>
                                        <th>Stock</th>
                                        <th>Stock Quantity</th>
                                        <th>Customer</th>
                                        <th>Cost</th>
                                        <th>Price</th>
                                        <th>Date Of Selling</th>
                                    </tr>
                                </thead>
                                <tbody class="servicee">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <hr style="margin-top: 50px;width:120%">
            </div>

            <div class="form-group" id="items" style="margin-top: 40px">

                <div class="row">
                    <div class="col-lg-6">
                        <label for="" style="COLOR: #0275d8;">Additional Services</label>
                    </div>
                    <div class="col-lg-6">
                        <label for="" style="COLOR: #0275d8;">Amount</label>
                    </div>
                </div>
                <div class="row itemRow">
                    <div class="col-lg-6">
                        <input type="text" id="addService" class="form-control">
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input type="number" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-secondary" id="addItem">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </button>
            <button class="btn btn-secondary" id="removeItem">
                <i class="fa fa-minus" aria-hidden="true"></i>
            </button>
            <div class="row" style="margin-top: 15px">
                <div class="col-lg-6">
                    <label for="" style="COLOR: #0275d8;">VAT</label>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6" style="    z-index: 0;">
                    <div class="input-group">
                        <span class="input-group-addon">%</span>
                        <input type="number" id="vatValue" class="form-control">
                    </div>
                </div>
            </div>
    </form>
    <div class="row" style="margin-top: 40px">
        <div class="col-lg-6">
            <button class="btn btn-primary" id="printBtnn">Internal Invoice</button>
        </div>
        <div class="col-lg-6">
            <button class="btn btn-success" id="printBtn">External Invoice</button>
        </div>
    </div>
</div>
<div id="print" class="container-fluid">
    <button class="btn btn-primary no-print" id="back">
        <i class="fa fa-arrow-left" aria-hidden="true"></i>
        Back
    </button>
    <h5 class="center" id="companyNameBig" style="COLOR: #0275d8;font-size: 36px;font-weight: bold;">Hemede Industry</h5>
    <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4">
            <img src="/dist/aaaa.ico">
        </div>
        <div class=" col-lg-4 col-sm-4  col-md-4">
            <p style="text-align: center;margin-top: 28px;">
                Charqieh,
                <br> Kaouthariyet El Saiyad Rd.
                <br> 70967028
            </p>
        </div>
        <div class="col right">
            <p style="margin-bottom: 0; margin-top: 10px;">
                <b style="COLOR: #0275d8;">Invoice Date:</b>
                <span id="dateDes">08/01/17</span>
            </p>
        </div>
    </div>

    <hr style="    margin-top: 8px;
    margin-bottom: 5px;">
    <div class="row">
        <div class="col-lg-12">
            <p STYLE="margin: 0 0 9px;">
                <b id="cName" style="COLOR: #0275d8;"></b>
                <br>
                <p id="cAddress"></p>
                <p STYLE="margin: 0 0 9px;">
                    <p id="cPhone"></p>
                </p>
                <p STYLE="right: 0;
    display: block;
    position: absolute;
    bottom: -4px;" >
                    <b style="COLOR: #0275d8;">Engineer:</b>
                    <span id="engineerDes">Ali Choaib</span>
                </p>
        </div>

    </div>
    <table class="table" style="margin-bottom: 5px;">
        <thead>
            <tr>
                <th style="COLOR: #0275d8;width:495px">Service</th>
                <th style="COLOR: #0275d8;width:596px">Date</th>
                <th style="COLOR: #0275d8;">Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td id="sName"></td>
                <td id="sDate"></td>
                <td id="sPrice"></td>
            </tr>
        </tbody>
    </table>
    <div id="internalInvoice">
        <p style="COLOR: #0275d8;font-size: 21px;">Costs</p>
        <table class="table" style="margin-bottom: 5px;">
            <thead>
                <tr>
                    <th style="COLOR: #0275d8;width:495px">Stock</th>
                    <th style="COLOR: #0275d8;width:596px">Quantity</th>
                    <th style="COLOR: #0275d8;">Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td id="stName"></td>
                    <td id="stQuantity"></td>
                    <td id="stPrice"></td>
                </tr>
            </tbody>
        </table>
        <table class="table" style="margin-bottom: 5px;">
            <thead>
                <tr>
                    <th style="COLOR: #0275d8;width:495px">Consumable</th>
                    <th style="COLOR: #0275d8;width:596px">Quantity</th>
                    <th style="COLOR: #0275d8;">Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td id="conName"></td>
                    <td id="conQuantity"></td>
                    <td id="conPrice"></td>
                </tr>
                <tr>
                    <td id="conNamee"></td>
                    <td id="conQuantityy"></td>
                    <td id="conPricee"></td>
                </tr>
                <tr>
                    <td id="cconName"></td>
                    <td id="cconQuantity"></td>
                    <td id="cconPrice"></td>
                </tr>
            </tbody>
        </table>
        <table class="table" style="margin-bottom: 5px;">
            <thead>
                <tr>
                    <th style="COLOR: #0275d8;width:495px">Fuel</th>
                    <th style="COLOR: #0275d8;width:495px">Machine Consumption</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td id="fuel"></td>
                    <td id="consumption"></td>


                </tr>
            </tbody>
        </table>
    </div>
    <table class="table" id="addServiceTable" style="margin-bottom: 5px;">
        <thead>
            <tr>
                <th style="COLOR: #0275d8;width:495px">Additional Performed</th>
                <th style="COLOR: #0275d8;width:596px">Date</th>
                <th style="COLOR: #0275d8;">Amount</th>
            </tr>
        </thead>
        <tbody id="itemPrint">
            <tr class="itemDes">
                <td class="des">Oil Change</td>
                <td id="sDate"></td>
                <td class="price">$25.00</td>
            </tr>
        </tbody>
    </table>
    <hr style="    margin-top: 8px;
    margin-bottom: 5px;">
    <div class="right" style="margin-top: 5px;">
        <h5 style="COLOR: #0275d8;margin-top: 0px;margin-bottom: 0px;">SUBTOTAL: <span id="total" style="COLOR: black;">$125.00</span></h5>
    </div>
    <div class="right" style="margin-top: 20px;">
        <h5 style="COLOR: #0275d8;margin-top: 0px;margin-bottom: 0px;">VAT: <span id="vat" style="COLOR: black;"></span></h5>
    </div>
    <hr style="    margin-top: 8px;
    margin-bottom: 5px;">
    <div class="right" style="margin-top: 30px;">
        <h5 style="COLOR: #0275d8;margin-top: 0px;margin-bottom: 0px;">TOTAL: <span id="vatTotal" style="COLOR: black;"></span></h5>
    </div>
</div>
</div>
<script>
    document.getElementById("printBtn").disabled = true;
    document.getElementById("printBtnn").disabled = true;
    var container = $("#myDropdown");

    function showList() {
        if (!($('#myDropdown:visible').length === 0)) {

        } else {
            $("#myDropdown").show();
        }
    }

    $(document).mouseup(function(e) {


        if (!container.is(e.target) && container.has(e.target).length === 0) {

            container.hide();

        }
    });

    function filterFunction() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        div = document.getElementById("myDropdown");
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            txtValue = a[i].textContent || a[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
            } else {
                a[i].style.display = "none";
            }
        }
    }
    $(function() {
        var mainn = $("#mainn");
        var printExternal = $("#printBtn");
        var internalInvoice = $("#internalInvoice");
        var print = $("#print");
        var printInternal = $("#printBtnn");


        print.hide();

        addItems(0);


        $("#printBtn").click(function(e) {
            if ($('#addService').val() == "")
                $('#addServiceTable').hide();
            else
                $('#addServiceTable').show();
            internalInvoice.hide();
            e.preventDefault();
            var total = 0.0;
            var vatv = $('#vatValue');
            var vat = $('#vat');
            var vatTotal = $('#vatTotal');
            $("#dateDes").text(getFormattedDate(new Date()));
            getCustomer();
            var row = $(".itemDes").first();
            $("#itemPrint").empty();
            $(".itemRow").each(function(i, e) {
                var des = $(this).find("input").first().val();
                var price = $(this).find("input").eq(1).val();

                if (des.trim() || price.trim()) {
                    var newRow = row.clone().appendTo($("#itemPrint"))
                    newRow.find('.des').text(des);
                    var priceNum = parseFloat(price);
                    if (priceNum == priceNum) {
                        total += priceNum;
                    } else {
                        priceNum = 0.0;
                    }

                    newRow.find('.price').text(`$${numberWithCommas(priceNum.toFixed(2))}`);
                }
            });
            if ($(".itemDes").length < 1) {
                var newRow = row.clone().appendTo($("#itemPrint"));
                newRow.find(".des").text("");
                newRow.find('.price').text("$0.00");
            }
            var paddedTotal = parseFloat(numberWithCommas(total.toFixed(2)));
            paddedTotal += parseFloat($('#priceOperation').text());

            if (total != total) {
                paddedTotal = "0.00"
            }
            vat.text("$" + (vatv.val() / 100 * paddedTotal).toFixed(2));

            vatTotal.text("$" + ((vatv.val() / 100 + 1) * paddedTotal).toFixed(2));
            $("#total").text(`$${paddedTotal}`);

            mainn.hide();
            printExternal.hide();
            printInternal.hide();
            print.show();
        });

        $("#printBtnn").click(function(e) {
            internalInvoice.show();
            if ($('#addService').val() == "")
                $('#addServiceTable').hide();
            e.preventDefault();
            var total = 0.0;
            var vatv = $('#vatValue');
            var vat = $('#vat');
            var vatTotal = $('#vatTotal');
            $("#dateDes").text(getFormattedDate(new Date()));
            getCustomer();
            var row = $(".itemDes").first();
            $("#itemPrint").empty();
            $(".itemRow").each(function(i, e) {
                var des = $(this).find("input").first().val();
                var price = $(this).find("input").eq(1).val();

                if (des.trim() || price.trim()) {
                    var newRow = row.clone().appendTo($("#itemPrint"))
                    newRow.find('.des').text(des);
                    var priceNum = parseFloat(price);
                    if (priceNum == priceNum) {
                        total += priceNum;
                    } else {
                        priceNum = 0.0;
                    }

                    newRow.find('.price').text(`$${numberWithCommas(priceNum.toFixed(2))}`);
                }
            });
            if ($(".itemDes").length < 1) {
                var newRow = row.clone().appendTo($("#itemPrint"));
                newRow.find(".des").text("");
                newRow.find('.price').text("$0.00");
            }
            var paddedTotal = parseFloat(numberWithCommas(total.toFixed(2)));
            paddedTotal += parseFloat($('#priceOperation').text());

            if (total != total) {
                paddedTotal = "0.00"
            }
            vat.text("$" + (vatv.val() / 100 * paddedTotal).toFixed(2));

            vatTotal.text("$" + ((vatv.val() / 100 + 1) * paddedTotal).toFixed(2));
            $("#total").text(`$${paddedTotal}`);

            mainn.hide();
            printExternal.hide();
            printInternal.hide();
            print.show();
        });
        $("#addItem").click(function(e) {
            e.preventDefault()

            addItems(1);
        });
        $("#removeItem").click(function(e) {
            e.preventDefault()

            removeItem();
        });
        $("#back").click(function(e) {
            e.preventDefault();
            printExternal.show();
            printInternal.show();
            mainn.show()
            print.hide();
        });

        function addItems(num) {
            var row = $('.itemRow').first();
            for (var i = 0; i < num; i++) {
                var newRow = row.clone().appendTo($("#items")).css({
                    "margin-top": "15px"
                });

                newRow.find("input").val("");
            }
        }

        function removeItem() {
            if ($('.itemRow').length > 1) {
                $(".itemRow").last().remove()
            }
        }

        function getFormattedDate(date) {
            var year = date.getFullYear();
            var month = (1 + date.getMonth()).toString();
            month = month.length > 1 ? month : '0' + month;
            var day = date.getDate().toString();
            day = day.length > 1 ? day : '0' + day;
            return month + '/' + day + '/' + year;
        }

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    });
</script>