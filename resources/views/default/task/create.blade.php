@extends('default.layouts.app')

@section('sidebar')
    @include('default.static.sidebar')
@endsection

@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Görev Oluştur</h1>
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
    <div class="row">
        <div class="col-md-12">
            <form onsubmit="return false;" id="gorev_form">
                @csrf
                <div class="col-md-12 p-0">
                    <div class="row p-0">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header border-transparent">
                                    <h3 class="card-title"><i class="far fa-calendar-plus"></i>&ensp;Görev Bilgileri</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="gorev_basligi">Görev Başlığı</label>
                                                    <input type="text" class="form-control" id="gorev_basligi" name="gorev_basligi" autocomplete="off" placeholder="Buraya görev başlığı gelecek. Çok uzun olmasın" required maxlength="50">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="gorev_kisa">Kısa Tanım</label>
                                                    <textarea name="gorev_kisa" id="gorev_kisa" name="gorev_kisa" class="form-control" placeholder="Anlayacak kadar kısa bir tanım yazabilirsiniz." maxlength="100"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- /.card-footer -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header border-transparent">
                                    <h3 class="card-title"><i class="far fa-calendar-plus"></i>&ensp;Görev Ayarları</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                        <input type="checkbox" class="custom-control-input" name="sure_yok" id="sure_yok">
                                                        <label class="custom-control-label" for="sure_yok"> Süre belirtmek istemiyorum ( Eğer bir tarih yok ise kafanda bunu işaretleyebilirsin ) </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label> Teslim / Bitiş Tarihi <code>Yapacağın günü de girebilirsin.</code></label>
                                                    <div class="input-group date">
                                                        <input type="text" class="form-control" id="bitistarihi" name="bitistarihi" autocomplete="off" placeholder="Teslim / Bitiş tarihi girebilirsin" required/>
                                                        <div class="input-group-append">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- /.card-footer -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 alert alert-warning">
                    Oluşturulan görevler düzenlenemez. Ona göre açın eğer yanlış açtıysanız silip tekrar açmak zorundasınız.
                </div>
                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-success float-right">Oluştur</button>
                    </div>
                </div>
            </form>
        </div>

        
    </div>
@endsection

@section('script')
    <link rel="stylesheet" href="{{asset("default/plugins/jquery-ui/jquery-ui.min.css")}}">
    <script src="{{asset("default/plugins/jquery-ui/jquery-ui.min.js")}}"></script>
    <script src="{{asset("default/plugins/jquery-ui/datepicker/tr.js")}}"></script>
    <script src="{{asset("default/js/common.js")}}"></script>
    <script>
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

            $('#gorev_form').on('submit', function() {
                var bthis = this;
                var formData = new FormData($(this)[0]);
                sendAjaxRequest('{{route("task.save")}}', formData, {}, function(error, res) {
                    if(error) {
                        toastr["error"](error);
                        return;
                    }

                    if(res.status) {
                        toastr["success"](res.message);
                        $(bthis).trigger("reset");
                        
                        /**
                         * Sonrasında sağ altta eklenilen görevler diye açılır pencere açıp görev detayına gitmesi sağlanacak
                        */
                    } else {
                        toastr["error"](res.message);
                    }
                });
            });
        })
    </script>
@endsection
