
<?php

session_start();
require "../config/config.php";

if(!empty($_POST)){
    $file = 'images/'.($_FILES['image']['name']);
    $path = pathinfo($file,PATHINFO_EXTENSION);

    if($path != "jpg" && $path != "jpeg" && $path != "png"){
        echo "<script>alert('Images must be jpg or png or jpeg')</script>";
    }else{
        $title = $_POST['title'];
        $content = $_POST['content'];
        $image = $_FILES['image']['name'];
        $authorid = $_SESSION['user_id'];

        move_uploaded_file($_FILES['image']['tmp_name'],$file);

        $stmt = $pdo->prepare("INSERT INTO posts (title,content,image,author_id) VALUES(:title,:content,:image,:author_id) ");
        $result = $stmt->execute(
            array(':title'=>$title , ':content'=>$content , ':image'=>$image , ':author_id'=>$authorid )
        );

        if($result){
            echo "<script>alert('Add New Article Successfully ');window.location.href='index.php'; </script>";
        }
    }
}

?>



<?php include "header.php" ?>


  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">Create New Article</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
               

                <form action="add.php" method="post" enctype="multipart/form-data" > 
                    <div class="form-group">
                        <label for="">Title</label><br>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="">Content</label><br>
                        <textarea name="content" class="form-control" id="" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Image</label><br>
                        <input type="file" name="image" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="SUBMIT">
                        <a href="index.php" class="btn btn-warning" type="button">Back</a>
                    </div>
                </form>

                
              
            </div>
            <!-- /.card-body -->
           
          </div>
          <!-- /.card -->

         
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
  <div class="p-3">
    <h5>Title</h5>
    <p>Sidebar content</p>
  </div>
</aside>
<!-- /.control-sidebar -->

<?php include "footer.php" ?>


