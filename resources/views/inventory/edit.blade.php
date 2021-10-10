@extends('layouts.app')
@section('content')
<div class="container">
    <form method="POST" action="{{ route('inventory.update',$inventory->id) }}">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="exampleInputEmail1">Nama</label>
            <input type="text" class="form-control" name="name" value="{{ $inventory->name }}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Department</label>
            <input type="text" class="form-control" name="department" value="{{ $inventory->department }}">
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
                @foreach ($detailInventory as $item)
                <tr>
                    <input type="text" name="" id="id" hidden value="{{ $item->id }}">
                    <td><input type="text" name="nama_alat[]" id="" class="form-control" value="{{ $item->nama_alat }}"></td>
                    <td><input type="number" name="jumlah[]" id="" class="form-control" value="{{ $item->jumlah }}"></td>
                    <td><a class="btn btn-danger" id="delete-data">X</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<script>
    $(document).on('click', '#btn-tambah', function () {
        addData();
    });

    function addData(nama_barang, jumlah) {
        let tambah_data ='<tr><td><input type="text" name="nama_alat[]" id="" class="form-control"></td><td><input type="number" name="jumlah[]" id="" class="form-control"></td><td><button class="btn btn-danger" id="delete">X</button></td></tr>';
        $('.tbody').append(tambah_data);
    }
    $(document).on('click', '#delete', function () {
        $(this).parent().parent().remove();
    });
    $(document).on('click','#delete-data', function () {
        const id = $('#id').val();
        $.ajax({
            url: "edit/delete",
            data: {
                'id':id
            },
            method: 'GET',
            success: function (response) {
                alert("Data Berhasil Dihapus");
            }
        });
        $(this).parent().parent().remove();
    });
</script>
@endsection
