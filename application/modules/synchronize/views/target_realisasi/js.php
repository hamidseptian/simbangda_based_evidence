<?php
/**
	* Author     : Alfikri, M.Kom
	* Created By : Alfikri, M.Kom
	* E-Mail     : alfikri.name@gmail.com
	* No HP      : 081277337405
*/
?>

<script type="text/javascript" src="<?php echo base_url() ?>assets/datatables/dataTables.min.js"></script>
<script src="https://code.highcharts.com/highcharts.src.js"></script>
<!-- Export -->
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script>



	$(document).ready(function() {
		show_opd();
	});

	function show_opd() {

		var kunci_synch = '<?php echo kunci_synch()['synchronize'] ?>';
		var pesan_kunci = '<?php echo kunci_synch()['pesan'] ?>';
		$.ajax({
			url: baseUrl('web_services/get_opd'),
			type: 'POST',
			dataType: 'JSON',
			data: {},
			success: function(data) {
				
				if (data.status == true) {
					$('#aliran-kas-opd').html('');
					$.each(data.data, function(k, v) {

						if (kunci_synch==1) {
							var tombol_synch = '<button class="btn btn-primary btn-sm tahap-2" id="tahap-2-' + v.id_instansi + '" onclick="sync(' + "'" + v.id_instansi + "'" + ')" data-toggle="tooltip" title="synchronize grafik '+v.nama_instansi+'">' +
							'<i class="pe-7s-science btn-icon-wrapper"> </i>' +
							'</button> </div>';

						}else{
							var tombol_synch = '<button class="btn btn-danger btn-sm tahap-2" id="" onclick="Swal.fire(' + "'Terkunci'" +",'"+pesan_kunci+"'" +",'error'" + ')" data-toggle="tooltip" title="synchronize grafik '+v.nama_instansi+'">' +
							'<i class="pe-7s-science btn-icon-wrapper"> </i>' +
							'</button> </div>';
						}
						$('#aliran-kas-opd').append('<tr>' +
							'<th scope="row">' + (k + 1) + '</th>' +
							'<td>' + v.kode_opd + '</td>' +
							'<td>' + v.nama_instansi + '</td>' +
							// '<td>' + v.bulan_mulai_realisasi + '</td>' +
							// '<td>' + v.bulan_akhir_realisasi + '</td>' +
							// '<td>' + v.status + '</td>' +
							'<td id="cek_status_progress_'+v.id_instansi+'"></td>' +
							'<td id="keterangan_status_progress_'+v.id_instansi+'"></td>' +
							'<td style="text-align: center;"> <div class="btn-group">' +
							'<button class="btn btn-primary btn-sm hitung_intansi" onclick="perbandingan_grafik_2_tahun_terakhir(' + "'Akumulasi','"+v.id_instansi+"','" +v.nama_instansi+"'" + ')" data-toggle="tooltip" title="Lihat grafik '+v.nama_instansi+'" nama_opd="'+v.nama_instansi+'">' +
							'<i class="fa fa-signal"></i>' +
							'</button> ' +
							'<button class="btn btn-info btn-sm hitung_intansi" onclick="grafik(' + "'Akumulasi','"+v.id_instansi+"','" +v.nama_instansi+"'" + ')" data-toggle="tooltip" title="Lihat grafik '+v.nama_instansi+'" nama_opd="'+v.nama_instansi+'">' +
							'<i class="fa fa-signal"></i>' +
							'</button> ' +
							tombol_synch +
							'</td>' +
							'</tr>');
					});
				}
			}
		});
	}






	// grafik('Akumulasi');

	function grafik(kategori, id_instansi, nama_instansi){

		$('#modal_grafik_skpd').modal('show');
		$('#modal_grafik_skpd').find('#nama_skpd').html(nama_instansi);
		$('#modal_grafik_skpd').find('#tombol_pilihan_grafik').html(`<button type="button" class="btn-icon btn-shadow btn-outline-2x btn btn-outline-primary" onclick="grafik('Akumulasi','`+id_instansi+`','`+nama_instansi+`')"><i class="fa fa-signal"> </i> Grafik Akumulasi</button>
                                       <button type="button" class="btn-icon btn-shadow btn-outline-2x btn btn-outline-primary"  onclick="grafik('Bulanan','`+id_instansi+`','`+nama_instansi+`')"><i class="fa fa-signal"> </i> Grafik Bulanan</button>`);

		var sumber_data = requestData(kategori, id_instansi);
		Highcharts.chart('grafik_realisasi_skpd', {
		  chart: {
		    zoomType: 'xy'
		  },
		  title: {
		    text: 'Grafik Pencapaian SKPD <br>' + sumber_data.opd
		  },
		  subtitle: {
		    text: '' + kategori + ' ' + sumber_data.tahapan_apbd
		  },
		  xAxis: [{
		    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
		      'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
		    crosshair: true
		  }],
		  yAxis: [
		  { // Primary yAxis

		    labels: {
		      format: '{value}%',
		      style: {
		        color: Highcharts.getOptions().colors[1]
		      }
		    },
		    title: {
		      text: 'Fisik',
		      style: {
		        color: Highcharts.getOptions().colors[1]
		      }
		    }
		  }, 
		  { 
		    // Secondary yAxis

		    opposite: true,
		    title: {
		      text: 'Keuangan',
		      style: {
		        color: Highcharts.getOptions().colors[0]
		      }
		    },
		    labels: {
		      format: '{value}%',
		      style: {
		        color: Highcharts.getOptions().colors[0]
		      }
		    },
		  }],
		  tooltip: {
		    shared: true
		  },
		  // legend: {
		  //   layout: 'vertical',
		  //   align: 'left',
		  //   x: 120,
		  //   verticalAlign: 'top',
		  //   y: 100,
		  //   floating: true,
		  //   backgroundColor:
		  //     Highcharts.defaultOptions.legend.backgroundColor || // theme
		  //     'rgba(255,255,255,0.25)'
		  // },
		  series: [
			  {
			    name: 'Target Fisik',
			    type: 'column',
			    yAxis: 0,
			    color: 'pink',
			    data: sumber_data.fisik,
			    tooltip: {
			      valueSuffix: '%'
			    }
			  }, 
			  {
			    name: 'Target Keuangan',
			    type: 'column',
			    yAxis: 1,
			    color: 'aqua',
			    data: sumber_data.keu,
			    tooltip: {
			      valueSuffix: '%'
			    }
			  }, 
			  {
			    name: 'Realisasi Fisik',
			    type: 'line',

			    color: 'red',
			    yAxis: 0,
			    data: sumber_data.r_fis,
				// color: '#caf3d5',
			    tooltip: {
			      valueSuffix: '%'
			    }
			  },
			  {
			    name: 'Realisasi Keuangan',
			    type: 'line',

			    color: 'blue',

			    yAxis: 1,
			    data: sumber_data.r_keu,
				// color: '#caf3d5',
			    tooltip: {
			      valueSuffix: '%'
			    }
			  }
		  ]
		});


		$('#tfisik').html('<td rowspan="3" align="center">Fisik</td>');
		$('#rfisik').html('');
		$('#dfisik').html('');
		$('#tkeu').html('<td rowspan="3" align="center">Keuangan</td>');
		$('#rkeu').html('');
		$('#dkeu').html('');

		$('#tfisik').append('<td>Target</td>');
		$('#rfisik').append('<td>Realisasi</td>');
		$('#dfisik').append('<td>Deviasi</td>');
		$('#tkeu').append('<td>Target</td>');
		$('#rkeu').append('<td>Realisasi</td>');
		$('#dkeu').append('<td>Deviasi</td>');
		for (var i = 0; i < 12; i++) {
			var deviasi_fisik = sumber_data.r_fis[i] - sumber_data.fisik[i];
			$('#tfisik').append('<td>' + sumber_data.fisik[i] + '</td>');
			$('#rfisik').append('<td>' + sumber_data.r_fis[i] + '</td>');
			$('#dfisik').append('<td>' + sumber_data.d_fisik[i] + '</td>');

			var deviasi_keuangan = sumber_data.r_keu[i] - sumber_data.keu[i];
			$('#tkeu').append('<td>' + sumber_data.keu[i] + '</td>');
			$('#rkeu').append('<td>' + sumber_data.r_keu[i] + '</td>');
			$('#dkeu').append('<td>' + sumber_data.d_keu[i] + '</td>');
		}
	
	}





	function perbandingan_grafik_2_tahun_terakhir_asisten(kategori, asisten){

		if (asisten=='Semua') {
			var text_judul = 'Grafik Pencapaian Semua OPD ';
		}else{
			var text_judul = 'Grafik Pencapaian Asisten ' + asisten;

		}
		$('#modal_grafik_skpd_2_tahun_terakhir').modal('show');
		// $('#modal_grafik_skpd_2_tahun_terakhir').find('#tombol_pilihan_grafik').html(`<button type="button" class="btn-icon btn-shadow btn-outline-2x btn btn-outline-primary" onclick="perbandingan_grafik_2_tahun_terakhir('Akumulasi','`+id_instansi+`')"><i class="fa fa-signal"> </i> Grafik Akumulasi</button>
  //                                      <button type="button" class="btn-icon btn-shadow btn-outline-2x btn btn-outline-primary"  onclick="perbandingan_grafik_2_tahun_terakhir('Bulanan','`+id_instansi+`')"><i class="fa fa-signal"> </i> Grafik Bulanan</button>`);

		var sumber_data = requestData_2_tahun_terakhir_asisten(kategori, asisten);
		
		Highcharts.chart('grafik_realisasi_skpd_2_tahun_terakhir', {
		  chart: {
		    zoomType: 'xy'
		  },
		  title: {
		    text: text_judul
		  },
		  subtitle: {
		    text: '' + kategori + '  [Data 2 tahun terakhir]' 
		  },
		  xAxis: [{
		    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
		      'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
		    crosshair: true
		  }],
		  yAxis: [
		  { // Primary yAxis

		    labels: {
		      format: '{value}%',
		      style: {
		        color: Highcharts.getOptions().colors[1]
		      }
		    },
		    title: {
		      text: 'Fisik',
		      style: {
		        color: Highcharts.getOptions().colors[1]
		      }
		    }
		  }, 
		  { 
		    // Secondary yAxis

		    opposite: true,
		    title: {
		      text: 'Keuangan',
		      style: {
		        color: Highcharts.getOptions().colors[0]
		      }
		    },
		    labels: {
		      format: '{value}%',
		      style: {
		        color: Highcharts.getOptions().colors[0]
		      }
		    },
		  }],
		  tooltip: {
		    shared: true
		  },

		  series: [
			  // {
			  //   name: 'Target Fisik 2024',
			  //   type: 'column',
			  //   yAxis: 0,
			  //   color: '#FCCCEB',
			  //   data: sumber_data.fisik_sebelumnya,
			  //   tooltip: {
			  //     valueSuffix: '%'
			  //   }
			  // }, 
			  // {
			  //   name: 'Target Fisik 2025',
			  //   type: 'column',
			  //   yAxis: 0,
			  //   color: '#FF42B6',
			  //   data: sumber_data.fisik,
			  //   tooltip: {
			  //     valueSuffix: '%'
			  //   }
			  // }, 
			  // {
			  //   name: 'Target Keuangan 2024',
			  //   type: 'column',
			  //   yAxis: 1,
			  //   color: '#C7C2FF',
			  //   data: sumber_data.keu_sebelumnya,
			  //   tooltip: {
			  //     valueSuffix: '%'
			  //   }
			  // }, 
			  // {
			  //   name: 'Target Keuangan 2025',
			  //   type: 'column',
			  //   yAxis: 1,
			  //   color: '#3E30FF',
			  //   data: sumber_data.keu,
			  //   tooltip: {
			  //     valueSuffix: '%'
			  //   }
			  // }, 
			  {
			    name: 'Realisasi Fisik 2024',
			    type: 'line',
			      dashStyle: 'ShortDash',
			    color: '#F0C9C9',
			    yAxis: 0,
			    data: sumber_data.r_fis_sebelumnya,
				// color: '#caf3d5',
			    tooltip: {
			      valueSuffix: '%'
			    }
			  },
			  {
			    name: 'Realisasi Keuangan 2024',
			    type: 'line',

			    color: '#D0C9F0',
			      dashStyle: 'ShortDash',

			    yAxis: 1,
			    data: sumber_data.r_keu_sebelumnya,
				// color: '#caf3d5',
			    tooltip: {
			      valueSuffix: '%'
			    }
			  },
			  {
			    name: 'Realisasi Fisik 2025',
			    type: 'line',

			    color: '#F70000',
			    yAxis: 0,
			    data: sumber_data.r_fis,
				// color: '#caf3d5',
			    tooltip: {
			      valueSuffix: '%'
			    }
			  },
			  {
			    name: 'Realisasi Keuangan 2025',
			    type: 'line',


			    color: '#1300F7',

			    yAxis: 1,
			    data: sumber_data.r_keu,
				// color: '#caf3d5',
			    tooltip: {
			      valueSuffix: '%'
			    }
			  }
		  ]
		});


		// menu syncronize
		$('#modal_grafik_skpd_2_tahun_terakhir').find('#tfisik').html('<td rowspan="2" align="center">Realisasi Fisik</td>');
		$('#modal_grafik_skpd_2_tahun_terakhir').find('#rfisik').html('');
		$('#modal_grafik_skpd_2_tahun_terakhir').find('#dfisik').html('');
		$('#modal_grafik_skpd_2_tahun_terakhir').find('#tkeu').html('<td rowspan="2" align="center">Realisasi Keuangan</td>');
		$('#modal_grafik_skpd_2_tahun_terakhir').find('#rkeu').html('');
		$('#modal_grafik_skpd_2_tahun_terakhir').find('#dkeu').html('');

		$('#modal_grafik_skpd_2_tahun_terakhir').find('#tfisik').append('<td>' + sumber_data.tahun_sebelumnya+'</td>');
		$('#modal_grafik_skpd_2_tahun_terakhir').find('#rfisik').append('<td>' + sumber_data.tahun_ini+'</td>');
		// $('#modal_grafik_skpd_2_tahun_terakhir').find('#dfisik').append('<td>Deviasi</td>');
		$('#modal_grafik_skpd_2_tahun_terakhir').find('#tkeu').append('<td>' + sumber_data.tahun_sebelumnya+'</td>');
		$('#modal_grafik_skpd_2_tahun_terakhir').find('#rkeu').append('<td>' + sumber_data.tahun_ini+'</td>');
		// $('#modal_grafik_skpd_2_tahun_terakhir').find('#dkeu').append('<td>Deviasi</td>');
		for (var i = 0; i < 12; i++) {
			// var deviasi_fisik = sumber_data.r_fis[i] - sumber_data.fisik[i];
			$('#modal_grafik_skpd_2_tahun_terakhir').find('#tfisik').append('<td>' + sumber_data.r_fis_sebelumnya[i] + '</td>');
			$('#modal_grafik_skpd_2_tahun_terakhir').find('#rfisik').append('<td>' + sumber_data.r_fis[i] + '</td>');
			// $('#modal_grafik_skpd_2_tahun_terakhir').find('#dfisik').append('<td>' + sumber_data.d_fisik[i] + '</td>');

			// var deviasi_keuangan = sumber_data.r_keu[i] - sumber_data.keu[i];
			$('#modal_grafik_skpd_2_tahun_terakhir').find('#tkeu').append('<td>' + sumber_data.r_keu_sebelumnya[i] + '</td>');
			$('#modal_grafik_skpd_2_tahun_terakhir').find('#rkeu').append('<td>' + sumber_data.r_keu[i] + '</td>');
			// $('#modal_grafik_skpd_2_tahun_terakhir').find('#dkeu').append('<td>' + sumber_data.d_keu[i] + '</td>');
		}
		// menu syncronize

		// bahan paparan

		$('#perbandingan').find('#tfisik').html('<td rowspan="2" align="center">Realisasi Fisik</td>');
		$('#perbandingan').find('#rfisik').html('');
		$('#perbandingan').find('#dfisik').html('');
		$('#perbandingan').find('#tkeu').html('<td rowspan="2" align="center">Realisasi Keuangan</td>');
		$('#perbandingan').find('#rkeu').html('');
		$('#perbandingan').find('#dkeu').html('');

		$('#perbandingan').find('#tfisik').append('<td>' + sumber_data.tahun_sebelumnya+'</td>');
		$('#perbandingan').find('#rfisik').append('<td>' + sumber_data.tahun_ini+'</td>');
		// $('#perbandingan').find('#dfisik').append('<td>Deviasi</td>');
		$('#perbandingan').find('#tkeu').append('<td>' + sumber_data.tahun_sebelumnya+'</td>');
		$('#perbandingan').find('#rkeu').append('<td>' + sumber_data.tahun_ini+'</td>');
		// $('#perbandingan').find('#dkeu').append('<td>Deviasi</td>');
		for (var i = 0; i < 12; i++) {
			// var deviasi_fisik = sumber_data.r_fis[i] - sumber_data.fisik[i];
			$('#perbandingan').find('#tfisik').append('<td>' + sumber_data.r_fis_sebelumnya[i] + '</td>');
			$('#perbandingan').find('#rfisik').append('<td>' + sumber_data.r_fis[i] + '</td>');
			// $('#perbandingan').find('#dfisik').append('<td>' + sumber_data.d_fisik[i] + '</td>');

			// var deviasi_keuangan = sumber_data.r_keu[i] - sumber_data.keu[i];
			$('#perbandingan').find('#tkeu').append('<td>' + sumber_data.r_keu_sebelumnya[i] + '</td>');
			$('#perbandingan').find('#rkeu').append('<td>' + sumber_data.r_keu[i] + '</td>');
			// $('#modal_grafik_skpd_2_tahun_terakhir').find('#dkeu').append('<td>' + sumber_data.d_keu[i] + '</td>');
		}
		// bahan paparan
	
	}



	function perbandingan_grafik_2_tahun_terakhir(kategori, id_instansi, nama_instansi){

		$('#modal_grafik_skpd_2_tahun_terakhir').modal('show');
		$('#modal_grafik_skpd_2_tahun_terakhir').find('#nama_skpd').html(nama_instansi);
		$('#modal_grafik_skpd_2_tahun_terakhir').find('#tombol_pilihan_grafik').html(`<button type="button" class="btn-icon btn-shadow btn-outline-2x btn btn-outline-primary" onclick="perbandingan_grafik_2_tahun_terakhir('Akumulasi','`+id_instansi+`','`+nama_instansi+`')"><i class="fa fa-signal"> </i> Grafik Akumulasi</button>
                                       <button type="button" class="btn-icon btn-shadow btn-outline-2x btn btn-outline-primary"  onclick="perbandingan_grafik_2_tahun_terakhir('Bulanan','`+id_instansi+`','`+nama_instansi+`')"><i class="fa fa-signal"> </i> Grafik Bulanan</button>`);

		var sumber_data = requestData_2_tahun_terakhir(kategori, id_instansi);
		
		Highcharts.chart('grafik_realisasi_skpd_2_tahun_terakhir', {
		  chart: {
		    zoomType: 'xy'
		  },
		  title: {
		    text: 'Grafik Pencapaian SKPD <br>' + sumber_data.opd
		  },
		  subtitle: {
		    text: '' + kategori + '  [Data 2 tahun terakhir]' 
		  },
		  xAxis: [{
		    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
		      'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
		    crosshair: true
		  }],
		  yAxis: [
		  { // Primary yAxis

		    labels: {
		      format: '{value}%',
		      style: {
		        color: Highcharts.getOptions().colors[1]
		      }
		    },
		    title: {
		      text: 'Fisik',
		      style: {
		        color: Highcharts.getOptions().colors[1]
		      }
		    }
		  }, 
		  { 
		    // Secondary yAxis

		    opposite: true,
		    title: {
		      text: 'Keuangan',
		      style: {
		        color: Highcharts.getOptions().colors[0]
		      }
		    },
		    labels: {
		      format: '{value}%',
		      style: {
		        color: Highcharts.getOptions().colors[0]
		      }
		    },
		  }],
		  tooltip: {
		    shared: true
		  },

		  series: [
			  // {
			  //   name: 'Target Fisik 2024',
			  //   type: 'column',
			  //   yAxis: 0,
			  //   color: '#FCCCEB',
			  //   data: sumber_data.fisik_sebelumnya,
			  //   tooltip: {
			  //     valueSuffix: '%'
			  //   }
			  // }, 
			  // {
			  //   name: 'Target Fisik 2025',
			  //   type: 'column',
			  //   yAxis: 0,
			  //   color: '#FF42B6',
			  //   data: sumber_data.fisik,
			  //   tooltip: {
			  //     valueSuffix: '%'
			  //   }
			  // }, 
			  // {
			  //   name: 'Target Keuangan 2024',
			  //   type: 'column',
			  //   yAxis: 1,
			  //   color: '#C7C2FF',
			  //   data: sumber_data.keu_sebelumnya,
			  //   tooltip: {
			  //     valueSuffix: '%'
			  //   }
			  // }, 
			  // {
			  //   name: 'Target Keuangan 2025',
			  //   type: 'column',
			  //   yAxis: 1,
			  //   color: '#3E30FF',
			  //   data: sumber_data.keu,
			  //   tooltip: {
			  //     valueSuffix: '%'
			  //   }
			  // }, 
			  {
			    name: 'Realisasi Fisik 2024',
			    type: 'line',
			      dashStyle: 'ShortDash',
			    color: '#F0C9C9',
			    yAxis: 0,
			    data: sumber_data.r_fis_sebelumnya,
				// color: '#caf3d5',
			    tooltip: {
			      valueSuffix: '%'
			    }
			  },
			  {
			    name: 'Realisasi Keuangan 2024',
			    type: 'line',

			    color: '#D0C9F0',
			      dashStyle: 'ShortDash',

			    yAxis: 1,
			    data: sumber_data.r_keu_sebelumnya,
				// color: '#caf3d5',
			    tooltip: {
			      valueSuffix: '%'
			    }
			  },
			  {
			    name: 'Realisasi Fisik 2025',
			    type: 'line',

			    color: '#F70000',
			    yAxis: 0,
			    data: sumber_data.r_fis,
				// color: '#caf3d5',
			    tooltip: {
			      valueSuffix: '%'
			    }
			  },
			  {
			    name: 'Realisasi Keuangan 2025',
			    type: 'line',


			    color: '#1300F7',

			    yAxis: 1,
			    data: sumber_data.r_keu,
				// color: '#caf3d5',
			    tooltip: {
			      valueSuffix: '%'
			    }
			  }
		  ]
		});


		$('#modal_grafik_skpd_2_tahun_terakhir').find('#tfisik').html('<td rowspan="2" align="center">Realisasi Fisik</td>');
		$('#modal_grafik_skpd_2_tahun_terakhir').find('#rfisik').html('');
		$('#modal_grafik_skpd_2_tahun_terakhir').find('#dfisik').html('');
		$('#modal_grafik_skpd_2_tahun_terakhir').find('#tkeu').html('<td rowspan="2" align="center">Realisasi Keuangan</td>');
		$('#modal_grafik_skpd_2_tahun_terakhir').find('#rkeu').html('');
		$('#modal_grafik_skpd_2_tahun_terakhir').find('#dkeu').html('');

		$('#modal_grafik_skpd_2_tahun_terakhir').find('#tfisik').append('<td>' + sumber_data.tahun_sebelumnya+'</td>');
		$('#modal_grafik_skpd_2_tahun_terakhir').find('#rfisik').append('<td>' + sumber_data.tahun_ini+'</td>');
		// $('#modal_grafik_skpd_2_tahun_terakhir').find('#dfisik').append('<td>Deviasi</td>');
		$('#modal_grafik_skpd_2_tahun_terakhir').find('#tkeu').append('<td>' + sumber_data.tahun_sebelumnya+'</td>');
		$('#modal_grafik_skpd_2_tahun_terakhir').find('#rkeu').append('<td>' + sumber_data.tahun_ini+'</td>');
		// $('#modal_grafik_skpd_2_tahun_terakhir').find('#dkeu').append('<td>Deviasi</td>');
		for (var i = 0; i < 12; i++) {
			var deviasi_fisik = sumber_data.r_fis[i] - sumber_data.fisik[i];
			$('#modal_grafik_skpd_2_tahun_terakhir').find('#tfisik').append('<td>' + sumber_data.fisik[i] + '</td>');
			$('#modal_grafik_skpd_2_tahun_terakhir').find('#rfisik').append('<td>' + sumber_data.r_fis[i] + '</td>');
			// $('#modal_grafik_skpd_2_tahun_terakhir').find('#dfisik').append('<td>' + sumber_data.d_fisik[i] + '</td>');

			var deviasi_keuangan = sumber_data.r_keu[i] - sumber_data.keu[i];
			$('#modal_grafik_skpd_2_tahun_terakhir').find('#tkeu').append('<td>' + sumber_data.keu[i] + '</td>');
			$('#modal_grafik_skpd_2_tahun_terakhir').find('#rkeu').append('<td>' + sumber_data.r_keu[i] + '</td>');
			// $('#modal_grafik_skpd_2_tahun_terakhir').find('#dkeu').append('<td>' + sumber_data.d_keu[i] + '</td>');
		}
	
	}




function requestData(kategori, id_instansi) {
		var rf = [];
		var rk = [];
		var ba = <?php echo bulan_aktif(); ?>;
				
		$.ajax({
			url: '<?php echo base_url('dashboard/show_chart'); ?>',
			type: "GET",
			data : {
				id_instansi : id_instansi,
				id_group : 5,
				kategori : kategori
			},
			dataType: "json",

            async: false,
			success: function(data) {
				
				result = data;
				
			},
			// cache: false
		});

		return result;
	}


function requestData_2_tahun_terakhir(kategori, id_instansi) {
		var rf = [];
		var rk = [];
		var ba = <?php echo bulan_aktif(); ?>;
				
		$.ajax({
			url: '<?php echo base_url('dashboard/show_chart_2_tahun_terakhir'); ?>',
			type: "GET",
			data : {
				id_instansi : id_instansi,
				id_group : 5,
				kategori : kategori
			},
			dataType: "json",

            async: false,
			success: function(data) {
				
				result = data;
				
			},
			// cache: false
		});

		return result;
	}
function requestData_2_tahun_terakhir_asisten(kategori, asisten) {
		var rf = [];
		var rk = [];
		var ba = <?php echo bulan_aktif(); ?>;
				
		$.ajax({
			url: '<?php echo base_url('dashboard/show_chart_2_tahun_terakhir_asisten'); ?>',
			type: "GET",
			data : {
				asisten : asisten,
				id_group : 2,
				kategori : kategori
			},
			dataType: "json",

            async: false,
			success: function(data) {
				
				result = data;
				console.log(data);
				
			},
			// cache: false
		});

		return result;
	}

	function sync_all() {
		$('.tahap-2').trigger('click');
		$('#synchronize_all').html(`

               <div style="text-align: center;"><b>Sinkronisasi data Target dan Realisasi Semua SKPD</b></div>
					<div class="progress" style="margin-top:6px">
	                    <div class="progress-bar progress-bar-animated bg-info progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
	                        <img src="<?php echo base_url() ?>assets/sbe/image/loading_line.gif" width="100%">
	                    </div>
                </div>`);
		// $('#tombol_sync_all').html("Loading....").attr('disabled', true);
	}

	function sync(id_instansi) {
		var tahapan_apbd = $('#tahapan_apbd').val();
		var tahun = $('#tahun').val();
		var banyak_instansi = $('.hitung_intansi').length; 
		var nama_instansi = $(this).attr('nama_instansi');
		gagal_synch = 0;
		berhasil_synch = 0;
		$('#cek_status_progress_' + id_instansi).html('<span class="badge badge-info">Loading</span>');

		
		$('#tahap-2'+ '-' + id_instansi).html('<i class="fa fa-cog fa-w-3 fa-spin"></i>').attr('disabled', true);



		if (tahun <= 2022) {
			$.ajax({
				url: baseUrl('synchronize/sync'),
				type: 'POST',
				dataType: 'JSON',
				data: {
					id_instansi : id_instansi,
					tahapan_apbd : tahapan_apbd
				},
				success: function(data) {
					if (data.status == true) {
						$('#tahap-2'+ '-' + id_instansi).attr('class', 'btn btn-sm btn-success selesai_sinkron');
						$('#tahap-2'+ '-' + id_instansi).find('i').attr('class', 'ion ion-checkmark');
						var selesai = $('.selesai_sinkron').length; 
						$('#jumlah_selesai_synchronize').html(selesai+" OPD");
						if (selesai==banyak_instansi) {
								$('#synchronize_all').html(`<div style="text-align: center;" class='alert alert-success'><b>Sinkronisasi Selesai</b></div>`);
							// $('#tombol_sync_all').html("Selesai Sinkronisasi").attr('class', 'btn btn-success btn-sm');
						}
						$('#cek_status_progress_' + id_instansi).html('<span class="badge badge-success">Synchronize Selesai</span>');
					}
				},
				error : function(){

					$('#tahap-2'+ '-' + id_instansi).attr('class', 'btn btn-sm btn-success selesai_sinkron');
					$('#tahap-2'+ '-' + id_instansi).find('i').attr('class', 'ion ion-checkmark');
					var selesai = $('.selesai_sinkron').length; 
					$('#jumlah_selesai_synchronize').html(selesai+" OPD");
					if (selesai==banyak_instansi) {
							$('#synchronize_all').html(`<div style="text-align: center;" class='alert alert-success'><b>Sinkronisasi Selesai</b></div>`);
						}
						$('#cek_status_progress_' + id_instansi).html('<span class="badge badge-danger">Synchronize Error</span>');

					
				}
			});
		}
		else{

			$.ajax({
				url: baseUrl('synchronize/synch_baru_2026/' +tahun+ '/' +tahapan_apbd+'/'+id_instansi),
				type: 'GET',
				dataType: 'JSON',
				data: {
					// id_instansi : id_instansi,
					// tahap : tahapan_apbd,
					// tahun : tahun
				},
				success: function(data) {
					
						$('#tahap-2'+ '-' + id_instansi).find('i').attr('class', 'ion ion-checkmark');

						$('#tahap-2'+ '-' + id_instansi).attr('class', 'btn btn-sm btn-success selesai_sinkron');
						var selesai = $('.selesai_sinkron').length; 
						$('#banyak_selesai').html(selesai);

						// $('#cek_status_progress_' + id_instansi).attr('style','background:green-light');
						if (selesai==banyak_instansi) {
							$('#synchronize_all').html(`<div style="text-align: center;" class='alert alert-success'><b>Sinkronisasi Selesai</b></div>`);
						}


					if (data.responcode == 200) {
						$('#cek_status_progress_' + id_instansi).html('<span class="badge badge-' +data.badge+'">'+ data.synchronize +'</span>');


						$('#cek_status_progress_' + id_instansi).attr('class', 'berhasil_sinkron');
						var berhasil_synch = $('.berhasil_sinkron').length; 

							$('#jumlah_selesai_synchronize').html(selesai+" OPD");
							$('#jumlah_synchronize_berhasil').html(berhasil_synch+" OPD");
						$('#keterangan_status_progress_' + id_instansi).html(data.message);
					}
					else{
						
						$('#cek_status_progress_' + id_instansi).html('<span class="badge badge-' +data.badge+'">'+ data.synchronize +'</span>');

						$('#cek_status_progress_' + id_instansi).attr('class', 'gagal_sinkron');
						var gagal_synch = $('.gagal_sinkron').length; 

							$('#jumlah_selesai_synchronize').html(selesai+" OPD");
							$('#jumlah_synchronize_gagal').html(gagal_synch+" OPD");
						$('#keterangan_status_progress_' + id_instansi).html(data.message);

					}

				},
				error : function(){
					
					$('#tahap-2'+ '-' + id_instansi).attr('class', 'btn btn-sm btn-success selesai_sinkron');
					$('#tahap-2'+ '-' + id_instansi).find('i').attr('class', 'ion ion-checkmark');
					
						$('#cek_status_progress_' + id_instansi).html('<span class="badge badge-danger">Synchronize Error</span>');
						$('#keterangan_status_progress_' + id_instansi).html('Error pada Aplikasi');
					var selesai = $('.selesai_sinkron').length; 
					$('#banyak_selesai').html(selesai);
					if (selesai==banyak_instansi) {
							$('#synchronize_all').html(`<div style="text-align: center;" class='alert alert-success'><b>Sinkronisasi Selesai</b></div>`);
						}

							$('#cek_status_progress_' + id_instansi).attr('class', 'gagal_sinkron');
						var gagal_synch = $('.gagal_sinkron').length; 
							$('#jumlah_selesai_synchronize').html(selesai+" OPD");
							$('#jumlah_synchronize_gagal').html(gagal_synch+" OPD");

					
				}
			});
		}


	}



	function rekap_synch_manual(sukses, gagal, jumlah_opd, tahun, tahap){
			$.ajax({
				url: baseUrl('synchronize/rekap_synch_manual'),
				type: 'POST',
				dataType: 'JSON',
				data: {
					sukses : sukses,
					gagal : gagal,
					jumlah_opd : jumlah_opd,
					tahun : tahun,
					tahap : tahap,
				},
				success: function(data) {
				},
				error : function(){

				}
			});
	}


	function Arrays_calc(array1, array2, ope) {
		var result = [];
		var ctr = 0;
		var x = 0;

		if (array1.length === 0)
			return "array1 is empty";
		if (array2.length === 0)
			return "array2 is empty";

		while (ctr < array1.length && ctr < array2.length) {
			switch (ope) {
				case '-':
					result.push(array1[ctr] - array2[ctr]);
					break;
				case '+':
					result.push(array1[ctr] + array2[ctr]);
			}
			ctr++;
		}

		if (ctr === array1.length) {
			for (x = ctr; x < array2.length; x++) {
				result.push(array2[x]);
			}
		} else {
			for (x = ctr; x < array1.length; x++) {
				result.push(array1[x]);
			}
		}

		var hasil = [];
		$.each(result, function(k, v) {
			hasil.push(v.toFixed(2));
		});

		return hasil;
	}









	function tess(){
		
	}



	function lihat_penjadwalan_synch(){
		$('#modal_jadwal_synch').modal('show');
		 dt_penjadwalan_synch();
	}





function dt_penjadwalan_synch()
	{
		$('#penjadwalan_synch').DataTable(
		{
	        processing	: true,
	        serverSide	: true,
	        bDestroy	: true,
	        responsive	: true,
	        ajax		: {
				          	url 	: baseUrl('synchronize/dt_penjadwalan_synch/'),
				            type 	: "POST",
				          	data 	: {}
	        			  },
	        columnDefs  : [
						  	{
						    	targets	 	: [ 0, -1 ],
						    	orderable 	: false,
						    },
						    {
								width		: "1%",
								targets		: [ 0 ],
							},
							{
								className	: "dt-center",
								targets		: [ -1 ],
							},
	        			  ],
	    
	     //    fnRowCallback : function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
		    //    var index = iDisplayIndex +1;
		    //    $('td:eq(0)',nRow).html(index);
		    //    return nRow;
		    // }

    	});
	}



</script>