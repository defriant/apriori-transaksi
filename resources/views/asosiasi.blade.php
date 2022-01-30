@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-headline">
            <div class="panel-heading">
                <h3 class="panel-title">Asosiasi</h3>
                <p class="panel-subtitle">Asosiasi produk dengan metode Apriori</p>
            </div>
            <div class="panel-body">
                <p>Tanggal Transaksi</p>
                <input type="text" id="periode" class="form-control date-picker" style="width: 70%" readonly>
                <br>
                <p>Min Support</p>
                <input type="number" step="0.1" id="min-support" class="form-control min" style="width: 40%; margin-bottom: 0.4rem">
                <span style="font-size: 1.3rem; opacity: .75">Range : 0.1 - 1.0</span>
                <br><br>
                <p>Min Confidence</p>
                <input type="number" step="0.1" id="min-confidence" class="form-control min" style="width: 40%; margin-bottom: 0.4rem">
                <span style="font-size: 1.3rem; opacity: .75">Range : 0.1 - 1.0</span>
                <br>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="text-right"><button id="btn-asosiasi-data" class="btn btn-primary">Mulai Asosiasi</button></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="hasil-asosiasi" style="display: none">
    
</div>
@endsection
