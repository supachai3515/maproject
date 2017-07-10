<!DOCTYPE html>
<html lang="">
       <head>
         <meta charset="utf-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <title>special_price</title>

         <!-- Bootstrap CSS -->
         <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">

         <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
         <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
         <!--[if lt IE 9]>
         <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
         <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
         <![endif]-->
       </head>
       <body>
        <h1 class="text-center">special_price</h1>
        <div class="container">
          <?php
          $success = $this->session->flashdata('success');
          $error = $this->session->flashdata('error');
          ?>
          <?php if ($success): ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $success; ?>
        </div>

            <?php endif; ?>
           <?php if ($error): ?>
               <div class="alert alert-danger alert-dismissable">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                   <?php echo $error; ?>
               </div>
            <?php endif; ?>

          <?php pre($order_data); ?>
          <br>
          <?php pre($order_detail_data); ?>
        </div>

        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <!-- Your own javascript -->
       </body>
</html>
