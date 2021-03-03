<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('map')->insert([[
            'key' => 'dongson',
            'title' => 'Đồng Sơn',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'quangxuong',
            'title' => 'Quảng Xương',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'samson',
            'title' => 'Sầm Sơn',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'thanhhoa',
            'title' => 'TP. Thanh Hoa',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'nongcong',
            'title' => 'Nông Cống',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'quanhoa',
            'title' => 'Quan Hóa',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'muonglat',
            'title' => 'MƯỜNG LÁT',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'langchanh',
            'title' => 'Lang Chánh',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'bimson',
            'title' => 'Bỉm Sơn',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'hoanghoa',
            'title' => 'Hoằng Hoá',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'honme',
            'title' => 'Hòn Me',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'hauloc',
            'title' => 'Hậu Lộc',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'hatrung',
            'title' => 'Hà Trung',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'hatrung2',
            'title' => 'Hà Trung 2',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'yendinh',
            'title' => 'Yên Định',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'daohoang1',
            'title' => 'Đảo hoang',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'daohoang2',
            'title' => 'Đảo hoang',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'daohoang3',
            'title' => 'Đảo hoang',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'daohoang4',
            'title' => 'Đảo hoang',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'daohoang5',
            'title' => 'Đảo hoang',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'honvat',
            'title' => 'Hòn Vát',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'daohoang6',
            'title' => 'Đảo hoang',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'daohoang7',
            'title' => 'Đảo hoang',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'honvang',
            'title' => 'Hòn Vàng',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'honmee',
            'title' => 'Hòn Mê',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'tinhgia',
            'title' => 'Tĩnh Gia',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'hondot',
            'title' => 'Hòn Đốt',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'honso1',
            'title' => 'Hòn Sổ 1',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'daohoang8',
            'title' => 'Đảo hoang',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'daohoang9',
            'title' => 'Đảo hoang',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'daohoang10',
            'title' => 'Đảo hoang',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'daohoang11',
            'title' => 'Đảo hoang',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'daohoang12',
            'title' => 'Đảo hoang',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'daohoang13',
            'title' => 'Đảo hoang',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'tinhgia',
            'title' => 'Tỉnh Gia',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'ngoclac',
            'title' => 'Ngọc Lặc',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'thachthanh',
            'title' => 'Thạch Thành',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'vinhloc',
            'title' => 'Vĩnh Lộc',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'thoxuan',
            'title' => 'Thọ Xuân',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'nhuxuan',
            'title' => 'Như Xuân',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'thuongxuan',
            'title' => 'Thường Xuân',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'trieuson',
            'title' => 'Triệu Sơn',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'bathuoc',
            'title' => 'Bá Thước',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'ngason',
            'title' => 'Nga Sơn',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'thieuson',
            'title' => 'Thiệu Sơn',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'camthuy',
            'title' => 'Cẩm Thuỷ',
            'description' => '',
            'language_id'=>1,
        ],
        [
            'key' => 'nhuthanh',
            'title' => 'Như Thanh',
            'description' => '',
            'language_id'=>1,
        ]],
    );
    }
}
