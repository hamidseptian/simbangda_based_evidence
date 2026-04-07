<?php

/**
 * Author     : Alfikri, M.Kom
 * Created By : Alfikri, M.Kom
 * E-Mail     : alfikri.name@gmail.com
 * No HP      : 081277337405
 * Class      : Realisasi_akumulasi_model.php
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Realisasi_akumulasi_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_opd()
	{
		if ($this->session->userdata('group_name') == 'OPERATOR') :
			if (id_instansi()) :
				$data = [
					'id_instansi' => id_instansi()
				];
			endif;
		else /*if ($this->session->userdata('group_name') == 'ADMIN' || $this->session->userdata('group_name') == 'SUPER ADMIN' || $this->session->userdata('group_name') == 'HELPDESK') */ :
			$data = [
				'kategori' => 'OPD',
				'id_instansi !=' => 3,
				'is_active =' => 1
			];
		endif;
		return $this->db->get_where('master_instansi', $data);
	}



	public function get_program($id_instansi, $tahap, $tahun)
	{

		if ($tahap == 4 ) {
			
			$where 		=['id_instansi'=>$id_instansi, 'tahun'=>$tahun];
			// $program 	= $this->db->get_where('v_program_apbd_perubahan' , $where);
			$program 	= $this->db->query("SELECT ski.kode_program as kode_rekening_program, ski.kode_bidang_urusan,  mp.nama_program from sub_kegiatan_instansi ski left join master_program mp on ski.kode_program=mp.kode_program where ski.id_instansi = '$id_instansi' and ski.tahun = '$tahun' and ski.status = '1' group by ski.kode_program order by ski.kode_program asc");
		}else{
			$where 		=['id_instansi'=>$id_instansi, 'tahun'=>$tahun, 'kode_tahap'=>$tahap];
			// $program 	= $this->db->get_where('v_program_apbd_awal' , $where);
			$program 	= $this->db->query("SELECT ski.kode_program as kode_rekening_program, ski.kode_bidang_urusan,  mp.nama_program from sub_kegiatan_instansi ski left join master_program mp on ski.kode_program=mp.kode_program where ski.id_instansi = '$id_instansi' and ski.tahun = '$tahun' and ski.kode_tahap = '2' group by ski.kode_program order by ski.kode_program asc");
		}
		return $program;
	}


	public function get_program_berdasarkan_sumber_dana($id_instansi, $tahap, $tahun, $jenis_sumber_dana)
	{

		

		$jenis_sumber_dana_terkolom = ['pad','dau','dak','dbh'];
		if (in_array($jenis_sumber_dana, $jenis_sumber_dana_terkolom)) {
			$where_sumber_dana = "sd.$jenis_sumber_dana > 0";	
		}else{
			if ($jenis_sumber_dana=='lainnya') {
				$where_sumber_dana = "sd.lainnya > 0 and sd.id_jenis_sumber_dana='Lainnya'";	
			}else{
				$where_sumber_dana = "sd.lainnya > 0 and sd.id_jenis_sumber_dana='$jenis_sumber_dana'";	
			}
		}
		if ($tahap == 4 ) {
			$q = $this->db->query("
				SELECT mp.nama_program, sd.kode_rekening_program from sumber_dana sd 
				left join sub_kegiatan_instansi ski on sd.kode_rekening_program = ski.kode_program  and sd.tahun=ski.tahun and sd.kode_tahap = ski.kode_tahap
				left join master_program mp on sd.kode_rekening_program	= mp.kode_program
				where $where_sumber_dana and ski.status=1 and sd.id_instansi='$id_instansi' and sd.tahun ='$tahun'
				group by sd.kode_rekening_program
				");
			
		}else{
			$q = $this->db->query("
				SELECT mp.nama_program, sd.kode_rekening_program from sumber_dana sd 
				left join sub_kegiatan_instansi ski on sd.kode_rekening_program = ski.kode_program  and sd.tahun=ski.tahun and sd.kode_tahap = ski.kode_tahap 
				left join master_program mp on sd.kode_rekening_program	= mp.kode_program and mp.status=1
				where $where_sumber_dana and ski.kode_tahap=2 and sd.id_instansi='$id_instansi' and sd.tahun ='$tahun'
				group by sd.kode_rekening_program
				");
		}
		return $q;
	}







	public function get_program_berdasarkan_struktur_instansi($id_instansi, $tahap, $tahun, $id_user_kpa, $id_user_pptk)
	{


		if ($tahap==4) {
			$where_pptk = "usk.kode_rekening_sub_kegiatan in (SELECT kode_sub_kegiatan from sub_kegiatan_instansi where tahun='$tahun' and status='1' and id_instansi='$id_instansi')";
		}else{
			$where_pptk = "usk.kode_rekening_sub_kegiatan in (SELECT kode_sub_kegiatan from sub_kegiatan_instansi where tahun='$tahun' and kode_tahap='$tahap' and id_instansi='$id_instansi')";
		}


		if ($id_user_pptk=='semua_pptk') {
			$q_user_kpa = $this->db->query("SELECT id_sub_instansi from master_users where id_user='$id_user_kpa'")->row_array();
            	$id_sub_instansi = $q_user_kpa['id_sub_instansi'];

	            $q_usk_pptk = $this->db->query("SELECT usk.kode_rekening_program, mp.nama_program from users_sub_kegiatan usk
	            	left join master_program mp on usk.kode_rekening_program = mp.kode_program and mp.status = 1 
	            	where usk.id_user in (SELECT mu.id_user from master_users mu join sub_instansi si on mu.id_sub_instansi=si.id_sub_instansi where si.id_kpa='$id_sub_instansi') and usk.tahun_anggaran='$tahun' and $where_pptk and usk.status='1' group by usk.kode_rekening_program")->result();
		}else{
			$q_usk_pptk = $this->db->query("SELECT  usk.kode_rekening_program, mp.nama_program from users_sub_kegiatan usk
	            	left join master_program mp on usk.kode_rekening_program = mp.kode_program and mp.status = 1 where usk.id_user='$id_user_pptk' and usk.tahun_anggaran='$tahun' and $where_pptk and usk.status='1' group by usk.kode_rekening_program")->result();
		}

		
		return $q_usk_pptk;
	}



	public function get_kegiatan_berdasarkan_struktur_instansi($id_instansi, $kode_program,  $tahun, $tahap, $id_user_kpa, $id_user_pptk)
	{


		if ($tahap==4) {
			$where_pptk = "kode_rekening_sub_kegiatan in (SELECT kode_sub_kegiatan from sub_kegiatan_instansi where tahun='$tahun' and status='1' and id_instansi='$id_instansi')";
		}else{
			$where_pptk = "kode_rekening_sub_kegiatan in (SELECT kode_sub_kegiatan from sub_kegiatan_instansi where tahun='$tahun' and kode_tahap='$tahap' and id_instansi='$id_instansi')";
		}

		
			if ($id_user_pptk=='semua_pptk') {
			$q_user_kpa = $this->db->query("SELECT id_sub_instansi from master_users where id_user='$id_user_kpa'")->row_array();
            	$id_sub_instansi = $q_user_kpa['id_sub_instansi'];

	            $q_usk_pptk = $this->db->query("SELECT usk.kode_rekening_kegiatan, mk.nama_kegiatan from users_sub_kegiatan usk
	            	left join master_kegiatan mk on usk.kode_rekening_kegiatan = mk.kode_kegiatan and mk.status = 1 
	            	where usk.id_user in (SELECT mu.id_user from master_users mu join sub_instansi si on mu.id_sub_instansi=si.id_sub_instansi where si.id_kpa='$id_sub_instansi') and usk.tahun_anggaran='$tahun' and $where_pptk and usk.status='1' and usk.kode_rekening_program='$kode_program' group by usk.kode_rekening_kegiatan");
		}else{
			$q_usk_pptk = $this->db->query("SELECT  usk.kode_rekening_kegiatan, mk.nama_kegiatan from users_sub_kegiatan usk
	            	left join master_kegiatan mk on usk.kode_rekening_kegiatan = mk.kode_kegiatan and mk.status = 1 where usk.id_user='$id_user_pptk' and usk.tahun_anggaran='$tahun' and $where_pptk and usk.status='1' and usk.kode_rekening_program='$kode_program' group by usk.kode_rekening_kegiatan");
		}

		
		return $q_usk_pptk;
	}
	public function get_sub_kegiatan_berdasarkan_struktur_instansi($id_instansi, $kode_kegiatan,  $tahun, $tahap, $id_user_kpa, $id_user_pptk)
	{


		if ($tahap==4) {
			$where_pptk = "kode_rekening_sub_kegiatan in (SELECT kode_sub_kegiatan from sub_kegiatan_instansi where tahun='$tahun' and status='1' and id_instansi='$id_instansi')";
		}else{
			$where_pptk = "kode_rekening_sub_kegiatan in (SELECT kode_sub_kegiatan from sub_kegiatan_instansi where tahun='$tahun' and kode_tahap='$tahap' and id_instansi='$id_instansi')";
		}

		
			if ($id_user_pptk=='semua_pptk') {
			$q_user_kpa = $this->db->query("SELECT id_sub_instansi from master_users where id_user='$id_user_kpa'")->row_array();
            	$id_sub_instansi = $q_user_kpa['id_sub_instansi'];

	            $q_usk_pptk = $this->db->query("SELECT  usk.kode_rekening_sub_kegiatan, usk.kode_tahap, usk.tahun_anggaran as tahun, msk.nama_sub_kegiatan,
	            total_anggaran_sub_kegiatan(usk.kode_rekening_sub_kegiatan,usk.kode_tahap,usk.id_instansi,usk.kode_rekening_kegiatan,usk.kode_rekening_program,usk.tahun_anggaran) AS pagu
	             from users_sub_kegiatan usk
	            	left join master_sub_kegiatan msk on 
				trim(substr(usk.kode_rekening_sub_kegiatan,1,15)) = trim(msk.kode_sub_kegiatan)
				 and msk.status=1
	            	where usk.id_user in (SELECT mu.id_user from master_users mu join sub_instansi si on mu.id_sub_instansi=si.id_sub_instansi where si.id_kpa='$id_sub_instansi') and usk.tahun_anggaran='$tahun' and $where_pptk and usk.status='1' and usk.kode_rekening_kegiatan='$kode_kegiatan' group by usk.kode_rekening_sub_kegiatan");
		}else{
			$q_usk_pptk = $this->db->query("SELECT  usk.kode_rekening_sub_kegiatan, usk.kode_tahap, usk.tahun_anggaran as tahun, msk.nama_sub_kegiatan,

	            total_anggaran_sub_kegiatan(usk.kode_rekening_sub_kegiatan,usk.kode_tahap,usk.id_instansi,usk.kode_rekening_kegiatan,usk.kode_rekening_program,usk.tahun_anggaran) AS pagu
	             from users_sub_kegiatan usk
	            	left join master_sub_kegiatan msk on 
				trim(substr(usk.kode_rekening_sub_kegiatan,1,15)) = trim(msk.kode_sub_kegiatan)
				 and msk.status=1
	            	where usk.id_user='$id_user_pptk' and usk.tahun_anggaran='$tahun' and $where_pptk and usk.status='1' and usk.kode_rekening_kegiatan='$kode_kegiatan' group by usk.kode_rekening_sub_kegiatan");
		}

		
		return $q_usk_pptk;
	}


	public function get_skpd_berdasarkan_sumber_dana($tahap, $tahun, $jenis_sumber_dana)
	{

		$jenis_sumber_dana_terkolom = ['pad','dau','dak','dbh','lainnya'];
		if (in_array($jenis_sumber_dana, $jenis_sumber_dana_terkolom)) {
			$where_sumber_dana = "sd.$jenis_sumber_dana > 0";	
		}else{
			$where_sumber_dana = "sd.lainnya > 0 and sd.id_jenis_sumber_dana='$jenis_sumber_dana'";	

		}
		if ($tahap == 4 ) {
			$q = $this->db->query("
				SELECT mi.nama_instansi, mi.id_instansi, g.pagu_total from sumber_dana sd 
				left join sub_kegiatan_instansi ski on sd.kode_rekening_program = ski.kode_program  and sd.tahun=ski.tahun and sd.kode_tahap = ski.kode_tahap
				left join master_instansi mi on sd.id_instansi	= mi.id_instansi
				left join grafik g on sd.id_instansi=g.id_instansi and sd.tahun = g.tahun and sd.kode_tahap = g.kode_tahap
				where $where_sumber_dana and ski.status=1 and sd.tahun ='$tahun'
				group by sd.id_instansi
				");
			
		}else{
			$q = $this->db->query("
				SELECT mi.nama_instansi, mi.id_instansi, g.pagu_total from sumber_dana sd 
				left join sub_kegiatan_instansi ski on sd.kode_rekening_program = ski.kode_program  and sd.tahun=ski.tahun and sd.kode_tahap = ski.kode_tahap 
				left join master_instansi mi on sd.id_instansi	= mi.id_instansi 
				left join grafik g on sd.id_instansi=g.id_instansi and sd.tahun = g.tahun and sd.kode_tahap = g.kode_tahap
				where $where_sumber_dana and ski.kode_tahap=2 and sd.tahun ='$tahun'
				group by sd.id_instansi
				");
		}
		return $q;
	}

	public function get_kegiatan($id_instansi, $kode_rekening_program, $kode_bidang_urusan)
	{	
		$tahun 				= $this->input->get('tahun');
		$tahap 				= $this->input->get('tahap');
		// return $this->db->query("SELECT * from v_kegiatan_apbd where  id_instansi ='$id_instansi'
		// 	and kode_tahap = '$tahap' 
		// 	and kode_rekening_program = '$kode_rekening_program'
		// 	and kode_urusan = '$kode_urusan'
		// 	and pagu >0");



		if ($tahap == 4 ) {
			
			$where 		=['id_instansi'=>$id_instansi, 'tahun'=>$tahun,'kode_rekening_program' => $kode_rekening_program,];
			$kegiatan 	=$this->db->get_where('v_kegiatan_apbd_perubahan' , $where);
		}else{
			$where 		=['id_instansi'=>$id_instansi, 'tahun'=>$tahun, 'kode_tahap'=>$tahap, 'kode_rekening_program' => $kode_rekening_program,];
			$kegiatan 	=$this->db->get_where('v_kegiatan_apbd_awal' , $where);
		}




		return $kegiatan;
	}
	public function get_kegiatan_berdasarkan_sumber_dana($id_instansi, $kode_rekening_program, $kode_bidang_urusan, $jenis_sumber_dana)
	{	
		$tahun 				= $this->input->get('tahun');
		$tahap 				= $this->input->get('tahap');
		// return $this->db->query("SELECT * from v_kegiatan_apbd where  id_instansi ='$id_instansi'
		// 	and kode_tahap = '$tahap' 
		// 	and kode_rekening_program = '$kode_rekening_program'
		// 	and kode_urusan = '$kode_urusan'
		// 	and pagu >0");



		$jenis_sumber_dana_terkolom = ['pad','dau','dak','dbh'];
		if (in_array($jenis_sumber_dana, $jenis_sumber_dana_terkolom)) {
			$where_sumber_dana = "sd.$jenis_sumber_dana > 0";	
		}else{
			if ($jenis_sumber_dana=='lainnya') {
				$where_sumber_dana = "sd.lainnya > 0 and sd.id_jenis_sumber_dana='Lainnya'";	
			}else{
				$where_sumber_dana = "sd.lainnya > 0 and sd.id_jenis_sumber_dana='$jenis_sumber_dana'";	
			}
		}


		if ($tahap == 4 ) {

			$q = $this->db->query("
				SELECT mk.nama_kegiatan, sd.kode_rekening_kegiatan from sumber_dana sd 
				left join sub_kegiatan_instansi ski on sd.kode_rekening_kegiatan = ski.kode_kegiatan  and sd.tahun=ski.tahun and sd.kode_tahap = ski.kode_tahap
				left join master_kegiatan mk on sd.kode_rekening_kegiatan	= mk.kode_kegiatan
				where $where_sumber_dana and ski.status=1 and sd.id_instansi='$id_instansi' and sd.tahun ='$tahun' and sd.kode_rekening_program='$kode_rekening_program'
				group by sd.kode_rekening_kegiatan
				");

		}else{

			$q = $this->db->query("
				SELECT mk.nama_kegiatan, sd.kode_rekening_kegiatan from sumber_dana sd 
				left join sub_kegiatan_instansi ski on sd.kode_rekening_kegiatan = ski.kode_kegiatan 
				left join master_kegiatan mk on sd.kode_rekening_kegiatan	= mk.kode_kegiatan
				where $where_sumber_dana and ski.kode_tahap=2 and sd.id_instansi='$id_instansi' and sd.tahun ='$tahun' and sd.kode_rekening_program='$kode_rekening_program'
				group by sd.kode_rekening_kegiatan
				");
		}




		return $q;
	}
	public function get_kegiatan_berdasarkan_sumber_dana_gabungan($id_instansi, $jenis_sumber_dana)
	{	
		$tahun 				= $this->input->get('tahun');
		$tahap 				= $this->input->get('tahap');
		// return $this->db->query("SELECT * from v_kegiatan_apbd where  id_instansi ='$id_instansi'
		// 	and kode_tahap = '$tahap' 
		// 	and kode_rekening_program = '$kode_rekening_program'
		// 	and kode_urusan = '$kode_urusan'
		// 	and pagu >0");


		$jenis_sumber_dana_terkolom = ['pad','dau','dak','dbh','lainnya'];
		if (in_array($jenis_sumber_dana, $jenis_sumber_dana_terkolom)) {
			$where_sumber_dana = "sd.$jenis_sumber_dana > 0";	
		}else{
			$where_sumber_dana = "sd.lainnya > 0 and sd.id_jenis_sumber_dana='$jenis_sumber_dana'";	

		}


		if ($tahap == 4 ) {

			$q = $this->db->query("
				SELECT mk.nama_kegiatan, sd.kode_rekening_kegiatan from sumber_dana sd 
				left join sub_kegiatan_instansi ski on sd.kode_rekening_kegiatan = ski.kode_kegiatan  and sd.tahun=ski.tahun and sd.kode_tahap = ski.kode_tahap
				left join master_kegiatan mk on sd.kode_rekening_kegiatan	= mk.kode_kegiatan
				where $where_sumber_dana and ski.status=1 and sd.id_instansi='$id_instansi' and sd.tahun ='$tahun'
				");

		}else{

			$q = $this->db->query("
				SELECT mk.nama_kegiatan, sd.kode_rekening_kegiatan from sumber_dana sd 
				left join sub_kegiatan_instansi ski on sd.kode_rekening_kegiatan = ski.kode_kegiatan 
				left join master_kegiatan mk on sd.kode_rekening_kegiatan	= mk.kode_kegiatan
				where $where_sumber_dana and ski.status=1 and sd.id_instansi='$id_instansi' and sd.tahun ='$tahun'
				");
		}




		return $q;
	}
	public function get_sub_kegiatan($id_instansi, $kode_rekening_kegiatan, $kode_rekening_program, $kode_bidang_urusan)
	{	
		$tahun 				= $this->input->get('tahun');
		$tahap 				= $this->input->get('tahap');
		// return $this->db->query("SELECT * from v_kegiatan_apbd where  id_instansi ='$id_instansi'
		// 	and kode_tahap = '$tahap' 
		// 	and kode_rekening_program = '$kode_rekening_program'
		// 	and kode_urusan = '$kode_urusan'
		// 	and pagu >0");

		if ($tahap == 4 ) {
			
			$where 		=['id_instansi'=>$id_instansi, 'tahun'=>$tahun,'status'=>1,'kode_rekening_program' => $kode_rekening_program,'kode_rekening_kegiatan' => $kode_rekening_kegiatan];
			$sub_kegiatan 	=$this->db->get_where('v_sub_kegiatan_apbd' , $where);
		}else{
			$where 		=['id_instansi'=>$id_instansi, 'tahun'=>$tahun, 'kode_tahap'=>$tahap, 'kode_rekening_program' => $kode_rekening_program,'kode_rekening_kegiatan' => $kode_rekening_kegiatan];
			$sub_kegiatan 	=$this->db->get_where('v_sub_kegiatan_apbd' , $where);
		}


		return $sub_kegiatan;
	}
	public function get_sub_kegiatan_berdasarkan_sumber_dana_gabungan($id_instansi, $tahap, $tahun, $jenis_sumber_dana)
	{	
		// $tahun 				= $this->input->get('tahun');
		// $tahap 				= $this->input->get('tahap');
		// return $this->db->query("SELECT * from v_kegiatan_apbd where  id_instansi ='$id_instansi'
		// 	and kode_tahap = '$tahap' 
		// 	and kode_rekening_program = '$kode_rekening_program'
		// 	and kode_urusan = '$kode_urusan'
		// 	and pagu >0");



		$jenis_sumber_dana_terkolom = ['pad','dau','dak','dbh'];
		if (in_array($jenis_sumber_dana, $jenis_sumber_dana_terkolom)) {
			$where_sumber_dana = "sd.$jenis_sumber_dana > 0";	
		}else{
			if ($jenis_sumber_dana=='lainnya') {
				$where_sumber_dana = "sd.lainnya > 0 and sd.id_jenis_sumber_dana='Lainnya'";	
			}else{
				$where_sumber_dana = "sd.lainnya > 0 and sd.id_jenis_sumber_dana='$jenis_sumber_dana'";	
			}
		}


		if ($tahap == 4 ) {

			$q = $this->db->query("
				SELECT msk.nama_sub_kegiatan, ski.kategori, ski.jenis_sub_kegiatan, ski.keterangan, total_anggaran_sub_kegiatan(ski.kode_sub_kegiatan,ski.kode_tahap,ski.id_instansi,ski.kode_kegiatan,ski.kode_program,ski.tahun) as pagu, $jenis_sumber_dana, ski.kode_sub_kegiatan as kode_rekening_sub_kegiatan , ski.kode_tahap, ski.tahun from sumber_dana sd 
				left join sub_kegiatan_instansi ski on sd.kode_rekening_sub_kegiatan = ski.kode_sub_kegiatan and sd.tahun=ski.tahun and sd.kode_tahap = ski.kode_tahap 
				left join master_sub_kegiatan msk on sd.kode_rekening_sub_kegiatan	= msk.kode_sub_kegiatan and msk.status=1
				where $where_sumber_dana and ski.status=1 and sd.id_instansi='$id_instansi' and sd.tahun ='$tahun'  and sd.kode_rekening_kegiatan = '$kode_rekening_kegiatan'

				");
		}else{

			$q = $this->db->query("
				SELECT msk.nama_sub_kegiatan from sumber_dana sd 
				left join sub_kegiatan_instansi ski on sd.kode_rekening_sub_kegiatan = ski.kode_sub_kegiatan and sd.tahun=ski.tahun and sd.kode_tahap = ski.kode_tahap 
				left join master_sub_kegiatan msk on sd.kode_rekening_sub_kegiatan	= msk.kode_sub_kegiatan and msk.status=1
				where $where_sumber_dana and ski.kode_tahap = 2 and sd.id_instansi='$id_instansi' and sd.tahun ='$tahun' and sd.kode_rekening_kegiatan = '$kode_rekening_kegiatan'
				group by sd.kode_rekening_sub_kegiatan	
				
				");
		}


		return $q;
	}
	public function get_sub_kegiatan_berdasarkan_sumber_dana($id_instansi, $kode_rekening_kegiatan, $kode_rekening_program, $kode_bidang_urusan, $jenis_sumber_dana)
	{	
		$tahun 				= $this->input->get('tahun');
		$tahap 				= $this->input->get('tahap');
	

		$jenis_sumber_dana_terkolom = ['pad','dau','dak','dbh'];
		if (in_array($jenis_sumber_dana, $jenis_sumber_dana_terkolom)) {
			$where_sumber_dana = "sd.$jenis_sumber_dana > 0";	
		}else{
			if ($jenis_sumber_dana=='lainnya') {
				$where_sumber_dana = "sd.lainnya > 0 and sd.id_jenis_sumber_dana='Lainnya'";	
			}else{
				$where_sumber_dana = "sd.lainnya > 0 and sd.id_jenis_sumber_dana='$jenis_sumber_dana'";	
			}

		}


		if ($tahap == 4 ) {

			$q = $this->db->query("
				SELECT msk.nama_sub_kegiatan, ski.kategori, ski.jenis_sub_kegiatan, ski.keterangan, jsd.jenis_sumber_dana, sd.nama_sumber_dana_lainnya, sd.id_jenis_sumber_dana, total_anggaran_sub_kegiatan(sd.kode_rekening_sub_kegiatan,sd.kode_tahap,sd.id_instansi,sd.kode_rekening_kegiatan,sd.kode_rekening_program,sd.tahun) as pagu, $jenis_sumber_dana, ski.kode_sub_kegiatan as kode_rekening_sub_kegiatan , sd.kode_tahap, sd.tahun from sumber_dana sd 
				left join sub_kegiatan_instansi ski on sd.kode_rekening_sub_kegiatan = ski.kode_sub_kegiatan and sd.tahun=ski.tahun and sd.kode_tahap = ski.kode_tahap and sd.id_instansi = ski.id_instansi
				left join master_sub_kegiatan msk on sd.kode_rekening_sub_kegiatan	= msk.kode_sub_kegiatan and msk.status=1
				left join jenis_sumber_dana jsd on sd.id_jenis_sumber_dana = jsd.id_jenis_sumber_dana
				where $where_sumber_dana and ski.status=1 and sd.id_instansi='$id_instansi' and sd.tahun ='$tahun'  and sd.kode_rekening_kegiatan = '$kode_rekening_kegiatan'
				group by sd.kode_rekening_sub_kegiatan

				");
		}else{

			$q = $this->db->query("
				SELECT msk.nama_sub_kegiatan,ski.kategori, ski.jenis_sub_kegiatan, ski.keterangan, jsd.jenis_sumber_dana, sd.nama_sumber_dana_lainnya, sd.id_jenis_sumber_dana, total_anggaran_sub_kegiatan(sd.kode_rekening_sub_kegiatan,sd.kode_tahap,sd.id_instansi,sd.kode_rekening_kegiatan,sd.kode_rekening_program,sd.tahun) as pagu, $jenis_sumber_dana, ski.kode_sub_kegiatan as kode_rekening_sub_kegiatan , sd.kode_tahap, sd.tahun   from sumber_dana sd 
				left join sub_kegiatan_instansi ski on sd.kode_rekening_sub_kegiatan = ski.kode_sub_kegiatan and sd.tahun=ski.tahun and sd.kode_tahap = ski.kode_tahap and sd.id_instansi = ski.id_instansi
				left join master_sub_kegiatan msk on 
				trim(substr(sd.kode_rekening_sub_kegiatan,1,15)) = trim(msk.kode_sub_kegiatan)
				 and msk.status=1
				 left join jenis_sumber_dana jsd on sd.id_jenis_sumber_dana = jsd.id_jenis_sumber_dana
				where $where_sumber_dana and ski.kode_tahap = 2 and sd.id_instansi='$id_instansi' and sd.tahun ='$tahun' and sd.kode_rekening_kegiatan = '$kode_rekening_kegiatan' and sd.kode_tahap = 2
				group by sd.kode_rekening_sub_kegiatan
				");
		}


		return $q;
	}

	public function get_sub_kegiatan_perbandingan_tahapan($id_instansi, $kode_rekening_kegiatan, $kode_rekening_program, $kode_bidang_urusan)
	{	
		$tahun 				= $this->input->get('tahun');
		
			$where 		=['id_instansi'=>$id_instansi, 'tahun'=>$tahun,'kode_rekening_program' => $kode_rekening_program,'kode_rekening_kegiatan' => $kode_rekening_kegiatan];
			$sub_kegiatan 	=$this->db->group_by("kode_rekening_sub_kegiatan")->get_where('v_sub_kegiatan_apbd' , $where);
		


		return $sub_kegiatan;
	}
	public function get_paket_per_sub_kegiatan($id_instansi, $kode_rekening_sub_kegiatan, $kode_rekening_program, $kode_bidang_urusan)
	{	
		$tahun 				= $this->input->get('tahun');
		$tahap 				= $this->input->get('tahap');
		$jenis_paket 				= $this->input->get('jenis_paket');
		$kategori 				= $this->input->get('kategori');
		$metode 				= $this->input->get('metode');
		// return $this->db->query("SELECT * from v_kegiatan_apbd where  id_instansi ='$id_instansi'
		// 	and kode_tahap = '$tahap' 
		// 	and kode_rekening_program = '$kode_rekening_program'
		// 	and kode_urusan = '$kode_urusan'
		// 	and pagu >0");
		if ($jenis_paket=='Semua Paket') {
			$where = [
				'id_instansi' => $id_instansi,
				'tahun' => $tahun,
				'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
			];
		}
		else if ($jenis_paket=='RUTIN') {
			$where = [
				'id_instansi' => $id_instansi,
				'tahun' => $tahun,
				'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
				'jenis_paket' => $jenis_paket,
			];
		}
		else if ($jenis_paket=='SWAKELOLA') {
			if ($metode=='semua') {
				$where = [
					'id_instansi' => $id_instansi,
					'tahun' => $tahun,
					'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
					'jenis_paket' => $jenis_paket,
				];		# code...
			}else{
				$where = [
					'id_instansi' => $id_instansi,
					'tahun' => $tahun,
					'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
					'jenis_paket' => $jenis_paket,
					'id_metode' => $metode,
				];
			}	
			
		}else{


			if ($metode=='semua') {
				$where = [
					'id_instansi' => $id_instansi,
					'tahun' => $tahun,
					'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
					'jenis_paket' => $jenis_paket,
				];		# code...
			}else{

				if ($kategori=='semua') {
				 	$where = [
						'id_instansi' => $id_instansi,
						'tahun' => $tahun,
						'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
						'jenis_paket'=>$jenis_paket,
						'id_metode' => $metode,

					];
				}else{
					$where = [
						'id_instansi' => $id_instansi,
						'tahun' => $tahun,
						'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
						'jenis_paket'=>$jenis_paket,
						'id_metode' => $metode,
						'kategori'=>$kategori
					];
				}

				
			}	



			
		}

		return $this->db->get_where('v_paket', $where);
	}


	public function get_paket_per_opd($id_instansi)
	{	
		$tahun 				= $this->input->get('tahun');
		$tahap 				= $this->input->get('tahap');
		$jenis_paket 				= $this->input->get('jenis_paket');
		$kategori 				= $this->input->get('kategori');
		$metode 				= $this->input->get('metode');
		// return $this->db->query("SELECT * from v_kegiatan_apbd where  id_instansi ='$id_instansi'
		// 	and kode_tahap = '$tahap' 
		// 	and kode_rekening_program = '$kode_rekening_program'
		// 	and kode_urusan = '$kode_urusan'
		// 	and pagu >0");
		if ($jenis_paket=='Semua Paket') {
			$where = [
				'id_instansi' => $id_instansi,
				'tahun' => $tahun,
				//'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
			];
		}
		else if ($jenis_paket=='RUTIN') {
			$where = [
				'id_instansi' => $id_instansi,
				'tahun' => $tahun,
				//'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
				'jenis_paket' => $jenis_paket,
			];
		}
		else if ($jenis_paket=='SWAKELOLA') {
			if ($metode=='semua') {
				$where = [
					'id_instansi' => $id_instansi,
					'tahun' => $tahun,
					//'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
					'jenis_paket' => $jenis_paket,
				];		# code...
			}else{
				$where = [
					'id_instansi' => $id_instansi,
					'tahun' => $tahun,
					//'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
					'jenis_paket' => $jenis_paket,
					'id_metode' => $metode,
				];
			}	
			
		}else{

			if ($kategori=='semua') {
				if ($metode=='semua') {
					$where = [
						'id_instansi' => $id_instansi,
						'tahun' => $tahun,
						//'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
						'jenis_paket' => $jenis_paket,
					];		# code...
				}else{
				 	$where = [
						'id_instansi' => $id_instansi,
						'tahun' => $tahun,
						//'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
						'jenis_paket'=>$jenis_paket,
						'id_metode' => $metode,
					];
				}	


			}else{
				if ($metode=='semua') {
					$where = [
						'id_instansi' => $id_instansi,
						'tahun' => $tahun,
						//'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
						'jenis_paket'=>$jenis_paket,
						'kategori'=>$kategori
					];	
				}else{
				 	$where = [
						'id_instansi' => $id_instansi,
						'tahun' => $tahun,
						//'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
						'jenis_paket'=>$jenis_paket,
						'id_metode' => $metode,
						'kategori'=>$kategori
					];
				}	

				
			}



			


			
		}

		return $this->db->order_by('kode_rekening_sub_kegiatan', 'ACS')->get_where('v_paket', $where);
		// return $this->db->order_by('kode_rekening_sub_kegiatan', 'ACS')->get_where('v_paket_terkontrak', $where);
	}

	public function get_paket_per_opd_group_sub_kegiatan($id_instansi)
	{	
		$tahun 				= $this->input->get('tahun');
		$tahap 				= $this->input->get('tahap');
		$jenis_paket 				= $this->input->get('jenis_paket');
		$kategori 				= $this->input->get('kategori');
		$metode 				= $this->input->get('metode');
		// return $this->db->query("SELECT * from v_kegiatan_apbd where  id_instansi ='$id_instansi'
		// 	and kode_tahap = '$tahap' 
		// 	and kode_rekening_program = '$kode_rekening_program'
		// 	and kode_urusan = '$kode_urusan'
		// 	and pagu >0");
		if ($jenis_paket=='Semua Paket') {
			$where = [
				'id_instansi' => $id_instansi,
				'tahun' => $tahun,
				//'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
			];
		}
		else if ($jenis_paket=='RUTIN') {
			$where = [
				'id_instansi' => $id_instansi,
				'tahun' => $tahun,
				//'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
				'jenis_paket' => $jenis_paket,
			];
		}
		else if ($jenis_paket=='SWAKELOLA') {
			if ($metode=='semua') {
				$where = [
					'id_instansi' => $id_instansi,
					'tahun' => $tahun,
					//'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
					'jenis_paket' => $jenis_paket,
				];		# code...
			}else{
				$where = [
					'id_instansi' => $id_instansi,
					'tahun' => $tahun,
					//'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
					'jenis_paket' => $jenis_paket,
					'id_metode' => $metode,
				];
			}	
			
		}else{

			if ($kategori=='semua') {
				if ($metode=='semua') {
					$where = [
						'id_instansi' => $id_instansi,
						'tahun' => $tahun,
						//'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
						'jenis_paket' => $jenis_paket,
					];		# code...
				}else{
				 	$where = [
						'id_instansi' => $id_instansi,
						'tahun' => $tahun,
						//'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
						'jenis_paket'=>$jenis_paket,
						'id_metode' => $metode,
					];
				}	


			}else{
				if ($metode=='semua') {
					$where = [
						'id_instansi' => $id_instansi,
						'tahun' => $tahun,
						//'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
						'jenis_paket'=>$jenis_paket,
						'kategori'=>$kategori
					];	
				}else{
				 	$where = [
						'id_instansi' => $id_instansi,
						'tahun' => $tahun,
						//'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
						'jenis_paket'=>$jenis_paket,
						'id_metode' => $metode,
						'kategori'=>$kategori
					];
				}	

				
			}



			


			
		}

		// return $this->db->order_by('kode_rekening_sub_kegiatan', 'ACS')->get_where('v_paket', $where);
		return $this->db->select("kode_rekening_sub_kegiatan")->order_by('kode_rekening_sub_kegiatan', 'ACS')->group_by('kode_rekening_sub_kegiatan')->get_where('paket_pekerjaan', $where);
	}



	public function get_paket_opd_per_sub_kegiatan($id_instansi, $kode_rekening_sub_kegiatan)
	{	
		$tahun 				= $this->input->get('tahun');
		$tahap 				= $this->input->get('tahap');
		$jenis_paket 				= $this->input->get('jenis_paket');
		$kategori 				= $this->input->get('kategori');
		$metode 				= $this->input->get('metode');
		// return $this->db->query("SELECT * from v_kegiatan_apbd where  id_instansi ='$id_instansi'
		// 	and kode_tahap = '$tahap' 
		// 	and kode_rekening_program = '$kode_rekening_program'
		// 	and kode_urusan = '$kode_urusan'
		// 	and pagu >0");
		if ($jenis_paket=='Semua Paket') {
			$where = [
				'id_instansi' => $id_instansi,
				'tahun' => $tahun,
				'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
			];
		}
		else if ($jenis_paket=='RUTIN') {
			$where = [
				'id_instansi' => $id_instansi,
				'tahun' => $tahun,
				'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
				'jenis_paket' => $jenis_paket,
			];
		}
		else if ($jenis_paket=='SWAKELOLA') {
			if ($metode=='semua') {
				$where = [
					'id_instansi' => $id_instansi,
					'tahun' => $tahun,
					'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
					'jenis_paket' => $jenis_paket,
				];		# code...
			}else{
				$where = [
					'id_instansi' => $id_instansi,
					'tahun' => $tahun,
					'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
					'jenis_paket' => $jenis_paket,
					'id_metode' => $metode,
				];
			}	
			
		}else{

			if ($kategori=='semua') {
				if ($metode=='semua') {
					$where = [
						'id_instansi' => $id_instansi,
						'tahun' => $tahun,
						'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
						'jenis_paket' => $jenis_paket,
					];		# code...
				}else{
				 	$where = [
						'id_instansi' => $id_instansi,
						'tahun' => $tahun,
						'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
						'jenis_paket'=>$jenis_paket,
						'id_metode' => $metode,
					];
				}	


			}else{
				if ($metode=='semua') {
					$where = [
						'id_instansi' => $id_instansi,
						'tahun' => $tahun,
						'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
						'jenis_paket'=>$jenis_paket,
						'kategori'=>$kategori
					];	
				}else{
				 	$where = [
						'id_instansi' => $id_instansi,
						'tahun' => $tahun,
						'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
						'jenis_paket'=>$jenis_paket,
						'id_metode' => $metode,
						'kategori'=>$kategori
					];
				}	

				
			}



			


			
		}

		// return $this->db->order_by('kode_rekening_sub_kegiatan', 'ACS')->get_where('v_paket', $where);
		return $this->db->order_by('kode_rekening_sub_kegiatan', 'ACS')->get_where('v_paket_terkontrak', $where);
	}

	public function get_sumber_dana($id_instansi, $kode_rekening_sub_kegiatan, $kode_rekening_kegiatan, $kode_rekening_program, $kode_bidang_urusan, $tahap)
	{
		$tahun 				= $this->input->get('tahun');
		// $tahap 				= $this->input->get('tahap');
		return $this->db->get_where('sumber_dana', [
			'id_instansi' => $id_instansi,
			'kode_tahap' => $tahap,
			'tahun' => $tahun,
			'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
			'kode_rekening_kegiatan' => $kode_rekening_kegiatan,
			'kode_rekening_program' => $kode_rekening_program,
			'kode_bidang_urusan' => $kode_bidang_urusan
		]);
	}

	public function get_target($id_instansi, $kode_rekening_sub_kegiatan, $bulan, $tahap, $tahun)
	{
		// $tahun 				= $this->input->get('tahun');
		// $tahap 				= $this->input->get('tahap');

		$where =  [
			'id_instansi' => $id_instansi,
			'kode_tahap' => $tahap,
			'tahun' => $tahun,
			'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
			'bulan' => $bulan
		];


			$this->db->select('kode_rekening_sub_kegiatan,				 target_fisik,target_keuangan,target_fisik_bulanan,target_keuangan_bulanan ');
		return $this->db->get_where('target_apbd', $where);
	}
	public function get_target_pergeseran($id_instansi, $kode_rekening_sub_kegiatan, $pergeseran_ke, $bulan, $tahap, $tahun)
	{
		// $tahun 				= $this->input->get('tahun');
		// $tahap 				= $this->input->get('tahap');

		$where =  [
			'id_instansi' => $id_instansi,
			'kode_tahap' => $tahap,
			'tahun' => $tahun,
			'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
			'bulan' => $bulan,
			'pergeseran_ke' => $pergeseran_ke
		];


			$this->db->select('kode_rekening_sub_kegiatan,				 target_fisik,target_keuangan,target_fisik_bulanan,target_keuangan_bulanan ');
		return $this->db->get_where('target_apbd', $where);
	}

	public function get_realisasi_keuangan($id_instansi, $kode_rekening_sub_kegiatan, $bulan, $ope, $tahun, $tahap)
	{
		// $tahun 				= $this->input->get('tahun');
		// $tahap 				= $this->input->get('tahap');
		$query  = $this->db->query("SELECT
										sum(bo_bp + bo_bbj+ bo_bs+bo_bh + bm_bmt + bm_bmpm + bm_bmgb + bm_bmjji + bm_bmatl +btt +  bt_bbh+bt_bbk ) as total_realisasi,
										sum(bo_bp) as realisasi_bo_bp,
										sum(bo_bbj) as realisasi_bo_bbj,
										sum(bo_bs) as realisasi_bo_bs,
										sum(bo_bh) as realisasi_bo_bh,
										sum(bm_bmt) as realisasi_bm_bmt,
										sum(bm_bmpm) as realisasi_bm_bmpm,
										sum(bm_bmgb) as realisasi_bm_bmgb,
										sum(bm_bmjji) as realisasi_bm_bmjji,
										sum(bm_bmatl) as realisasi_bm_bmatl,
										sum(btt) as realisasi_btt,
										sum(bt_bbh) as realisasi_bt_bbh,
										sum(bt_bbk) as realisasi_bt_bbk
									FROM
										realisasi_keuangan 
									WHERE
										id_instansi = {$id_instansi} 
										AND kode_sub_kegiatan = '{$kode_rekening_sub_kegiatan}' 
										AND bulan {$ope} {$bulan}
										AND kode_tahap = '$tahap'
										AND tahun='$tahun'");
		return $query;
	}

	public function get_realisasi_fisik($id_instansi, $kode_rekening_sub_kegiatan, $bulan, $jenis_paket, $ope, $tahun, $tahap)
	{
		

		if ($tahap==4) {
			$where_tahap = "AND pp.status='1'";
		}else{
			$where_tahap = "AND pp.kode_tahap='2'";

		}
		$query  = $this->db->query("SELECT
										rk.kode_rekening_sub_kegiatan,
										rk.bulan,
										SUM( rk.nilai ) AS total 
									FROM
										realisasi_fisik rk
										LEFT JOIN paket_pekerjaan pp ON rk.id_paket_pekerjaan = pp.id_paket_pekerjaan 
									WHERE
										rk.id_instansi = {$id_instansi} 
										AND rk.kode_rekening_sub_kegiatan = '$kode_rekening_sub_kegiatan' 
										AND pp.jenis_paket = '{$jenis_paket}' $where_tahap
										AND rk.bulan {$ope} {$bulan}
										AND rk.tahun='$tahun'");
		return $query;
	}

	public function get_total_paket($id_instansi, $kode_rekening_sub_kegiatan, $tahun, $tahap)
	{
		$kode_tahap 				= $this->input->get('tahap');
		if ($kode_tahap == 4) {
			if ($kode_tahap == $tahap) {
				$where = "AND pp.status=1";
			}else{
				$where = "";
			}
		}else{
			$where = "AND pp.kode_tahap='$tahap'";

		}

		$query  = $this->db->query("SELECT
										id_paket_pekerjaan
									FROM
										paket_pekerjaan pp 
									WHERE
										pp.kode_rekening_sub_kegiatan = '{$kode_rekening_sub_kegiatan}'
										AND pp.id_instansi = {$id_instansi} and pp.tahun='$tahun'
										$where 
								");
		return $query;
	}
	public function get_total_paket_perjenis($id_instansi, $kode_rekening_sub_kegiatan, $jenis, $tahun, $tahap)
	{
		$kode_tahap 				= $this->input->get('tahap');
		if ($kode_tahap ==4) {
			if ($kode_tahap == $tahap) {
				$where = "AND pp.status=1";
			}else{
				$where = "";
			}
		}else{
			$where = "AND pp.kode_tahap='$tahap'";

		}

		$query  = $this->db->query("SELECT
										id_paket_pekerjaan
									FROM
										paket_pekerjaan pp 
									WHERE
										pp.kode_rekening_sub_kegiatan = '{$kode_rekening_sub_kegiatan}'
										AND pp.id_instansi = {$id_instansi}
										AND pp.jenis_paket = '{$jenis}'
										AND pp.tahun='$tahun' 
										$where
								");
		return $query;
	}


	public function jumlah_kegiatan($id_instansi)
	{
		$tahap  = tahapan_apbd();
		return $this->db->query("SELECT total_kegiatan($id_instansi, $tahap) as total_kegiatan")->row()->total_kegiatan;
	}



 public function total_pagu_sub_kegiatan($kode_sub_kegiatan, $tahap, $id_instansi, $jenis)
    {


		$tahun 				= $this->input->get('tahun');
		// $tahap 				= $this->input->get('tahap');
        // $tahun = tahun_anggaran();
  //       if ($tahap ==4) {
		// 	$where = "  WHERE
		// 	id_instansi = '$id_instansi' and kode_sub_kegiatan='$kode_sub_kegiatan'  and status = '1' and tahun = '$tahun'";
		// 	}
		// else{
			$where = "  WHERE
			id_instansi = '$id_instansi' and kode_tahap='$tahap' and kode_sub_kegiatan='$kode_sub_kegiatan'  and tahun = '$tahun'";
        // }

        if ($jenis=='pagu_bo') {
             $query  = $this->db->query("SELECT
                                         sum(bo_bp + bo_bbj+ bo_bs+bo_bh) as pagu_bo
                                    FROM
                                        anggaran_sub_kegiatan 
                                    $where
                                        ");
        }
        else if ($jenis=='pagu_bm') {
            $query  = $this->db->query("SELECT
                                         sum( bm_bmt + bm_bmpm + bm_bmgb + bm_bmjji + bm_bmatl ) as pagu_bm
                                    FROM
                                        anggaran_sub_kegiatan 
                                    $where
                                        ");
        }
        else if ($jenis=='pagu_btt') {
            $query  = $this->db->query("SELECT
                                         sum(btt) as pagu_btt
                                    FROM
                                        anggaran_sub_kegiatan 
                                    $where
                                        ");
        }
        else if ($jenis=='pagu_bt') {
            $query  = $this->db->query("SELECT
                                         sum( bt_bbh+bt_bbk ) as pagu_bt
                                    FROM
                                        anggaran_sub_kegiatan 
                                    $where
                                        ");
        }else{
        	 $query  = $this->db->query("SELECT
                                         sum(bo_bp + bo_bbj+ bo_bs+bo_bh + bm_bmt + bm_bmpm + bm_bmgb + bm_bmjji + bm_bmatl + btt + bt_bbh+bt_bbk) as pagu_total
                                    FROM
                                        anggaran_sub_kegiatan 
                                    $where
                                        ");
        }
     
        return $query;
    }






	public function get_program_berdasarkan_instansi_pembantu($id_instansi, $tahap, $tahun, $id_instansi_pembantu)
	{


		if ($tahap==4) {
			$where = "ski.status = '1'";
		}else{
			$where = "ski.kode_tahap='2'";
		}


		if ($id_instansi_pembantu == 'non') { 
			$q_usk_pptk = $this->db->query("SELECT  ski.kode_program, mp.nama_program from sub_kegiatan_instansi ski
	         	left join master_program mp on ski.kode_program = mp.kode_program and mp.status = 1 where ski.kategori='Sub Kegiatan SKPD' and id_instansi='$id_instansi' and ski.tahun='$tahun' and $where group by ski.kode_program")->result();
			# code...
		}else{
			$q_usk_pptk = $this->db->query("SELECT  ski.kode_program, mp.nama_program from sub_kegiatan_instansi ski
	         	left join master_program mp on ski.kode_program = mp.kode_program and mp.status = 1 where ski.id_instansi_pembantu_teknis='$id_instansi_pembantu' and ski.tahun='$tahun' and $where group by ski.kode_program")->result();

		}


		

		
		return $q_usk_pptk;
	}

	public function get_kegiatan_berdasarkan_instansi_pembantu($id_instansi, $kode_program, $tahun, $tahap,  $id_instansi_pembantu)
	{


		if ($tahap==4) {
			$where = "ski.status = '1'";
		}else{
			$where = "ski.kode_tahap='2'";
		}

		if ($id_instansi_pembantu == 'non') { 
			$q_usk_pptk = $this->db->query("SELECT  ski.kode_kegiatan, mk.nama_kegiatan from sub_kegiatan_instansi ski
	            	left join master_kegiatan mk on ski.kode_kegiatan = mk.kode_kegiatan and mk.status = 1 where ski.kode_program='$kode_program' and ski.kategori='Sub Kegiatan SKPD' and id_instansi='$id_instansi' and ski.tahun='$tahun' and $where group by ski.kode_kegiatan");
		}else{
			$q_usk_pptk = $this->db->query("SELECT  ski.kode_kegiatan, mk.nama_kegiatan from sub_kegiatan_instansi ski
	            	left join master_kegiatan mk on ski.kode_kegiatan = mk.kode_kegiatan and mk.status = 1 where ski.kode_program='$kode_program' and  ski.id_instansi_pembantu_teknis='$id_instansi_pembantu' and ski.tahun='$tahun' and $where group by ski.kode_kegiatan");
		}
		

		
		return $q_usk_pptk;
	}

	public function get_sub_kegiatan_berdasarkan_instansi_pembantu($id_instansi, $kode_kegiatan, $tahun, $tahap,  $id_instansi_pembantu)
	{


		if ($tahap==4) {
			$where = "ski.status = '1'";
		}else{
			$where = "ski.kode_tahap='2'";
		}

		if ($id_instansi_pembantu == 'non') { 
			$q_usk_pptk = $this->db->query("SELECT  ski.kode_sub_kegiatan,ski.kode_tahap, ski.nama_sub_kegiatan, ski.jenis_sub_kegiatan, ski.kategori, ski.keterangan,
			total_anggaran_sub_kegiatan(ski.kode_sub_kegiatan,ski.kode_tahap,ski.id_instansi,ski.kode_kegiatan,ski.kode_program,ski.tahun) AS pagu
			 from sub_kegiatan_instansi ski
	            	left join master_sub_kegiatan msk on 
				trim(substr(ski.kode_sub_kegiatan,1,15)) = trim(msk.kode_sub_kegiatan) and msk.status = 1 where ski.kode_kegiatan='$kode_kegiatan' and ski.kategori='Sub Kegiatan SKPD' and id_instansi='$id_instansi'  and ski.tahun='$tahun' and $where group by ski.kode_sub_kegiatan");
		}else{
			$q_usk_pptk = $this->db->query("SELECT  ski.kode_sub_kegiatan,ski.kode_tahap, ski.nama_sub_kegiatan, ski.jenis_sub_kegiatan, ski.kategori, ski.keterangan,
			total_anggaran_sub_kegiatan(ski.kode_sub_kegiatan,ski.kode_tahap,ski.id_instansi,ski.kode_kegiatan,ski.kode_program,ski.tahun) AS pagu
			 from sub_kegiatan_instansi ski
	            	left join master_sub_kegiatan msk on 
				trim(substr(ski.kode_sub_kegiatan,1,15)) = trim(msk.kode_sub_kegiatan) and msk.status = 1 where ski.kode_kegiatan='$kode_kegiatan' and  ski.id_instansi_pembantu_teknis='$id_instansi_pembantu' and ski.tahun='$tahun' and $where group by ski.kode_sub_kegiatan");
		}
		

		
		return $q_usk_pptk;
	}



}
