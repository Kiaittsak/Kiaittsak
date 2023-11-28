@extends('navbar')
@extends('layouts.app')
@section('title', 'Edit Page')
@section('container')
    <form action="" id="add_player_form" method="post" enctype="multipart/form-data">
        <h3>แก้ไขข้อมูลนักเตะ</h3>
        <div class="row mx-auto p-2">
            @csrf
            <div class="col-sm-12 col-md-10 col-lg-10  mx-auto">
                <label for="name" class="form-label">ชื่อนักเตะ</label>
                <input type="text" class="form-control" name="name" id="name" value="{{$play->name}}">
            </div>
            <div class="col-sm-12 col-md-2 col-lg-2  mx-auto">
                <label for="age" class="form-label">อายุนักเตะ</label>
                <input type="text" class="form-control" name="age" id="age" value="{{$play->age}}">
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 mt-4  mx-auto ">
                <label for="position" class="form-label">ตำแหน่ง</label>
                <input type="text" class="form-control" name="position" id="position" value="{{$play->position}}">
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6 mt-4 mx-auto ">
                <label for="deteils" class="form-label">รายละเอียดผู้เล่น</label>
                <textarea class="form-control" id="deteils" name="deteils" rows="3">{{$play->deteils}}</textarea>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 mt-4 mx-auto ">
                <label for="avatar" class="form-label">อัพโหลดรูปภาพ</label>
               
                <input type="file" class="form-control" name="avatar" id="avatar" php artisan servevalue="{{$play->avatar}}" >
                <img src="storage/images/{{$play->avatar}}" height="80%" width="20%" style="object-fit: cover; object-position: top;"   alt="...">
            </div>
           
            <div class="row">
                <div class="col mt-4">
                 
                    <button type="submit" id="save" class="btn btn-success">แก้ไขข้อมูล</button>
    </form>
    </div>

    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $("#add_player_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
    
            var name = $('#name').val();
            var age = $('#age').val();
            var position = $('#position').val();
            var deteils = $('#deteils').val();
         
            if (name == "") {
                Swal.fire({
                    text: "กรุณาป้อนข้อมูล ชื่อนักเตะ",
                    icon: "warning",
                    showConfirmButton: true,
                    timer: 3000
                });
            } else if (age == "") {

                Swal.fire({
                    text: "กรุณาป้อนข้อมูล อายุนักเตะ",
                    icon: "warning",
                    showConfirmButton: true,
                    timer: 3000
                });

            } else if (position == "") {

                Swal.fire({
                    text: "กรุณาป้อนข้อมูล อายุนักเตะ",
                    icon: "warning",
                    showConfirmButton: true,
                    timer: 3000
                });

            } else if (deteils == "") {

                Swal.fire({
                    text: "กรุณาป้อนข้อมูล อายุนักเตะ",
                    icon: "warning",
                    showConfirmButton: true,
                    timer: 3000
                });

            }  else {
                $("#save").text('กำลังแก้ไขข้อมูล...');
                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route('update',$play->id) }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire(
                                'แก้ไขข้อมูลสำเร็จ!',
                                'เแก้ไขข้อมูล ผู้เล่นที่คุณชื่นชอบสำเร็จแล้ว!',
                                'success'
                            )
                            setTimeout(function() {
                                swal.close();
                                window.location.reload()
                                document.location.href = '/tableplayer'
                            }, 1500);
                        } else if (response.status == 400) {
                            Swal.fire({
                                icon: "error",
                                title: "ไม่สามารถแก้ไข้ข้อมูลได้",
                                text: "เนื่องจากข้อมูลยังไม่มีการเปลี่ยนแปลง",
                                showConfirmButton: true,
                               time:2000
                            });
                        }
                        setTimeout(function() {
                                swal.close();
                                window.location.reload()
                            }, 2500);
                    }
                })
            };
        });
    </script>

    </div>
@endsection

