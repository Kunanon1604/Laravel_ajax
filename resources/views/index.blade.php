<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!--SweetAlert-->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<!--Jquery-->
	{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<title>Home</title>
</head>
<body>
	<div class="container"><br>
		<center><h2>Add Data</h2></center><br>
		<form method="post" id="adddata">
          <div class="row">
            <div class="col-xs-12 col-md-6">
              <p>Firstname: </p>
              <input type="text" class="form-control" name="firstname" id="firstname">
            </div>
            <div class="col-xs-12 col-md-6">
              <p>Lastname: </p>
             <input type="text" class="form-control" name="lastname" id="lastname">
            </div>
            <div class="col-xs-12 col-md-6">
              <p>Phone:</p>
              <input type="text" class="form-control" name="phone" id="phone" maxlength="10">
            </div>
            <div class="col-xs-12 col-md-6">
              <p>Email:</p>
              <input type="email" class="form-control" name="email" id="email">
            </div>
          </div><br>
          <div align="right">
          	<button type="button" class="btn btn-success" id="save">Save</button>
          </div>
        </form>
  <br>
  <br>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Firstname</th>
              <th>Lastname</th>
              <th>Phone</th>
              <th>Email</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data['query'] as $key => $row)
            <tr>
              <td>{{ $row->firstname }}</td>
              <td>{{ $row->lastname }}</td>
              <td>{{ $row->phone }}</td>
              <td>{{ $row->email }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        </div>
</body>
</html>

<script>
$(document).ready(function() {
  $('#save').on('click', function() {

    var firstname = $('#firstname').val();
    var lastname = $('#lastname').val();
    var phone = $('#phone').val();
    var email = $('#email').val();

    if(firstname!="" && lastname!="" && phone!="" && email!=""){
      $("#save").attr("disabled", "disabled");
      $.ajax({
        url: "{{ url('/save') }}",
        type: "POST",
        data: {
          firstname: firstname,
          lastname: lastname,
          phone: phone,
          email: email,
          "_token": "{{ csrf_token() }}",
        },
        cache: false,
        success: function(response){
          if(response.status==200){
            Swal.fire({
               title: 'Success',
               text: "Save Success",
               icon: 'success',
               width: '550px',
               showConfirmButton: true,
            })
            setTimeout(function(){
                swal.close();
                    window.location.reload();
            },1500)
          }
          else if(response.status==400){
             Swal.fire({
               title: 'Error',
               text: "Failed to save data",
               icon: 'error',
               width: '550px',
               showConfirmButton: true,
               timer: 3000
            })
          }
          
        }
      });
    }
    else{
      Swal.fire({
         title: 'Warning !.',
         text: "Please fill all the field !",
         icon: 'warning',
         width: '550px',
         showConfirmButton: true,
         timer: 3000
    })
    }
  });
});
</script>