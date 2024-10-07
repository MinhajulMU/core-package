<?php

namespace Minhack\CorePackage\Helper;

class Format
{
    public static function tanggal($tanggal, $cetak_hari = false, $cetak_waktu = true)
    {
        if ($tanggal == null || $tanggal == '') {
            return '';
        }
        $hari = array(
            1 =>    'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu'
        );

        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $split1       = explode('-', $tanggal);
        if (strlen($split1[2]) != 2) {
            $split = array();
            foreach ($split1 as $key => $value) {
                if ($key == 2) {
                    $a      = explode(' ', $value);
                    $split[] = array_push($split, $a[0], $a[1]);
                } else {
                    $split[] = $value;
                }
            }
            $tgl_indo = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0] . ' | ' . $split[3];
        } else {
            $split      = explode('-', $tanggal);
            $tgl_indo = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
        }

        if ($cetak_waktu == false) {
            $split      = explode('-', $tanggal);
            $tgl_indo = substr($split[2], 0, 2) . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
        }

        if ($cetak_hari) {
            $num = date('N', strtotime($tanggal));
            return $hari[$num] . ', ' . $tgl_indo;
        }

        return $tgl_indo;
    }

    public static function getIP()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public static function escapeString($input)
    {

        $input = str_replace('&#39;', "'", $input);
        $input = str_replace('&quot;', '"', $input);
        $input = str_replace('&lt;', "<", $input);
        $input = str_replace('&gt;', ">", $input);
        $input = str_replace('&amp;', "&", $input);

        return $input;
    }

    public static function rupiah($nominal)
    {
        return 'Rp ' . number_format($nominal, 0, ',', '.');
    }
    public static function getPeriod()
    {
        return date('m') . date('y');
    }
    public static function addMinute($mulai, $minute)
    {
        $date_skrg = date_create($mulai);
        date_add($date_skrg, date_interval_create_from_date_string(($minute * 60) . " seconds"));
        return date_format($date_skrg, 'Y-m-d H:i:s');
    }

    public static function phoneNumber($phone){
		$removePlusSign = preg_replace('/[+]/', "", $phone);
		if (substr($removePlusSign, 0, 2) == '08') {
			$phone = preg_replace('/^0/', '62', $removePlusSign);
		}
		return $phone;
	}
}
