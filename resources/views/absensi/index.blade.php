@extends('template.layout')

@push('style')

@endpush

@section('content')
<section class="content">
        <div class="right_col" role="main">
            <!-- /top tiles -->
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="dashboard_graph">
                        <div class="row x_title">
                            <div class="col-md-6">
                                <h3>
                                JCASHIER
                                </h3>
                            </div>
                            <div class="col-md-6">
                                <div id="reportrange" class="pull-right"
                                    style="
                                    background: #fff;
                                    cursor: pointer;
                                    padding: 5px 10px;
                                    border: 1px solid #ccc;
                                ">
                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                    <span>December 30, 2023 - April 30, 2024</span>
                                    <b class="caret"></b>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-3 bg-white">
                            <div class="x_title">
                                <h2>Absensi Karyawan</h2>
                                <div class="float-right ml-auto">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modalFormAbsensi">
                                        Tambah Karyawan
                                    </button>
                                    <a href="{{route('export-absensi')}}" class="btn btn-success">
                                    <i class="fa fa-file-excel"></i> Export
                                </a>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#importAbsensi">
                                    <i class="fa fa-file-excel"></i> Import
                                </button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            

                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                            </ul>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" \
                                            aria-label="Close">
                                        </button>
                                    </div>
                                @endif
                                <div class="mt-3">
                                    @include('absensi.data')
                                </div>
                                <!-- Button trigger modal -->
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <br />
        </div>
        @include('absensi.modal')
        @include('absensi.form')
    </section>
@endsection

@push('script')
<script>
        $('#tbl-absensi').DataTable({"dom": '<"float-right" f><"float=left"l>rt<"bottom" ip>'});

        $('.alert-success').fadeTo(2000,500).slideUp(500, function(){
             $('.alert-success').slideUp(500)
        })
        $('.alert-danger').fadeTo(2000,500).slideUp(500, function(){
            $('.alert-danger').slideUp(500)
        })

        console.log($('.delete-data'))

        $('.delete-data').on('click', function(e){
        e.preventDefault()
        const data = $(this).closest('tr').find('td:eq(1)').text()
        Swal.fire({
            title: `Apakah data <span style="color:red">${data}</span> akan dihapus?`,
            text: "Data tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus data ini!'
        }).then((result) => {
            if (result.isConfirmed)
              $(e.target).closest('form').submit()
            else swal.close()
        })
    })

    $('#modalFormAbsensi').on('show.bs.modal', function(e) {
        const btn = $(e.relatedTarget)
        const mode = btn.data('mode')
        const nama_karyawan = btn.data('nama_karyawan')
        const tgl_masuk = btn.data('tgl_masuk')
        const waktu_masuk = btn.data('waktu_masuk')
        const status = btn.data('status')
        const waktu_keluar = btn.data('waktu_keluar')
        const id = btn.data('id')
        const modal = $(this)
        if(mode === 'edit'){
            console.log(nama_karyawan)
            modal.find('.modal-title').text('Edit Data')
            modal.find('#nama_karyawan').val(nama_karyawan)
            modal.find('#tgl_masuk').val(tgl_masuk)
            modal.find('#waktu_masuk').val(waktu_masuk)
            modal.find('#status').val(status)
            modal.find('#waktu_keluar').val(waktu_keluar)
            modal.find('.modal-body form').attr('action','{{ url("absensi")}}/' + id)
            modal.find('#method').html('@method("PATCH")')
        }else{
            modal.find('.modal-title').text('Input Data Karyawan')
            modal.find('#nama_karyawan').val('')
            modal.find('#tgl_masuk').val('')
            modal.find('#waktu_masuk').val('')
            modal.find('#status').val('')
            modal.find('#waktu_keluar').val('')
            modal.find('#method').html('')
            modal.find('.modal-body form').attr('action','{{ url("absensi") }}')
        }

    })



    // $(document).ready(function () {
        // You might need to initialize your modal using JavaScript
        // $('#formImport').modal({
        //     backdrop: 'static', // Prevent closing on click outside the modal
        //     keyboard: false // Prevent closing with keyboard
        // });

        // Alternatively, if you are using Bootstrap's data attributes, you can trigger the modal manually
    //     $('#formImport').modal('show');
    // });

    </script>
@endpush