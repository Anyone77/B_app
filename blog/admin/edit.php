
<?php

session_start();
require "../config/config.php";

$stmt = $pdo->prepare("SELECT * FROM posts WHERE id =".$_GET['id']);
$stmt->execute();
    $res = $stmt->fetchAll();

    if(!empty($_POST)){
        $id = $_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];

        if($_FILES['image']['name'] != null ){

            $file = 'images/'.($_FILES['image']['name']);
            $path = pathinfo($file,PATHINFO_EXTENSION);
        
            if($path != "jpg" && $path != "jpeg" && $path != "png"){
                echo "<script>alert('Images must be jpg or png or jpeg')</script>";
            }else{
               
                $image = $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'],$file);
        
                $sql = $pdo->prepare("UPDATE posts SET title='$title',content='$content',image='$image' WHERE id = '$id' ");
                $result = $sql->execute();

                if($result){
                    echo "<script>alert('Add New Article Successfully ');window.location.href='index.php'; </script>";
                }
            }

        }else{
            $sql = $pdo->prepare("UPDATE posts SET title='$title',content='$content' WHERE id = '$id' ");
            $result = $sql->execute();

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
              
               

                <form action="" method="post" enctype="multipart/form-data" > 
                    <input type="hidden" name="id" value="<?php echo $res[0]['id']?>">
                    <div class="form-group">
                        <label for="">Title</label><br>
                        <input type="text" class="form-control" name="title" value="<?php echo $res[0]['title']?>" required>
                    </div>
                    <div class="form-group">
                        <label for="">Content</label><br>
                        <textarea name="content" class="form-control" id="" cols="30" rows="10"><?php echo $res[0]['content']?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Image</label><br>
                        <img src="images/<?php echo $res[0]['image'] ?>" width="150" height="150" alt=""><br><br>
                        <input type="file" name="image" >
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Update">
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


