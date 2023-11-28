<!DOCTYPE html>
<html lang="en">
<head></head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet' type='text/css'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title')</title>
    <link rel="icon" type="images/x-icon" href="https://w7.pngwing.com/pngs/248/249/png-transparent-american-football-football-team-football-sport-sports-equipment-football-team.png" />
</head>

<body>
  
  <style>
     body{
    font-family: 'Kanit', sans-serif;
  }
  
  </style>

      <div class="container-md  py-5">
       
        <div class="shadow p-5 mb-1 bg-body-tertiary rounded">
        
          
          @yield('container')

            
        

    </div>





      <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
      <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>