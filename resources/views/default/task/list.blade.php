@extends('default.layouts.app')

@section('sidebar')
    @include('default.static.sidebar')
@endsection


@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Görev Listesi</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route("index") }}">Anasayfa</a></li>
                <li class="breadcrumb-item active">Görev Oluştur</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')
    <!-- Info boxes -->
    @php 
        echo "<pre>";
            print_r($data);
        echo "</pre>";
    @endphp
    <input type="hidden" name="_token" id="csrf_token" value="{{ csrf_token() }}" />
    <div class="row">
        <div class="col-md-12">
            @csrf
            <div class="col-md-12 p-0">
                <div class="row p-0">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title"><i class="far fa-calendar-plus"></i>&ensp;Görev Bilgileri</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="col-md-12">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Görev Adı
                                                </th>
                                                <th style="width: 30%">
                                                    Görev Açıklaması
                                                </th>
                                                <th class="text-center">
                                                    Durum
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @foreach ($data["data"] as $gorev)
                                                <tr data-id="{{ $gorev["task_id"] }}">
                                                    <td>
                                                        {{ $gorev["task_name"] }}
                                                    </td>
                                                    <td style="width: 30%">
                                                        {{ $gorev["task_desc"] }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $gorev["done"] }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <button type="button" id="load_more" class="btn btn-outline-info btn-block btn-sm">{{-- <i class="fa fa-spinner fa-spin"></i> --}}<i class="fa fa-solid fa-caret-down"></i> Daha Fazla Göster</button>

                            </div>
                        <!-- /.card-footer -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
@endsection

@section('script')
    <link rel="stylesheet" href="{{asset("default/plugins/jquery-ui/jquery-ui.min.css")}}">
    <script src="{{asset("default/plugins/jquery-ui/jquery-ui.min.js")}}"></script>
    <script src="{{asset("default/plugins/jquery-ui/datepicker/tr.js")}}"></script>
    <script src="{{asset("default/js/common.js")}}"></script>
    <script>
        var nextkey = '{{ $data["next_cursor"] }}';
        $(document).ready(function() {
            
            $('#bitistarihi').datepicker({
                showButtonPanel: false,
            });

            $('#sure_yok').on('change', function() {
                if($(this).prop("checked")) {
                    $('#bitistarihi').prop("required", false);
                } else {
                    $('#bitistarihi').prop("required", true);
                }
            });

            $('#load_more').on('click', function() {
                getTasks();
            });
        })

        function getTasks() {
            var formData = new FormData();
            formData.append("_token", $('#csrf_token').val());
            sendAjaxRequest('{{route("task.get")}}?cursor=' + nextkey, formData, {}, function(error, res) {
                var html = '' + 
                '<tr>' +
                    '<td>' +
                        '#' +
                    '</td>' +
                    '<td>' +
                        '<a>' +
                            'AdminLTE v3' +
                        '</a>' +
                        '<br>' +
                        '<small>' +
                            'Created 01.01.2019' +
                        '</small>' +
                    '</td>' +
                    '<td>' +
                        '<ul class="list-inline">' +
                            '<li class="list-inline-item">' +
                                '<img alt="Avatar" class="table-avatar" src="../../dist/img/avatar.png">' +
                            '</li>' +
                            '<li class="list-inline-item">' +
                                '<img alt="Avatar" class="table-avatar" src="../../dist/img/avatar2.png">' +
                            '</li>' +
                            '<li class="list-inline-item">' +
                                '<img alt="Avatar" class="table-avatar" src="../../dist/img/avatar3.png">' +
                            '</li>' +
                            '<li class="list-inline-item">' +
                                '<img alt="Avatar" class="table-avatar" src="../../dist/img/avatar4.png">' +
                            '</li>' +
                        '</ul>' +
                    '</td>' +
                    '<td class="project-state">' +
                        '<span class="badge badge-success">Success</span>' +
                    '</td>' +
                    '<td class="project-actions text-right">' +
                        '<a class="btn btn-primary btn-sm" href="#">' +
                            '<i class="fas fa-folder">' +
                            '</i>' +
                            'View' +
                        '</a>' +
                        '<a class="btn btn-info btn-sm" href="#">' +
                            '<i class="fas fa-pencil-alt">' +
                            '</i>' +
                            'Edit' +
                        '</a>' +
                        '<a class="btn btn-danger btn-sm" href="#">' +
                            '<i class="fas fa-trash">' +
                            '</i>' +
                            'Delete' +
                        '</a>' +
                    '</td>' +
                '</tr>';

            });
        }
    </script>
@endsection
