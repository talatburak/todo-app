@extends('default.layouts.app')

@section('sidebar')
    @include('default.static.sidebar')
@endsection

@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Günlük Kayıtlar</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route("index") }}">Anasayfa</a></li>
                <li class="breadcrumb-item active">Günlük Kayıtlar</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')
    <!-- Info boxes -->
    
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Merhaba {{ Auth::user()->adi . " " . Auth::user()->soyadi}}
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="callout callout-info @if(!$dayFinished) display-none @endif" id="day_off_warning">
                        <h5>Gün bitmiş!</h5>
        
                        <p>Günü bitirdiğin için yeniden gün oluşturamazsın. O yüzden yarına kadar yaptığın şeyleri giremezsin. Eğer erken bitirdiysen lütfen <a href="javascript:void(0);" class="text-white" id="gunu_tekrar_baslat"> buraya tıkla </a></p>
                    </div>

                    @if(!$dayFinished)
                        <button type="button" class="btn btn-outline-success btn-block @if($dayAlreadyStarted) display-none @endif" style="text-align:unset;" id="gunu_baslat"><i class="fa fa-bell"></i> Günü Başlat</button>
                        <button type="button" class="btn btn-outline-danger btn-block @if(!$dayAlreadyStarted) display-none @endif" style="text-align:unset;" id="gunu_bitir"><i class="fa fa-bell"></i> Günü Bitir</button>
                    @endif
                   
                    <button type="button" class="btn btn-outline-warning btn-block" style="text-align:unset;" id="gecmis_kayitlar"><i class="fa fa-bell"></i> Geçmiş Kayıtlar</button>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h3 class="col-md-12 card-title">
                        <div class="col-md-12">
                            <input type="hidden" name="_token" id="csrf_token" value="{{ csrf_token() }}" />
                            <input type="text" class="form-control @if($dayFinished) display-none @endif" id="message_kayit" placeholder="@if(!$dayAlreadyStarted) Günü başlatarak yaptığın şeyleri girebilirsin. @else Yaptığın işlemleri kaydetmek istiyorsan enter tuşunu kullanabilirsin. @endif " @if(!$dayAlreadyStarted) disabled @endif>
                        </div>
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="overlay" style="background-color:rgb(52 58 64)"><i class="fas fa-3x fa-sync-alt fa-spin" style="color: white;"></i><div class="text-bold pt-2"></div></div>

                    <div class="timeline" id="timeline_wrapper">
                        
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection

@section('script')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="{{asset("default/js/common.js")}}"></script>
    <script>
        $(document).ready(function() {
            getAllElements();
            $('#message_kayit').on('keyup', function(e) {
                var bthis = this;
                if(e.which == "13") {
                    if($(this).val() != "") {
                        var formData = new FormData();
                        formData.append("_token", $('#csrf_token').val());
                        formData.append("content", $(this).val());
                        sendAjaxRequest('{{route("daily.save")}}', formData, {}, function(error, success) {
                            if(error) {
                                toastr["error"](success.message);
                                return;
                            }
                            
                            if(success.status) {
                                addNewElement(success.id, success.date, success.content);
                                $(bthis).val("");
                            } else {
                                toastr["error"](success.message);
                            }
                            
                        });
                    }
                }
            });

            $('#gunu_baslat').on('click', function() {
                var self;
                $.confirm({
                    title: 'Günü Başlat',
                    theme: 'dark',
                    content: 'Günü başlatmak istediğinize emin misiniz?',
                    buttons: {
                        cancel: {
                            text: 'Hayır',
                            btnClass: 'btn-red',
                            keys: ['esc'],
                            action: function(){
                                return true;
                            }
                        },
                        somethingElse: {
                            text: 'Evet',   
                            btnClass: 'btn-green',
                            keys: ['enter'],
                            action: function(){
                                var formData = new FormData();
                                formData.append("_token", $('#csrf_token').val());
                                self.showLoading();

                                sendAjaxRequest('{{route("day.start")}}', formData, {}, function(error, success) {
                                    self.close();

                                    if(error) {
                                        toastr["error"]("Bilinmedik bir hata oluştu");
                                        return;
                                    }
                                    
                                    if(success.status) {
                                        toastr["success"](success.message);

                                        $('#gunu_baslat').hide();
                                        $('#gunu_bitir').show();

                                        $('#message_kayit').attr("placeholder", "Yaptığın işlemleri kaydetmek istiyorsan enter tuşunu kullanabilirsin.");
                                        $('#message_kayit').prop("disabled", false)
                                    } else {
                                        toastr["error"](success.message);
                                    }
                                    
                                });

                                return false;
                            }
                        }
                    },
                    onContentReady : function() {
                        self = this;
                    }
                });
            });

            $('#gunu_bitir').on('click', function() {
                var self;
                $.confirm({
                    title: 'Günü Bitir',
                    theme: 'dark',
                    content: 'Günü bitirirsen eğer yarına kadar günü tekrar başlatamazsın. Devam etmek istediğine emin misin?',
                    buttons: {
                        cancel: {
                            text: 'Hayır',
                            btnClass: 'btn-red',
                            keys: ['esc'],
                            action: function(){
                                return true;
                            }
                        },
                        somethingElse: {
                            text: 'Evet',   
                            btnClass: 'btn-green',
                            keys: ['enter'],
                            action: function(){
                                var formData = new FormData();
                                formData.append("_token", $('#csrf_token').val());
                                self.showLoading();
                                sendAjaxRequest('{{route("day.end")}}', formData, {}, function(error, success) {
                                    self.close();

                                    if(error) {
                                        toastr["error"]("Bilinmedik bir hata oluştu");
                                        return;
                                    }
                                    
                                    if(success.status) {
                                        toastr["success"](success.message);
                                        $('#gunu_bitir').remove();

                                        $('#message_kayit').remove();
                                        $('#day_off_warning').show();
                                    } else {
                                        toastr["error"](success.message);
                                    }
                                    
                                });

                                return false;
                            }
                        }
                    },
                    onContentReady : function() {
                        self = this;
                    }
                });
            });

            $('#gunu_tekrar_baslat').on('click', function() {
                toastr["error"]("Kafan mı iyi, bitmiş günü başlatamazsın. Agam keşke bu arkadaşa bişi yiyip içirmeseydik, o kadar uyarıya rağmen günü bitirmiş, başlatacağını sanıyor.")
            });
        });

        function addNewElement(id, date, content, append = false) {
            var html = '<div data-id="'+id+'">' +
                '<i class="fas fa-thumbtack bg-green"></i>' +
                '<div class="timeline-item">' +
                    '<span class="time"><i class="fas fa-clock"></i> '+date+'</span>' +
                    '<h3 class="timeline-header no-border">'+content+'</h3>' +
                '</div>' +
            '</div>';
            if(!append) {
                $('#timeline_wrapper').prepend(html);
            } else {
                $('#timeline_wrapper').append(html);
            }
           
        }

        function getAllElements() {
            var formData = new FormData();
            formData.append("_token", $('#csrf_token').val());

            sendAjaxRequest('{{route("daily.dailylist")}}', formData, {}, function(error, success) {
                $('.overlay').hide();
                if(error) {
                    toastr["error"](success.message);
                    return;
                }
                
                if(success.status) {
                    success.data.forEach(element => {
                        addNewElement(element.dailyid, convertDateToReadable(element.date) + " " + (!element.daily_time ? "" : convertTimeToReadable(element.daily_time)), element.content, true);
                    });
                    // console.log(success.data);
                } else {
                    toastr["error"](success.message);
                }
                
            });
        }
    </script>
@endsection
