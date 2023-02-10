<!DOCTYPE html>
<html>
    <head>
        <title>DASHBOARD</title>

        <script type="text/javascript" src="../../includes/js/chart/core.js"></script>
        <script type="text/javascript" src="../../includes/js/chart/charts.js"></script>
        <script type="text/javascript" src="../../includes/js/chart/animated.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery-2.2.1.min.js"></script>

        <style type="text/css">
            .preloader {
              position: fixed;
              top: 0;
              left: 0;
              width: 100%;
              height: 100%;
              z-index: 9999;
              background-color: #fff;
            }
            .preloader .loading {
              position: absolute;
              left: 50%;
              top: 50%;
              transform: translate(-50%,-50%);
              font: 14px arial;
            }

            .kolom {
                height: 450px;
                width: 260px;
                margin-bottom: 30px;
                float: left;
                margin-right: 20px;
                text-align: center;
            }

            .kolom2 {
                width: 280px;   
            }

            .kolom3 {
                width: 380px;
                float: left;
                text-align: center;
            }

            .kolom4 {
                width: 450px;
                float: left;
                text-align: center;
            }

            .kolom5 {
                width: 1000px;
                float: left;
                text-align: center;
            }

            .kolom6 {
                height: 200px;
                width: 260px;
                margin-top: 10%;
                float: left;
            }

            body, html {
                height: 100%;
                width: 100%;
            }

            body {
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            }

            h1 {
                color:#045FB4;
                font-size: 44px;
                font-family: Trebuchet MS;
            }

            small{
                font-size: 14px;
                color: #000000;
            }
            
            #chartdiv {
                width: 100%;
                height: 300px;
                padding-top: 10%;
                padding-left: 20px;
                margin-bottom: 15px;
            }
            
            #chartline {
                width: 100%;
                height: 400px;
            }

            #chartprocess_1 {
                width: 100%;
                height: 300px;
            }

            #chartapprove {
                /*background-color: #F7819F;*/
                width: 100%;
                height: 300px;
            }

            #chartprocess_2{
                /*background-color: #E6E6E6;*/
                width: 100%;
                height: 300px;
                padding-top: 10%;
                border-radius: 20px;
                border-style: solid;
                border-color: #3c8dbc;
            }

            #chartpelunasan{
                /*background-color: #E6E6E6;*/
                width: 100%;
                height: 300px;
                padding-top: 10%;
                padding-left: 20px;
                border-radius: 30px;
                border-style: solid;
                border-color: #3c8dbc;
                margin-bottom: 15px;
            }
            
            tr.border_bottom td {
                border-bottom:1pt solid black;
            }

        </style>
    </head>

    <body>
        <div class="preloader">
            <div class="loading">
                <img src="../../images/Poi.gif" width="80">
                <p>Harap Tunggu</p>
            </div>
        </div>
        <div class="header" style="text-align: center;">
            <h1>DASHBOARD</h1>
            <div class="kolom5">
                <div id="chartline"></div>
            </div>
            <div class="kolom6">
                <table style="text-align: left; width: 100%; font-size: 16px; font-style: italic;" >
                    <tr>
                        <td colspan="2" style="border-bottom-style: solid; font-size: 28px;">Portofolio</br>Tahun 2020</td>
                    </tr>
                    <tr>
                        <td width="25%">Total Polis</td>
                        <td width="75%">: <b>1000</b></td>
                    </tr>
                    <tr>
                        <td>Total Premi</td>
                        <td>: <b>Rp. 1.000.000.000</b></td>
                    </tr>
                    <tr>
                        <td>ANP</td>
                        <td>: <b>Rp. 10.000.000.000</b></td>
                    </tr>
            </table>
            </div>
            <div class="kolom kolom4">
                <div id="chartdiv"></div>
            </div>
        </div>

        <div id="header" style="height: 70px; width:100%; background-color: #F2F2F2; margin-bottom: 30px; float: left;">
            <form name="prop" action="<?=$PHP_SELF?>" method="get">
                <table>
                    <tr align="left">
                        <td width="45%"><h3>PRODUCTION TRACKING</h3></td>
                        <td>Regional Agency Head : </td>
                        <td width="10%">
                            <select class="form-control" name="rayon_cari" id="rayon_cari">
                                <option value="EAST REGIONAL AGENCY HEAD" selected>EAST</option>
                                <option value="WEST REGIONAL AGENCY HEAD">WEST</option>
                                <option value="SOUTH REGIONAL AGENCY HEAD">SOUTH</option>
                            </select>
                        </td>
                        <td>Periode :</td>
                        <td>
                            <select class="form-control" name="bulan_cari" id="bulan_cari">
                                <option value="">All</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-control" name="tahun_cari" id="tahun_cari">
                                <option value="2019">2019</option>
                                <option value="2020" selected>2020</option>
                                <option value="2021">2021</option>
                            </select>
                        </td>
                        <td width="10%" align="right">
                            <input type="submit" value="SEARCH" name="submit"> 
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="header">
            <div class="kolom">
            <!-- <div class="kolom" style="border-radius: 30px;border-style: solid; border-color: #3c8dbc;"> -->
                <label>
                    <b><i>Tracking</b></i>
                </label>
                <h1>WEST</h1>
                <label style="border-bottom-style: solid;">
                    Periode : 04/2020
                </label></br></br>
                <b><i>Proposal</b></i>
                <h1>100<small> / 1000</small></h1>
                <h4><i>Potensi Premi : </i></h4>
                <h4><?php echo "Rp. ".(number_format(10000000,0,',','.'));?><small style="font-size:12px"> / <?php echo "Rp. ".(number_format(1000000000,0,',','.'));?></small></h4>
                <h4><i>Potensi ANP : </i></h4>
                <h4><?php echo "Rp. ".(number_format(10000000,0,',','.'));?><small style="font-size:12px"> / <?php echo "Rp. ".(number_format(1000000000,0,',','.'));?></small></h4>
            </div>
        </div>

        <div class="header2">
            <div class="kolom kolom2">
                <label>
                    <b><i>On Process</b></i>
                </label></br>
                <h1>20<small> / 100</small></h1>
                <div id="chartprocess_1"></div>
            </div>

            <div class="kolom kolom3">
                <div id="chartprocess_2"></div>
            </div>
        </div>
        <div class="header2">
            <div class="kolom kolom2">
                <label>
                    <b><i>Approve</b></i>
                </label></br>
                <h1>80<small> / 100</small></h1>
                <div id="chartapprove"></div>
            </div>
            <div class="kolom kolom4" style="margin-bottom: 70px;">
                <div id="chartpelunasan"></div>
                <table style="text-align: left; width: 100%; font-size: 11px; font-style: italic;" >
            		<tr align="center">
            			<td colspan="5">Lunas : 1000</td>
            		</tr>
            		<tr align="center">
            			<td colspan="5">Premi : Rp 169.000.464</td>
            		</tr>
            		<tr align="center">
            			<td colspan="5">ANP : Rp 5.246.000.464</td>
            		</tr>
			
                    <tr>
                        <td width="20%">
                            Belum Lunas
                        </td>
                        <td width="25%">: 69</td>
                        <td></td>
                        <td width="20%" style="color: red;">
                            Batal
                        </td>
                        <td width="25%" style="color: red;">: 4</td>
                    </tr>
                    <tr><td></td></tr>
                    <tr>
                        <td style="border-bottom-style: solid;">
                            GAP Premi
                        </td>
                        <td style="border-bottom-style: solid;">
                            : 69
                        </td>
                        <td></td>
                        <td style="border-bottom-style: solid; color: red;">
                            GAP Premi
                        </td>
                        <td style="border-bottom-style: solid; color: red;">
                            : 45421569
                        </td>
                    </tr>
                    <tr>
                        <td>GAP ANP</td>
                        <td>: 102515455</td>
                        <td></td>
                        <td style="color: red;">GAP ANP</td>
                        <td style="color: red;">: 1111111111</td>
                    </tr>
            </table>
            </div>
        </div>

        <div class="header">
            <table style="width: 80%; margin-left: 10%;border-collapse: collapse;">
                <tr bgcolor="#89acd8" align="center" height="50px">
                    <th>No</th>
                    <th>Rayon RAH</th>
                    <th>Rayon</th>
                    <th>Nama SAM</th>
                    <th>Kantor</th>
                    <th>Proposal</th>
                    <th>Waiting</th>
                    <th>Pending</th>
                    <th>Approve</th>
                    <th>Bayar</th>
                    <th>Potensi Premi</th>
                    <th>Potensi ANP</th>
                    <th>Lunas</th>
                    <th>ANP Lunas</th>
                    <th>ANP Belum Lunas</th>
                </tr>
                <tr class="border_bottom">
                    <td>No</td>
                    <td>Rayon RAH</td>
                    <td>Rayon</td>
                    <td>Nama SAM</td>
                    <td>Kantor</td>
                    <td>Proposal</td>
                    <td>Waiting</td>
                    <td>Pending</td>
                    <td>Approve</td>
                    <td>Bayar</td>
                    <td>Potensi Premi</td>
                    <td>Potensi ANP</td>
                    <td>Lunas</td>
                    <td>ANP Lunas</td>
                    <td>ANP Belum Lunas</td>
                </tr>
            </table>
        </div>

        <div id="header" style="height: 50px; width:100%; color: #FFFFFF ; background-color: #000000; margin-top: 30px; float: left; padding-top: 23px; padding-left: 15px;">
            <footer>
                &copy;2020 PT. Asuransi Jiwa IFG | Divisi Teknologi Informasi
            </footer>
        </div>
        
    </body>
    
    </script>
    
    <script type="text/javascript">
        am4core.useTheme(am4themes_animated);
        var chart = am4core.create("chartline", am4charts.XYChart);

        chart.data = [{"date":"2020-01","value":"271"},{"date":"2020-02","value":"389"},{"date":"2020-03","value":"649"},{"date":"2020-04","value":"383"},{"date":"2020-05","value":"0"},{"date":"2020-06","value":"0"},{"date":"2020-07","value":"0"},{"date":"2020-08","value":"0"},{"date":"2020-09","value":"0"},{"date":"2020-10","value":"0"},{"date":"2020-11","value":"0"},{"date":"2020-12","value":"0"}] ; /* Add data */

        /* Create axes */
        var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
        dateAxis.renderer.minGridDistance = 50;
        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

        /* Create series */
        var series = chart.series.push(new am4charts.LineSeries());
        series.dataFields.valueY = "value";
        series.dataFields.dateX = "date";
        series.strokeWidth = 2;
        series.minBulletDistance = 10;
        series.tooltipText = "Jumlah Polis:[/][bold] {value}";
        series.tooltip.pointerOrientation = "vertical";

        /* Add cursor */
        chart.cursor = new am4charts.XYCursor();
        chart.cursor.xAxis = dateAxis;
    </script>

    <script type="text/javascript">
        am4core.useTheme(am4themes_animated);
        var chart = am4core.create("chartdiv", am4charts.PieChart);
        chart.width = 450;
        chart.height = 250;

        chart.data = [{"rayon_1":"WEST ","jumlah_1":"345"},{"rayon_1":"SOUTH","jumlah_1":"605"},{"rayon_1":"EAST ","jumlah_1":"697"}]; /* Add data */

        /* Add label */
        chart.innerRadius = 70;
        var label = chart.seriesContainer.createChild(am4core.Label);
        label.text = "IFGLIFE";
        label.horizontalCenter = "middle";
        label.verticalCenter = "middle";
        label.fontSize = 30;

        /* Add and configure Series */
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "jumlah_1";
        pieSeries.dataFields.category = "rayon_1";
    </script>

    <script type="text/javascript">
        am4core.useTheme(am4themes_animated);
        var chart = am4core.create("chartprocess_1", am4charts.PieChart);

        chart.data = [
                      {
                        "jenis_2":"PROCESS",
                        "jumlah_2":36},
                      {
                        "jenis_2":"DONE",
                        "jumlah_2":60}
                    ];

        /* Add label */
        chart.innerRadius = 80;
        var label = chart.seriesContainer.createChild(am4core.Label);
        label.text = "69%";
        label.horizontalCenter = "middle";
        label.verticalCenter = "middle";
        label.fontSize = 40;

        /* Add and configure Series */
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.labels.template.disabled = true;
        pieSeries.ticks.template.disabled = true;
        pieSeries.slices.template.tooltipText = "";
        pieSeries.dataFields.value = "jumlah_2";
        pieSeries.dataFields.category = "jenis_2";
        //pieSeries.slices.template.propertyFields.fill = "color_2";

    </script>

    <script type="text/javascript">
    $(document).ready(function(){
      $(".preloader").fadeOut();
    })
    </script>

    <script type="text/javascript">
        am4core.useTheme(am4themes_animated);
        var chart = am4core.create("chartprocess_2", am4charts.PieChart);
        chart.width = 350;
        chart.height = 250;

        chart.data = [
                      {
                        "jenis_3":"PROCESS",
                        "jumlah_3":0},
                      {
                        "jenis_3":"DONE",
                        "jumlah_3":60}
                    ];

        /* Add label */
        chart.innerRadius = 60;
        var label = chart.seriesContainer.createChild(am4core.Label);

        /* Add and configure Series */
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "jumlah_3";
        pieSeries.dataFields.category = "jenis_3";
        //pieSeries.slices.template.propertyFields.fill = "color_3";
        pieSeries.alignLabels = false;
        pieSeries.legendSettings.itemValueText = ": {value}";
        pieSeries.fontSize = 12;

        // Add a legend
        chart.legend = new am4charts.Legend();
        chart.legend.fontSize = 12;

    </script>

    <script type="text/javascript">
        am4core.useTheme(am4themes_animated);
        var chart = am4core.create("chartapprove", am4charts.PieChart);

        chart.data = [
                      {
                        "jenis_4":"PROCESS",
                        "jumlah_4":36},
                      {
                        "jenis_4":"DONE",
                        "jumlah_4":60}
                    ];

        /* Add label */
        chart.innerRadius = 80;
        var label = chart.seriesContainer.createChild(am4core.Label);
        label.text = "4.6%";
        //label.text = "<?=$percentase_approve;?>%";
        label.horizontalCenter = "middle";
        label.verticalCenter = "middle";
        label.fontSize = 40;

        /* Add and configure Series */
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.labels.template.disabled = true;
        pieSeries.ticks.template.disabled = true;
        pieSeries.slices.template.tooltipText = "";
        pieSeries.dataFields.value = "jumlah_4";
        pieSeries.dataFields.category = "jenis_4";
        //pieSeries.slices.template.propertyFields.fill = "color_4";
    </script>

    <script type="text/javascript">
        am4core.useTheme(am4themes_animated);
        var chart = am4core.create("chartpelunasan", am4charts.PieChart);
        chart.width = 350;
        chart.height = 250;

        chart.data = [
                      {
                        "jenis_5":"BELUM LUNAS",
                        "jumlah_5":36},
                      {
                        "jenis_5":"LUNAS",
                        "jumlah_5":60}
                    ];

        /* Add label */
        chart.innerRadius = 60;
        var label = chart.seriesContainer.createChild(am4core.Label);

        /* Add and configure Series */
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "jumlah_5";
        pieSeries.dataFields.category = "jenis_5";
        //pieSeries.slices.template.propertyFields.fill = "color_3";
        pieSeries.alignLabels = false;
        pieSeries.legendSettings.itemValueText = ": {value}";
        pieSeries.fontSize = 12;

        // Add a legend
        chart.legend = new am4charts.Legend();
        chart.legend.fontSize = 12;
    </script>
</html>