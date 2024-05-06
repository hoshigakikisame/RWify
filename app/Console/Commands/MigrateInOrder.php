<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateInOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate-in-order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute the migrations in the order specified in the file app/Console/Comands/MigrateInOrder.php \n Drop all the table in db before execute the command.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $migrations = [
            // laravel default migrations
            '0001_01_01_000001_create_cache_table.php',

            // custom migrations
            'tb_user/2024_03_15_151817_create_tb_user.php',
            'tb_rukun_warga/2024_03_15_145807_create_tb_rukun_warga.php',
            'tb_rukun_tetangga/2024_03_15_151505_create_tb_rukun_tetangga.php',
            'tb_user/2024_03_16_122638_create_tb_user_to_tb_rukun_tetangga_relation.php',
            'tb_pembayaran_iuran/2024_03_15_153146_create_tb_pembayaran_iuran.php',
            'tb_iuran/2024_03_15_153450_create_tb_iuran.php',
            'tb_pengumuman/2024_03_15_153925_create_tb_pengumuman.php',
            'tb_umkm/2024_03_15_154051_create_tb_umkm.php',
            'tb_log/2024_03_15_155105_create_tb_log.php',
            'tb_password_reset_token/2024_03_15_155240_create_tb_password_reset_token.php',
            'tb_reservasi_jadwal_temu/2024_04_25_032730_create_tb_reservasi_jadwal_temu.php',
            'tb_pengaduan/2024_04_28_153746_create_tb_pengaduan.php',
        ];

        // set foreign key check to 0
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        // drop all the tables
        $tables = DB::select('SHOW TABLES');
        foreach ($tables as $table) {
            $table_array = get_object_vars($table);
            $table_name = $table_array[key($table_array)];
            DB::statement("DROP TABLE $table_name");
        }

        // execute the migrations
        foreach ($migrations as $migration) {
            $this->call('migrate:refresh', [
                '--path' => "database/migrations/{$migration}"
            ]);
        }

        // set foreign key check to 1
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
