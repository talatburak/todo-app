@extends('default.layouts.app')
 
@section('title', 'Giriş Yap')
 
@section('content')
    <div class="col-md-12">
        <div class="row gx-0">
            <div class="col-md-6 m-0 p-0 hidden-mobile" style="height: 70vh;background: #5c6bc0;">
               <img src="{{ asset("img/todoapp.png") }}" style="max-width:50%;height:auto;">
            </div>
            <div class="col-md-6">

                <input type="text" class="form-control" name="email">
                <input type="password" class="form-control" name="password">
                <button type="submit">Gönder</button>
            </div>
        </div>
    </div>
    {{-- <div class="col-md-12 p-0" style="height: 70vh;">
        <div class="row p-0">
            <div class="col-xs-12 col-md-6 p-0 h-100" style="background: #;">
                
            </div>
        </div>
    </div> --}}
    <div class="container-fluid p-0">
        <!--Footer-->


    </div>
@endsection

@section('script')
    <script>
        
    </script>
@endsection