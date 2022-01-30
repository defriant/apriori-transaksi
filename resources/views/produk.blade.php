@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-headline">
            <div class="panel-heading">
                <h3 class="panel-title">Produk</h3>
                <div class="right">
                    <button type="button" data-toggle="modal" data-target="#modalInput"><i class="far fa-plus"></i>&nbsp; Tambah produk</button>
                </div>
            </div>
            <div class="panel-body">
                <table class="table" id="table-produk">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="loading">12345</span></td>
                            <td><span class="loading">Lorem, ipsum.</span></td>
                            <td><span class="loading">12345</span></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><span class="loading">12345</span></td>
                            <td><span class="loading">Lorem, ipsum.</span></td>
                            <td><span class="loading">12345</span></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><span class="loading">12345</span></td>
                            <td><span class="loading">Lorem, ipsum.</span></td>
                            <td><span class="loading">12345</span></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalInput" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah produk</h4>
            </div>
            <div class="modal-body">
                <p>Kode</p>
                <input type="text" id="input-kode" class="form-control">
                <br>
                <p>Nama</p>
                <input type="text" id="input-nama" class="form-control">
                <br>
                <p>Harga</p>
                <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input class="form-control input-number" id="input-harga" type="text">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-input-data">Tambahkan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Produk</h4>
            </div>
            <div class="modal-body">
                <p>Kode Produk</p>
                <input type="text" id="edit-id" class="form-control" disabled>
                <br>
                <p>Nama Produk</p>
                <input type="text" id="edit-nama" class="form-control">
                <br>
                <p>Harga</p>
                <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input class="form-control input-number" id="edit-harga" type="text">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-edit-data">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDeleteData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h4 class="text-center" style="margin-top: 3rem" id="delete-warning-message"></h4>
                <input type="hidden" id="delete-id">
                <div style="margin-top: 5rem; text-align: center">
                    <button type="button" class="btn btn-danger" id="btn-delete-data">Hapus</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection