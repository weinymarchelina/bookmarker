<?php 

include('config/db_connect.php'); 

$bookmark = '';

if(isset($_POST['delete'])){

    // print_r($_POST);

    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    $sql = "DELETE FROM bookmarks WHERE id = $id_to_delete";

    if(mysqli_query($conn, $sql)){
        header('Location: index.php');
    } else {
        echo 'Query error: '. mysqli_error($conn);
    }

}

// check GET request id param
if(isset($_GET['id'])){

    // prevent any sql injections here
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // make sql
    $sql = "SELECT * FROM bookmarks WHERE id = $id";

    // get the query result
    $result = mysqli_query($conn, $sql);

    // fetch result in array format
    $bookmark = mysqli_fetch_assoc($result);

    // close
    mysqli_free_result($result);
    mysqli_close($conn);

}

?>


<!DOCTYPE html>

    <?php include('templates/header.php'); ?>

    <div class="container-md my-5 bg-light">

        <div class="card m-5">
            <div class="card-body m-3 py-4 bg-white">
                
                <?php if($bookmark) : ?>

                    <h2 class="fw-bold mx-3">Details</h2>

                    <form class="container mx-1 mt-4" action="details.php" method="POST">
                        <p>Name: <?php echo htmlspecialchars($bookmark['name']); ?></p>
                        <p>Folder: <?php echo htmlspecialchars($bookmark['folder']); ?></p>
                        <p>Description: <?php echo htmlspecialchars($bookmark['descriptions']); ?></p>
                        <p>Created at: <?php echo date($bookmark['created_at']); ?></p>

                        <div class="btn-group">
                        <a href="<?php echo htmlspecialchars($bookmark['link']); ?>" class="btn btn-outline-primary btn-sm">
                        Visit Page
                        </a>
                        
                        <a href="index.php" class="btn btn-outline-primary btn-sm">
                        Home Page
                        </a>

                        <button type="submit" class="btn btn-outline-danger btn-sm" name="delete" value="Delete" >Delete</button>

                        <input type="hidden" name="id_to_delete" id="id_to_delete" class="d-none" value="<?php echo $bookmark['id']; ?>">
                        </div>
                    </form>
                   
                <?php else : ?>

                    <div class="text-center">
                    <h2>Bookmark doesn't exist</h2>
                    <a href="index.php" class="btn btn-outline-primary btn mx-1 my-3">
                        Home Page
                    </a>
                    </div>

                <?php endif ?>

            </div>
        </div>

    </div>

    <?php include('templates/footer.php'); ?>

    
</html>