
@extends('navbar')
@extends('layouts.app')
@section('title', 'ListPlayer Page')
@section('container')
   

<style>
    td img{
        object-fit: cover;
        height: 250px;
        width: 100%;
        object-position: top;
    }
    .grop{
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }
    .grop .btn{
        width: 150px;

    }
    @media only screen and (max-width: 600px) {
        .grop .btn{
        display: none;
    

    }
    .button-group{
      
    }
}

</style>


    <div class="grop">
          
        <div class="input-group ">
            <div class="form-outline">
                <label class="form-label" for="search">Search</label>
              <input type="search" id="search" class="form-control" onkeyup='searchTable()' />
            </div>
        </div>
        <button type="button" class="btn btn-success mb-0 "><a href="add" style="text-decoration: none; color:white">เพิ่มข้อมูล</a></button>
    </div>
       
        
    <div class="table-responsive">
        <table class="table table-hover table-bordered text-center" id="table">
        <thead>
            <tr>
                <th style="min-width: 200px">ชื่อ</th>
                <th style="min-width: 250px">รูป</th>
                <th style="min-width: 350px">รายละเอียด</th>
                <th>อายุ</th>
                <th style="min-width: 150px">ตำแหน่ง </th>
                <th style="min-width: 160px">Update/Delete</th>

            </tr>
        </thead>
        <tbody>

            @foreach ($players as $row)

            <tr>

                <td>{{$row->name}}</td>
                <td><img src="storage/images/{{$row->avatar}}" alt="">  </td>
                <td>{{$row->deteils }}</td>
                <td>{{$row->age}}</td>
                <td>{{$row->position}}</td>
                <td>


                  
                        
                            <form method="GET" action="{{ route('player.delete', $row->id) }}">
                                @csrf
                               
                                <a href="{{route('edit',$row->id)}}"  class="btn btn-warning">แก้ไข</a>
                                <button type="submit" class="btn btn-danger show-alert-delete-box" data-toggle="tooltip" title='Delete'>ลบ</button>
                            </form>
                       
                   
              



                </td>

            </tr>

            @endforeach

        </tbody>
    </table>
    {{$players->links()}}
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.show-alert-delete-box').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                });
                setTimeout(function() {
                  
                    form.submit();
                }, 1000)
            }
        });
    });
</script>
    
@endsection
