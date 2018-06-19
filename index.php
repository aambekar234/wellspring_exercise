<?php
require_once('train.php');
$tmp_name = "trains_6.csv";
$filename = "trains_6.csv";
if(isset($_POST['submit']))
{
  $tmp_name = $_FILES['csv_file']['name'];
  $filename  = $_FILES['csv_file']['tmp_name'];
}
ini_set('auto_detect_line_endings', true);
$error_message = "";

if(strpos($tmp_name,".csv")!==false)
{
  $row  = 0;
  $trains = array();
  if (($handle = fopen($filename, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      $num = count($data);

      if($num == 4 && $row > 0)
      {
          $train_line = trim($data[0]);
          $route_name = trim($data[1]);
          $run_number = trim($data[2]);
          $operator_id = trim($data[3]);

          if(!empty($train_line) && !empty($route_name) && !empty($run_number) && !empty($operator_id)){

            $train = new Train($train_line, $route_name, $run_number, $operator_id);
            array_push($trains, $train);
        }
      }

      $row++;

  }
    fclose($handle);
  }
  else {
    $error_message = "Invalid File! Please upload only valid csv files.";
  }

  if(count($trains) == 0)
  {
    $error_message = "Invalid File! Please upload only valid csv files.";
  }

  function cmp($a, $b)
  {
      return strcmp($a->run_number, $b->run_number);
  }


  usort($trains,"cmp");

  $table_data= array();

  for($i=0;$i<sizeof($trains);$i++)
  {
    $tmp = array($trains[$i]->train_line, $trains[$i]->route_name, $trains[$i]->run_number, $trains[$i]->operator_id);
    if(!in_array($tmp, $table_data, true)){
        array_push($table_data,$tmp);
    }

  }
}
else {
$error_message = "Invalid File! Please upload only valid csv files.";
}

 ?>

 <!DOCTYPE html>
 <html lang="en">
   <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Wellspring Exercise</title>

     <!-- Bootstrap -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.css">

   </head>
   <body>

     <div class="container">

       <h3>Wellspring Exercise Solution</h3>
       <h4>Abhijeet Ambekar</h4>
       <br><br>

       <?php if($error_message!= "") { echo "<h4>$error_message<h4><br><br>";} ?>

        <button type="button" class="btn btn-primary" id="addnewrow" data-toggle="modal" data-target="#addnewrow_modal">Add new row</button>
<<<<<<< HEAD
        <button type="button" class="btn btn-warning" id="editrow">Edit Selected Row</button>
=======
>>>>>>> master
        <button type="button" class="btn btn-danger" id="removerow">Remove Selected Row</button>
        <button type="button" class="btn btn-success" id="uploadcsv" data-toggle="modal" data-target="#upload_csv_modal">Upload new csv file</button>
        <br><br>

       <table id="train_table" class="display">

      </table>

    </div>


    <!--modal add row -->
    <div class="modal" tabindex="-1" role="dialog" id="addnewrow_modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Add Row</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
          <div class="form-group">
            <label for="exampleInputEmail1">Train Line</label>
            <input type="text" class="form-control" id="train_line" placeholder="eg. Metra">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Route</label>
            <input type="text" class="form-control" id="route" placeholder="eg. Green Line">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Run Number</label>
            <input type="text" class="form-control" id="run_number" placeholder="eg. A025">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Operator ID</label>
            <input type="text" class="form-control" id="opearator_id" placeholder="eg. A Ambekar">
          </div>

          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="addrow_commit">Add Row</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

<<<<<<< HEAD

  <!--modal edit row -->
  <div class="modal" tabindex="-1" role="dialog" id="editrow_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Add Row</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
        <div class="form-group">
          <label for="exampleInputEmail1">Train Line</label>
          <input type="text" class="form-control" id="train_line_e" placeholder="eg. Metra">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Route</label>
          <input type="text" class="form-control" id="route_e" placeholder="eg. Green Line">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Run Number</label>
          <input type="text" class="form-control" id="run_number_e" placeholder="eg. A025">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Operator ID</label>
          <input type="text" class="form-control" id="opearator_id_e" placeholder="eg. A Ambekar">
        </div>

        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="editrow_commit">Save Changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

=======
>>>>>>> master
  <!--modal upload csv -->
  <div class="modal" tabindex="-1" role="dialog" id="upload_csv_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Upload CSV File</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form method="post" action="index.php" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Choose CSV File</label>
          <input type="file" name="csv_file" id="csv_file" class="form-control-file" id="csv_file">
        </div>


      </div>
      <div class="modal-footer">
        <input  type="submit" class="btn btn-primary" name="submit" value="Upload" id="addrow_commit"></input>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </form>
    </div>
  </div>
</div>


     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
     <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.js"></script>

     <script>
     $(document).ready( function () {

<<<<<<< HEAD

       var selectd_row= -1;
      var err = "<?php echo $error_message;?>";
      console.log(err);
      var dataset;
      if(err=="")
      {
        dataset = <?php echo json_encode($table_data); ?>;
        $('#train_table').DataTable( {
                "lengthMenu": [[5, 10, 50, -1], [5, 10, 50, "All"]],
                 data: dataset,
                 destroy: true,
=======
      var err = "<?php echo $error_message;?>";
      console.log(err);

      if(err=="")
      {
        var dataset = <?php echo json_encode($table_data); ?>;
        $('#train_table').DataTable( {
                "lengthMenu": [[5, 10, 50, -1], [5, 10, 50, "All"]],
                 data: dataset,
>>>>>>> master
                 columns:[{title:"Train Line"}, {title:"Route"}, {title:"Run Number"}, {title:"Operator ID"}]
            } );

      }


      $("#addrow_commit").click(function(){
            var train_line = $("#train_line").val();
            var route = $("#route").val();
            var run_number = $("#run_number").val();
            var operator_id = $("#opearator_id").val();

            var train_table = $("#train_table").DataTable();
<<<<<<< HEAD
            if(train_line!="" && route !="" && run_number!="" && operator_id!="")
            {
              train_table.row.add([train_line, route, run_number, operator_id]).draw(false);
              $('#addnewrow_modal').modal('toggle');
            }
            else {
              alert("Please add valid data in the text fields.");
            }


      });

      $("#editrow_commit").click(function(){
            if(selectd_row != -1)
            {
              var train_line = $("#train_line_e").val();
              var route = $("#route_e").val();
              var run_number = $("#run_number_e").val();
              var operator_id = $("#opearator_id_e").val();

              var train_table = $("#train_table").DataTable();
              if(train_line!="" && route !="" && run_number!="" && operator_id!="")
              {
                dataset[selectd_row][0] = train_line;
                dataset[selectd_row][1] = route;
                dataset[selectd_row][2] = run_number;
                dataset[selectd_row][3] = operator_id;

                train_table.clear();
                $('#train_table').DataTable( {
                        "lengthMenu": [[5, 10, 50, -1], [5, 10, 50, "All"]],
                         data: dataset,
                         destroy: true,
                         columns:[{title:"Train Line"}, {title:"Route"}, {title:"Run Number"}, {title:"Operator ID"}]
                    } );
              }
              else {
                alert("Please add valid data in the text fields.");
              }

              selectd_row = -1;
              $('#editrow_modal').modal('toggle');
            }


=======
            train_table.row.add([train_line, route, run_number, operator_id]).draw(false);
>>>>>>> master

      });

      $('#train_table').on( 'click', 'tr', function () {
            var train_table = $("#train_table").DataTable();
            console.log("click");

              if ( $(this).hasClass('selected') ) {
                  $(this).removeClass('selected');
              }
              else {
                  train_table.$('tr.selected').removeClass('selected');
                  $(this).addClass('selected');
              }
          } );

          $('#removerow').click( function () {

              var train_table = $("#train_table").DataTable();
<<<<<<< HEAD

              console.log(train_table.row('.selected').data());
              console.log(train_table.row('.selected').index());
              train_table.row('.selected').remove().draw( false );


          } );

          $('#editrow').click( function () {

              var train_table = $("#train_table").DataTable();
              var data = train_table.row('.selected').data();
              selectd_row = train_table.row('.selected').index();

              $("#train_line_e").val(data[0]);
              $("#route_e").val(data[1]);
              $("#run_number_e").val(data[2]);
              $("#opearator_id_e").val(data[3]);

              console.log(train_table.row('.selected').data());
              console.log(train_table.row('.selected').index());

              $('#editrow_modal').modal('toggle');

=======
              train_table.row('.selected').remove().draw( false );


>>>>>>> master

          } );

});
     </script>

   </body>
 </html>
