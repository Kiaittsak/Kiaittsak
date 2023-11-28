@extends('navbar')
@extends('layouts.app')
@section('title','หน้าแรกของเว็บไซต์')
@section('container')
<div class="row">
  @foreach ($players as $row)
<div class="col-sm-12 col-md-6 col-lg-6 mt-4   c">
  <div class="card card-img">
    <img src="storage/images/{{$row->avatar}}" class="card-img-top"   alt="...">
    <div class="card-body">
      <h5 class="card-title">{{$row->name}}</h5>
      <p class="card-text">รายละเอียดนักเตะ : {{$row->deteils}}</p>
      <p class="card-text">อายุนักเตะ : {{$row->age}}</p>
      <p class="card-text">ตำแหน่ง : {{$row->position}}</p>
      <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
  </div>
</div>

@endforeach
{{$players->links()}}

</div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>
           $("#add_employee_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_employee_btn").text('Adding...');
        $.ajax({
          url: '{{ route('store') }}',
          method: 'get',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
              Swal.fire(
                'Added!',
                'Employee Added Successfully!',
                'success'
              )
              fetchAllEmployees();
            }
         
          }
        });
      });
       
      </script>

  </div>
@endsection
<style>
    .card-img img {
        object-fit: cover;
        height: 400px;
        object-position: top;
        
    }
 
</style>