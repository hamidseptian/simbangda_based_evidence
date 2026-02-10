<?php

/**
 * Author     : Alfikri, M.Kom
 * Created By : Alfikri, M.Kom
 * E-Mail     : alfikri.name@gmail.com
 * No HP      : 081277337405
 * Class      : Realisasi_akumulasi_model.php
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Rekap_kegiatan_kab_kota extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function provinsi($id_provinsi)
	{
		$data = ['id_provinsi'=>$id_provinsi];
		return $this->db->get_where('provinsi', $data)->row();
	}

	public function kab_kota($id_kota)
	{
		$q = $this->db->query("SELECT k.nama_kota, p.nama_provinsi
		 from kota k  
		 left join provinsi p  on k.id_provinsi = p.id_provinsi
			where k.id_kota = '$id_kota'
			");
		
		return $q->row_array();
	}
	public function lokasi_per_skpd($id_kota, $id_kecamatan , $tahun, $id_instansi, $jenis_paket)
	{
		if ($id_instansi=='semua') {
			$where_opd = "";
		}else{
			$where_opd = "AND lpp.id_instansi = '$id_instansi'";

		}


		if ($id_kecamatan=='semua') {
			$where_kecamatan = "";
		}else{
			$where_kecamatan = "AND lpp.id_kecamatan = '$id_kecamatan'";

		}


		if ($id_kota=='semua') {
			$where_kab_kota = "";
		}else{
			$where_kab_kota = "AND lpp.id_kab_kota = '$id_kota'";

		}


		if ($jenis_paket=='semua') {
			$where_jenis_paket = "";
		}
		elseif ($jenis_paket=='SWAKELOLA') {
			$where_jenis_paket = "AND pp.jenis_paket='SWAKELOLA'";
		}
		elseif ($jenis_paket=='PENYEDIA-KONTRUKSI') {
			$pisah = explode('-', $jenis_paket);
			$kategori = $pisah[1];

			$where_jenis_paket = "AND pp.jenis_paket='PENYEDIA' and pp.kategori = 'KONTRUKSI'";
		}
		elseif ($jenis_paket=='PENYEDIA-NON KONTRUKSI') {
			$pisah = explode('-', $jenis_paket);
			$kategori = $pisah[1];
			$where_jenis_paket = "AND pp.jenis_paket='PENYEDIA' and pp.kategori = 'NON KONTRUKSI'";
		}

		

		
		$q = $this->db->query("SELECT lpp.id_kab_kota, mi.nama_instansi, mi.kode_opd, lpp.id_instansi, 
			pp.kode_rekening_sub_kegiatan, pp.jenis_paket, pp.pagu, pp.kategori as kategori_penyedia, pp.kode_rekening_sub_kegiatan,
			total_anggaran_sub_kegiatan(ski.kode_sub_kegiatan,ski.kode_tahap,ski.id_instansi,ski.kode_kegiatan,ski.kode_program,ski.tahun) AS pagu_sub_kegiatan,
			lpp.id_paket_pekerjaan, pp.nama_paket, lpp.id_kecamatan,
			k.nama_kota, kc.nama_kecamatan,
			ski.nama_sub_kegiatan, ski.kategori, ski.jenis_sub_kegiatan,  ski.keterangan,
			sd.pad,sd.dau,sd.dak,sd.dbh,sd.lainnya,sd.nama_sumber_dana_lainnya, sd.nama_sumber_dana_lainnya 
		 from lokasi_paket_pekerjaan lpp
			left join master_instansi mi on lpp.id_instansi = mi.id_instansi
			left join paket_pekerjaan pp on lpp.id_paket_pekerjaan = pp.id_paket_pekerjaan
			left join kota k on lpp.id_kab_kota = k.id_kota
			left join kecamatan kc on lpp.id_kecamatan = kc.id_kecamatan
			left join sub_kegiatan_instansi ski on pp.kode_rekening_sub_kegiatan = ski.kode_sub_kegiatan and ski.tahun = '$tahun' 
			left join sumber_dana sd on pp.kode_rekening_sub_kegiatan = sd.kode_rekening_sub_kegiatan and sd.tahun = '$tahun' 
			where mi.is_active=1 and pp.tahun = '$tahun' 
			$where_opd $where_kecamatan $where_kab_kota $where_jenis_paket
			GROUP BY lpp.id_paket_pekerjaan order by k.nama_kota, kc.nama_kecamatan,  mi.nama_instansi
			");
		
		return $q->result_array();
	}

	public function get_pagu_opd($id_instansi)
	{
		$tahap = tahapan_apbd();
		$query  = $this->db->query("SELECT
																	ka.id_instansi,
																	SUM( ka.pagu ) AS pagu
																FROM
																	kegiatan_apbd ka 
																WHERE
																	ka.id_instansi = '{$id_instansi}'
																	AND ka.kode_tahap = '{$tahap}'
																GROUP BY
																	ka.id_instansi");
		return $query;
	}

	public function get_program($id_instansi)
	{
		return $this->db->get_where('v_program_apbd', [
			'id_instansi' => $id_instansi,
			'kode_tahap' => tahapan_apbd()
		]);
	}

	public function get_kegiatan($id_instansi, $kode_rekening_program, $kode_bidang_urusan)
	{	$tahap = tahapan_apbd();
		// return $this->db->query("SELECT * from v_kegiatan_apbd where  id_instansi ='$id_instansi'
		// 	and kode_tahap = '$tahap' 
		// 	and kode_rekening_program = '$kode_rekening_program'
		// 	and kode_urusan = '$kode_urusan'
		// 	and pagu >0");
		return $this->db->get_where('v_kegiatan_apbd', [
			'id_instansi' => $id_instansi,
			'kode_tahap' => tahapan_apbd(),
			'kode_rekening_program' => $kode_rekening_program,
			'kode_bidang_urusan' => $kode_bidang_urusan
		]);
	}
	public function get_sub_kegiatan($id_instansi, $kode_rekening_kegiatan, $kode_rekening_program, $kode_bidang_urusan)
	{	$tahap = tahapan_apbd();
		// return $this->db->query("SELECT * from v_kegiatan_apbd where  id_instansi ='$id_instansi'
		// 	and kode_tahap = '$tahap' 
		// 	and kode_rekening_program = '$kode_rekening_program'
		// 	and kode_urusan = '$kode_urusan'
		// 	and pagu >0");
		return $this->db->get_where('v_sub_kegiatan_apbd', [
			'id_instansi' => $id_instansi,
			'kode_tahap' => tahapan_apbd(),
			'kode_rekening_kegiatan' => $kode_rekening_kegiatan,
			'kode_rekening_program' => $kode_rekening_program,
			'kode_bidang_urusan' => $kode_bidang_urusan
		]);
	}

	public function get_sumber_dana($id_instansi, $kode_rekening_sub_kegiatan, $kode_rekening_kegiatan, $kode_rekening_program, $kode_bidang_urusan)
	{
		return $this->db->get_where('sumber_dana', [
			'id_instansi' => $id_instansi,
			'kode_tahap' => tahapan_apbd(),
			'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
			'kode_rekening_kegiatan' => $kode_rekening_kegiatan,
			'kode_rekening_program' => $kode_rekening_program,
			'kode_bidang_urusan' => $kode_bidang_urusan
		]);
	}

	public function get_target($id_instansi, $kode_rekening_sub_kegiatan, $bulan)
	{
		return $this->db->get_where('target_apbd', [
			'id_instansi' => $id_instansi,
			'kode_tahap' => tahapan_apbd(),
			'kode_rekening_sub_kegiatan' => $kode_rekening_sub_kegiatan,
			'bulan' => $bulan
		]);
	}

	public function get_realisasi_keuangan($id_instansi, $kode_rekening_sub_kegiatan, $bulan, $ope)
	{
		$query  = $this->db->query("SELECT
										sum(bo_bp + bo_bbj+ bo_bs+bo_bh + bm_bmt + bm_bmpm + bm_bmgb + bm_bmjji + bm_bmatl +btt +  bt_bbh+bt_bbk ) as total_realisasi
									FROM
										realisasi_keuangan 
									WHERE
										id_instansi = {$id_instansi} 
										AND kode_sub_kegiatan = '{$kode_rekening_sub_kegiatan}' 
										AND bulan {$ope} {$bulan}");
		return $query;
	}

	public function get_realisasi_fisik($id_instansi, $kode_rekening_sub_kegiatan, $bulan, $jenis_paket, $ope)
	{
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
										AND pp.jenis_paket = '{$jenis_paket}' 
										AND rk.bulan {$ope} {$bulan}");
		return $query;
	}

	public function get_total_paket($id_instansi, $kode_rekening_sub_kegiatan)
	{
		$query  = $this->db->query("SELECT
										id_paket_pekerjaan
									FROM
										paket_pekerjaan pp 
									WHERE
										pp.kode_rekening_sub_kegiatan = '{$kode_rekening_sub_kegiatan}'
										AND pp.id_instansi = {$id_instansi}
								");
		return $query;
	}
	public function get_total_paket_perjenis($id_instansi, $kode_rekening_sub_kegiatan, $jenis)
	{
		$query  = $this->db->query("SELECT
										id_paket_pekerjaan
									FROM
										paket_pekerjaan pp 
									WHERE
										pp.kode_rekening_sub_kegiatan = '{$kode_rekening_sub_kegiatan}'
										AND pp.id_instansi = {$id_instansi}
										AND pp.jenis_paket = '{$jenis}'
								");
		return $query;
	}


	public function jumlah_kegiatan($id_instansi)
	{
		$tahap  = tahapan_apbd();
		return $this->db->query("SELECT total_kegiatan($id_instansi, $tahap) as total_kegiatan")->row()->total_kegiatan;
	}


}
