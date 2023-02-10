<? //print_r($UM); ?> 
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/css/getorgchart.css" />
<style type="text/css">
    html, body {
        margin: 0px;
        padding: 0px;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }


    #people {
        width: 100%;
        height: 100%;
    }
</style>
<div class="container">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="<?=base_url()?>">Beranda</a><i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="javascript:;">Pencapaian</a>
            <i class="fa fa-circle"></i>
        </li>
        <li class="active">
            <?=$this->template->title?>
        </li>
    </ul>
    <!-- END PAGE BREADCRUMB -->

    <!-- BEGIN PAGE CONTENT INNER -->
    <div class="row margin-top-10">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet light">
                <div class="portlet-body">
					<div id="people"></div>
				</div>
			</div>
		</div>
	</div>

    <div class="modal fade" id="getCodeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg">
          <div class="modal-content">
               <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title" id="myModalLabel"> Detail </h4>
               </div>
               <div class="modal-body" id="getCode">
                    <div class="container">
                        <h2>Produksi Tahun <?=date('Y');?></h2>
                        <div>
                            <canvas id="myChart" width="800" height="400"></canvas>
                        </div>
                    </div>
               </div>
            </div>
       </div>
     </div>

</div>

<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/clockface/js/clockface.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/orgchart/getorgchart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script>
    function detail(noagen){
        contentForm = {};
        contentForm['noagen'] = noagen;

        $.ajax({
            method: "POST",
            url: "<?= base_url(); ?>" + "evaluasi/detail_maarMaapr",
            data: contentForm,
            success: function(msg){
                console.log(msg);
                var target1 = [];
                var target2 = [];
                $.each(msg["maar"], function(index,value){
                    target1.push(parseFloat(value.replace(",",".")));
                });
                 $.each(msg["maapr"], function(index,value){
                    target2.push(parseFloat(value.replace(",",".")));
                });

                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                  type: 'line',
                  data: {
                    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli','Agustus','September','Oktober','Nopember','Desember'],
                    datasets: [{
                      label: 'MAAR',
                      data: target1,
                      backgroundColor: "rgba(153,255,51,0.6)"
                    }, {
                      label: 'MAAPR',
                      data: target2,
                      backgroundColor: "rgba(255,153,0,0.6)"
                    }]
                  },
                  options: {
                        responsive: false
                    }
                });

                jQuery("#getCodeModal").modal('show');
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log('ERROR ' + errorThrown);
                console.log(XMLHttpRequest);
                console.log(textStatus);
                console.log(errorThrown);
            }
        }); 
    }

	var peopleElement = document.getElementById("people");
        var orgChart = new getOrgChart(peopleElement, {
            primaryFields: ["name", "title","maar", "maapr","noagen", "detail"],
            photoFields: ["image"],
            color : "darkblue",
            enableEdit: false,
            dataSource: [
                <? foreach($dataDisplay as $idx => $display){?>
                    { id: '<?=$display["NOAGEN"]?>', parentId: '<?=$display["ATASAN"]?>', name: '<a onclick="detail('+"'<?=$display['NOAGEN'];?>'"+');"> <?=$display["NAMAAGEN"]?> </a>', title: '<?=$display["JABATANAGEN"]?>', maar: "MAAR : <?=$display["MAAR"]?>", maapr: "MAAPR : <?=$display["MAAPR"]?>", noagen: '<?=$display["NOAGEN"]?>', image: '<?=base_url()?>asset/avatar/<?=$display["NOAGEN"];?>.jpg'},
                <? } ?>
            ],
            customize:{
                <? foreach($AM as $nomorAM){ ?>
                  '<?=$nomorAM?>': { color: "blue"},
                <? } ?>
                <? foreach($UM as $nomorUM){ ?>
                  '<?=$nomorUM?>': {color: "lightblue"},
                <? } ?>
                <? foreach($MA as $nomorMA){ ?>
                  '<?=$nomorMA?>': { color: "lightteal"},
                <? } ?>
                <? foreach($CMA as $nomorCMA){ ?>
                  '<?=$nomorCMA?>': { color: "teal"},
                <? } ?>
            }
        });
</script>