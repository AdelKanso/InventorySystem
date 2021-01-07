<script src="/vendor/jquery/jquery.min.js"></script>

<script>
    $('.page-header').text("Dashboard");
</script>

<div id="page-wrapper" style="position: relative ;height:92.2%;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                </h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div id="customers" class="huge"></div>
                                <div>Customers!</div>
                            </div>
                        </div>
                    </div>
                    <a href="/customers">
                        <div class="panel-footer">
                            <span class="pull-left">View Customers</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-cogs fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div id="Operations" class="huge"></div>
                                <div>Operations!</div>
                            </div>
                        </div>
                    </div>
                    <a href="/items_sold">
                        <div class="panel-footer">
                            <span class="pull-left">View Operations</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary" id="electrodeContainer">
                    <div class="panel-heading" id="electrodeBody">
                        <div class="row">
                            <div class="col-xs-3">
                                <img src="dist/electrode.png" width="60" height="70">
                            </div>
                            <div class="col-xs-9 text-right">
                                <div id="electrode" class="huge"></div>
                                <div>Electrode!</div>
                            </div>
                        </div>
                    </div>
                    <a href="/machineConsumable">
                        <div class="panel-footer">
                            <span class="pull-left" id="viewElectrode">View Electrode</span>
                            <span class="pull-right" id="viewElectrodeArrow"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary" id="nozzleContainer">
                    <div class="panel-heading" id="nozzleBody">
                        <div class="row">
                            <div class="col-xs-3">
                                <img src="dist/nozzle.png" width="60" height="70">
                            </div>
                            <div class="col-xs-9 text-right">
                                <div id="nozzle" class="huge"></div>
                                <div>Nozzle!</div>
                            </div>
                        </div>
                    </div>
                    <a href="/machineConsumable">
                        <div class="panel-footer">
                            <span class="pull-left" id="viewNozzle">View Nozzle</span>
                            <span class="pull-right" id="viewNozzleArrow"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
        <!-- /.row -->
        <div class="row">
            <div class='container col-lg-7'>
                <div class='calendar'>
                    <div class='date-header'>
                        <i id='prev' class="fa fa-chevron-left time-skip"></i>
                        <div class='year-month'>
                            <span class='month'></span>
                            <span class='year'></span>
                        </div>
                        <i id='next' class="fa fa-chevron-right time-skip"></i>
                    </div>
                    <table class='days-body'>
                        <thead>
                            <tr class='days-row'>
                                <th>Sun</th>
                                <th>Mon</th>
                                <th>Tue</th>
                                <th>Wed</th>
                                <th>Thu</th>
                                <th>Fri</th>
                                <th>Sat</th>
                            </tr>
                        </thead>
                        <tbody class='calendar-days'></tbody>
                    </table>
                    <form class='select-date' style="display: none;">
                        <label for='month'>Go To: </label>
                        <select name='month' id='month'>
                            <option value=0>Jan</option>
                            <option value=1>Feb</option>
                            <option value=2>Mar</option>
                            <option value=3>Apr</option>
                            <option value=4>May</option>
                            <option value=5>Jun</option>
                            <option value=6>Jul</option>
                            <option value=7>Aug</option>
                            <option value=8>Sep</option>
                            <option value=9>Oct</option>
                            <option value=10>Nov</option>
                            <option value=11>Dec</option>
                        </select>
                        <input type='number' min='1' id='year'>
                    </form>
                </div>
                <div class='event-container'>
                    <div class='events visible'>
                        <span class='no-Events event-message'>There are no events today</span>
                        <button class='show-event-form rotate btn-success' data-toggle="modal" data-target="#exampleModal">Add new event</button>
                    </div>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Submit New Event</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: 15px;" onclick="closee();">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class='new-event-form '>
                                        <input id='new-event-desc' type="text" class="form-control" name='Note...' placeholder='desc'>
                                        <input type='button' class='submit-event rotate btn-success' onclick="submit()" value='submit'>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div CLASS="col-lg-5">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <i class="fa fa-credit-card fa-fw"></i> Latest Customers
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive" style="overflow-x: hidden;overflow-y: hidden;">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                    </tr>
                                </thead>
                                <tbody class="latest-customers">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    <div id="footerDiv">
        <div id="chartContainer" style="height: 200px; width: 45%;float: left;margin-left: 50px;"></div>
        <div id="hideTrial"></div>
        <div id="chartContainerr" style="height: 200px; width: 45%;float: right;margin-right: 50px;"></div>
        <div id="hideTrial2"></div>
    </div>
</div>


</div>

<script src="dist/js/canvasJs.js"></script>
<script type='text/javascript' src='dist/js/calendar.js'></script>
<script type="text/javascript">
    var dps = []; //dataPoints. 
    var dps1 = []; //dataPoints. 
    var dpss = []; //dataPoints. 
    var dps11 = []; //dataPoints. 

    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        legend: {
            fontSize: 15,
            fontColor: "#337ab7"
        },
        axisX: {
            intervalType: "day",
            interval: 1,
            lineColor: "#337ab7",
            gridColor: "#337ab7",
            labelFontColor: "#337ab7",
            valueFormatString: "DD MMM",
            stripLines: [{
                value: 32,
                color: "blue"
            }]
        },
        axisY: {
            lineColor: "#337ab7",
            includeZero: false,
            labelFontColor: "#337ab7",
            gridColor: "#337ab7",
            valueFormatString: "$####0.00",

        },
        data: [{
            color: "green",
            type: "line",
            showInLegend: true,
            name: "incomes",
            legendText: "Plasma Incomes",
            xValueFormatString: "DD MMM",
            yValueFormatString: "$##0.00",
            dataPoints: dps
        }, {
            color: "red",
            type: "line",
            showInLegend: true,
            name: "expenses",
            legendText: "Plasma Expenses",
            xValueFormatString: "DD MMM",
            yValueFormatString: "$##0.00",
            dataPoints: dps1
        }]
    });
    var chartt = new CanvasJS.Chart("chartContainerr", {
        animationEnabled: true,
        legend: {
            fontSize: 15,
            fontColor: "#337ab7"
        },
        axisX: {
            intervalType: "day",
            interval: 1,
            lineColor: "#337ab7",
            gridColor: "#337ab7",
            labelFontColor: "#337ab7",
            valueFormatString: "DD MMM",
            stripLines: [{
                value: 32,
                color: "blue"
            }]
        },
        axisY: {
            lineColor: "#337ab7",
            includeZero: false,
            labelFontColor: "#337ab7",
            gridColor: "#337ab7",
            valueFormatString: "$####0.00",

        },
        data: [{
            color: "green",
            type: "line",
            showInLegend: true,
            name: "incomess",
            legendText: "Router Incomes",
            xValueFormatString: "DD MMM",
            yValueFormatString: "$##0.00",
            dataPoints: dpss
        }, {
            color: "red",
            type: "line",
            showInLegend: true,
            name: "expensess",
            legendText: "Router Expenses",
            xValueFormatString: "DD MMM",
            yValueFormatString: "$##0.00",
            dataPoints: dps11
        }]
    });
</script>
<!-- /#page-wrapper -->