<?php

/**
 * Author     : Alfikri, M.Kom
 * Created By : Alfikri, M.Kom
 * E-Mail     : alfikri.name@gmail.com
 * No HP      : 081277337405
 * Class      : Realisasi_akumulasi_model.php
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Synchronize_model_new extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}


	public function get_sub_kegiatan_new($id_instansi, $tahun, $tahap)
	{	
		
		
				if ($tahap==2) {
			 //    	$sub_kegiatan = $this->db->query("SELECT ski.kode_program as kode_rekening_program, ski.kategori, ski.jenis_sub_kegiatan, ski.keterangan, ski.kode_kegiatan as kode_rekening_kegiatan, ski.kode_sub_kegiatan as kode_rekening_sub_kegiatan, ski.nama_sub_kegiatan,
			 //    		total_anggaran_sub_kegiatan(ski.kode_sub_kegiatan,2, ski.id_instansi, ski.kode_kegiatan, ski.kode_program, ski.tahun) as pagu,
			 //    		ski.kode_tahap, ski.pergeseran_ke, ski.id_instansi, ski.tahun, ski.tambahan_kode_sub_kegiatan, ski.input_by_tambahan_kode_sub_kegiatan, ski.id_instansi_pembantu_teknis, ski.status
			 //    	 from sub_kegiatan_instansi ski where ski.id_instansi='$id_instansi' and ski.tahun='$tahun' and ski.kode_tahap = '2'");
				// }elseif ($tahap==3) {
			    	$sub_kegiatan = $this->db->query("SELECT kode_rekening_program, kategori, jenis_sub_kegiatan, keterangan, kode_rekening_kegiatan, kode_rekening_sub_kegiatan, pagu, nama_sub_kegiatan,
			    	kode_tahap, pergeseran_ke, id_instansi, tahun ,tambahan_kode_sub_kegiatan,input_by_tambahan_kode_sub_kegiatan, id_instansi_pembantu_teknis, status, id_tambahan_anggaran
			    		from v_sub_kegiatan_apbd where id_instansi='$id_instansi' and tahun='$tahun' and kode_tahap = '2' order by kode_rekening_sub_kegiatan	asc");
				}else{
			    	$sub_kegiatan = $this->db->query("SELECT kode_rekening_program, kategori, jenis_sub_kegiatan, keterangan, kode_rekening_kegiatan, kode_rekening_sub_kegiatan, pagu, nama_sub_kegiatan,
			    	kode_tahap, pergeseran_ke, id_instansi, tahun , tambahan_kode_sub_kegiatan,input_by_tambahan_kode_sub_kegiatan, id_instansi_pembantu_teknis, status, id_tambahan_anggaran
			    		from v_sub_kegiatan_apbd where id_instansi='$id_instansi' and tahun='$tahun' and status = '1' order by kode_rekening_sub_kegiatan	asc");

				}


		return $sub_kegiatan;
	}




	public function get_target_all($id_instansi, $tahun, $tahap)
	{
		
	    $where = [
	        'id_instansi'                => $id_instansi,
	        'kode_tahap'                 => $tahap,
	        'tahun'                      => $tahun,
	        // 'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
	    ];
	

			$this->db->select('
				bulan, 
				kode_rekening_sub_kegiatan,
				target_fisik,
				target_keuangan,
				target_fisik_bulanan,
				target_keuangan_bulanan, pergeseran_ke');
			$this->db->order_by('kode_rekening_sub_kegiatan ASC, bulan ASC');
		return $this->db->get_where('target_apbd', $where);
	}


	public function get_pagu_all($id_instansi, $tahun)
	{
		
	    $where = [
	        'id_instansi'                => $id_instansi,
	        // 'kode_tahap'                 => $tahap,
	        'tahun'                      => $tahun,
	        // 'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
	    ];
	

			$this->db->select(' kode_sub_kegiatan,
								kode_tahap,
								status,
								pergeseran_ke,
								bo_bp,
								bo_bbj,
								bo_bs,
								bo_bh,
								bm_bmt,
								bm_bmpm,
								bm_bmgb,
								bm_bmjji,
								bm_bmatl,
								btt,
								bt_bbh,
								bt_bbk ');
			$this->db->order_by('kode_sub_kegiatan ASC');
		return $this->db->get_where('anggaran_sub_kegiatan', $where);
	}


	public function get_rk_all($id_instansi, $tahun)
	{
		
	    $where = [
	        'id_instansi'                => $id_instansi,
	        // 'kode_tahap'                 => $tahap,
	        'tahun'                      => $tahun,
	        // 'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
	    ];
	

			$this->db->select(' kode_sub_kegiatan,
								kode_tahap,
								bulan,
								bo_bp,
								bo_bbj,
								bo_bs,
								bo_bh,
								bm_bmt,
								bm_bmpm,
								bm_bmgb,
								bm_bmjji,
								bm_bmatl,
								btt,
								bt_bbh,
								bt_bbk ');
			$this->db->order_by('kode_sub_kegiatan ASC, bulan ASC');
		return $this->db->get_where('realisasi_keuangan', $where);
	}



	public function get_rf_all($id_instansi, $tahun)
	{
		
	    $where = [
	        'id_instansi'                => $id_instansi,
	        // 'kode_tahap'                 => $tahap,
	        'tahun'                      => $tahun,
	        // 'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
	    ];
	

			$q = $this->db->select(' kode_rekening_sub_kegiatan,
				id_paket_pekerjaan,
				dokumen,
								bulan,
								nilai');
			$this->db->order_by('kode_rekening_sub_kegiatan ASC, bulan ASC');
		return $this->db->get_where('realisasi_fisik', $where);
	}



	
}
