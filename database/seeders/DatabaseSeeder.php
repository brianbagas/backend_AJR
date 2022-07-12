<?php

namespace Database\Seeders;

use App\Models\Promo;
use App\Models\Role;
use App\Models\Customer;
use App\Models\Brosur;
use App\Models\Detail_jadwal;
use App\Models\Jadwal;
use App\Models\Pemilik;
use App\Models\Driver;
use App\Models\Pegawai;
use App\Models\Aset;
use App\Models\Transaksi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use phpDocumentor\Reflection\PseudoTypes\True_;
use Illuminate\Support\Collection\Random;
use iLLuminate\Support\Arr;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Customer::factory(10)->create();

        Customer::create([
            //'id_customer' => 'CUS-001',
            'nama_customer' => 'bagaskara',
            'no_ktp'=>'123123123123',
            'password'=> bcrypt('12345678'),
            'alamat_customer' => 'Medan',
            'tgl_lahir_customer' => date('Y-m-d',strtotime('01-04-2000')),
            'gender_customer' => 'Laki-Laki',
            'no_telp_customer' => '08773214',
            'email' => 'bagaskara@gmail.com',
            'verifikasi_data'=> True,
            'status'=> True,

        ]);



        Customer::create([
           // 'id_customer' => 'CUS-002',
            'nama_customer' => 'michael brian',
            'no_ktp'=>'123123123123',
            'password'=> bcrypt('12345678'),
            'alamat_customer' => 'Solo',
            'tgl_lahir_customer' => date('Y-m-d',strtotime('05-05-2001')),
            'gender_customer' => 'Laki-Laki',
            'no_telp_customer' => '08214446666',
            'email' => 'michael@gmail.com',
            'verifikasi_data'=> False,
            'status'=> True,

        ]);
        Customer::create([
           // 'id_customer' => 'CUS-003',
            'nama_customer' => 'lala ',
            'no_ktp'=>'123123123123',
            'password'=> bcrypt('12345678'),
            'alamat_customer' => 'Jakarta',
            'tgl_lahir_customer' => date('Y-m-d',strtotime('02-01-2005')),
            'gender_customer' => 'Perempuan',
            'no_telp_customer' => '088811123332',
            'email' => 'lala@gmail.com',
            'verifikasi_data'=> True,
            'status'=> True,
        ]);
        Customer::create([
            //'id_customer' => 'CUS-004',
            'nama_customer' => 'lily',
            'no_ktp'=>'123123123123',
            'password'=> bcrypt('12345678'),
            'alamat_customer' => 'Yogyakarta',
            'tgl_lahir_customer' => date('Y-m-d',strtotime('04-01-1997')),
            'gender_customer' => 'Perempuan',
            'no_telp_customer' => '027499997777',
            'email' => 'lily@gmail.com',
            'verifikasi_data'=> True,
            'status'=> True,
        ]);
        Customer::create([
           // 'id_customer' => 'CUS-005',
            'nama_customer' => 'Bobo',
            'no_ktp'=>'123123123123',
            'password'=> bcrypt('12345678'),
            'alamat_customer' => 'Yogyakarta',
            'tgl_lahir_customer' => date('Y-m-d',strtotime('04-01-1997')),
            'gender_customer' => 'Laki-Laki',
            'no_telp_customer' => '027499997777',
            'email' => 'Bobo@gmail.com',
            'verifikasi_data'=> True,
            'status'=> True,
        ]);
        Customer::create([
           // 'id_customer' => 'CUS-006',
            'nama_customer' => 'Danang',
            'no_ktp'=>'123123123123',
            'password'=> bcrypt('12345678'),
            'alamat_customer' => 'Yogyakarta',
            'tgl_lahir_customer' => date('Y-m-d',strtotime('04-10-1997')),
            'gender_customer' => 'Laki-Laki',
            'no_telp_customer' => '027499997777',
            'email' => 'Danang@gmail.com',
            'verifikasi_data'=> True,
            'status'=> True
        ]);

        role::Create([
            'nama_role'=>'CS',
        ]);
        role::Create([
            'nama_role'=> 'Admin',
        ]);
        role::Create([
            'nama_role'=> 'Manager',
        ]);

        promo::create([
            'kode_promo' =>'MHS',
            'jenis_promo' => 'Pelajar&Mahasiswa',
            'Keterangan' => 'Promo bagi customer yang berusia mulai dari 17-22 tahun dan memiliki kartu identitas pelajar/mahasiswa, mendapat diskon sebesar 20%.',
            'diskon'=> 0.2,
            'status'=> TRUE,
        ]);

        promo::Create([
            'kode_promo' =>'BDAY',
            'jenis_promo' => 'Ulang Tahun',
            'Keterangan' => 'Promo bagi customer yang sedang berulang tahun, mendapat diskon sebesar 15%.',
            'diskon'=> 0.15,
            'status'=> TRUE,
        ]);
        promo::Create([
            'kode_promo' =>'MDK',
            'jenis_promo' => 'Mudik',
            'Keterangan' => 'Promo berlaku selama masa libur Lebaran dan Nataru, mendapat diskon sebesar 25%.',
            'diskon'=> 0.25,
            'status'=> FALSE,
        ]);
        promo::Create([
            'kode_promo' =>'WKN',
            'jenis_promo' => 'Weekend',
            'Keterangan' => 'Promo berlaku selama hari Sabtu dan Minggu, mendapat diskon sebesar 10%',
            'diskon'=> 0.25,
            'status'=> TRUE,
        ]);
        brosur::Create([
            'Harga'=>400000,
        ]);
        brosur::Create([
            'Harga'=>500000,
        ]);
        brosur::Create([
            'Harga'=>250000,
        ]);
        brosur::Create([
            'Harga'=>200000,
        ]);

        jadwal::Create([
            'hari'=>'Senin',
            'shift'=>'1',
        ]);
        jadwal::Create([
            'hari'=>'Senin',
            'shift'=>'2',
        ]);
        jadwal::Create([
            'hari'=>'Selasa',
            'shift'=>'1',
        ]);
        jadwal::Create([
            'hari'=>'Selasa',
            'shift'=>'2',
        ]);
        jadwal::Create([
            'hari'=>'Rabu',
            'shift'=>'1',
        ]);
        jadwal::Create([
            'hari'=>'Rabu',
            'shift'=>'2',
        ]);
        jadwal::Create([
            'hari'=>'Kamis',
            'shift'=>'1',
        ]);
        jadwal::Create([
            'hari'=>'Kamis',
            'shift'=>'2',
        ]);
        jadwal::Create([
            'hari'=>'Jumat',
            'shift'=>'1',
        ]);
        jadwal::Create([
            'hari'=>'Jumat',
            'shift'=>'2',
        ]);
        jadwal::Create([
            'hari'=>'Sabtu',
            'shift'=>'1',
        ]);
        jadwal::Create([
            'hari'=>'Sabtu',
            'shift'=>'2',
        ]);
        jadwal::Create([
            'hari'=>'Minggu',
            'shift'=>'1',
        ]);
        jadwal::Create([
            'hari'=>'Minggu',
            'shift'=>'2',
        ]);

        Pemilik::Create([
            'no_ktp'=>'100000001',
            'nama'=>'Qiqi',
            'alamat'=>'Jayapura',
            'no_telp'=>'08757576373',
            'waktu_kontrak'=> 2,
            'mulai_kontrak'=>date('Y-m-d',strtotime('05-05-2022')),
            'selesai_kontrak'=>date('Y-m-d',strtotime('05-05-2024')),
        ]);
        
        Pemilik::Create([
            'no_ktp'=>'220000001',
            'nama'=>'Wahyu',
            'alamat'=>'Solo',
            'no_telp'=>'0822556677',
            'waktu_kontrak'=> 5,
            'mulai_kontrak'=>date('Y-m-d',strtotime('05-03-2022')),
            'selesai_kontrak'=>date('Y-m-d',strtotime('05-03-2027')),
        ]);
               
        Pemilik::Create([
            'no_ktp'=>'11000054',
            'nama'=> 'Jono',
            'alamat'=>'Jakarta',
            'no_telp'=>'0855667788',
            'waktu_kontrak'=> 3,
            'mulai_kontrak'=>date('Y-m-d',strtotime('01-08-2022')),
            'selesai_kontrak'=>date('Y-m-d',strtotime('01-08-2025')),
            
        ]);

        Driver::Create([
            'nama'=> 'Joko',
            'alamat'=> 'Yogyakarta',
            'tgl_lahir'=>date('Y-m-d',strtotime('01-08-1992')),
            'gender'=> 'Laki-Laki',
            'email'=>'Joko@gmail.com',
            'password'=>bcrypt('12345678'),
            'bahasa'=> 'Inggris',
            'no_telp'=> '081905013973',
            'foto'=>'',
            'sim'=>'',
            'napza'=>'',
            'jiwa'=>'',
            'jasmani'=>'',
            'skck'=>'',
            'status'=> True

        ]);
        Driver::Create([
            'nama'=> 'Yoyok',
            'alamat'=> 'Semarang',
            'tgl_lahir'=>date('Y-m-d',strtotime('01-08-1985')),
            'gender'=> 'Laki-Laki',
            'email'=>'Yoyok@gmail.com',
            'password'=>bcrypt('12345678'),
            'bahasa'=> 'Indonesia',
            'no_telp'=> '081905011273',
            'foto'=>'',
            'sim'=>'',
            'napza'=>'',
            'jiwa'=>'',
            'jasmani'=>'',
            'skck'=>'',
            'status'=> True
        ]);
        Driver::Create([
            'nama'=> 'Budi',
            'alamat'=> 'Yogyakarta',
            'tgl_lahir'=>date('Y-m-d',strtotime('05-04-1987')),
            'gender'=> 'Laki-Laki',
            'email'=>'Budi@gmail.com',
            'password'=>bcrypt('12345678'),
            'bahasa'=> 'Indonesia',
            'no_telp'=> '081905011231',
            'foto'=>'',
            'sim'=>'',
            'napza'=>'',
            'jiwa'=>'',
            'jasmani'=>'',
            'skck'=>'',
            'status'=> True
        ]);

        Pegawai::Create([
            'nama'=> 'Isabel',
            'alamat'=>'Yogyakarta',
            'tgl_lahir'=>date('Y-m-d',strtotime('05-04-2000')),
            'gender'=>'Perempuan',
            'email'=>'isabel@gmail.com',
            'password'=>bcrypt('12345678'),
            'no_telp' => '027499997777',
            'foto'=>'',
            'id_role'=> 1,
            'status'=> True
        ]);
        
        Pegawai::Create([
            'nama'=> 'Angel',
            'alamat'=>'Yogyakarta',
            'tgl_lahir'=>date('Y-m-d',strtotime('27-06-1999')),
            'gender'=>'Perempuan',
            'email'=>'CS@gmail.com',
            'password'=>bcrypt('12345678'),
            'no_telp' => '027499997777',
            'foto'=>'',
            'id_role'=> 1,
            'status'=> True
        ]);
        Pegawai::Create([
            'nama'=> 'Zoro',
            'alamat'=>'Yogyakarta',
            'tgl_lahir'=>date('Y-m-d',strtotime('27-06-1997')),
            'gender'=>'Laki-Laki',
            'email'=>'Admin@gmail.com',
            'password'=>bcrypt('12345678'),
            'no_telp' => '027499997777',
            'foto'=>'',
            'id_role'=> 2,
            'status'=> True
        ]);
        Pegawai::Create([
            'nama'=> 'Luffy',
            'alamat'=>'Yogyakarta',
            'tgl_lahir'=>date('Y-m-d',strtotime('27-06-1996')),
            'gender'=>'Laki-Laki',
            'email'=>'Manager@gmail.com',
            'password'=>bcrypt('12345678'),
            'no_telp' => '027499997777',
            'foto'=>'',
            'id_role'=> 3,
            'status'=> True
        ]);

        Detail_jadwal::Create([
            'keterangan'=>'',
            'id_jadwal'=>9,
            'id_pegawai'=> 2,
        ]);

        Detail_jadwal::Create([
            'keterangan'=>'',
            'id_jadwal'=>6,
            'id_pegawai'=> 1,
        ]);
        
        Detail_jadwal::Create([
            'keterangan'=>'jadwal bisa berubah',
            'id_jadwal'=>3,
            'id_pegawai'=> 1,
        ]);
        Detail_jadwal::Create([
            'keterangan'=>'jadwal bisa berubah',
            'id_jadwal'=>4,
            'id_pegawai'=> 4,
        ]);

        Aset::Create([
            'nama_mobil'=> 'Toyota New Vios',
            'plat_nomor'=>'AB7777DA',
            'stnk'=>'1588888',
            'kategory'=>'mitra',
            'kapasitas'=>4,
            'tipe'=>'sedan',
            'transmisi'=> 'AT',
            'bahanBakar'=>'Pertalite',
            'volume'=>100,
            'warna'=>'merah',
            'status'=>'tersedia',
            'harga'=> 70000,
            'id_pemilik'=>1,
            'id_brosur'=>1,
            'fasilitas'=>'AC'
        ]);
        Aset::Create([
            'nama_mobil'=> 'Toyota New Avanza',
            'plat_nomor'=>'AB1111BA',
            'stnk'=>'2765588',
            'kategory'=>'pribadi',
            'kapasitas'=>6,
            'tipe'=>'MPV',
            'transmisi'=> 'AT',
            'bahanBakar'=>'Pertamax',
            'volume'=>150,
            'warna'=>'putih',
            'harga'=> 70000,
            'fasilitas'=>'AC',
            'status'=>'tersedia',
            'id_pemilik'=>NULL,
            'id_brosur'=>2,
        ]);

        Aset::Create([
            'nama_mobil'=> 'Honda Brio',
            'plat_nomor'=>'AB3333CA',
            'stnk'=>'1231247',
            'kategory'=>'mitra',
            'kapasitas'=>2,
            'tipe'=>'City Car',
            'transmisi'=> 'AT',
            'bahanBakar'=>'Pertamax',
            'volume'=>200,
            'warna'=>'merah',
            'harga'=> 70000,
            'status'=>'tersedia',
            'id_pemilik'=>2,
            'id_brosur'=>2,
            'fasilitas'=>'AC'
        ]);

        Aset::Create([
            'nama_mobil'=> 'Toyota Fortuner',
            'plat_nomor'=>'AD1231CA',
            'stnk'=>'5512344',
            'kategory'=>'mitra',
            'kapasitas'=>8,
            'tipe'=>'SUV',
            'transmisi'=> 'AT',
            'bahanBakar'=>'Pertamax',
            'volume'=>150,
            'warna'=>'merah',
            'harga'=> 70000,
            'status'=>'tersedia',
            'id_pemilik'=>3,
            'id_brosur'=>1,
            'fasilitas'=>'AC'
        ]);





/*         Transaksi::Create([
          //  'id_transaksi'=>'TRN21021501-001',
            'tgl_transaksi'=>date('Y-m-d',strtotime('27-02-2021')),
            'tgl_mulai'=>date('Y-m-d',strtotime('28-02-2021')),
            'tgl_selesai'=>date('Y-m-d',strtotime('29-02-2021')),
            'biaya'=>400000,
            'rating'=>8,
            'metode_pembayaran'=>'online',
            'bukti_pembayaran'=>'buktiPembayaran.png',
            'verifikasi_pembayaran'=>'belum Diverifikasi',
            'verifikasi_dokumen'=>'Sudah Diverifikasi',
            'id_customer'=>'CUS-003',
            'id_aset'=>1,
            'id_promo'=>NULL,
            'id_pegawai'=>1,
            'id_driver'=>1,
        ]);

        Transaksi::Create([
         //   'id_transaksi'=>'TRN21023001-001',
            'tgl_transaksi'=>date('Y-m-d',strtotime('30-02-2021')),
            'tgl_mulai'=>date('Y-m-d',strtotime('02-03-2021')),
            'tgl_selesai'=>date('Y-m-d',strtotime('03-03-2021')),
            'biaya'=>500000,
            'denda'=>50000,
            'rating'=>5,
            'metode_pembayaran'=>'online',
            'bukti_pembayaran'=>'buktiPembayaran.png',
            'verifikasi_pembayaran'=>'Sudah Diverifikasi',
            'verifikasi_dokumen'=>'Sudah Diverifikasi',
            'id_customer'=>'CUS-002',
            'id_aset'=>2,
            'id_promo'=>NULL,
            'id_pegawai'=>2,
            'id_driver'=>3,
        ]);

        Transaksi::Create([
         //   'id_transaksi'=>'TRN21040101-001',
            'tgl_transaksi'=>date('Y-m-d',strtotime('01-04-2021')),
            'tgl_mulai'=>date('Y-m-d',strtotime('02-04-2021')),
            'tgl_selesai'=>date('Y-m-d',strtotime('03-04-2021')),
            'biaya'=>800000,
            'rating'=>10,
            'metode_pembayaran'=>'online',
            'bukti_pembayaran'=>'buktiPembayaran.png',
            'verifikasi_pembayaran'=>'sudah Diverifikasi',
            'verifikasi_dokumen'=>'Sudah Diverifikasi',
            'id_customer'=>'CUS-002',
            'id_aset'=>2,
            'id_promo'=>NULL,
            'id_pegawai'=>1,
            'id_driver'=>NULL,
        ]);

        Transaksi::Create([
         //   'id_transaksi'=>'TRN21040101-002',
            'tgl_transaksi'=>date('Y-m-d',strtotime('01-04-2021')),
            'tgl_mulai'=>date('Y-m-d',strtotime('02-04-2021')),
            'tgl_selesai'=>date('Y-m-d',strtotime('06-04-2021')),
            'biaya'=>900000,
            'rating'=>8,
            'metode_pembayaran'=>'online',
            'bukti_pembayaran'=>'buktiPembayaran.png',
            'verifikasi_pembayaran'=>'sudah Diverifikasi',
            'verifikasi_dokumen'=>'Sudah Diverifikasi',
            'id_customer'=>'CUS-005',
            'id_aset'=>2,
            'id_promo'=>NULL,
            'id_pegawai'=>1,
            'id_driver'=>1,
        ]);

        Transaksi::Create([
        //    'id_transaksi'=>'TRN21040101-003',
            'tgl_transaksi'=>date('Y-m-d',strtotime('01-04-2021')),
            'tgl_mulai'=>date('Y-m-d',strtotime('02-04-2021')),
            'tgl_selesai'=>date('Y-m-d',strtotime('06-04-2021')),
            'biaya'=>900000,
            'rating'=>8,
            'metode_pembayaran'=>'online',
            'bukti_pembayaran'=>'buktiPembayaran.png',
            'verifikasi_pembayaran'=>'sudah Diverifikasi',
            'verifikasi_dokumen'=>'Sudah Diverifikasi',
            'id_customer'=>'CUS-002',
            'id_aset'=>2,
            'id_promo'=>NULL,
            'id_pegawai'=>1,
            'id_driver'=>3,
        ]); */


    }
}
