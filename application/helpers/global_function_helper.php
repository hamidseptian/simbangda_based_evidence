<?php

/**
 * Author     : Alfikri, M.Kom
 * Created By : Alfikri, M.Kom
 * License    : Pemerintahan Provinsi Sumatera Barat
 * Class 	  : global_function_helper.php
 */
defined('BASEPATH') or exit('No direct script access allowed');

/* CI Get Instance */
function CI()
{
	$CI = &get_instance();
	return $CI;
}
function bulan_aktif()
{
	$cek_izin = CI()->db->get('izin_konfigurasi')->row(); 
	$izin_opd = $cek_izin->izin;
	$izin_kab_kota = $cek_izin->izin_kab_kota;


	$config_aktif = CI()->db->query("SELECT * from config where status='1'")->row_array(); 
	$id_config_aktif = $config_aktif['id_config'];
	$id_instansi = id_instansi();
	$id_group = CI()->session->userdata('id_group');
	if ($id_group==5) {
		if ($izin_opd==1) {
			$config = CI()->db->query("SELECT c.bulan_aktif from master_instansi mi 
				left join config c on mi.id_config = c.id_config
				where mi.id_instansi='$id_instansi'")->row_array(); 
			$bulan_aktif = $config['bulan_aktif'];
			// if ($config['id_config']<$id_config_aktif) {
			// 	$bulan_aktif = 12;
			// }else{
			// 	$bulan_aktif = $config['bulan_aktif'];
			// }
		}else{
			$config = CI()->db->query("SELECT bulan_aktif from config where id_config='$id_config_aktif'")->row_array(); 
			$bulan_aktif = $config['bulan_aktif'];
		}
	}
	else if ($id_group==7) {
		if ($izin_kab_kota==1) {
			$id_kota = CI()->session->userdata('id_kota');
			$config = CI()->db->query("SELECT c.bulan_aktif, ckk.id_config  from config_kab_kota ckk
			left join config c on ckk.id_config = c.id_config
			 where id_kota='$id_kota'")->row_array(); 
			// $bulan_aktif = $config['bulan_aktif'];
			if ($config['id_config']<$id_config_aktif) {
				$bulan_aktif = 12;
			}else{
				$bulan_aktif = $config['bulan_aktif'];
			}
		}else{
			$config = CI()->db->query("SELECT bulan_aktif from config where id_config='$id_config_aktif'")->row_array(); 
			$bulan_aktif = $config['bulan_aktif'];
		}

	}
	else{
		$config = CI()->db->query("SELECT bulan_aktif from config where id_config='$id_config_aktif'")->row_array(); 
		$bulan_aktif = $config['bulan_aktif'];
	}
	return $bulan_aktif;
}

// Konversi Bulan
function konversi_bulan($x)
{
	$bulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
	return $bulan[$x];
}
function izin_konfigurasi()
{
	$cek_izin = CI()->db->get('izin_konfigurasi')->row(); 
	return $cek_izin;
}
/* Tahun Anggaran APBD */
function tahun_anggaran()
{
	$cek_izin = CI()->db->get('izin_konfigurasi')->row(); 
	$izin_opd = $cek_izin->izin;
	$izin_kab_kota = $cek_izin->izin_kab_kota;

	$config_aktif = CI()->db->query("SELECT * from config where status='1'")->row_array(); 
	$id_config_aktif = $config_aktif['id_config'];
	$id_instansi = id_instansi();
		$id_group = CI()->session->userdata('id_group');
	if ($id_group==5) {
		if ($izin_opd==1) {
			$config = CI()->db->query("SELECT c.tahun_anggaran from master_instansi mi 
				left join config c on mi.id_config = c.id_config
				where mi.id_instansi='$id_instansi'")->row_array(); 
			$tahun_anggaran = $config['tahun_anggaran'];
		}else{
			$config = CI()->db->query("SELECT tahun_anggaran from config where id_config='$id_config_aktif'")->row_array(); 
			$tahun_anggaran = $config['tahun_anggaran'];
		}
	}
	else if ($id_group==7) {
		if ($izin_kab_kota==1) {
			$id_kota = CI()->session->userdata('id_kota');
			$config = CI()->db->query("SELECT c.tahun_anggaran  from config_kab_kota ckk
			left join config c on ckk.id_config = c.id_config
			 where id_kota='$id_kota'")->row_array(); 
			$tahun_anggaran = $config['tahun_anggaran'];
		}else{
			$config = CI()->db->query("SELECT tahun_anggaran from config where id_config='$id_config_aktif'")->row_array(); 
			$tahun_anggaran = $config['tahun_anggaran'];
		}

	}
	else{
		$config = CI()->db->query("SELECT tahun_anggaran from config where id_config='$id_config_aktif'")->row_array(); 
		$tahun_anggaran = $config['tahun_anggaran'];
	}
	


	return $tahun_anggaran ;//CI()->db->get('config')->row()->tahun_anggaran;
}
/* Tahapan APBD */
function tahapan_apbd()
{
	$cek_izin = CI()->db->get('izin_konfigurasi')->row(); 
	$izin_opd = $cek_izin->izin;
	$izin_kab_kota = $cek_izin->izin_kab_kota;

	$config_aktif = CI()->db->query("SELECT * from config where status='1'")->row_array(); 
	$id_config_aktif = $config_aktif['id_config'];
	$id_instansi = id_instansi();
	$id_group = CI()->session->userdata('id_group');
	if ($id_group==5) {
		if ($izin_opd==1) {
			$config = CI()->db->query("SELECT kode_tahap from master_instansi where id_instansi='$id_instansi'")->row_array(); 
			$tahap = $config['kode_tahap'];
		}else{
			$config = CI()->db->query("SELECT tahapan_apbd from config where id_config='$id_config_aktif'")->row_array(); 
			$tahap = $config['tahapan_apbd'];
		}
	}
	else if ($id_group==7) {
		if ($izin_kab_kota==1) {
			$id_kota = CI()->session->userdata('id_kota');
			$config = CI()->db->query("SELECT tahapan_apbd from config_kab_kota where id_kota='$id_kota'")->row_array(); 
			$tahap = $config['tahapan_apbd'];
		}else{
			$config = CI()->db->query("SELECT tahapan_apbd from config where id_config='$id_config_aktif'")->row_array(); 
			$tahap = $config['tahapan_apbd'];
		}
	}
	else{
		$config = CI()->db->query("SELECT tahapan_apbd from config where id_config='$id_config_aktif'")->row_array(); 
		$tahap = $config['tahapan_apbd'];
	}
		
	
	return $tahap;
}
function config_kab_kota()
{
	$where = [
		'id_kota'=>CI()->session->userdata('id_kota'),
		'id_provinsi'=>CI()->session->userdata('id_provinsi'),
	];
	return $tahapan_apbd = CI()->db->get_where('config_kab_kota', $where)->row();
}
/* Nama Tahapan APBD */
function nama_tahapan()
{
	$tahap = tahapan_apbd();
	if ($tahap == 2) {
		$nama_tahapan = "APBD AWAL /  PERGESERAN";
	} elseif ($tahap == 4) {
		$nama_tahapan = "APBD PERUBAHAN";
	} elseif ($tahap == 3) {
		$nama_tahapan = "APBD PERGESERAN";
	}

	return $nama_tahapan;
}
function nama_kota($id_kota)
{
	if ($id_kota == '') {
		$nama_kota = "Semua Kota";
	} else {
		$q = CI()->db->query("SELECT * from kota where id_kota='$id_kota'")->row_array();
		$nama_kota = $q['nama_kota'];
	}

	return $nama_kota;
}
function pilihan_nama_tahapan($kode)
{
	$tahap = [0=> '<span class="text-danger">Error</span>', 2=>'APBD AWAL',3=>'APBD Pergeseran',4=>'APBD PERUBAHAN'];
	

	return $tahap[$kode];
}
function balikkan_tanggal($tgl)
{
	$pecah = explode('-', $tgl);
	$show = $pecah[2].' '.nama_bulan($pecah[1]).' '.$pecah[0];

	return $show;
}
function timestamp_lengkap($timestamp)
{
	$pecah1 = explode(' ', $timestamp);
	$tgl = $pecah1[0];
	$pecah2 = explode('-', $tgl);
	$tgl_ok = $pecah2[2].' '.nama_bulan($pecah2[1]).' '.$pecah2[0];
	$show = $tgl_ok.' '.$pecah1[1];

	return $show;
}
function caption_perubahan_tahapan($kode)
{
	$tahap = [2=>'-',3=>'Data berubah pada APBD Pergeseran',4=>'Data berubah pada APBD Perubahan'];

	return $tahap[$kode];
}
function nama_hari($kode)
{
	$tahap = [1=>'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];

	return $tahap[$kode];
}
// Nama Instansi
function nama_instansi($id_instansi = '')
{
	if ($id_instansi) {
		$id = $id_instansi;
	} else {
		$id = id_instansi();
	}
	$q =  CI()->db->get_where('master_instansi', ['id_instansi' => $id])->row_array();
	return $q['nama_instansi'];
}
/* ID instansi berdasarkan Kode OPD */
function id_instansi_kode_opd($kode_opd)
{
	$data = CI()->db->get_where('master_instansi', ['kode_opd' => $kode_opd]);
	if ($data->num_rows() > 0) {
		return $data->row()->id_instansi;
	} else {
		return 0;
	}
}
/* Check Internet Connection */
function internet_connection($sCheckHost = 'www.google.com')
{
	return (bool) @fsockopen($sCheckHost, 80, $iErrno, $sErrStr, 5);
}
/* Check Identitas Exist */
function identitas()
{
	$check = CI()->db->query("SELECT * FROM master_identitas")->num_rows();
	if ($check > 0) {
		return true;
	} else {
		return false;
	}
}
/* id user */
function id_user()
{
	return CI()->session->userdata('id_user');
}
/* nama user */
function nama_user()
{
	return CI()->session->userdata('full_name');
}
/* id instansi */
function id_instansi()
{
	return CI()->session->userdata('id_instansi');
}
function id_config_instansi()
{
	$id_instansi = CI()->session->userdata('id_instansi');
	$config = CI()->db->query("SELECT id_config from master_instansi where id_instansi='$id_instansi'")->row_array();
	return $config['id_config'];
}
function id_config()
{
	$config = CI()->db->query("SELECT id_config from config where status='1'")->row_array();
	return $config['id_config'];
}
/* mulai realisasi instansi */
function mulai_realisasi_instansi($id_instansi)
{
	$q = CI()->db->query("SELECT bulan_mulai_realisasi FROM master_instansi WHERE id_instansi ='{$id_instansi}'")->row()->bulan_mulai_realisasi;
	return $q;
}
/* akhir realisasi instansi */
function akhir_realisasi_instansi($id_instansi)
{
	$q = CI()->db->query("SELECT bulan_akhir_realisasi FROM master_instansi WHERE id_instansi ='{$id_instansi}'")->row()->bulan_akhir_realisasi;
	return $q;
}
/* Get Full Name */
function full_name($id_user)
{
	if ($id_user) {
		return CI()->db->get_where('master_users', ['id_user' => $id_user])->row()->full_name;
	}
}
/* get id by email */
function get_id_by_email($email)
{
	$id = CI()->db->query("SELECT id_user FROM master_users WHERE email ='{$email}'")->row()->id_user;
	return $id;
}
/* get group name */
function get_group_name($id_user)
{
	$group_name = CI()->db->query("SELECT group_name FROM v_users WHERE id_user={$id_user}")->row()->group_name;
	return $group_name;
}
// Where In Array
function flatten(array $array)
{
	$return = array();
	array_walk_recursive($array, function ($a) use (&$return) {
		$return[] = $a;
	});
	return $return;
}

// Create Folder and File Modules
function create_folder_file_modules($folder)
{
	$module_name    = ucfirst($folder);
	$current_dir    = APPPATH . 'modules';
	chdir($current_dir);
	mkdir("./" . lcfirst($module_name), 0700, true);
	chdir($module_name);
	mkdir("./controllers", 0700, true);
	mkdir("./models", 0700, true);
	mkdir("./views", 0700, true);
	mkdir("./views/" . lcfirst($module_name), 0700, true);
	chdir("controllers");
	$file_controllers = fopen($module_name . ".php", "w");
	fwrite($file_controllers, "<?php\n/**\n\t* Author     : Alfikri, M.Kom\n\t* Created By : Alfikri, M.Kom\n\t* E-Mail     : alfikri.name@gmail.com\n\t* No HP      : 081277337405\n\t* Class      : {$module_name}.php\n*/\ndefined('BASEPATH') OR exit('No direct script access allowed');\n\nclass {$module_name} extends MY_Controller\n{\n\tpublic function __construct()\n\t{\n\t\tparent::__construct();\n\t}\n}");
	fclose($file_controllers);

	chdir($current_dir . "/" . lcfirst($module_name));
	chdir("models");
	$file_models = fopen($module_name . "_model.php", "w");
	fwrite($file_models, "<?php\n/**\n\t* Author     : Alfikri, M.Kom\n\t* Created By : Alfikri, M.Kom\n\t* E-Mail     : alfikri.name@gmail.com\n\t* No HP      : 081277337405\n\t* Class      : {$module_name}_model.php\n*/\ndefined('BASEPATH') OR exit('No direct script access allowed');\n\nclass {$module_name}_model extends CI_Model\n{\n\tpublic function __construct()\n\t{\n\t\tparent::__construct();\n\t}\n}");
	fclose($file_models);

	chdir($current_dir . "/" . lcfirst($module_name));
	chdir("views/" . lcfirst($module_name));
	$file_index = fopen("index.php", "w");
	fwrite($file_index, "<?php\n/**\n\t* Author     : Alfikri, M.Kom\n\t* Created By : Alfikri, M.Kom\n\t* E-Mail     : alfikri.name@gmail.com\n\t* No HP      : 081277337405\n*/\n?>\n");
	$file_css = fopen("css.php", "w");
	fwrite($file_css, "<?php\n/**\n\t* Author     : Alfikri, M.Kom\n\t* Created By : Alfikri, M.Kom\n\t* E-Mail     : alfikri.name@gmail.com\n\t* No HP      : 081277337405\n*/\n?>\n");
	$file_js = fopen("js.php", "w");
	fwrite($file_js, "<?php\n/**\n\t* Author     : Alfikri, M.Kom\n\t* Created By : Alfikri, M.Kom\n\t* E-Mail     : alfikri.name@gmail.com\n\t* No HP      : 081277337405\n*/\n?>\n");
	$file_modal = fopen("modal.php", "w");
	fwrite($file_modal, "<?php\n/**\n\t* Author     : Alfikri, M.Kom\n\t* Created By : Alfikri, M.Kom\n\t* E-Mail     : alfikri.name@gmail.com\n\t* No HP      : 081277337405\n*/\n?>\n");
	fclose($file_index);
	fclose($file_css);
	fclose($file_js);
	fclose($file_modal);
}

// Function delete folder and file
function delete_directory($dirname)
{
	$current_dir    = APPPATH . 'modules';
	chdir($current_dir);
	if (is_dir($dirname))
		$dir_handle = opendir($dirname);
	if (!$dir_handle)
		return false;
	while ($file = readdir($dir_handle)) {
		if ($file != "." && $file != "..") {
			if (!is_dir($dirname . "/" . $file))
				unlink($dirname . "/" . $file);
			else
				delete_directory($dirname . '/' . $file);
		}
	}
	closedir($dir_handle);
	rmdir($dirname);
}
// Fungsi Encrypt
function encrypt($str)
{
	$hasil = '';
	$kunci = '979a218e0632df2935317f98d47956c7';
	for ($i = 0; $i < strlen($str); $i++) {
		$karakter = substr($str, $i, 1);
		$kuncikarakter = substr($kunci, ($i % strlen($kunci)) - 1, 1);
		$karakter = chr(ord($karakter) + ord($kuncikarakter));
		$hasil .= $karakter;
	}
	return urlencode(base64_encode($hasil));
}
// Fungsi Decrypt
function decrypt($str)
{
	$str = base64_decode(urldecode($str));
	$hasil = '';
	$kunci = '979a218e0632df2935317f98d47956c7';
	for ($i = 0; $i < strlen($str); $i++) {
		$karakter = substr($str, $i, 1);
		$kuncikarakter = substr($kunci, ($i % strlen($kunci)) - 1, 1);
		$karakter = chr(ord($karakter) - ord($kuncikarakter));
		$hasil .= $karakter;
	}
	return $hasil;
}
// Users Theme
function theme($kategori)
{

	$result = CI()->db->get_where('users_theme', ['id_user' => id_user()]);
	if ($result->num_rows() > 0) {
		if ($kategori == "header") {
			return $result->row()->header_class;
		} else {
			return $result->row()->sidebar_class;
		}
	} else {
		return "";
	}
}

// Slug
function slug($text)
{
	// replace non letter or digits by -
	$text = preg_replace('~[^\\pL\d]+~u', '-', $text);
	// trim
	$text = trim($text, '-');
	// transliterate
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	// Upper Case
	$text = strtoupper($text);
	// remove unwanted characters
	$text = preg_replace('~[^-\w]+~', '', $text);

	if (empty($text)) {
		return 'n-a';
	}

	return $text;
}

function sbe_crypt($string, $action = 'E')
{
	$secret_key = 'my_simple_secret_key';
	$secret_iv = 'my_simple_secret_iv';

	$output = false;
	$encrypt_method = "AES-256-CBC";
	$key = hash('sha256', $secret_key);
	$iv = substr(hash('sha256', $secret_iv), 0, 16);

	if ($action == 'E') {
		$output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
	} else if ($action == 'D') {
		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	}

	return $output;
}

function bulan_global($x)
{
	$bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
	return $bulan[$x];
}
function pilihan_bulan()
{
	$bulan = array(1=>'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
	return $bulan;
}
function nama_bulan($x)
{
	$bulan = array(
	'01'=>'Januari',
	'02'=> 'Februari',
	'03'=> 'Maret',
	'04'=> 'April',
	'05'=> 'Mei',
	'06'=> 'Juni',
	'07'=> 'Juli',
	'08'=> 'Agustus',
	'09'=> 'September',
	'10'=> 'Oktober',
	'11'=> 'November',
	'12'=> 'Desember');
	return $bulan[$x];
}

function jml_hari_dalam_bulan($bulan, $tahun)
{
	$kalender = CAL_GREGORIAN;
	$jml_hari = cal_days_in_month($kalender, $bulan, $tahun);
	return $jml_hari;
}
function timestamp()
{
	$tgls = date('Y-m-d H:i:s');
	return $tgls;
}



function deadline_upload()
{
	$deadline = CI()->db->get('config')->row()->realisasi_fisik_selesai ;
	return $deadline;
}
function mulai_upload_realisasi_fisik()
{
	$deadline = CI()->db->get('config')->row()->realisasi_fisik_mulai ;
	return $deadline;
}
function jadwal_rfk_kab_kota()
{
	$id_kota  = CI()->session->userdata('id_kota');
	$config_kab_kota = CI()->db->query("SELECT id_config from config_kab_kota where id_kota='$id_kota'")->row_array();

	if(izin_konfigurasi()->izin_kab_kota==0){
		$config_aktif = CI()->db->query("SELECT id_config from config where status='1'")->row_array(); 
		$id_config = $config_aktif['id_config'];
	}else{

		$id_config = $config_kab_kota['id_config'];
	}

	$config_admin = CI()->db->query("SELECT * from config where id_config='$id_config'")->row_array();
	$tgl =  intval(date('d'));

	$mulai = $config_admin['tgl_input_rfk_kab_kota_awal'];
	$selesai = $config_admin['tgl_input_rfk_kab_kota_akhir'];
	$penginputan = $config_admin['penginputan_kab_kota'];
	$bulan_aktif = $config_admin['bulan_aktif'];
	$bulan_sebelumnya = date('n') == 1 ? 12 : date('n')-1;
	if ($tgl>=$mulai && $tgl<=$selesai && $bulan_sebelumnya==$bulan_aktif) {
		$aktif = 1;
		$pesan = 'Bulan laporan yang boleh di inputkan adalah bulan '. bulan_global(bulan_aktif());
	}else{
		$aktif = 0;
		$pesan = 'penginputan di kunci karena diluar jadwal penginputan';

	}

	if ($penginputan==0) {
		$info_input_rfk = 'Penginputan Realisasi Fisik Dan Keuangan dikunci admin' ;
		$kunci_kuncian = [
			'bulan_aktif'=>$bulan_aktif,
			'aktif'=>0,
			'info'=>'<div class="alert alert-info">'.$info_input_rfk.'</div>',
			'pesan'=>'Penginputan RFK di kunci admin',
		];
	}
	elseif ($penginputan==1) {

		$info_input_rfk = 'Penginputan Realisasi Fisik Dan Keuangan dilakukan pada tanggal '.$mulai.' - '.$selesai.' '.bulan_global(date('n')).' '.tahun_anggaran() ;
		$kunci_kuncian = [
			'bulan_aktif'=>$bulan_aktif,
			'aktif'=>$aktif,
			'info'=>'<div class="alert alert-info">'.$info_input_rfk.'</div>',
			'pesan'=>$pesan,
		];
	}
	else {
		$info_input_rfk = 'Penginputan Bebas';
		$kunci_kuncian = [
			'bulan_aktif'=>$bulan_aktif,
			'aktif'=>2,
			'info'=>''.$info_input_rfk.'',
			'pesan'=>'Penginputan bebas ',
		];
	}

	return $kunci_kuncian;
}




function kunci_synch()
{
	$id_instansi  = id_instansi();
	$config_instansi = CI()->db->query("SELECT id_config from master_instansi where id_instansi='$id_instansi'")->row_array();
	$config_aktif = CI()->db->query("SELECT id_config from config where status='1'")->row_array(); 

	if(izin_konfigurasi()->izin==0){
		$id_config = $config_aktif['id_config'];
	}else{
		if (CI()->session->userdata('id_group')==2) {
			$id_config = $config_aktif['id_config'];
		}else{
			$id_config = $config_instansi['id_config'];
		}
	}

	$config_admin = CI()->db->query("SELECT * from config where id_config='$id_config'")->row_array();

		if ($config_admin['synchronize']==1) {
			
			$kunci_kuncian = [
				'synchronize'=>$config_admin['synchronize'],
				'info'=>'<div class="alert alert-info">Synchronize Bebas</div>',
				'pesan'=>"Synchronize bebas",
			];			# code...
		}else{


			$kunci_kuncian = [
				'synchronize'=>$config_admin['synchronize'],
				'info'=>'<div class="alert alert-info">Synchronize sedang dikunci admin</div>',
				'pesan'=>$config_admin['synchronize'] == 1 ? '' : "Synchronize dikunci admin",
			];
		}

	return $kunci_kuncian;

}



function jadwal_rfk()
{
	$id_instansi  = id_instansi();
	$config_instansi = CI()->db->query("SELECT id_config from master_instansi where id_instansi='$id_instansi'")->row_array();

	if(izin_konfigurasi()->izin==0){
		$config_aktif = CI()->db->query("SELECT id_config from config where status='1'")->row_array(); 
		$id_config = $config_aktif['id_config'];
	}else{

		$id_config = $config_instansi['id_config'];
	}

	$config_admin = CI()->db->query("SELECT * from config where id_config='$id_config'")->row_array();
	$tgl =  strtotime(date('Y-m-d H:i:s'));



	$mulai = $config_admin['tgl_input_rfk_mulai'];
	$selesai = $config_admin['tgl_input_rfk_akhir'];
	$tgl_terbuka = strtotime(date('Y-m-').$mulai.' '.$config_admin['jam_mulai_penginputan']);
	$tgl_terkunci = strtotime(date('Y-m-').$selesai.' '.$config_admin['jam_akhir_penginputan']);


	$tgl_countdown = date('Y-m-').$selesai;
	$penginputan = $config_admin['penginputan'];
	$bulan_aktif = $config_admin['bulan_aktif'];
	$bulan_sebelumnya = date('n') == 1 ? 12 : date('n')-1;

	$caption_mulai = $mulai.' '.bulan_global(intval(date('m'))).' '.date('Y').' '.$config_admin['jam_mulai_penginputan'];
	$caption_selesai = $selesai.' '.bulan_global(intval(date('m'))).' '.date('Y').' '.$config_admin['jam_akhir_penginputan'];







		$expired = date('Y-m-d H:i:s');
		$q_izin_khusus = CI()->db->query("SELECT * from izin_akses_input_khusus where id_instansi='$id_instansi' and (akses_input='rfk' or akses_input='full') and id_config='$id_config' order by id_izin_akses_khusus DESC");
		$izin_khusus = $q_izin_khusus->row_array();










	// if ($tgl>$mulai && $tgl<$selesai) {
	if ($tgl>=$tgl_terbuka && $tgl<=$tgl_terkunci) {
		$aktif = 1;
		$pesan = 'Waktu penginputan Realisasi fisik dan realisasi keuangan  pada <br>'.$caption_mulai.' sampai '.$caption_selesai;
	}else{
		$aktif = 0;
		$pesan = 'Terkunci karena diluar jadwal penginputan pada <br>'.$caption_mulai.' sampai '.$caption_selesai;

	}

	if ($penginputan==0) {

		if ($q_izin_khusus->num_rows()>0) {
			if ($izin_khusus['penginputan']==1) {
				if (date('Y-m-d H:i:s')<=$izin_khusus['jadwal_berakhir'] && date('Y-m-d H:i:s')>$izin_khusus['jadwal_mulai']) {
					$info_input_rfk = 'Penginputan Realisasi Fisik Dan Keuangan Bebas Sementara';
					$kunci_kuncian = [
						'bulan_aktif'=>$bulan_aktif,
						'penginputan'=>$penginputan,
						'aktif'=>1,
						'info'=>'<div class="alert alert-info">'.$info_input_rfk.'</div>',
						'waktu_terkunci'=>$config_admin['jam_akhir_penginputan'],
						'tanggal_terkunci'=>$tgl_countdown,
						'pesan'=>'Anda mendapatkan izin khusus dari admin dari '.$izin_khusus['jadwal_mulai'].' sampai '.$izin_khusus['jadwal_berakhir'],
					];


				}else{
					$info_input_rfk = 'Penginputan Realisasi Fisik Dan Keuangan dikunci admin' ;
					$kunci_kuncian = [
						'bulan_aktif'=>$bulan_aktif,
						'penginputan'=>$penginputan,
						'aktif'=>0,
						'info'=>'<div class="alert alert-info">'.$info_input_rfk.'</div>',
						'waktu_terkunci'=>$config_admin['jam_akhir_penginputan'],
						'tanggal_terkunci'=>$tgl_countdown,
						'pesan'=>'Penginputan dikunci oleh admin <br>penginputan data terkunci karena dikunci oleh admin dan akses izin khusus anda telah berakhir pada '.$izin_khusus['jadwal_berakhir'],
					];
				
				}
			}else{
				$info_input_rfk = 'Penginputan Realisasi Fisik Dan Keuangan dikunci admin' ;
				$kunci_kuncian = [
					'bulan_aktif'=>$bulan_aktif,
					'penginputan'=>$penginputan,
					'aktif'=>0,
					'info'=>'<div class="alert alert-info">'.$info_input_rfk.'</div>',
					'waktu_terkunci'=>$config_admin['jam_akhir_penginputan'],
					'tanggal_terkunci'=>$tgl_countdown,
					'pesan'=>'Penginputan dikunci oleh admin <br>penginputan data terkunci karena dikunci oleh admin dan akses izin khusus anda telah berakhir pada '.$izin_khusus['jadwal_berakhir'],
				];


			}
		}else{
			$info_input_rfk = 'Penginputan Realisasi Fisik Dan Keuangan dikunci admin' ;
			$kunci_kuncian = [
				'bulan_aktif'=>$bulan_aktif,
				'penginputan'=>$penginputan,
				'aktif'=>0,
				'info'=>'<div class="alert alert-info">'.$info_input_rfk.'</div>',
				'waktu_terkunci'=>$config_admin['jam_akhir_penginputan'],
				'tanggal_terkunci'=>$tgl_countdown,
				'pesan'=>'Penginputan Realisasi Fisik dan Realisasi Keuangan di kunci Admin',
			];
		}




	}
	elseif ($penginputan==1) {






		if ($q_izin_khusus->num_rows()>0) {
			if ($izin_khusus['penginputan']==1) {
				if (date('Y-m-d H:i:s')<=$izin_khusus['jadwal_berakhir'] && date('Y-m-d H:i:s')>$izin_khusus['jadwal_mulai']) {
					$info_input_rfk = 'Penginputan Realisasi Fisik Dan Keuangan Bebas Sementara';
					$kunci_kuncian = [
						'bulan_aktif'=>$bulan_aktif,
						'penginputan'=>$penginputan,
						'aktif'=>1,
						'info'=>'<div class="alert alert-info">'.$info_input_rfk.'</div>',
						'waktu_terkunci'=>$config_admin['jam_akhir_penginputan'],
						'tanggal_terkunci'=>$tgl_countdown,
						'pesan'=>'Terkunci karena diluar jadwal penginputan pada <br>'.$caption_mulai.' sampai '.$caption_selesai.'<br>Anda mendapatkan izin khusus dari admin dari '.$izin_khusus['jadwal_mulai'].' sampai '.$izin_khusus['jadwal_berakhir'],
					];


				}else{
					$info_input_rfk = 'Penginputan Realisasi Fisik Dan Keuangan dikunci admin' ;
					$kunci_kuncian = [
						'bulan_aktif'=>$bulan_aktif,
						'penginputan'=>$penginputan,
						'aktif'=>0,
						'info'=>'<div class="alert alert-info">'.$info_input_rfk.'</div>',
						'waktu_terkunci'=>$config_admin['jam_akhir_penginputan'],
						'tanggal_terkunci'=>$tgl_countdown,
						'pesan'=>'Terkunci karena diluar jadwal penginputan pada <br>'.$caption_mulai.' sampai '.$caption_selesai.'<br>akses izin khusus anda telah berakhir pada '.$izin_khusus['jadwal_berakhir'],
					];
				
				}
			}else{
				$info_input_rfk = 'Penginputan Realisasi Fisik Dan Keuangan dikunci admin' ;
				$kunci_kuncian = [
					'bulan_aktif'=>$bulan_aktif,
					'penginputan'=>$penginputan,
					'aktif'=>0,
					'info'=>'<div class="alert alert-info">'.$info_input_rfk.'</div>',
					'waktu_terkunci'=>$config_admin['jam_akhir_penginputan'],
					'tanggal_terkunci'=>$tgl_countdown,
					'pesan'=>'Penginputan terkunci karena diluar jadwal penginputan pada '.$mulai.' - '.$selesai.' oleh admin <br>penginputan data terkunci karena dikunci oleh admin dan akses izin khusus anda telah berakhir pada '.$izin_khusus['jadwal_berakhir'],
				];


			}
		}else{
			$info_input_rfk = 'Penginputan Realisasi Fisik Dan Keuangan dilakukan pada tanggal '.$mulai.' - '.$selesai.' '.bulan_global(date('n')).' '.tahun_anggaran() ;
			$kunci_kuncian = [
				'bulan_aktif'=>$bulan_aktif,
				'penginputan'=>$penginputan,
				'aktif'=>$aktif,
				'info'=>'<div class="alert alert-info">'.$info_input_rfk.'</div>',
				'waktu_terkunci'=>$config_admin['jam_akhir_penginputan'],
				'tanggal_terkunci'=>$tgl_countdown,
				'pesan'=>$pesan,
			];
		}








	}
	else {
		$info_input_rfk = 'Penginputan Realisasi Fisik Dan Keuangan Bebas Sementara';
		$kunci_kuncian = [
			'bulan_aktif'=>$bulan_aktif,
			'penginputan'=>$penginputan,
			'aktif'=>2,
			'info'=>'<div class="alert alert-info">'.$info_input_rfk.'</div>',
			'waktu_terkunci'=>$config_admin['jam_akhir_penginputan'],
			'tanggal_terkunci'=>$tgl_countdown,
			'pesan'=>'Penginputan bebas ',
		];
	}

	return $kunci_kuncian;
}

function jadwal_input_data_dasar()
{
	// ?untuk mengunci data program, kegiatan, dan sub kegiatan (target, sumber dana, pagu, hapus ), paket (bolume, lokasi, edit, hapus), penambahan sub kegiatan batu, UPTD,  
	$id_instansi  = id_instansi();
	$config_instansi = CI()->db->query("SELECT id_config from master_instansi where id_instansi='$id_instansi'")->row_array();

	if(izin_konfigurasi()->izin==0){
		$config_aktif = CI()->db->query("SELECT id_config from config where status='1'")->row_array(); 
		$id_config = $config_aktif['id_config'];
	}else{

		$id_config = $config_instansi['id_config'];
	}

	$config_admin = CI()->db->query("SELECT * from config where id_config='$id_config'")->row_array();
	$tgl =  strtotime(date('Y-m-d H:i:s'));

	$mulai = strtotime($config_admin['jadwal_input_data_dasar_awal'].' '.$config_admin['jam_mulai_penginputan']);
	$selesai = strtotime($config_admin['jadwal_input_data_dasar_akhir'].' '.$config_admin['jam_akhir_penginputan']);

	$caption_mulai = $config_admin['jadwal_input_data_dasar_awal'].' '.$config_admin['jam_mulai_penginputan'];
	$caption_selesai = $config_admin['jadwal_input_data_dasar_akhir'].' '.$config_admin['jam_akhir_penginputan'];

	$jadwal = $caption_mulai.' sampai tanggal '.$caption_selesai;

	if ($tgl>$mulai && $tgl<=$selesai) {
	// if (date('Y-m-d H:i:s')<=$izin_khusus['jadwal_berakhir'] && date('Y-m-d H:i:s')>$izin_khusus['jadwal_mulai']) {
		$aktif = 1;
		$pesan = 'Penginputan dilakukan dari tanggal '.$caption_mulai.' sampai tanggal '.$caption_selesai;
		$pesan_action = '';
	}else{
		$expired = date('Y-m-d H:i:s');
		$q_izin_khusus = CI()->db->query("SELECT * from izin_akses_input_khusus where id_instansi='$id_instansi' and (akses_input='data_apbd' or akses_input='full') and id_config='$id_config' order by expired desc");
		$izin_khusus = $q_izin_khusus->row_array();
		if ($q_izin_khusus->num_rows()>0) {
			if ($izin_khusus['penginputan']==1) {
				if (date('Y-m-d H:i:s')<=$izin_khusus['jadwal_berakhir'] && date('Y-m-d H:i:s')>$izin_khusus['jadwal_mulai']) {
					$aktif = 1;
					$pesan = 'Anda mendapatkan izin khusus dari admin dari '.$izin_khusus['jadwal_mulai'].' sampai '.$izin_khusus['jadwal_berakhir'];
					$pesan_action = '';
				}else{
					$aktif = 0;
					$pesan = 'Penginputan dilakukan dari tanggal '.$caption_mulai.' sampai tanggal '.$caption_selesai.'<br>penginputan data terkunci karena diluar jadwal penginputan dan akses izin khusus anda telah expired pada '.$izin_khusus['jadwal_berakhir'];
					$pesan_action = 'Terkunci';
				}
			}else{
					$aktif = 0;
					$pesan = 'Penginputan dilakukan dari tanggal '.$caption_mulai.' sampai tanggal '.$caption_selesai.'<br>penginputan data terkunci karena diluar jadwal penginputan dan akses izin khuusus anda telah dicabut';
					$pesan_action = 'Terkunci';
			}
		}else{
			$aktif = 0;
			$pesan = 'Penginputan dilakukan dari tanggal '.$caption_mulai.' sampai tanggal '.$caption_selesai.'<br>penginputan data terkunci karena diluar jadwal penginputan';
			$pesan_action = 'Terkunci';

		}


	}

	
		$kunci_kuncian = [
			'penginputan'=> "Penginputan Data <br>Pemilihan Sub Kegiatan, Target, Sumber Dana, Pagu, Master Paket",
			'pesan_action'=>$pesan_action,
			'aktif'=>$aktif,
			'jadwal'=>$jadwal,
			'pesan'=>$pesan,
		];
	

	return $kunci_kuncian;
}

function nama_program($kode){
	$program = CI()->db->query("SELECT nama_program, kode_program from master_program")->result_array(); 
	$kumpul_program = [];
	foreach ($program as $k => $v) {
		$kumpul_program[$v['kode_program']] = $v['nama_program'];
	}
	return $kumpul_program[$kode];
}
function nama_kegiatan($kode){
	$kegiatan = CI()->db->query("SELECT nama_kegiatan, kode_kegiatan from master_kegiatan")->result_array(); 
	$kumpul_kegiatan = [];
	foreach ($kegiatan as $k => $v) {
		$kumpul_kegiatan[$v['kode_kegiatan']] = $v['nama_kegiatan'];
	}
	return $kumpul_kegiatan[$kode];
	
}
function list_sub_kegiatan_opd($id_instansi, $tahun, $tahap){
	if ($tahap==2) {
		$kegiatan = CI()->db->query("SELECT nama_sub_kegiatan, kode_sub_kegiatan, kategori, jenis_sub_kegiatan, keterangan from sub_kegiatan_instansi where id_instansi='$id_instansi' and tahun='$tahun' and kode_tahap='$tahap'")->result_array(); 
		# code...
	}else{
		$kegiatan = CI()->db->query("SELECT nama_sub_kegiatan, kode_sub_kegiatan, kategori, jenis_sub_kegiatan, keterangan from sub_kegiatan_instansi where id_instansi='$id_instansi' and tahun='$tahun' and status='1'")->result_array(); 
	}
	$kumpul_kegiatan = [];
	foreach ($kegiatan as $k => $v) {
		if ($v['kategori']=='Unit Pelaksana') {
			$nama_sub_kegiatan = $v['nama_sub_kegiatan'].'<br>'.$v['jenis_sub_kegiatan'].' - '.$v['keterangan'];
		}else{
			$nama_sub_kegiatan = $v['nama_sub_kegiatan'];

		}
		$kumpul_kegiatan[$v['kode_sub_kegiatan']] = $nama_sub_kegiatan	;
	}
	return $kumpul_kegiatan;
	
}
function jadwal_validasi()
{
	// ?untuk mengunci data program, kegiatan, dan sub kegiatan (target, sumber dana, pagu, hapus ), paket (bolume, lokasi, edit, hapus), penambahan sub kegiatan batu, UPTD,  
	$config_aktif = CI()->db->query("SELECT jam_mulai_penginputan, jam_akhir_penginputan, tgl_validasi_rfk_mulai, tgl_validasi_rfk_akhir from config where status='1'")->row_array(); 
	$tgls = date('d');
	$bulan_saat_ini = intval(date('m'));
	$tahun_ini = date('Y');

	$jam_mulai_penginputan = $config_aktif['jam_mulai_penginputan'];
	$jam_akhir_penginputan = $config_aktif['jam_akhir_penginputan'];

	$tgl_mulai = $config_aktif['tgl_validasi_rfk_mulai'];
	$tgl_selesai = $config_aktif['tgl_validasi_rfk_akhir'];

	$waktu_sekarang = date('Y-m-d H:i:s');
	$waktu_mulai = $tahun_ini.'-'.$bulan_saat_ini.'-'.$tgl_mulai.' '.$jam_mulai_penginputan;
	$waktu_selesai = $tahun_ini.'-'.$bulan_saat_ini.'-'.$tgl_selesai.' '.$jam_akhir_penginputan ;


	$mulai_input = strtotime($waktu_mulai);
	$selesai_input = strtotime($waktu_selesai);
	$input_sekarang = strtotime($waktu_sekarang);

	$tanggal_sekarang =$tgls.' '.bulan_global($bulan_saat_ini).' '.$tahun_ini;
	$jadwal =$tgl_mulai.' - '.$tgl_selesai.' '.bulan_global($bulan_saat_ini).' '.$tahun_ini;


// $tgl>$mulai && $tgl<$selesai
	if ($input_sekarang > $mulai_input && $input_sekarang < $selesai_input) {
		$aktif = 1;
		$pesan = '';
	}else{
		$aktif = 0;
		$pesan = 'Validasi terkunci karena melewati jadwal ['.$tanggal_sekarang.'] <br>Validasi dilakukan pada tanggal '.$jadwal;

	}
	
		$kunci_kuncian = [
			'aktif'=>1,//$aktif,
			'tanggal_sekarang'=>$tanggal_sekarang,
			'jadwal'=>$jadwal,
			'pesan'=>$pesan,
		];
	

	return $kunci_kuncian;
}




function terbilang($angka) {
    $angka = (int) $angka;
    $hasil = "";
    $bilangan = array(
        "",
        "satu",
        "dua",
        "tiga",
        "empat",
        "lima",
        "enam",
        "tujuh",
        "delapan",
        "sembilan",
        "sepuluh",
        "sebelas"
    );

    if ($angka < 12) {
        $hasil = $bilangan[$angka];
    } elseif ($angka < 20) {
        $hasil = terbilang($angka - 10) . " belas";
    } elseif ($angka < 100) {
        $hasil = terbilang($angka / 10) . " puluh " . terbilang($angka % 10);
    } elseif ($angka < 200) {
        $hasil = "seratus " . terbilang($angka - 100);
    } elseif ($angka < 1000) {
        $hasil = terbilang($angka / 100) . " ratus " . terbilang($angka % 100);
    } elseif ($angka < 2000) {
        $hasil = "seribu " . terbilang($angka - 1000);
    } elseif ($angka < 1000000) {
        $hasil = terbilang($angka / 1000) . " ribu " . terbilang($angka % 1000);
    } elseif ($angka < 1000000000) {
        $hasil = terbilang($angka / 1000000) . " juta " . terbilang($angka % 1000000);
    } // Tambahkan logika untuk jutaan, milyaran, triliun, dst. sesuai kebutuhan

    return trim($hasil);
}

function jenis_belanja($kode){
	$jenis_belanja = [
    '5.1.01'=>'Belanja Pegawai',
    '5.1.02'=>'Belanja Barang Jasa',
    '5.1.03'=>'Belanja Bunga',
    '5.1.04'=>'Belanja Subsidi',
    '5.1.05'=>'Belanja Hibah',
    '5.1.06'=>'Belanja Bantuan Sosial',
    '5.2.01'=>'Belanja Modal Tanah',
    '5.2.02'=>'Belanja Modal Peralatan Dan Mesin',
    '5.2.03'=>'Belanja Modal Gedung & Bangunan',
    '5.2.04'=>'Belanja Modal Jalan, Jaringan, dan Irigasi',
    '5.2.05'=>'Belanja Modal dan Aset Tetap Lainnya',
    '5.2.06'=>'Belanja Modal aset Lainnya',
    '5.3.01'=>'Belanja Tidak Terduga',
    '5.4.01'=>'Belanja Bagi Hasil',
    '5.4.02'=>'Belanja Bantuan Keuangan',
];

return $jenis_belanja[$kode];
}



function kelompok_jenis_belanja($kode){
	$kelompok_jenis_belanja = [
	    '5.1'=>'Belanja Operasi',
	    '5.2'=>'Belanja Modal',
	    '5.3'=>'Belanja Tidak Terduga',
	    '5.4'=>'Belanja Transfer',
	];

	return $kelompok_jenis_belanja[$kode];
}


function angkaKeHuruf($angka) {
    $huruf = '';

    while ($angka > 0) {
        $mod = ($angka - 1) % 26;
        $huruf = chr(65 + $mod) . $huruf;
        $angka = intval(($angka - 1) / 26);
    }

    return $huruf;
}



