            @extends('navbar')
            @extends('layouts.app')
            @section('title', 'AddPlayer Page')
            @section('container')
                <form action="" id="add_player_form" method="post" enctype="multipart/form-data">
                    <div class="row mx-auto p-2">
                        @csrf
                        <div class="col-sm-12 col-md-10 col-lg-10  mx-auto ">
                            <label for="name" class="form-label">ชื่อนักเตะ</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="col-sm-12 col-md-2 col-lg-2  mx-auto">
                            <label for="age" class="form-label">อายุนักเตะ</label>
                            <input type="text" class="form-control" name="age" id="age">
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6 mt-4  mx-auto ">
                            <label for="position" class="form-label">ตำแหน่ง</label>
                            <input type="text" class="form-control" name="position" id="position">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 mt-4  mx-auto ">
                            <label for="position" class="form-label">หัวหน้าชื่ออะไร</label>
                            <input type="text" class="form-control" name="position" id="position">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 mt-4 mx-auto ">
                            <label for="deteils" class="form-label">รายละเอียดผู้เล่น</label>
                            <textarea class="form-control" id="deteils" name="deteils" rows="3"></textarea>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12 mt-4 mx-auto ">
                            <label for="avatar" class="form-label">อัพโหลดรูปภาพ</label>
                            <input type="file" class="form-control" name="avatar" id="avatar">
                        </div>
                        <div class="row">
                            <div class="col mt-4">
                                <button type="submit" id="save" class="btn btn-success">เพิ่มข้อมูลผู้เล่น</button>
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
                        var avatar = $('#avatar').val();
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

                        } else if (avatar == "") {

                            Swal.fire({
                                text: "กรุณาป้อนข้อมูล อายุนักเตะ",
                                icon: "warning",
                                showConfirmButton: true,
                                timer: 3000
                            });

                        } else {
                            $("#save").text('กำลังเพิ่มข้อมูล...');
                            $.ajax({
                                url: 'http://127.0.0.1:8000/api/players',
                                method: 'post',
                                data: fd,
                                cache: false,
                                contentType: false,
                                processData: false,
                                dataType: 'json',
                                success: function(response) {
                                    if (response.status == 200) {
                                        Swal.fire(
                                            'เพิ่มข้อมูลสำเร็จ!',
                                            'เพิ่มข้อมูล ผู้เล่นที่คุณชื่นชอบสำเร็จแล้ว!',
                                            'success'
                                        )
                                        setTimeout(function() {
                                            swal.close();
                                            window.location.reload()
                                            document.location.href = '/'
                                        }, 1500);
                                    } else if (response.status == 400) {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Oops...",
                                            text: "Something went wrong!",
                                            showConfirmButton: true,
                                            timer: 3000
                                        });
                                    }

                                }
                            })
                        };
                    });
                </script>

                </div>
                <style>
                    .card-img img {
                        object-fit: cover;
                        height: auto;
    
                    }
                </style>
    
     @endsection