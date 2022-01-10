<?php 

   include('config/db_connect.php'); 

    $sql = 'SELECT id, name, link, descriptions, folder FROM bookmarks ORDER BY created_at'; 

    // make query and get result
    $result = mysqli_query($conn, $sql); 
    // fetch the resulting rows as an array
    $bookmarks = mysqli_fetch_all($result, MYSQLI_ASSOC); 
    // free the result from the memory and disconnect from mysql 
    mysqli_free_result($result);
    mysqli_close($conn);

    // print_r($bookmarks);
?>

<!DOCTYPE html>

    <?php include('templates/header.php'); ?>

    <div class="container-md my-5 bg-light">

        <h2 class="fw-bold mx-3">Bookmarks</h2>

        <div class="container mt-5">
            <div class="row">

                <?php foreach($bookmarks as $bookmark) { ?>
                    <div class="col">
                        <div class="card">
                            <div class="card-body text-center py-4">
                                <p class="mb-3 h5">
                                    <?php echo htmlspecialchars($bookmark['name']); ?>
                                </p>
                                <a href="<?php echo htmlspecialchars($bookmark['link']); ?>" class="btn btn-outline-primary btn-sm">
                                Visit Page
                                </a>
                                
                            </div>
                            <div class="card p-1 px-3 text-end">
                                    <a class="text-secondary small" href="details.php?id=<?php echo $bookmark['id'] ?>">More info</a>
                            </div>
                        </div>
                    </div>
                <?php }?>

            </div>
        </div>

    </div>

    <?php include('templates/footer.php'); ?>

    
</html>