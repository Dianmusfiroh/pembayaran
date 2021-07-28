@extends('layouts.front')

@section('title', 'SIPENAS')

@section('content')
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
      <li data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="w-100 img-fluid" style="height: 100%;" src="{{ asset('img/alur.jpeg') }}" alt="First slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </a>
  </div>
  <!-- Button trigger modal -->
<div class="modal fade" id="infoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="infoModalLabel">PENGUMUMAN</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
Dengan mempertimbangkan nomenklatur pada DPA 2021, maka formasi sebelumnya di nyatakan batal, dan oleh sebab itu, akan dibuka kembali Formasi yg sudah di sesuaikan dengan DPA 2021, sehingga bagi guru/tendik yg sudah melakukan pendaftaran pada formasi sebelumnya di harapkan untuk dapat melakukan pendaftaran ulang pada formasi baru.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
    <script>
       $(window).on('load', function() {
        $('#infoModal').modal('show');
    });
    </script>
@endsection