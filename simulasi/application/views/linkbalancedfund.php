<div class="form-group">
  <label class="control-label col-md-3">Cara Bayar <span class="required"> * </span> </label>
  <div class="col-md-4">
										  <select class="form-control select2me" name="carabayar" id="carabayar" onChange="chooseCaraBayar()">
												<option value="">Pilih...</option>
												<option value="Bulanan">Bulanan</option>
												<option value="Kuartalan">Kuartalan</option>
												<option value="Semesteran">Semesteran</option>
												<option value="Tahunan">Tahunan</option>
                                                <option value="Sekaligus">Sekaligus</option>
											</select>
										</div>
									</div>
                                    <div class="form-group">
										<label class="control-label col-md-3">Usia
										</label>
										<div class="col-md-4">
											<input type="number" id="usia" name="usia" data-required="1" class="form-control"/ readonly>   
                                            
										</div>
                                        <span class="input-group-btn"><div class="col-md-4" style="display:inline">
												<button type="button" class="btn btn-default" id="cekusia" onClick="totalUsia();">Cek Usia</button></div></span>
                                        
									</div>
<div class="form-group">
	<label class="control-label col-md-3" style="font-weight:bold">Premi Sesuai Cara Bayar
	<span class="required">
		 *
	</span>
	</label>
	<div class="col-md-4">
		<div class="input-group">
			<span class="input-group-addon">
				<i>Rp.</i>
			</span>
			<input class="form-control" placeholder="Premi Sesuai Cara Bayar" type="number" name="premisesuaicarabayar" id="premisesuaicarabayar" onchange="handleCaraBayar()">
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>
<div class="form-group">
										<label class="control-label col-md-3" style="font-weight:bold">Jaminan Uang Asuransi TL1+TL2
										</label>
										<div class="col-md-4">
		<div class="input-group">
			<span class="input-group-addon">
				<i>Rp.</i>
			</span>
			<input class="form-control" placeholder="JUA TL1+TL2" type="number" name="juatl" id="juatl" onchange="" disabled>
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>
<div class="form-group">
  <label class="control-label col-md-3">Masa Pemb. Premi Yg Dikehendaki <span class="required"> * </span> </label>
  <div class="col-md-4">
											<input class="form-control" placeholder="" type="number" name="masapembpremi" id="masapembpremi" onchange="handlePembPremi()">
										</div>
                                        <span class="input-group-btn"><div class="col-md-4" style="display:inline">
                       <label>Tahun.</label></div>
                       </span>
</div>
<div class="form-group">
	<label class="control-label col-md-3" style="font-weight:bold">Asumsi Nilai Aktiva Bersih
	<span class="required">
		 *
	</span>
	</label>
	<div class="col-md-4">
		<div class="input-group">
			<span class="input-group-addon">
				<i>Rp.</i>
			</span>
			<input class="form-control" placeholder="Asumsi Nilai Aktiva Bersih" type="number" name="asumsinab" id="asumsinab" onchange="onAsumsiNab()">
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>
                                    
                                    <div class="form-group">
	<label class="control-label col-md-3" style="font-weight:bold">Top Up Berkala
	
	</label>
	<div class="col-md-4">
		<div class="input-group">
			<span class="input-group-addon">
				<i>Rp.</i>
			</span>
			<input class="form-control" placeholder="Top Up Berkala" type="number" name="topupberkalaunitlink" id="topupberkalaunitlink" onChange="OnHandleTopUpBerkala()">
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3" style="font-weight:bold">Top Up Sekaligus
	
	</label>
	<div class="col-md-4">
		<div class="input-group"><span class="input-group-addon"> <i>Rp.</i> </span>
		  <input class="form-control" placeholder="Top Up Sekaligus" type="number" name="topupsekaligusunitlink" id="topupsekaligusunitlink" onchange="onHandleTopUpSekaligus()">
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
         <span class="input-group-btn">
                                 <div class="col-md-4" style="display:inline"><label id="minimal"></label></div>
                       </span>
	</div>
</div>
<div class="form-group">
										<label class="control-label col-md-3">Selama <span class="required">
		 *
	</span> 
										</label>
                                        <div class="col-md-4">
										<input class="form-control" placeholder="" type="number" name="selama" id="selama" onchange="handleselama()">
										</div>
                                        <span class="input-group-btn">
                       <div class="col-md-4" style="display:inline"><label>Tahun (Diasumsikan Dibayar Per Tahun).</div></label> 
                       </span>
</div>
<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Saat Mulai</label>
															<div class="col-md-9">															
									
										<div class="input-group date date-picker" >
												<input type="text" class="form-control" readonly id="saatmulaiunitlink" name="saatmulaiunitlink" >
												<span class="input-group-btn">
												<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
												</span>
											</div>
															</div>
														</div>
                                                        <div class="form-group">
															<label class="control-label col-md-3">Dibuat</label>
															<div class="col-md-9">															
									
										<div class="input-group date date-picker" >
												<input type="text" class="form-control" readonly id="dibuatunitlink" name="dibuatunitlink" value="">
												<span class="input-group-btn">
												<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
												</span>
											</div>
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
                                                    											
<div class="form-group" style="border: 1px solid #444; padding: 10px;">                                                      						<div class="col-md-12">
																<div class="checkbox-list" data-error-container="#form_2_services_error">
												<label>
												<input type="checkbox" value="1" name="denganbeasiswaunitlink" id="denganbeasiswa" onClick="checkedBeasiswa(this)"/> Dengan Beasiswa </label>
											</div>
                                            <br>
                                        <div class="col-md-6">   
                                        <label>Usia Anak 
										</label>
                                        </div>
										<div class="col-md-6">
											<input type="number" id="usiaanakunitlink" name="usiaanakunitlink" data-required="1" class="form-control" disabled onChange="HandleUsiaAnak()"/>
										</div>
                                        <span class="input-group-btn"><div class="col-md-6" style="display:inline">
                       <label >Tahun</label></div>
                       </span>
                       
                       <br>
                       <div class="row">
													<div class="col-md-5">
														<div class="form-group">
															<label class="control-label col-md-12">Ekspektasi Biaya Pendidikan</label>
													</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">SD</label>
															<div class="col-md-9">
		<div class="input-group">
			<span class="input-group-addon">
				<i>Rp.</i>
			</span>
			<input class="form-control" placeholder="" type="number" name="sdunitlink" id="sd" onchange="" disabled>
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
													<!--/span-->
												</div>
                                                
                                                <div class="form-group">
															<label class="control-label col-md-3">SMP</label>
															<div class="col-md-9">
		<div class="input-group">
			<span class="input-group-addon">
				<i>Rp.</i>
			</span>
			<input class="form-control" placeholder="" type="number" name="smpunitlink" id="smp" onchange="" disabled>
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
													<!--/span-->
												</div>
												<div class="form-group">
															<label class="control-label col-md-3">SMA</label>
															<div class="col-md-9">
		<div class="input-group">
			<span class="input-group-addon">
				<i>Rp.</i>
			</span>
			<input class="form-control" placeholder="" type="number" name="smaunitlink" id="sma" onchange="onHandleSMAValue()" disabled>
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
													<!--/span-->
												</div>
                                                <div class="form-group">
															<label class="control-label col-md-3">PT</label>
															<div class="col-md-9">
		<div class="input-group">
			<span class="input-group-addon">
				<i>Rp.</i>
			</span>
			<input class="form-control" placeholder="" type="number" name="ptunitlink" id="pt" onchange="" disabled>
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
													<!--/span-->
												</div>
               			 </div>
        </div>
														
</div>
													<!--/span-->
                    </div>
    </div>
</div>

<br>

<table class="table table-striped table-bordered table-hover" id="datatable_ajax">
								<thead>
								<tr role="row" class="heading">
									
									<th width="33%">
										 Manfaat&nbsp;Tambahan
									</th>
									<th width="33%">
										 Jaminan Uang Asuransi
									</th>
									<th width="33%">
										 Premi Tambahan
									</th>
								</tr>
								<tr role="row" class="filter">
							
									<td>
												<p><input type="checkbox" class="group-checkable" id ="ci"onClick="checkedRider(this)">Perlindungan thd Penyakit Kritis (CI)</p>
                                                <p style="margin-top:12px"> 
                                                <input type="checkbox" class="group-checkable" id ="pa" onClick="checkedRider(this)">Personal Accident (PA), UA</p>
                                                <p style="margin-top:12px">
                                                <input type="checkbox" class="group-checkable" id ="wp" onClick="checkedRider(this)">Waiver Premium</p>
                                                <p style="margin-top:12px">
                                                <input type="checkbox" class="group-checkable" id="ctt" onClick="checkedRider(this)">Cacat Tetap Total, UA</p>
                                                <p style="margin-top:12px">
                                                <input type="checkbox" class="group-checkable" id="cpm" onClick="checkedRider(this)">Cash Plan Murni, Manfaat Harian</p>
                                                <p style="margin-top:12px">
                                                <input type="checkbox" class="group-checkable" id="cpb" onClick="checkedRider(this)">Cash Plan Bedah, Manfaat Bedah</p>
                                               <p style="margin-top:12px">
                                                <input type="checkbox" class="group-checkable" id="term" onClick="checkedRider(this)">Term, UA</p>                                               <td>
                                                <input type="number" class="form-control form-filter input-sm" name="juaci" id="juaci" disabled onChange="onJUACIMinimumHandle()">
                                                <input type="number" class="form-control form-filter input-sm" name="juapa" id="juapa" disabled style="margin-top:5px" onChange="onJUAPAMinimumHandle()">
                                                <input type="number" class="form-control form-filter input-sm" name="juawp" id="juawp" style="margin-top:5px" disabled readonly>
                                                <input type="number" class="form-control form-filter input-sm" name="juactt" id="juactt" disabled style="margin-top:5px" onChange="onJUACTTMinimumHandle()">

<div class="row" style="margin-top:5px">


<div class="col-md-3">																<input type="number" class="form-control form-filter input-sm" name="dropdowncpm" id="dropdowncpm" disabled onChange="handleCPM()">
</div>															<div class="col-md-9">															<input type="number" class="form-control form-filter input-sm" name="juacpm" id="juacpm" disabled>														</div>
													<!--/span-->
												
                                        </div>
                                                <div class="row" style="margin-top:5px">


<div class="col-md-3">																<input type="number" class="form-control form-filter input-sm" name="dropdowncpb" id="dropdowncpb" disabled onClick="handleCPB()" onChange="onChangeCPB()">
</div>															<div class="col-md-9">															<input type="number" class="form-control form-filter input-sm" name="juacpb" id="juacpb" disabled> 														</div>

													<!--/span-->
												
                                        </div>
                                                <input type="number" class="form-control form-filter" name="juaterm" id="juaterm" disabled style="margin-top:5px" onChange="onJUATERMMinimumHandle()">
                                                
									</td>
									<td>
										<input type="number" class="form-control form-filter input-sm" name="premitambahanci" id="premitambahanci" disabled>
                                        <input type="number" class="form-control form-filter input-sm" name="premitambahanpa" id="premitambahanpa" disabled style="margin-top:5px">
                                        <input type="number" class="form-control form-filter input-sm" name="premitambahanwp" id="premitambahanwp" disabled readonly style="margin-top:5px">
                                        <input type="number" class="form-control form-filter input-sm" name="premitambahanctt" id="premitambahanctt" disabled style="margin-top:5px">
                                        <input type="number" class="form-control form-filter input-sm" name="premitambahancpm" id="premitambahancpm" disabled style="margin-top:5px">
                                        <input type="number" class="form-control form-filter input-sm" name="premitambahancpb" id="premitambahancpb" disabled style="margin-top:5px">
                                        <input type="number" class="form-control form-filter input-sm" name="premitambahanterm" id="premitambahanterm" disabled style="margin-top:5px;height:34px">
									</td>
								</tr>
								</thead>
								<tbody>
								</tbody>
</table>
                                <div class="form-group">
										<label class="control-label col-md-3" style="font-weight:bold">Total Premi Sesuai Cara Bayar 
										</label>
										<div class="col-md-4">
		<div class="input-group">
			<span class="input-group-addon">
				<i>Rp.</i>
			</span>
			<input class="form-control" placeholder="Total Premi Sesuai Cara Bayar" type="number" name="totalpremisesuaicarabayarunitlink" id="totalpremisesuaicarabayarunitlink" onchange="" disabled>
		</div>
	</div>
      <span class="input-group-btn"><div class="col-md-4" style="display:inline">
												<button type="button" class="btn btn-default" id="cektotalpremi" onClick="onHitungTotalPremi()">Cek Total Premi</button></div></span>
                                       
</div>
                                    <div class="form-group">
										<label class="control-label col-md-3" style="font-weight:bold">Kesanggupan Membayar Premi (Lebih Besar dari Total Premi sesuai Cr Bayar) 
										</label>
										<div class="col-md-4">
		<div class="input-group">
			<span class="input-group-addon">
				<i>Rp.</i>
			</span>
			<input class="form-control" placeholder="Kesanggupan Membayar Premi" type="number" name="kesanggupanmembayarpremiunitlink" id="kesanggupanmembayarpremiunitlink" onchange="OnHandleKesanggupanMembayarPremi()">
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
             <span class="input-group-btn">
                       <div class="col-md-4" style="display:inline"><label>* Kelipatan 100.000</div></label> 
                       </span>
            
		</div>
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3">Nomor Financial Consultant<span class="required">
		 
	</span></label>
	
	<div class="col-md-3">
			<input class="form-control" placeholder="Nomer Agen" type="text" name="nomeragen" id="nomeragen">
		<span class="help-block">
			 Masukkan nomer agen, kosongkan bila tidak ada.
		</span>
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3">Nama Financial Consultant<span class="required">
		 
	</span></label>
	
	<div class="col-md-3">
			<input class="form-control" placeholder="Nama Agen" type="text" name="namaagen" id="namaagen">
		<span class="help-block">
			 Masukkan nama agen, kosongkan bila tidak ada.
		</span>
	</div>
</div>

<script>
    jQuery(document).ready(function() {       
       // initiate layout and plugins
       App.init();
       ComponentsPickers.init();
	   $("#dibuatunitlink").datepicker("setDate", new Date());
	   
	   $("#juaci").change(function() {
					
					var juaci = $("#juaci").val();
					
					var masapembpremi = $("#masapembpremi").val();
					var usia = $("#usia").val();
					
					var carabayar = $("#carabayar").val();	
					
					if (carabayar == "Bulanan")
					{
						faktorcb = 0.095;
					}
					else if (carabayar == "Kuartalan")
					{
						faktorcb = 0.27;
					}
					else if (carabayar == "Semesteran")
					{
						faktorcb = 0.52;
					}
					else if (carabayar == "Tahunan")
					{
						faktorcb = 1;
					}
					else if (carabayar == "Sekaligus")
					{
						faktorcb = 1;
					}
						
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('linkbalancedfund/hitungpremitambahan');?>",
						data	: "juaci="+juaci+"&masapembpremi="+masapembpremi+"&faktorcb="+faktorcb+"&usia="+usia,
						success : function(data) {
							$("#premitambahanci").val(data);
						}
					});
				});
				
				$("#juapa").change(function() {
					
					var juapa = $("#juapa").val();
					
					var masapembpremi = $("#masapembpremi").val();
					var usia = $("#usia").val();
					
					var carabayar = $("#carabayar").val();	
					
					if (carabayar == "Bulanan")
					{
						faktorcb = 0.095;
					}
					else if (carabayar == "Kuartalan")
					{
						faktorcb = 0.27;
					}
					else if (carabayar == "Semesteran")
					{
						faktorcb = 0.52;
					}
					else if (carabayar == "Tahunan")
					{
						faktorcb = 1;
					}
					else if (carabayar == "Sekaligus")
					{
						faktorcb = 1;
					}
						
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('linkbalancedfund/hitungpremitambahanPA');?>",
						data	: "juapa="+juapa+"&masapembpremi="+masapembpremi+"&faktorcb="+faktorcb+"&usia="+usia,
						success : function(data) {
							$("#premitambahanpa").val(data);
						}
					});
				});
				
				$("#wp").click(function() {
					
					if (document.getElementById('wp').checked) {
					var premisesuaicarabayar = $("#premisesuaicarabayar").val();
					
					var masapembpremi = $("#masapembpremi").val();			
					var carabayar = $("#carabayar").val();	
						
					if ((masapembpremi == "") || (premisesuaicarabayar == ""))
					{
						alert("Mohon Isi Cara Pembayaran atau Masa Pembayaran Premi Terlebih Dahulu!");
						$('#wp').click();
					}
					else if ((masapembpremi != "") && (premisesuaicarabayar != "")) 
					{
						var carabayar = $("#carabayar").val();	
						
						if (carabayar == "Bulanan")
						{
							kali = 12;
						}
						else if (carabayar == "Kuartalan")
						{
							kali = 4;
						}
						else if (carabayar == "Semesteran")
						{
							kali = 2;
						}
						else if (carabayar == "Tahunan")
						{
							kali = 1;
						}
						else if (carabayar == "Sekaligus")
						{
							kali = 0;
						}
					
					}
					
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('linkbalancedfund/hitungjuaWP');?>",
						data	: "premisesuaicarabayar="+premisesuaicarabayar+"&masapembpremi="+masapembpremi+"&kali="+kali,
						success : function(data) {
							$("#juawp").val(data);
							
							var juawp = $("#juawp").val();
					
							var masapembpremi = $("#masapembpremi").val();
							var usia = $("#usia").val();
							
							var carabayar = $("#carabayar").val();	
							
							if (carabayar == "Bulanan")
							{
								faktorcb = 0.095;
							}
							else if (carabayar == "Kuartalan")
							{
								faktorcb = 0.27;
							}
							else if (carabayar == "Semesteran")
							{
								faktorcb = 0.52;
							}
							else if (carabayar == "Tahunan")
							{
								faktorcb = 1;
							}
							else if (carabayar == "Sekaligus")
							{
								faktorcb = 1;
							}
								
							$.ajax({
								type	: "POST",
								url		: "<?=base_url('linkbalancedfund/hitungpremitambahanWP');?>",
								data	: "juawp="+juawp+"&masapembpremi="+masapembpremi+"&faktorcb="+faktorcb+"&usia="+usia,
								success : function(data) {
									$("#premitambahanwp").val(data);
								}
							});
						}
					});
						
					}
					else
					{
						
					
					}
					
				});
			
				/*$("#juawp").click(function() {
					
					var premisesuaicarabayar = $("#premisesuaicarabayar").val();
					
					var masapembpremi = $("#masapembpremi").val();				
					
					if (masapembpremi == "")
					{
						alert("Mohon Isi Masa Pembayaran Premi Terlebih Dahulu!");
					}
					else
					{
						
						var carabayar = $("#carabayar").val();	
						
						if (carabayar == "Bulanan")
						{
							kali = 12;
						}
						else if (carabayar == "Kuartalan")
						{
							kali = 4;
						}
						else if (carabayar == "Semesteran")
						{
							kali = 2;
						}
						else if (carabayar == "Tahunan")
						{
							kali = 1;
						}
						else if (carabayar == "Sekaligus")
						{
							kali = 0;
						}
					
					}
					
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('linkbalancedfund/hitungjuaWP');?>",
						data	: "premisesuaicarabayar="+premisesuaicarabayar+"&masapembpremi="+masapembpremi+"&kali="+kali,
						success : function(data) {
							$("#juawp").val(data);
						}
					});
					
				});*/
				
				$("#premitambahanwp").focus(function() {
					
					var juawp = $("#juawp").val();
					
					var masapembpremi = $("#masapembpremi").val();
					var usia = $("#usia").val();
					
					var carabayar = $("#carabayar").val();	
					
					if (carabayar == "Bulanan")
					{
						faktorcb = 0.095;
					}
					else if (carabayar == "Kuartalan")
					{
						faktorcb = 0.27;
					}
					else if (carabayar == "Semesteran")
					{
						faktorcb = 0.52;
					}
					else if (carabayar == "Tahunan")
					{
						faktorcb = 1;
					}
					else if (carabayar == "Sekaligus")
					{
						faktorcb = 1;
					}
						
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('linkbalancedfund/hitungpremitambahanWP');?>",
						data	: "juawp="+juawp+"&masapembpremi="+masapembpremi+"&faktorcb="+faktorcb+"&usia="+usia,
						success : function(data) {
							$("#premitambahanwp").val(data);
						}
					});
				});
				
				$("#juactt").change(function() {
					
					var juactt = $("#juactt").val();
					
					var masapembpremi = $("#masapembpremi").val();
					var usia = $("#usia").val();
					
					var carabayar = $("#carabayar").val();	
					
					if (carabayar == "Bulanan")
					{
						faktorcb = 0.095;
					}
					else if (carabayar == "Kuartalan")
					{
						faktorcb = 0.27;
					}
					else if (carabayar == "Semesteran")
					{
						faktorcb = 0.52;
					}
					else if (carabayar == "Tahunan")
					{
						faktorcb = 1;
					}
					else if (carabayar == "Sekaligus")
					{
						faktorcb = 1;
					}
						
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('linkbalancedfund/hitungpremitambahanCTT');?>",
						data	: "juactt="+juactt+"&masapembpremi="+masapembpremi+"&faktorcb="+faktorcb+"&usia="+usia,
						success : function(data) {
							$("#premitambahanctt").val(data);
						}
					});
				});
				
				$("#dropdowncpm").change(function() {
					
					var gendernasabah = $("#gendernasabah").val();	
					var usia = $("#usia").val();
					
					var masacpm =$("#dropdowncpm").val();
					
					if (usia < 20)
					{
						usia = 20;	
					}
					else
					{
						usia = $("#usia").val();
					}
					
					if (gendernasabah == "M")
					{
						kodetarif = "CPML";	
					}
					else if (gendernasabah == "F")
					{
						kodetarif = "CPMP";
					}
					
					var carabayar = $("#carabayar").val();	
					
					if (carabayar == "Bulanan")
					{
						faktorcb = 0.095;
					}
					else if (carabayar == "Kuartalan")
					{
						faktorcb = 0.27;
					}
					else if (carabayar == "Semesteran")
					{
						faktorcb = 0.52;
					}
					else if (carabayar == "Tahunan")
					{
						faktorcb = 1;
					}
					else if (carabayar == "Sekaligus")
					{
						faktorcb = 1;
					}
					
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('linkbalancedfund/hitungpremitambahanCPM');?>",
						data	: "masacpm="+masacpm+"&usia="+usia+"&faktorcb="+faktorcb+"&kodetarif="+kodetarif,
						success : function(data) {
							$("#premitambahancpm").val(data);
						}
					});
					
				});
				
				$("#dropdowncpb").click(function() {
					
					var gendernasabah = $("#gendernasabah").val();	
					var usia = $("#usia").val();
					
					var masacpb = $("#dropdowncpb").val();
					
					if (usia < 20)
					{
						usia = 20;	
					}
					else
					{
						usia = $("#usia").val();
					}
					
					if (gendernasabah == "M")
					{
						kodetarif = "CPBL";	
					}
					else if (gendernasabah == "F")
					{
						kodetarif = "CPBP";
					}
					
					var carabayar = $("#carabayar").val();	
					
					if (carabayar == "Bulanan")
					{
						faktorcb = 0.095;
					}
					else if (carabayar == "Kuartalan")
					{
						faktorcb = 0.27;
					}
					else if (carabayar == "Semesteran")
					{
						faktorcb = 0.52;
					}
					else if (carabayar == "Tahunan")
					{
						faktorcb = 1;
					}
					else if (carabayar == "Sekaligus")
					{
						faktorcb = 1;
					}
					
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('linkbalancedfund/hitungpremitambahanCPB');?>",
						data	: "masacpb="+masacpb+"&usia="+usia+"&faktorcb="+faktorcb+"&kodetarif="+kodetarif,
						success : function(data) {
							$("#premitambahancpb").val(data);
						}
					});
					
				});
				

				$("#juaterm").change(function() {
					
					var juaterm = $("#juaterm").val();
					
					var masapembpremi = $("#masapembpremi").val();
					var usia = $("#usia").val();
					
					var carabayar = $("#carabayar").val();	
					
					if (carabayar == "Bulanan")
					{
						faktorcb = 0.095;
					}
					else if (carabayar == "Kuartalan")
					{
						faktorcb = 0.27;
					}
					else if (carabayar == "Semesteran")
					{
						faktorcb = 0.52;
					}
					else if (carabayar == "Tahunan")
					{
						faktorcb = 1;
					}
					else if (carabayar == "Sekaligus")
					{
						faktorcb = 1;
					}
						
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('linkbalancedfund/hitungpremitambahanTERM');?>",
						data	: "juaterm="+juaterm+"&masapembpremi="+masapembpremi+"&faktorcb="+faktorcb+"&usia="+usia,
						success : function(data) {
							$("#premitambahanterm").val(data);
						}
					});
				});
    }); 
	
	function onTotalPremiSesuaiCaraBayar(input){
		var totalpremisesuaicarabayarunitlink = document.getElementById('totalpremisesuaicarabayarunitlink');
		var premisesuaicarabayar = document.getElementById('premisesuaicarabayar');	
		var premitambahanci = document.getElementById('premitambahanci'); 	
		var premitambahanpa = document.getElementById('premitambahanpa');
		var premitambahanwp = document.getElementById('premitambahanwp');
		var premitambahanctt = document.getElementById('premitambahanctt');
		var premitambahancpm = document.getElementById('premitambahancpm');
		var premitambahancpb = document.getElementById('premitambahancpb');
		var premitambahanterm = document.getElementById('premitambahanterm');
		
		if (premisesuaicarabayar.value != "")
		{
			totalpremisesuaicarabayarunitlink.value = premisesuaicarabayar.value + premitambahanci.value + premitambahanpa.value + premitambahanwp.value + premitambahanctt.value + premitambahancpm.value + premitambahancpb.value + premitambahanterm.value;
		}
		else
		{
			alert('Premi Sesuai cara Bayar Wajib Diisi!');	
		}
	}
	
	function onHandleSMAValue(input){
		
		var sma = document.getElementById('sma');
		var pt = document.getElementById('pt');
		
		pt.value = (2 * sma.value);	
	}
	
	function HandleUsiaAnak(input){
		
		var usiaanak = document.getElementById('usiaanakunitlink');
		if (usiaanak.value < 0)
		{
			alert("Isi Usia Anak antara 0 sampai 13!");	
			usiaanak.value = "";
		}
		else if (usiaanak.value > 13)
		{
			alert("Isi Usia Anak antara 0 sampai 13!");
			usiaanak.value = "";
		}		
	}
	
	function onJUACIMinimumHandle(input){
	var juaci = document.getElementById('juaci');
	
		if (juaci.value < 5000000)
		{
			alert("JUA Minimal 5000000!");
			juaci.value = 5000000;
		}
		
		
	}
	
	function onJUAPAMinimumHandle(input){
	var juapa = document.getElementById('juapa');
	
		if (juapa.value < 5000000)
		{
			alert("JUA Minimal 5000000!");
			juapa.value = 5000000;
		}
	}
	
	function onJUACTTMinimumHandle(input){
	var juactt = document.getElementById('juactt');
	
		if (juactt.value < 5000000)
		{
			alert("JUA Minimal 5000000!");
			juactt.value = 5000000;
		}
	}
	
	function onJUATERMMinimumHandle(input){
	var juaterm = document.getElementById('juaterm');
	
		if (juaterm.value < 5000000)
		{
			alert("JUA Minimal 5000000!");
			juaterm.value = 5000000;
		}
	}
	
	function totalUsia(input){
	var lahir = document.getElementById('lahirnasabah');
	var usia = document.getElementById('usia');	
	
		if (lahir.length != 0)
		{			
			var birthday = +new Date(lahir.value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
		
			usia.value = usiasekarang;
			
			if (usiasekarang > 60 && usiasekarang <=65)
			{
				alert("Untuk Usia > 60 Tahun Maka Cara Bayar Harus Sekaligus!");	
				var carabayar = document.getElementById("carabayar");
				
				
				$('#carabayar').val('Sekaligus');
				$('#carabayar').trigger('change');
				carabayar.disabled = true;
				document.getElementById('masapembpremi').value = 1;	
				document.getElementById('selama').value = 1;	
			}
			else if (usiasekarang > 65)
			{
				alert("Maksimum usia untuk mengikuti produk Asuransi ini adalah 65 tahun!");	
				usia.value = "";
			}
			else
			{
				carabayar.disabled = false;	
			}
		}
		else
		{	
		  alert('Masukkan Tanggal Lahir Terlebih Dahulu!');
		}
	}
	
	function handleCPM(input){
		var dropdowncpm = document.getElementById('dropdowncpm');
		var juacpm = document.getElementById('juacpm');	
		
		switch(dropdowncpm.value)
		{
			case '1':
				juacpm.value = 100000;
				break;	
			case '2':
				juacpm.value = 200000;
				break;
			case '3':
				juacpm.value = 300000;
				break;
			case '4':
				juacpm.value = 400000;
				break;
			case '5':
				juacpm.value = 500000;
				break;
		}
		
		if (dropdowncpm.value < 1)
		{
			alert('Masukkan antara 1 - 5');
		} 
		else if (dropdowncpm.value > 5)
		{
			alert('Masukkan antara 1 - 5');
		}
		else if (document.getElementById('cpb').checked == true)
		{
			document.getElementById('dropdowncpb').value = dropdowncpm.value;
		}
	}
	
	function onChangeCPB(input){
		var dropdowncpb = document.getElementById('dropdowncpb');
		var dropdowncpm = document.getElementById('dropdowncpm');	
		
		dropdowncpb.value = dropdowncpm.value;
	}
	
	function handleCPB(input){
		var dropdowncpb = document.getElementById('dropdowncpb');
		var juacpb = document.getElementById('juacpb');	
		var juacpm = document.getElementById('juacpm');	
		
		switch(dropdowncpb.value)
		{
			case '1':
				juacpb.value = juacpm.value * 10;
				break;	
			case '2':
				juacpb.value = juacpm.value * 10;
				break;
			case '3':
				juacpb.value = juacpm.value * 10;
				break;
			case '4':
				juacpb.value = juacpm.value * 10;
				break;
			case '5':
				juacpb.value = juacpm.value * 10;
				break;
		}
		
		if (dropdowncpb.value < 1)
		{
			alert('Masukkan antara 1 - 5');
		} 
		else if (dropdowncpb.value > 5)
		{
			alert('Masukkan antara 1 - 5');
		}
		
	
	}
	
	function onAsumsiNab(input){
	var asumsinab = document.getElementById("asumsinab");
	var minimal = document.getElementById("minimal");
		
	asumsinab.value = (asumsinab.value+'.0000');
	minimal.innerHTML = "Minimal Rp. "+(asumsinab.value * 1000);
	}

	function onHandleTopUpSekaligus(input){
	var asumsinab = document.getElementById("asumsinab");
	var topupsekaligus = document.getElementById("topupsekaligusunitlink");
	asumsinab = parseInt(asumsinab.value * 1000);
		if (topupsekaligus.value < asumsinab)
		{
			if (topupsekaligus.value != "" || topupsekaligus.value != 0)
			{
				alert("Minimal Top Up Sekaligus Rp. "+ asumsinab);
				topupsekaligus.value = asumsinab;
			}
		}
	}
		  
	function checkedBeasiswa(input){
	$("#denganbeasiswa").click(function() {
				
				if (document.getElementById('denganbeasiswa').checked) {
					document.getElementById("usiaanakunitlink").disabled = false;
					document.getElementById("sd").disabled = false;
					document.getElementById("smp").disabled = false;
					document.getElementById("sma").disabled = false;
				} else {
					document.getElementById("usiaanakunitlink").disabled = true;
					document.getElementById("sd").disabled = true;
					document.getElementById("smp").disabled = true;
					document.getElementById("sma").disabled = true;
					document.getElementById("usiaanakunitlink").value = "";
					document.getElementById("sd").value = "";
					document.getElementById("smp").value = "";
					document.getElementById("sma").value = "";
				}
			});
	}
	
	function checkedRider(input){
	$("#ci").click(function() {
	if (document.getElementById('ci').checked) {
		document.getElementById("juaci").disabled = false;
	}
	else {
		document.getElementById("juaci").disabled = true;
		document.getElementById("juaci").value = "";
		document.getElementById("premitambahanci").value = "";
	}
	});

	$("#pa").click(function() {
		if (document.getElementById('pa').checked) {
			document.getElementById("juapa").disabled = false;
		}
		else {
			document.getElementById("juapa").disabled = true;
			document.getElementById("juapa").value = "";
			document.getElementById("premitambahanpa").value = "";
		}
	});

	$("#wp").click(function() {
		if (document.getElementById('wp').checked) {
			document.getElementById("juawp").disabled = false;
			document.getElementById("premitambahanwp").disabled = false;
		}
		else {
			document.getElementById("juawp").disabled = true;
			document.getElementById("juawp").value = "";
			document.getElementById("premitambahanwp").disabled = true;
			document.getElementById("premitambahanwp").value = "";
		}
	});

	$("#ctt").click(function() {
		if (document.getElementById('ctt').checked) {
			document.getElementById("juactt").disabled = false;
		}
		else {
			document.getElementById("juactt").disabled = true;
			document.getElementById("juactt").value = "";
			document.getElementById("premitambahanctt").value = "";
		}
	});

	$("#cpm").click(function() {
		if (document.getElementById('cpm').checked) {
			document.getElementById("dropdowncpm").disabled = false;
		}
		else {
			document.getElementById("dropdowncpm").disabled = true;
			document.getElementById("dropdowncpm").value = "";
			document.getElementById("juacpm").value = "";
			document.getElementById("premitambahancpm").value = "";
			
			if (document.getElementById('cpb').checked == true)
			{
				$('#cpb').click();
			}
		}	
	});

	$("#cpb").click(function() {
		
		//if (document.getElementById('cpm').checked == true){
			if (document.getElementById('cpb').checked) {
				
				if (document.getElementById('cpm').checked == true){
				document.getElementById("dropdowncpb").disabled = false;
				document.getElementById("dropdowncpb").value = document.getElementById("dropdowncpm").value;	
		}
				else
				{
					alert('Anda Harus Mengambil Cash Plan Murni Terlebih Dahulu!');
			$('#cpb').click();
			alert.stop();	
				}
			}
			else {
				document.getElementById("dropdowncpb").disabled = true;
				document.getElementById("dropdowncpb").value = "";
				document.getElementById("premitambahancpb").value = "";
				document.getElementById("juacpb").value = "";
			}
		/*}
		else
		{	
			alert('Anda Harus Mengambil Cash Plan Murni Terlebih Dahulu!');
			$('#cpb').click();
			alert.stop();
		}*/
	});

	$("#term").click(function() {
		if (document.getElementById('term').checked) {
			document.getElementById("juaterm").disabled = false;
		}
		else {
			document.getElementById("juaterm").disabled = true;
			document.getElementById("juaterm").value = "";
			document.getElementById("premitambahanterm").value = "";
		}
	});
	}
	function handlePembPremi()
	{
		var pembpremi = document.getElementById("masapembpremi");
		var carabayar = document.getElementById("carabayar");
		var selectedValue = carabayar.options[carabayar.selectedIndex].value;
		var usia = document.getElementById("usia");
		
		if (usia.value != "")
		{
			if (selectedValue != "")
			{  
				if (usia.value < 61)
				{
					if (selectedValue == "Bulanan")
					{
						var usiamin = 5;
						var usiamax = 65 - usia.value;
						if (pembpremi.value < usiamin)
						{
							alert("Isi Masa Pembayaran Premi Antara "+usiamin+" - "+usiamax+" Tahun!");
							pembpremi.value = usiamin;
						}
						else if (pembpremi.value > usiamax)
						{	
							alert("Isi Masa Pembayaran Premi Antara "+usiamin+" - "+usiamax+" Tahun!");
							pembpremi.value = usiamax;
						} 	
					}
					else if (selectedValue == "Kuartalan")
					{
						var usiamin = 5;
						var usiamax = 65 - usia.value;
						if (pembpremi.value < usiamin)
						{
							alert("Isi Masa Pembayaran Premi Antara "+usiamin+" - "+usiamax+" Tahun!");
							pembpremi.value = usiamin;
						}
						else if (pembpremi.value > usiamax)
						{	
							alert("Isi Masa Pembayaran Premi Antara "+usiamin+" - "+usiamax+" Tahun!");
							pembpremi.value = usiamax;
						} 		
					}
					else if (selectedValue == "Semesteran")
					{
						var usiamin = 5;
						var usiamax = 65 - usia.value;
						if (pembpremi.value < usiamin)
						{
							alert("Isi Masa Pembayaran Premi Antara "+usiamin+" - "+usiamax+" Tahun!");
							pembpremi.value = usiamin;
						}
						else if (pembpremi.value > usiamax)
						{	
							alert("Isi Masa Pembayaran Premi Antara "+usiamin+" - "+usiamax+" Tahun!");
							pembpremi.value = usiamax;
						} 		
					}
					else if (selectedValue == "Tahunan")
					{
						var usiamin = 5;
						var usiamax = 65 - usia.value;
						if (pembpremi.value < usiamin)
						{
							alert("Isi Masa Pembayaran Premi Antara "+usiamin+" - "+usiamax+" Tahun!");
							pembpremi.value = usiamin;
						}
						else if (pembpremi.value > usiamax)
						{	
							alert("Isi Masa Pembayaran Premi Antara "+usiamin+" - "+usiamax+" Tahun!");
							pembpremi.value = usiamax;
						} 		
					}
					else if (selectedValue == "Sekaligus")
					{
						var usiamin = 1;
						var usiamax = 1;
						if (pembpremi.value < usiamin)
						{
							alert("Untuk Pembayaran Sekaligus Masa Pemb Premi Hanya Berlaku Untuk 1 Tahun!");
							pembpremi.value = 1;
						}
						else if (pembpremi.value > usiamax)
						{	
							alert("Untuk Pembayaran Sekaligus Masa Pemb Premi Hanya Berlaku Untuk 1 Tahun!");
							pembpremi.value = 1;
						} 		
					}
				}
				else if (usia.value > 60)
				{
					if (selectedValue == "Sekaligus")
					{
						var usiamin = 1;
						var usiamax = 1;
						if (pembpremi.value < usiamin)
						{
							alert("Untuk Pembayaran Sekaligus Masa Pemb Premi Hanya Berlaku Untuk 1 Tahun!");
							pembpremi.value = 1;
						}
						else if (pembpremi.value > usiamax)
						{	
							alert("Untuk Pembayaran Sekaligus Masa Pemb Premi Hanya Berlaku Untuk 1 Tahun!");
							pembpremi.value = 1;
						} 		
					}
				}
			}
			else
			{
				alert("Pilih Cara Bayar terlebih Dahulu!");	
			}
		}
		else 
		{
			alert("Mohon Cek Usia Terlebih Dahulu!");	
		}
	}
	function handleselama()
	{
		var selama = document.getElementById("selama");
		var carabayar = document.getElementById("carabayar");
		var selectedValue = carabayar.options[carabayar.selectedIndex].value;
		var usia = document.getElementById("usia");		
		var topupsekaligus = document.getElementById("topupsekaligusunitlink");		
		
		if (topupsekaligus.value != "")
		{
			if (usia.value != "") 
			{
				if (selectedValue != "")
				{  
					if (usia.value < 61)
					{
						if (selectedValue == "Bulanan")
						{
							var usiamin = 1;
							var usiamax = 65 - usia.value;
							if ((selama.value < usiamin) && (selama.value != 0))
							{
								alert("Isi Masa Pembayaran Premi Antara "+usiamin+" - "+usiamax+" Tahun!");
								pembpremi.value = usiamin;
							}
							else if (selama.value > usiamax)
							{	
								alert("Isi Masa Pembayaran Premi Antara "+usiamin+" - "+usiamax+" Tahun!");
								selama.value = usiamax;
							} 	
						}
						else if (selectedValue == "Kuartalan")
						{
							var usiamin = 1;
							var usiamax = 65 - usia.value;
							if (selama.value < usiamin)
							{
								alert("Isi Masa Pembayaran Premi Antara "+usiamin+" - "+usiamax+" Tahun!");
								selama.value = usiamin;
							}
							else if (selama.value > usiamax)
							{	
								alert("Isi Masa Pembayaran Premi Antara "+usiamin+" - "+usiamax+" Tahun!");
								selama.value = usiamax;
							} 		
						}
						else if (selectedValue == "Semesteran")
						{
							var usiamin = 1;
							var usiamax = 65 - usia.value;
							if (selama.value < usiamin)
							{
								alert("Isi Masa Pembayaran Premi Antara "+usiamin+" - "+usiamax+" Tahun!");
								selama.value = usiamin;
							}
							else if (selama.value > usiamax)
							{	
								alert("Isi Masa Pembayaran Premi Antara "+usiamin+" - "+usiamax+" Tahun!");
								selama.value = usiamax;
							} 		
						}
						else if (selectedValue == "Tahunan")
						{
							var usiamin = 1;
							var usiamax = 65 - usia.value;
							if (selama.value < usiamin)
							{
								alert("Isi Masa Pembayaran Premi Antara "+usiamin+" - "+usiamax+" Tahun!");
								selama.value = usiamin;
							}
							else if (selama.value > usiamax)
							{	
								alert("Isi Masa Pembayaran Premi Antara "+usiamin+" - "+usiamax+" Tahun!");
								selama.value = usiamax;
							} 		
						}
						else if (selectedValue == "Sekaligus")
						{
							var usiamin = 1;
							var usiamax = 65 - usia.value;
							if (selama.value < usiamin)
							{
								alert("Isi Masa Pembayaran Premi Antara "+usiamin+" - "+usiamax+" Tahun!");
								selama.value = usiamin;
							}
							else if (selama.value > usiamax)
							{	
								alert("Isi Masa Pembayaran Premi Antara "+usiamin+" - "+usiamax+" Tahun!");
								selama.value = usiamax;
							} 	
						}
					}
					else if (usia.value > 60)
					{
						if (selectedValue == "Sekaligus")
						{
							var usiamin = 1;
							var usiamax = 1;
							if (selama.value < usiamin)
							{
								alert("Untuk Pembayaran Sekaligus Masa Pemb Premi Hanya Berlaku Untuk 1 Tahun!");
								selama.value = 1;
							}
							else if (selama.value > usiamax)
							{	
								alert("Untuk Pembayaran Sekaligus Masa Pemb Premi Hanya Berlaku Untuk 1 Tahun!");
								selama.value = 1;
							} 		
						}
					}
				}
				else
				{
					alert("Pilih Cara Bayar terlebih Dahulu!");	
				}
			}
			else 
			{
				alert("Mohon Cek Usia Terlebih Dahulu!");	
			}
		}
		else
		{
			selama.value = 0;	
		}
	}
	
	function chooseCaraBayar()
	{
		var carabayar = document.getElementById("carabayar");
		var selectedValue = carabayar.options[carabayar.selectedIndex].value;
		if (selectedValue == "Bulanan")
		{
			var premisesuaicarabayar = document.getElementById("premisesuaicarabayar");
			premisesuaicarabayar.value = 300000;
			
			//JUA TL1 + TL2
			var juatl = document.getElementById("juatl");
			juatl.value = premisesuaicarabayar.value * (25+5);		
			
			var masapembpremi = document.getElementById("masapembpremi");
			var usiamin = 5;
			var usiamax = 65 - usia.value;
			if (masapembpremi.value < usiamin)
			{
				masapembpremi.value = usiamin;
			}
			else if (masapembpremi.value > usiamax)
			{	
				masapembpremi.value = usiamax;
			} 	
		}
		else if (selectedValue == "Kuartalan")
		{
			var premisesuaicarabayar = document.getElementById("premisesuaicarabayar");
			premisesuaicarabayar.value = 500000;
			
			//JUA TL1 + TL2
			var juatl = document.getElementById("juatl");
			juatl.value = premisesuaicarabayar.value * (15+3);		
			
			var masapembpremi = document.getElementById("masapembpremi");
			var usiamin = 5;
			var usiamax = 65 - usia.value;
			if (masapembpremi.value < usiamin)
			{
				masapembpremi.value = usiamin;
			}
			else if (masapembpremi.value > usiamax)
			{	
				masapembpremi.value = usiamax;
			} 	
		}
		else if (selectedValue == "Semesteran")
		{
			var premisesuaicarabayar = document.getElementById("premisesuaicarabayar");
			premisesuaicarabayar.value = 750000;
			
			//JUA TL1 + TL2
			var juatl = document.getElementById("juatl");
			juatl.value = premisesuaicarabayar.value * (10+2);
			
			var masapembpremi = document.getElementById("masapembpremi");
			var usiamin = 5;
			var usiamax = 65 - usia.value;
			if (masapembpremi.value < usiamin)
			{
				masapembpremi.value = usiamin;
			}
			else if (masapembpremi.value > usiamax)
			{	
				masapembpremi.value = usiamax;
			} 	
		}
		else if (selectedValue == "Tahunan")
		{
			var premisesuaicarabayar = document.getElementById("premisesuaicarabayar");
			premisesuaicarabayar.value = 1500000;
			
			//JUA TL1 + TL2
			var juatl = document.getElementById("juatl");
			juatl.value = premisesuaicarabayar.value * (5+1);
			var masapembpremi = document.getElementById("masapembpremi");
			var usiamin = 5;
			var usiamax = 65 - usia.value;
			if (masapembpremi.value < usiamin)
			{
				masapembpremi.value = usiamin;
			}
			else if (masapembpremi.value > usiamax)
			{	
				masapembpremi.value = usiamax;
			} 		
		}
		else if (selectedValue == "Sekaligus")
		{
			
			var premisesuaicarabayar = document.getElementById("premisesuaicarabayar");
			premisesuaicarabayar.value = 12000000;
			
			//JUA TL1 + TL2
			var juatl = document.getElementById("juatl");
			juatl.value = (premisesuaicarabayar.value * (125+10)) / 100;
			
			var masapembpremi = document.getElementById("masapembpremi");
			masapembpremi.value = 1;
		}
	
	}
	
	function handleCaraBayar()
	{
		var carabayar = document.getElementById("carabayar");
		var selectedValue = carabayar.options[carabayar.selectedIndex].value;
		if (selectedValue == "Bulanan")
		{
			var premisesuaicarabayar = document.getElementById("premisesuaicarabayar");
			if (premisesuaicarabayar.value < 300000)
			{   
			    alert("Minimal Premi 300000!");
				premisesuaicarabayar.value = 300000;
			}
			
			//JUA TL1 + TL2
			var juatl = document.getElementById("juatl");
			juatl.value = premisesuaicarabayar.value * (25+5);
		}
		else if (selectedValue == "Kuartalan")
		{
			var premisesuaicarabayar = document.getElementById("premisesuaicarabayar");
			if (premisesuaicarabayar.value < 500000)
			{
				
			    alert("Minimal Premi 500000!");
				premisesuaicarabayar.value = 500000;
			}
			
			//JUA TL1 + TL2
			var juatl = document.getElementById("juatl");
			juatl.value = premisesuaicarabayar.value * (15+3);
		}
		else if (selectedValue == "Semesteran")
		{
			var premisesuaicarabayar = document.getElementById("premisesuaicarabayar");
			if (premisesuaicarabayar.value < 750000)
			{
				
			    alert("Minimal Premi 750000!");
				premisesuaicarabayar.value = 750000;
			}
			
			//JUA TL1 + TL2
			var juatl = document.getElementById("juatl");
			juatl.value = premisesuaicarabayar.value * (10+2);
		}
		else if (selectedValue == "Tahunan")
		{
			var premisesuaicarabayar = document.getElementById("premisesuaicarabayar");
			if (premisesuaicarabayar.value < 1500000)
			{
			    alert("Minimal Premi 1500000!");
				premisesuaicarabayar.value = 1500000;
			}
			
			//JUA TL1 + TL2
			var juatl = document.getElementById("juatl");
			juatl.value = premisesuaicarabayar.value * (5+1);
		}
		else if (selectedValue == "Sekaligus")
		{
			var premisesuaicarabayar = document.getElementById("premisesuaicarabayar");
			if (premisesuaicarabayar.value < 12000000)
			{
				alert("Minimal Premi 12000000!");
				premisesuaicarabayar.value = 12000000;
			}
			
			//JUA TL1 + TL2
			var juatl = document.getElementById("juatl");
			juatl.value = (premisesuaicarabayar.value * (125+10)) / 100;
		}
		
		var totalpremisesuaicarabayarunitlink = document.getElementById('totalpremisesuaicarabayarunitlink');
		var premisesuaicarabayar = document.getElementById('premisesuaicarabayar');	
		var premitambahanci = document.getElementById('premitambahanci'); 	
		var premitambahanpa = document.getElementById('premitambahanpa');
		var premitambahanwp = document.getElementById('premitambahanwp');
		var premitambahanctt = document.getElementById('premitambahanctt');
		var premitambahancpm = document.getElementById('premitambahancpm');
		var premitambahancpb = document.getElementById('premitambahancpb');
		var premitambahanterm = document.getElementById('premitambahanterm');
		
		/*if (premisesuaicarabayar.value != "")
		{
			totalpremisesuaicarabayarunitlink.value = premisesuaicarabayar.value + premitambahanci.value + premitambahanpa.value + premitambahanwp.value + premitambahanctt.value + premitambahancpm.value + premitambahancpb.value + premitambahanterm.value;
		}
		else
		{
			alert('Premi Sesuai cara Bayar Wajib Diisi!');	
		}*/
	}
	
	function onHitungTotalPremi(input)
	{
		var premisesuaicarabayar = document.getElementById('premisesuaicarabayar'); 	
		var totalpremisesuaicarabayarunitlink = document.getElementById('totalpremisesuaicarabayarunitlink');
		var premitambahanci = document.getElementById('premitambahanci');
		var premitambahanpa = document.getElementById('premitambahanpa');
		var premitambahanwp = document.getElementById('premitambahanwp');
		var premitambahanctt = document.getElementById('premitambahanctt');
		var premitambahancpm = document.getElementById('premitambahancpm');
		var premitambahancpb = document.getElementById('premitambahancpb');
		var premitambahanterm = document.getElementById('premitambahanterm');
		var topupberkalaunitlink = document.getElementById('topupberkalaunitlink');
		
		if (premitambahanci.value == '')
		{
			premitambahanci.value = 0;
		}
		else
		{
			premitambahanci.value = premitambahanci.value;
		}
		
		if (premitambahanpa.value == '')
		{
			premitambahanpa.value = 0;
		}
		else
		{
			premitambahanpa.value = premitambahanpa.value;
		}
		
		if (premitambahanwp.value == '')
		{
			premitambahanwp.value = 0;
		}
		else
		{
			premitambahanwp.value = premitambahanwp.value;
		}
		
		if (premitambahanctt.value == '')
		{
			premitambahanctt.value = 0;
		}
		else
		{
			premitambahanctt.value = premitambahanctt.value;
		}
		
		if (premitambahancpm.value == '')
		{
			premitambahancpm.value = 0;
		}
		else
		{
			premitambahancpm.value = premitambahancpm.value;
		}
		
		if (premitambahancpb.value == '')
		{
			premitambahancpb.value = 0;
		}
		else
		{
			premitambahancpb.value = premitambahancpb.value;
		}
		
		if (premitambahanterm.value == '')
		{
			premitambahanterm.value = 0;
		}
		else
		{
			premitambahanterm.value = premitambahanterm.value;
		}
		
		if (topupberkalaunitlink.value == '')
		{
			topupberkalaunitlink.value = 0;
		}
		else
		{
			topupberkalaunitlink.value = topupberkalaunitlink.value;
		}
		
		totalpremisesuaicarabayarunitlink.value = parseInt(premisesuaicarabayar.value) + parseInt(premitambahanci.value) + parseInt(premitambahanpa.value) + parseInt(premitambahanwp.value) + parseInt(premitambahancpm.value) + parseInt(premitambahancpb.value) + parseInt(premitambahanterm.value) + parseInt(topupberkalaunitlink.value);
		
	}
	
	function OnHandleKesanggupanMembayarPremi(input)
	{	
		var kesanggupanmembayarpremiunitlink = document.getElementById('kesanggupanmembayarpremiunitlink');
		var totalpremisesuaicarabayarunitlink = document.getElementById('totalpremisesuaicarabayarunitlink');
		var topupberkalaunitlink = document.getElementById('topupberkalaunitlink');
		
		if (kesanggupanmembayarpremiunitlink.value == '')
		{
			kesanggupanmembayarpremiunitlink.value = 0;
		}
		else
		{
			kesanggupanmembayarpremiunitlink.value = kesanggupanmembayarpremiunitlink.value;
		}
		
		if (totalpremisesuaicarabayarunitlink.value == '')
		{
			totalpremisesuaicarabayarunitlink.value = 0;
		}
		else
		{
			totalpremisesuaicarabayarunitlink.value = totalpremisesuaicarabayarunitlink.value;
		}
		
		if (topupberkalaunitlink.value == '')
		{
			topupberkalaunitlink.value = 0;
		}
		else
		{
			topupberkalaunitlink.value = topupberkalaunitlink.value;
		}
		 
		if (parseInt(kesanggupanmembayarpremiunitlink.value) > parseInt(totalpremisesuaicarabayarunitlink.value))
		{	
			topupberkalaunitlink.value = parseInt(topupberkalaunitlink.value) + (parseInt(kesanggupanmembayarpremiunitlink.value) - parseInt(totalpremisesuaicarabayarunitlink.value));
		}
		
		var premisesuaicarabayar = document.getElementById('premisesuaicarabayar'); 	
		var totalpremisesuaicarabayarunitlink = document.getElementById('totalpremisesuaicarabayarunitlink');
		var premitambahanci = document.getElementById('premitambahanci');
		var premitambahanpa = document.getElementById('premitambahanpa');
		var premitambahanwp = document.getElementById('premitambahanwp');
		var premitambahanctt = document.getElementById('premitambahanctt');
		var premitambahancpm = document.getElementById('premitambahancpm');
		var premitambahancpb = document.getElementById('premitambahancpb');
		var premitambahanterm = document.getElementById('premitambahanterm');
		var topupberkalaunitlink = document.getElementById('topupberkalaunitlink');
		
		if (premitambahanci.value == '')
		{
			premitambahanci.value = 0;
		}
		else
		{
			premitambahanci.value = premitambahanci.value;
		}
		
		if (premitambahanpa.value == '')
		{
			premitambahanpa.value = 0;
		}
		else
		{
			premitambahanpa.value = premitambahanpa.value;
		}
		
		if (premitambahanwp.value == '')
		{
			premitambahanwp.value = 0;
		}
		else
		{
			premitambahanwp.value = premitambahanwp.value;
		}
		
		if (premitambahanctt.value == '')
		{
			premitambahanctt.value = 0;
		}
		else
		{
			premitambahanctt.value = premitambahanctt.value;
		}
		
		if (premitambahancpm.value == '')
		{
			premitambahancpm.value = 0;
		}
		else
		{
			premitambahancpm.value = premitambahancpm.value;
		}
		
		if (premitambahancpb.value == '')
		{
			premitambahancpb.value = 0;
		}
		else
		{
			premitambahancpb.value = premitambahancpb.value;
		}
		
		if (premitambahanterm.value == '')
		{
			premitambahanterm.value = 0;
		}
		else
		{
			premitambahanterm.value = premitambahanterm.value;
		}
		
		if (topupberkalaunitlink.value == '')
		{
			topupberkalaunitlink.value = 0;
		}
		else
		{
			topupberkalaunitlink.value = topupberkalaunitlink.value;
		}
		
		totalpremisesuaicarabayarunitlink.value = parseInt(premisesuaicarabayar.value) + parseInt(premitambahanci.value) + parseInt(premitambahanpa.value) + parseInt(premitambahanwp.value) + parseInt(premitambahancpm.value) + parseInt(premitambahancpb.value) + parseInt(premitambahanterm.value) + parseInt(topupberkalaunitlink.value);
			
	}
	
	function OnHandleTopUpBerkala()
	{
		var premisesuaicarabayar = document.getElementById('premisesuaicarabayar'); 	
		var totalpremisesuaicarabayarunitlink = document.getElementById('totalpremisesuaicarabayarunitlink');
		var premitambahanci = document.getElementById('premitambahanci');
		var premitambahanpa = document.getElementById('premitambahanpa');
		var premitambahanwp = document.getElementById('premitambahanwp');
		var premitambahanctt = document.getElementById('premitambahanctt');
		var premitambahancpm = document.getElementById('premitambahancpm');
		var premitambahancpb = document.getElementById('premitambahancpb');
		var premitambahanterm = document.getElementById('premitambahanterm');
		var topupberkalaunitlink = document.getElementById('topupberkalaunitlink');
		
		if (premitambahanci.value == '')
		{
			premitambahanci.value = 0;
		}
		else
		{
			premitambahanci.value = premitambahanci.value;
		}
		
		if (premitambahanpa.value == '')
		{
			premitambahanpa.value = 0;
		}
		else
		{
			premitambahanpa.value = premitambahanpa.value;
		}
		
		if (premitambahanwp.value == '')
		{
			premitambahanwp.value = 0;
		}
		else
		{
			premitambahanwp.value = premitambahanwp.value;
		}
		
		if (premitambahanctt.value == '')
		{
			premitambahanctt.value = 0;
		}
		else
		{
			premitambahanctt.value = premitambahanctt.value;
		}
		
		if (premitambahancpm.value == '')
		{
			premitambahancpm.value = 0;
		}
		else
		{
			premitambahancpm.value = premitambahancpm.value;
		}
		
		if (premitambahancpb.value == '')
		{
			premitambahancpb.value = 0;
		}
		else
		{
			premitambahancpb.value = premitambahancpb.value;
		}
		
		if (premitambahanterm.value == '')
		{
			premitambahanterm.value = 0;
		}
		else
		{
			premitambahanterm.value = premitambahanterm.value;
		}
		
		if (topupberkalaunitlink.value == '')
		{
			topupberkalaunitlink.value = 0;
		}
		else
		{
			topupberkalaunitlink.value = topupberkalaunitlink.value;
		}
		
		totalpremisesuaicarabayarunitlink.value = parseInt(premisesuaicarabayar.value) + parseInt(premitambahanci.value) + parseInt(premitambahanpa.value) + parseInt(premitambahanwp.value) + parseInt(premitambahancpm.value) + parseInt(premitambahancpb.value) + parseInt(premitambahanterm.value) + parseInt(topupberkalaunitlink.value);		
	}
	
</script>







