Report 23/08/2019

Nama Project : Reminder ATM
Tahapan : Build
Detail :

1. 

Progress : 55%

Report 22/08/2019

Nama Project : Reminder ATM
Tahapan : Build
Detail :

1. Memperbaiki view template:
- merubah link pada setiap halaman navbar
2. Membuat fungsi pada controller data:
- fungsi mon_pegawai, menampilkan halaman monitoring mon_pegawai
- fungsi mon_sewa_tempat, menampilkan halaman monitoring sewa tempat
- fungsi reminder, menampilkan halaman reminder
- fungsi tampil_reminder, menampilkan list data reminder
3. Membuat halaman view:
- view V_mon_pegawai
- view V_mon_sewa_tempat
- view V_reminder

Progress : 55%

Nama Project : R-CARE Iterasi 1.1
Tahapan : Build
Detail :

1. Memperbaiki model get_data_r_noa
2. Memperbaiki model get_cari_data_r_noa

Progress : 100%

Report 21/08/2019

Nama Project : Reminder ATM
Tahapan : Build
Detail :

1. Memperbaiki fungsi javascript:
- pada fungsi tambah data, menambahkan kondisi bila data belum terpilih
- pada fungsi ubah data, menambahkan kondisi bila data belum terpilih

Progress : 50%

Nama Project : A-CARE Iterasi 1.1
Tahapan : Build
Detail :

1. Membuat fungsi pada controller Info:
- fungsi tampil_kontak, untuk menampilkan data kontak 
- fungsi ambil_data_ajax_kontak, menampilkan data edit kontak
- fungsi ubah_data_kontak, proses ubah data kontak
2. Memperbaiki view info_sk:
- menambahkan navbar tab kontak
- menambahkan halaman data kontak
- manambahkan fungsi javascript menampilkan data dengan dataTable ajax
- menambahkan fungsi javascript edit_kontak untuk menampilkan data yang akan diubah
- menambahkan fungsi javascript ubah_kontak untuk aksi proses ubah data kontak
3. Menambahkan data pada tabel tampak_asset:
- kamar tidur, ruang tamu, ruang keluarga, kamar tidur utama, kolam, garasi, balkon, kamar mandi

Progress : 100%

Nama Project : R-CARE Iterasi 1.1
Tahapan : Build
Detail :

1. Memperbaiki model M_noa: 
- fungsi get_data_r_noa, menampilkan data r_noa memisahkan data dengan status debitur
2. Memperbaiki model M_noa_syariah:
- fungsi get_data_r_noa, menampilkan data r_noa memisahkan data dengan status debitur
3. Memperbaiki view V_noa dan V_noa untuk syariah:
- memperbaiki untuk menampilkan data total subrogasi, recoveries, total_tagihan, total saldo tagihan

Progress : 100%

Report 20/08/2019

Nama Project : Reminder ATM
Tahapan : Build
Detail :

1. Memperbaiki aksi javascript untuk selelah ubah data pengguna
2. Menambahkan kondisi jika list nama karyawan kosong akan menghilangkan form tambah
3. Memperbaiki aksi javascript setelah klik button cancel ubah data pengguna
4. Menambahkan kondisi bila value pada button berisi 0 atau tidak, maka akan menghilangkan form tambah data pengguna
5. Menampilkan nama karyawan saat setelah button cancel diklik
6. Memperbaiki fungsi ubah_pengguna controler master:
- menambahkan parameter id untuk menjadi kondisi akan update data atau tidak
7. Membuat controler Data
8. Membuat fungsi pada controller Data: 
- fungsi kelolaan, menampilkan halaman kelolaan
- fungsi tampil tampil_kelolaan, menampilkan list data kelolaan
- fungsi tambah_kelolaan, proses tambah data kelolaan
- fungsi form_edit_kelolaan, menampilkan form edit kelolaan
- fungsi ubah_kelolaan, proses ubah data kelolaan
- fungsi hapus_kelolaan, proses hapus data kelolaan
9. Membuat model M_data
10. Membuat fungsi pada model M_data: 
- fungsi get_data_kelolaan, menampilkan data kelolaan
- fungsi edit_data_kelolaan, proses ubah data kelolaan
11. Membuat view: 
- halaman V_kelolaan
- halaman V_edit_kelolaan

Progress : 50%

Report 19/08/2019

Nama Project : Reminder ATM
Tahapan : Build
Detail :

1. Membuat fungsi pada controller Master:
- fungsi tambah_mesin, proses untuk menambahkan mesin_atm
- fungsi form_edit_mesin, menampilkan halaman form edit mesin atm
- fungsi ubah_mesin, proses untuk mengubah data master mesin
- fungsi hapus_mesin, proses untuk menghapus data mesin atm
- fungsi jenis_reminder, menampilkan halaman jenis_reminder
- fungsi tampil_jenis_reminder, menampilkan list data jenis Reminder
- fungsi tambah_jenis_reminder, proses tambah data jenis_reminder
- fungsi form_edit_jenis, menampilkan form edit jenis_reminder
- fungsi ubah_jenis_reminder, proses ubah jenis_reminder
- fungsi hapus_jenis_reminder, proses hapus jenis_reminder
2. Membuat view:
- view V_edit_mesin, menampilkan halaman edit mesin atm
- view V_jenis_reminder, menambahkan halaman awal master jenis_reminder
- view V_edit_jenis_reminder, menampilkan halaman edit jenis reminder

Progress : 40%

Report 16/08/2019

Nama Project : Reminder ATM
Tahapan : Build
Detail :

1. Memperbaiki fungsi ubah_karyawan, merubah post id_karyawan
2. Memperbaiki tampilan halaman master karyawan, tampilan modal tambah data dan ubah data
3. Menambahkan javascript untuk menampilkan alert saat data ditambahkan, dihapus, atau diedit
4. Membuat fungsi pada controller Master :
- fungsi tambah_pengguna, proses untuk tambah data pengguna
- fungsi form_edit_pengguna, untuk menampilkan form edit pengguna
- fungsi ubah_pengguna, untuk proses mengubah data pengguna
- fungsi hapus_pengguna, untuk proses mnghapus data pengguna
- fungsi mesin_atm, menampilkan halaman V_mesin_atm
- fungsi tampil_mesin_atm, menampilkan lis data mesin atm
5. Membuat fungsi pada model M_master:
- fungsi data_edit_pengguna, untuk menampilkan data pengguna sesuai id_pengguna
- fungsi get_data_mesin_atm, untuk menampilkan data mesin_atm
6. Memperbaiki view V_pengguna:
- Menambahkan proses ajax untuk menyimpan, mengubah, menghapus data pengguna
7. Membuat view halaman:
- view V_edit_pengguna, menampilkan form edit pengguna
- view V_mesin_atm, menampilkan halaman mesin_atm

Progress : 30%

Report 15/08/2019

Nama Project : Reminder ATM
Tahapan : Build
Detail :

-> Controller Master:
1. Membuat fungsi form_edit_karyawan, menampilkan form edit karyawan
2. Membuat fungsi ubah_karyawan, proses ubah data karyawan
3. Membuat fungsi hapus_karyawan, proses hapus data karyawan
4. Membuat fungsi Pengguna, untuk menampilkan halaman Pengguna
5. Membuat fungsi tampil_pengguna, untuk menampilkan list data pengguna
-> Model M_master:
1. Membuat fungsi ubah_data, proses ubah data
2. Membuat fungsi hapus_data, proses hapus data
3. Membuat fungsi data_edit_karyawan, menampilkan data sesuai id karyawan
4. Membuat fungsi get_data_pengguna, menampilkan data pengguna
5. MEmbuat fungsi get_karyawan_pengguna, menampilkan karyawan yang tidak ada pada data pengguna
-> View V_karyawan: 
1. Menambahkan form modal edit karyawan
2. Menambahkan proses ajax untuk edit karyawan
3. Menambahkan proses ajax untuk hapus data karyawan
-> Membuat view:
1. V_edit_karyawan, menampilkan form edit karyawan
2. V_pengguna, menampilkan data pengguna
-> View V_pengguna: 
1. Membuat fungsi javascript show password
2. Membuat ajax datatables menampilkan data pengguna

Progress : 20%