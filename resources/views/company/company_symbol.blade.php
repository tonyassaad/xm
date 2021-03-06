<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>XM Test</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
   <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- daterange picker -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Trade</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
             </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Company Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
          <form name="companySymbolForm" method="post" action="/company-historical-quotes" enctype="multipart/form-data"/>
          {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                      <label for="companySymbol">Company Symbol</label>
                <input type="text"   class="form-control" name="company_symbol" id="companySymbol" placeholder="Company Symbol">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                  </div>

                    <div class="form-group">
                     <label for="startDate">Start Date:</label>
                <input type="text" class="form-control" name ="startDate"id="startDate" aria-describedby="emailHelp" placeholder="Start Date:">
               
                  </div>
 
                    <div class="form-group">
                     <label for="endDate">End Date:</label>
                <input type="text" name ="endDate" class="form-control" id="endDate" aria-describedby="emailHelp" placeholder="Start Date:">
              
                  </div>
 
            <div class="input-group-append">
                @if($errors->any())
                  @foreach($errors->getMessages() as $this_error)
                      <p style="color: red;">{{$this_error[0]}}</p>
                  @endforeach
                @endif 
                      </div>
                        <div class="form-group">
                  <button type="submit" class="btn btn-info">Search</button>
                  <button type="reset" class="btn btn-default ">Cancel</button>
                  </div>
                    </div>
                </div>
                <!-- /.card-body -->
              </form>
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
     
    </div>
    <strong>Copyright &copy; 2014-2019 Tony Assaad</strong> All rights
    reserved.
  </footer>

 
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
<!-- date-range-picker -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="../../dist/js/demo.js"></script>
<script type="text/javascript">
  $(function () {


   $('#startDate').datepicker({
      dateFormat: "yy-mm-dd",
    onSelect: function(dateText, inst) {
      $("input[name='startDate']").val(dateText);
    }
});
       $('#endDate').datepicker({
        dateFormat: "yy-mm-dd",
    onSelect: function(dateText, inst) {
      $("input[name='endDate']").val(dateText);
    }
});
 

  });

</script>
</body>
</html>
''