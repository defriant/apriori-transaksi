<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\TProduk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WebController extends Controller
{
    function random($type, $length)
    {
        $result = "";
        if ($type == 'char') {
            $char = 'ABCDEFGHJKLMNPRTUVWXYZ';
            $max        = strlen($char) - 1;
            for ($i = 0; $i < $length; $i++) {
                $rand = mt_rand(0, $max);
                $result .= $char[$rand];
            }
            return $result;
        } elseif ($type == 'num') {
            $char = '0123456789';
            $max        = strlen($char) - 1;
            for ($i = 0; $i < $length; $i++) {
                $rand = mt_rand(0, $max);
                $result .= $char[$rand];
            }
            return $result;
        } elseif ($type == 'mix') {
            $char = 'A1B2C3D4E5F6G7H8J9KLMNPRTUVWXYZ';
            $max = strlen($char) - 1;
            for ($i = 0; $i < $length; $i++) {
                $rand = mt_rand(0, $max);
                $result .= $char[$rand];
            }
            return $result;
        }
    }

    function multiArrSearch($val, $arr)
    {
        foreach ($arr as $arrKey => $arrVal) {
            $cek = array_search($val, $arrVal);
            if ($cek) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function login_attempt(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect('/dashboard');
        } else {
            Session::flash('failed');
            return redirect()->back()->withInput($request->all());
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function get_dashboard()
    {
        $produk = Produk::all();
        $total_terjual = TProduk::all()->sum('jumlah');
        $produkSort = [];

        foreach ($produk as $p) {
            $produkSort[] = [
                "nama" => $p->nama,
                "terjual" => $p->tproduk->sum('jumlah')
            ];
        }

        usort($produkSort, function ($a, $b) {
            return $a['terjual'] < $b['terjual'];
        });

        $produkTerlaris = array_slice($produkSort, 0, 5);

        $chart_data = [];
        foreach ($produkSort as $ps) {
            $chart_data["label"][] = $ps["nama"];
            $chart_data["value"][] = $ps["terjual"];
        }

        $response = [
            "response" => "success",
            "produk_terlaris" => $produkTerlaris,
            "total_terjual" => $total_terjual,
            "total_produk" => $produk->count(),
            "chart_data" => $chart_data
        ];
        return response()->json($response);
    }

    public function get_produk()
    {
        $produk = Produk::all();
        foreach ($produk as $p) {
            $p->harga = "Rp. " . number_format($p->harga);
        }

        $response = [
            "response" => "success",
            "data" => $produk
        ];
        return response()->json($response);
    }

    public function input_produk(Request $request)
    {
        $cek = Produk::where('id', $request->id)->first();
        if ($cek) {
            $response = [
                "response" => "failed",
                "message" => "Kode produk " . $request->kode . " telah terdaftar"
            ];
            return response()->json($response);
        } else {
            Produk::create([
                'id' => $request->id,
                'nama' => $request->nama,
                'harga' => $request->harga
            ]);
            $response = [
                "response" => "success",
                "message" => "Berhasil menambahkan produk"
            ];
            return response()->json($response);
        }
    }

    public function update_produk(Request $request)
    {
        Produk::where('id', $request->id)->update([
            "nama" => $request->nama,
            "harga" => $request->harga
        ]);
        $response = [
            "response" => "success",
            "message" => "Produk " . $request->id . " berhasil di update"
        ];
        return response()->json($response);
    }

    public function delete_produk(Request $request)
    {
        Produk::where('id', $request->id)->delete();
        $response = [
            "response" => "success",
            "message" => "Berhasil menghapus produk " . $request->id
        ];
        return response()->json($response);
    }

    public function get_transaksi(Request $request)
    {
        $transaksi = Transaksi::where('periode', date('Y-m-d', strtotime($request->periode)))->orderBy('created_at')->get();
        $data = [];

        foreach ($transaksi as $t) {
            $produk = '';
            foreach ($t->tproduk as $tpKey => $tpVal) {
                if ($t->tproduk->count() == $tpKey + 1) {
                    $produk .= $tpVal->nama;
                } else {
                    $produk .= $tpVal->nama . ", ";
                }
            }

            $data[] = [
                "invoice" => $t->id,
                "periode" => date('d F Y', strtotime($t->periode)),
                "waktu" => date('H:i', strtotime($t->created_at)),
                "produk" => $produk
            ];
        }

        $response = [
            "response" => "success",
            "data" => $data
        ];
        return response()->json($response);
    }

    public function input_transaksi(Request $request)
    {
        $inv = "INV" . $this->random('num', 4);
        while (true) {
            $cek = Transaksi::where('id', $inv)->first();
            if ($cek) {
                $inv = "INV" . $this->random('num', 4);
            } else {
                break;
            }
        }

        $total_belanja = 0;

        foreach ($request->produk as $p) {
            $produk = Produk::find($p["produk"]);
            $harga = $produk->harga;
            $jumlah = $p["jumlah"];
            $total = $harga * $p["jumlah"];
            $total_belanja = $total_belanja + $total;

            TProduk::create([
                'periode' => date('Y-m-d', strtotime($request->periode)),
                'invoice' => $inv,
                'id_produk' => $produk->id,
                'nama' => $produk->nama,
                'harga' => $harga,
                'jumlah' => $jumlah,
                'total' => $total
            ]);
        }

        Transaksi::create([
            'id' => $inv,
            'periode' => date('Y-m-d', strtotime($request->periode)),
            'total' => $total_belanja
        ]);

        $response = [
            "response" => "success",
            "message" => "Berhasil menyimpan data transaksi"
        ];
        return response()->json($response);
    }

    public function detail_transaksi(Request $request)
    {
        $transaksi = Transaksi::find($request->id);
        $tproduk = [];

        foreach ($transaksi->tproduk as $tp) {
            $tproduk[] = [
                "produk" => $tp->nama,
                "harga" => number_format($tp->harga),
                "jumlah" => $tp->jumlah,
                "total" => number_format($tp->total)
            ];
        }

        $data = [
            "invoice" => $transaksi->id,
            "tanggal" => date('d F Y', strtotime($transaksi->periode)),
            "waktu" => date('H:i', strtotime($transaksi->created_at)),
            "produk" => $tproduk,
            "total" => "Rp " . number_format($transaksi->total)
        ];

        return response()->json($data);
    }

    function apriori($periode, $minSupport, $minConfidence)
    {
        $periode = date('Y-m-d', strtotime($periode));
        $minSupport = $minSupport;
        $minConfidence = $minConfidence;

        $transaksi = Transaksi::where('periode', $periode)->get();
        $totalTransaksi = $transaksi->count();
        $rawProduk = [];

        foreach ($transaksi as $t) {
            foreach ($t->tproduk as $tp) {
                if (!in_array($tp->nama, $rawProduk)) {
                    $rawProduk[] = $tp->nama;
                }
            }
        }

        $itemset1 = [];
        $itemset1loop = count($rawProduk);
        for ($i = 0; $i < $itemset1loop; $i++) {
            $t = TProduk::where('periode', $periode)->where('nama', $rawProduk[$i])->get()->count();
            $support = $t / $totalTransaksi;
            if ($support >= $minSupport) {
                $itemset1[] = [
                    "produk" => $rawProduk[$i],
                    "transaksi" => $t,
                    "support" => (float) number_format((float)$support, '2', '.')
                ];
            } else {
                unset($rawProduk[$i]);
            }
        }

        $produk = [];
        foreach ($rawProduk as $rp) {
            $produk[] = $rp;
        }

        $itemset2 = [];
        for ($i = 0; $i < count($produk); $i++) {
            for ($j = $i + 1; $j < count($produk); $j++) {
                $p = $produk[$i] . ", " . $produk[$j];
                $pArr = explode(', ', $p);
                $t = 0;

                foreach ($transaksi as $trans) {
                    $tproduk = [];
                    $join = true;

                    foreach ($trans->tproduk as $tp) {
                        $tproduk[] = $tp->nama;
                    }

                    foreach ($pArr as $pVal) {
                        if (in_array($pVal, $tproduk)) {
                            $join = true;
                        } else {
                            $join = false;
                            break;
                        }
                    }

                    if ($join == true) {
                        $t = $t + 1;
                    }
                }

                $support = $t / $totalTransaksi;
                if ($support >= $minSupport) {
                    $itemset2[] = [
                        "produk" => $p,
                        "produkArr" => $pArr,
                        "transaksi" => $t,
                        "support" => (float) number_format((float)$support, '2', '.')
                    ];
                }
            }
        }

        $itemset3 = [];
        for ($i = 0; $i < count($produk); $i++) {
            for ($j = $i + 1; $j < count($produk); $j++) {
                for ($k = $j + 1; $k < count($produk); $k++) {
                    $p = $produk[$i] . ", " . $produk[$j] . ", " . $produk[$k];
                    $pArr = explode(', ', $p);
                    $t = 0;

                    foreach ($transaksi as $trans) {
                        $tproduk = [];
                        $join = true;

                        foreach ($trans->tproduk as $tp) {
                            $tproduk[] = $tp->nama;
                        }

                        foreach ($pArr as $pVal) {
                            if (in_array($pVal, $tproduk)) {
                                $join = true;
                            } else {
                                $join = false;
                                break;
                            }
                        }

                        if ($join == true) {
                            $t = $t + 1;
                        }
                    }

                    $support = $t / $totalTransaksi;
                    if ($support >= $minSupport) {
                        $itemset3[] = [
                            "produk" => $p,
                            "produkArr" => $pArr,
                            "transaksi" => $t,
                            "support" => (float) number_format((float)$support, '2', '.')
                        ];
                    }
                }
            }
        }

        $itemset4 = [];
        for ($i = 0; $i < count($produk); $i++) {
            for ($j = $i + 1; $j < count($produk); $j++) {
                for ($k = $j + 1; $k < count($produk); $k++) {
                    for ($l = $k + 1; $l < count($produk); $l++) {
                        $p = $produk[$i] . ", " . $produk[$j] . ", " . $produk[$k] . ", " . $produk[$l];
                        $pArr = explode(', ', $p);
                        $t = 0;

                        foreach ($transaksi as $trans) {
                            $tproduk = [];
                            $join = true;

                            foreach ($trans->tproduk as $tp) {
                                $tproduk[] = $tp->nama;
                            }

                            foreach ($pArr as $pVal) {
                                if (in_array($pVal, $tproduk)) {
                                    $join = true;
                                } else {
                                    $join = false;
                                    break;
                                }
                            }

                            if ($join == true) {
                                $t = $t + 1;
                            }
                        }

                        $support = $t / $totalTransaksi;
                        if ($support >= $minSupport) {
                            $itemset4[] = [
                                "produk" => $p,
                                "produkArr" => $pArr,
                                "transaksi" => $t,
                                "support" => (float) number_format((float)$support, '2', '.')
                            ];
                        }
                    }
                }
            }
        }


        $rule2itemset = [];
        foreach ($itemset2 as $item2) {
            $rule1 = "Jika membeli " . $item2["produkArr"][0] . " maka membeli " . $item2["produkArr"][1];
            $getIndex = array_search($item2["produkArr"][0], array_column($itemset1, "produk"));
            $rule1a = $itemset1[$getIndex]["transaksi"];

            $rule2 = "Jika membeli " . $item2["produkArr"][1] . " maka membeli " . $item2["produkArr"][0];
            $getIndex = array_search($item2["produkArr"][1], array_column($itemset1, "produk"));
            $rule2a = $itemset1[$getIndex]["transaksi"];

            $rule2itemset[] = [
                "key" => $item2["produkArr"][0] . ", " . $item2["produkArr"][1],
                "rule" => $rule1,
                "ab" => (float) $item2["transaksi"],
                "a" => $rule1a,
                "confidence" => (float) number_format((float)$item2["transaksi"] / $rule1a, '2', '.')
            ];
            $rule2itemset[] = [
                "key" => $item2["produkArr"][0] . ", " . $item2["produkArr"][1],
                "rule" => $rule2,
                "ab" => (float) $item2["transaksi"],
                "a" => $rule1a,
                "confidence" => (float) number_format((float)$item2["transaksi"] / $rule2a, '2', '.')
            ];
        }

        $rule3itemset = [];
        foreach ($itemset3 as $item3) {
            for ($i = 0; $i < count($item3["produkArr"]); $i++) {
                for ($j = $i + 1; $j < count($item3["produkArr"]); $j++) {
                    $rule3ab = $item3["produkArr"][$i] . ", " . $item3["produkArr"][$j];
                    $getIndex = array_search($rule3ab, array_column($itemset2, "produk"));
                    $rule3ab = $itemset2[$getIndex]["transaksi"];

                    $arr = [];
                    $arr[] = $item3["produkArr"][$i];
                    $arr[] = $item3["produkArr"][$j];
                    $diff = array_diff($item3["produkArr"], $arr);

                    foreach ($diff as $d) {
                        $rule3then = $d;
                    }

                    $rule3itemset[] = [
                        "key" => $item3["produkArr"][0] . ", " . $item3["produkArr"][1] . ", " . $item3["produkArr"][2],
                        "rule" => "Jika membeli " . $item3["produkArr"][$i] . " dan " . $item3["produkArr"][$j] . " maka membeli " . $rule3then,
                        "ab" => $rule3ab,
                        "a" => (float)$item2["transaksi"],
                        "confidence" => (float) number_format((float)$item2["transaksi"] / $rule3ab, '2', '.')
                    ];
                }
            }
        }

        $rule4itemset = [];
        foreach ($itemset4 as $item4) {
            for ($i = 0; $i < count($item4["produkArr"]); $i++) {
                for ($j = $i + 1; $j < count($item4["produkArr"]); $j++) {
                    for ($k = $j + 1; $k < count($item4["produkArr"]); $k++) {
                        $rule4ab = $item4["produkArr"][$i] . ", " . $item4["produkArr"][$j];
                        $getIndex = array_search($rule4ab, array_column($itemset3, "produk"));
                        $rule4ab = $itemset3[$getIndex]["transaksi"];

                        $arr = [];
                        $arr[] = $item4["produkArr"][$i];
                        $arr[] = $item4["produkArr"][$j];
                        $arr[] = $item4["produkArr"][$k];
                        $diff = array_diff($item4["produkArr"], $arr);

                        foreach ($diff as $d) {
                            $rule4then = $d;
                        }

                        $rule4itemset[] = [
                            "key" => $item4["produkArr"][0] . ", " . $item4["produkArr"][1] . ", " . $item4["produkArr"][2] . ", " . $item4["produkArr"][3],
                            "rule" => "Jika membeli " . $item4["produkArr"][$i] . " dan " . $item4["produkArr"][$j] . " dan " . $item4["produkArr"][$k] . " maka membeli " . $rule4then,
                            "ab" => $rule4ab,
                            "a" => (float)$item3["transaksi"],
                            "confidence" => (float) number_format((float)$item3["transaksi"] / $rule4ab, '2', '.')
                        ];
                    }
                }
            }
        }

        $assosiasi = [];

        foreach ($rule2itemset as $r2) {
            if ($r2["confidence"] >= $minConfidence) {
                $rule = $r2["rule"];
                $getIndex = array_search($r2["key"], array_column($itemset2, "produk"));
                $support = $itemset2[$getIndex]["support"];
                $confidence = $r2["confidence"];
                $result = $support * $confidence;

                $assosiasi[] = [
                    "rule" => $rule,
                    "support" => $support,
                    "confidence" => $confidence,
                    "result" => (float) number_format((float)$result, '2', '.')
                ];
            }
        }

        foreach ($rule3itemset as $r3) {
            if ($r3["confidence"] >= $minConfidence) {
                $rule = $r3["rule"];
                $getIndex = array_search($r3["key"], array_column($itemset3, "produk"));
                $support = $itemset3[$getIndex]["support"];
                $confidence = $r3["confidence"];
                $result = $support * $confidence;

                $assosiasi[] = [
                    "rule" => $rule,
                    "support" => $support,
                    "confidence" => $confidence,
                    "result" => (float) number_format((float)$result, '2', '.')
                ];
            }
        }

        foreach ($rule4itemset as $r4) {
            if ($r4["confidence"] >= $minConfidence) {
                $rule = $r4["rule"];
                $getIndex = array_search($r4["key"], array_column($itemset4, "produk"));
                $support = $itemset3[$getIndex]["support"];
                $confidence = $r4["confidence"];
                $result = $support * $confidence;

                $assosiasi[] = [
                    "rule" => $rule,
                    "support" => $support,
                    "confidence" => $confidence,
                    "result" => (float) number_format((float)$result, '2', '.')
                ];
            }
        }

        $final = [];
        foreach ($assosiasi as $assos) {
            if ($assos["result"] >= $minConfidence) {
                $final[] = $assos["rule"];
            }
        }

        $response = [
            "produk" => $produk,
            "itemset1" => $itemset1,
            "itemset2" => $itemset2,
            "itemset3" => $itemset3,
            "itemset4" => $itemset4,
            "rule2itemset" => $rule2itemset,
            "rule3itemset" => $rule3itemset,
            "rule4itemset" => $rule4itemset,
            "assosiasi" => $assosiasi,
            "final" => $final
        ];

        return $response;
    }

    public function start_asosiasi(Request $request)
    {
        $cek = Transaksi::where('periode', date('Y-m-d', strtotime($request->periode)))->get();
        if (count($cek) > 0) {
            $result = $this->apriori(date('Y-m-d', strtotime($request->periode)), $request->minSupport, $request->minConfidence);
            $response = [
                "response" => "success",
                "message" => "Success asosiasi data",
                "data" => $result
            ];
        } else {
            $response = [
                "response" => "failed",
                "message" => "Transaksi tanggal " . date('d F Y', strtotime($request->periode)) . " tidak ditemukan !"
            ];
        }

        return response()->json($response);
    }

    // public function generate_timestamp()
    // {
    //     $produk = Produk::all();
    //     foreach ($produk as $p) {
    //         Produk::where('id', $p->id)->update([
    //             'created_at' => date('Y-m-d H:i:s'),
    //             'updated_at' => date('Y-m-d H:i:s')
    //         ]);
    //     }
    // }
}
