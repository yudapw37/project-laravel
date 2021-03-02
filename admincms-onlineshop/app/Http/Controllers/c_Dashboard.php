<?php

namespace App\Http\Controllers;

use App\msPenumpang;
use App\msTiket;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class c_Dashboard extends Controller
{
    public static function sidebar()
    {
        $username = request()->session()->get('username');

        if ($username == 'dev') {
            $group = DB::table('sys_menus')
                ->select('sys_menu_groups.id', 'sys_menu_groups.name', 'sys_menu_groups.segment_name', 'sys_menu_groups.icon', 'sys_menu_groups.ord', 'sys_menu_groups.status', 'sys_menu_groups.created_at', 'sys_menu_groups.updated_at')
                ->join('sys_menu_groups', 'sys_menus.id_group', '=', 'sys_menu_groups.id')
                ->orderBy('sys_menu_groups.ord', 'asc')
                ->distinct()
                ->get();

            $dtMenu = DB::table('sys_menus')
                ->select('sys_menus.id', 'sys_menus.id_group', 'sys_menus.name', 'sys_menus.segment_name', 'sys_menus.url', 'sys_menus.ord', 'sys_menus.status', 'sys_menus.created_at', 'sys_menus.updated_at')
                ->orderBy('sys_menus.ord', 'asc')
                ->get();

            $menu = [];
            foreach ($dtMenu as $m) {
                $menu[$m->id_group][] = [
                    'id' => $m->id,
                    'id_group' => $m->id_group,
                    'name' => $m->name,
                    'segment_name' => $m->segment_name,
                    'url' => $m->url,
                    'ord' => $m->ord,
                    'created_at' => $m->created_at,
                    'updated_at' => $m->updated_at,
                ];
            }
        } else {
            $group = DB::table('sys_permission')
                ->select('sys_menu_groups.id', 'sys_menu_groups.name', 'sys_menu_groups.segment_name', 'sys_menu_groups.icon', 'sys_menu_groups.ord', 'sys_menu_groups.created_at', 'sys_menu_groups.status', 'sys_menu_groups.updated_at')
                ->join('sys_menus', 'sys_permission.id_menu', '=', 'sys_menus.id')
                ->join('sys_menu_groups', 'sys_menus.id_group', '=', 'sys_menu_groups.id')
                ->where('sys_permission.username', '=', $username)
                ->where('sys_menu_groups.status', '<>', 1)
                ->orderBy('sys_menu_groups.ord', 'asc')
                ->distinct()
                ->get();

            $dtMenu = DB::table('sys_permission')
                ->select('sys_menus.id', 'sys_menus.id_group', 'sys_menus.name', 'sys_menus.segment_name', 'sys_menus.url', 'sys_menus.ord', 'sys_menus.status', 'sys_menus.created_at', 'sys_menus.updated_at')
                ->join('sys_menus', 'sys_permission.id_menu', '=', 'sys_menus.id')
                ->where('sys_permission.username', '=', $username)
                ->where('sys_menus.status', '<>', 1)
                ->orderBy('sys_menus.ord', 'asc')
                ->get();

            $menu = [];
            foreach ($dtMenu as $m) {
                $menu[$m->id_group][] = [
                    'id' => $m->id,
                    'id_group' => $m->id_group,
                    'name' => $m->name,
                    'segment_name' => $m->segment_name,
                    'url' => $m->url,
                    'ord' => $m->ord,
                    'status' => $m->status,
                    'created_at' => $m->created_at,
                    'updated_at' => $m->updated_at,
                ];
            }
        }

        $i = 0;
        $sidebar = [];
        foreach ($group as $g) {
            $sidebar[$i]['group'] = [
                'name' => $g->name,
                'segment_name' => $g->segment_name,
                'icon' => $g->icon,
                'status' => $g->status,
            ];
            $sidebar[$i]['menu'] = $menu[$g->id];
            $i++;
        }
        return $sidebar;
    }

    public function wilayahProvinsi(Request $request)
    {
        if (isset($_GET['search'])) {
            $provinsi['results'] = DB::table('wilayah_provinsi')
                ->select('id', 'name as text')
                ->where('name', 'like', '%' . $_GET['search'] . '%')
                ->orderBy('name', 'asc')
                ->get();
            return $provinsi;
        } else {
            $provinsi['results'] = DB::table('wilayah_provinsi')
                ->select('id', 'name as text')
                ->orderBy('name', 'asc')
                ->get();
            return $provinsi;
        }
    }

    public function wilayahKota(Request $request)
    {
        if (isset($_GET['search'])) {
            $kota['results'] = DB::table('wilayah_kota')
                ->select('id', 'name as text')
                ->where('name', 'like', '%' . $_GET['search'] . '%')
                ->where('id_provinsi', '=', $_GET['provinsi'])
                ->orderBy('name', 'asc')
                ->get();
            return $kota;
        } else {
            $kota['results'] = DB::table('wilayah_kota')
                ->select('id', 'name as text')
                ->where('id_provinsi', '=', $_GET['provinsi'])
                ->orderBy('name', 'asc')
                ->get();
            return $kota;
        }
    }

    public function dealer(Request $request)
    {
        if (isset($_GET['search'])) {
            $dealer['results'] = DB::table('ms_dealer')
                ->select('id', 'nama as text')
                ->where('nama', 'like', '%' . $_GET['search'] . '%')
                ->orderBy('nama', 'asc')
                ->get();
            return $dealer;
        } else {
            $dealer['results'] = DB::table('ms_dealer')
                ->select('id', 'nama as text')
                ->orderBy('nama', 'asc')
                ->get();
            return $dealer;
        }
    }

    public function samsat(Request $request)
    {
        if (isset($_GET['search'])) {
            $samsat['results'] = DB::table('ms_samsat')
                ->select('id', 'nama as text')
                ->where('nama', 'like', '%' . $_GET['search'] . '%')
                ->orderBy('nama', 'asc')
                ->get();
            return $samsat;
        } else {
            $samsat['results'] = DB::table('ms_samsat')
                ->select('id', 'nama as text')
                ->orderBy('nama', 'asc')
                ->get();
            return $samsat;
        }
    }

    public function petugas(Request $request)
    {
        $petugas = [];
        $search = $_GET['search'] ?? null;
        if ($search !== null) {
            $petugas['results'] = DB::table('users')
                ->select('username as id', 'name as text')
                ->where([
                    ['name', 'like', '%' . $search . '%'],
                    ['status', '=', 1],
                ])
                ->whereIn('system', [0, 1])
                ->orderBy('name', 'asc')
                ->get();
        } else {
            $petugas['results'] = DB::table('users')
                ->select('username as id', 'name as text')
                ->where('status', '=', '1')
                ->whereIn('system', [0, 1])
                ->orderBy('name', 'asc')
                ->limit(10)
                ->get();
        }
        return $petugas;
    }

    public function koridor(Request $request)
    {
        $koridor = [];
        if (isset($_GET['search'])) {
            $koridor['results'] = DB::table('ms_koridor')
                ->select('id', 'koridor as text', 'koridor as koridor', 'rute', 'trip_a', 'trip_b')
                ->where('koridor', 'like', '%' . $_GET['search'] . '%')
                ->where('status', '=', '1')
                ->orderBy('koridor', 'asc')
                ->get();
        } else {
            $koridor['results'] = DB::table('ms_koridor')
                ->select('id', 'koridor as text', 'koridor as koridor', 'rute', 'trip_a', 'trip_b')
                ->where('status', '=', '1')
                ->orderBy('koridor', 'asc')
                ->limit(10)
                ->get();
        }
        return $koridor;
    }

    public function bus(Request $request)
    {
        $bus = [];
        if (isset($_GET['search'])) {
            $bus['results'] = DB::table('ms_bus')
                ->select('id', 'nama as text')
                ->where([
                    ['nama', 'like', '%' . $_GET['search'] . '%'],
                    ['status', '=', '1'],
                ])
                ->orderBy('nama', 'asc')
                ->get();
        } else {
            $bus['results'] = DB::table('ms_bus')
                ->select('id', 'nama as text')
                ->where([
                    ['status', '=', '1'],
                ])
                ->orderBy('nama', 'asc')
                ->limit(10)
                ->get();
        }
        return $bus;
    }

    public function penumpang(Request $request)
    {
        $penumpang = [];
        $search = $_GET['search'] ?? null;
        if ($search !== null) {
            $penumpang['results'] = DB::table('ms_penumpang')
                ->select('id', 'jenis as text', 'harga')
                ->where('jenis', 'like', '%' . $search . '%')
                ->where('status', '=', '1')
                ->orderBy('jenis', 'asc')
                ->get();
        } else {
            $penumpang['results'] = DB::table('ms_penumpang')
                ->select('id', 'jenis as text', 'harga')
                ->where('status', '=', '1')
                ->orderBy('jenis', 'asc')
                ->limit(10)
                ->get();
        }
        return $penumpang;
    }

    public function penumpangID($id)
    {
        return msPenumpang::find($id);
    }

    public function tiketID($id)
    {
        return msTiket::find($id);
    }

    public function tiket(Request $request)
    {
        $tiket = [];
        $search = $_GET['search'] ?? null;
        if ($search !== null) {
            $tiket['results'] = DB::table('ms_tiket')
                ->select('id', 'kode as text', 'sisa')
                // ->where('jenis', 'like', '%' . $search . '%')
                ->where('status', '=', '1')
                ->orderBy('text', 'asc')
                ->get();
        } else {
            $tiket['results'] = DB::table('ms_tiket')
                ->select('id', 'kode as text', 'sisa')
                ->where('status', '=', '1')
                ->orderBy('text', 'asc')
                ->limit(10)
                ->get();
        }
        return $tiket;
    }

    public function area(Request $request)
    {
        $koridor = [];
        if (isset($_GET['search'])) {
            $koridor['results'] = DB::table('ms_area')
                ->select('id', 'nama_area as text')
                ->where('nama_area', 'like', '%' . $_GET['search'] . '%')
                ->where('status', '=', '1')
                ->orderBy('nama_area', 'asc')
                ->get();
        } else {
            $koridor['results'] = DB::table('ms_area')
                ->select('id', 'nama_area as text')
                ->where('status', '=', '1')
                ->orderBy('nama_area', 'asc')
                ->limit(10)
                ->get();
        }
        return $koridor;
    }

    public function provider(Request $request)
    {
        $koridor = [];
        if (isset($_GET['search'])) {
            $koridor['results'] = DB::table('ms_provider')
                ->select('id', 'nama_provider as text')
                ->where('ms_provider', 'like', '%' . $_GET['search'] . '%')
                ->orderBy('nama_provider', 'asc')
                ->get();
        } else {
            $koridor['results'] = DB::table('ms_provider')
                ->select('id', 'nama_provider as text')
                ->orderBy('nama_provider', 'asc')
                ->limit(10)
                ->get();
        }
        return $koridor;
    }

    public function tipeProvider($prov)
    {
    try{
        $koridor = [];
        if (isset($_GET['search'])) {
            $koridor['results'] = DB::table('ms_provider_tipe')
                ->select('id', 'tipe as text')
                // ->where('id_provider', 'like', '%' . $_GET['search'] . '%')
                ->where('id_provider', '=',$prov)
                ->orderBy('id', 'asc')
                ->get();
        } else {
            $koridor['results'] = DB::table('ms_provider_tipe')
                ->select('id', 'tipe as text')
                ->orderBy('id', 'asc')
                ->where('id_provider', '=',$prov)
                ->limit(10)
                ->get();
        }
        return $koridor;
    
} catch (\Exception $ex) {
    return response()->json($prov);
}
    }

    public function tipePembelian()
    {
    try{
        $koridor = [];
        if (isset($_GET['search'])) {
            $koridor['results'] = DB::table('ms_tipe_pembelian')
                ->select('id', 'nama as text')
                 ->where('nama', 'like', '%' . $_GET['search'] . '%')
                ->orderBy('id', 'asc')
                ->get();
        } else {
            $koridor['results'] = DB::table('ms_tipe_pembelian')
                ->select('id', 'nama as text')
                ->orderBy('id', 'asc')
      
                ->limit(10)
                ->get();
        }
        return $koridor;
    
} catch (\Exception $ex) {
    return response()->json($prov);
}
    }

    public function supplier(Request $request)
    {
        $koridor = [];
        if (isset($_GET['search'])) {
            $koridor['results'] = DB::table('ms_supplier')
                ->select('id', 'nama as text')
                ->where('ms_supplier', 'like', '%' . $_GET['search'] . '%')
                ->orderBy('nama', 'asc')
                ->get();
        } else {
            $koridor['results'] = DB::table('ms_supplier')
                ->select('id', 'nama as text')
                ->orderBy('nama', 'asc')
                ->limit(10)
                ->get();
        }
        return $koridor;
    }

    public function admin(Request $request)
    {
        $koridor = [];
        if (isset($_GET['search'])) {
            $koridor['results'] = DB::table('users')
                ->select('id','name as text')
                ->where('name', 'like', '%' . $_GET['search'] . '%')
                ->orderBy('name', 'asc')
                ->get();
        } else {
            $koridor['results'] = DB::table('users')
                ->select('id', 'name as text')
                ->orderBy('name', 'asc')
                ->limit(10)
                ->get();
        }
        return $koridor;
    }

    public function akun(Request $request)
    {
        $koridor = [];
        if (isset($_GET['search'])) {
            $koridor['results'] = DB::table('ms_akun')
                ->select('id','nama as text')
                ->where('nama', 'like', '%' . $_GET['search'] . '%')
                ->orderBy('id', 'asc')
                ->get();
        } else {
            $koridor['results'] = DB::table('ms_akun')
                ->select('id', 'nama as text')
                ->orderBy('id', 'asc')
                ->limit(10)
                ->get();
        }
        return $koridor;
    }

    public function akunTipe(Request $request)
    {
        $koridor = [];
        if (isset($_GET['search'])) {
            $koridor['results'] = DB::table('ms_akun_tipe')
                ->select('id','tipe as text')
                ->where('tipe', 'like', '%' . $_GET['search'] . '%')
                ->orderBy('id', 'asc')
                ->get();
        } else {
            $koridor['results'] = DB::table('ms_akun_tipe')
                ->select('id', 'tipe as text')
                ->orderBy('id', 'asc')
                ->limit(10)
                ->get();
        }
        return $koridor;
    }

    public function tipe(Request $request)
    {
        $koridor = [];
        if (isset($_GET['search'])) {
            $koridor['results'] = DB::table('ms_tipe')
                ->select('id','nama as text')
                ->where('nama', 'like', '%' . $_GET['search'] . '%')
                ->orderBy('id', 'asc')
                ->get();
        } else {
            $koridor['results'] = DB::table('ms_tipe')
                ->select('id', 'nama as text')
                ->orderBy('id', 'asc')
                ->limit(10)
                ->get();
        }
        return $koridor;
    }

}
