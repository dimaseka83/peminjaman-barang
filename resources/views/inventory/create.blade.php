@extends('layouts.app')
@section('content')
<div class="container">
    <form method="POST" action="{{ route('inventory.store') }}">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Nama</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Department</label>
            <input type="text" class="form-control" name="department">
        </div>
        <a class="btn btn-success" id="btn-tambah">Add Data</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th colspan="2">Jumlah</th>
                </tr>
            </thead>
            <tbody class="tbody">
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<script>
    $(document).on('click','#btn-tambah', function () {
        addData();
    });
    function addData(nama_barang, jumlah) { 
        let tambah_data = '<tr><td><input type="text" name="nama_alat[]" id="" class="form-control"></td><td><input type="number" name="jumlah[]" id="" class="form-control"></td><td><button class="btn btn-danger" id="delete">X</button></td></tr>';
        $('.tbody').append(tambah_data);
    }
    $(document).on('click','#delete', function () {
        $(this).parent().parent().remove();
    });
</script>
@endsection
