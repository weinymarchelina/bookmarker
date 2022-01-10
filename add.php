<?php 
   include('config/db_connect.php');

    $name = $link = $desc = '';

    $errors = array('name'=>'', 'link'=>'');

    if(isset($_POST['submit'])){ 

        $name = htmlspecialchars($_POST['name']);
        $link = htmlspecialchars($_POST['link']);
        $desc = htmlspecialchars($_POST['desc']);


        // check name
		if(empty($name)){
			$errors['name'] = 'A name is required <br />';
		} else{
			echo $name . '<br />';
		}

		// check link
		if(empty($link)){
			$errors['link'] = 'A link is required <br />';
		} else{
			echo $link . '<br />';
		}

        // for desc
        if($desc){
			echo $desc . '<br />';
		}


       
        if(!array_filter($errors)){


            $name = mysqli_real_escape_string($conn, $name);
            $link = mysqli_real_escape_string($conn, $link);
            $desc = mysqli_real_escape_string($conn, $desc);
            $folder = mysqli_real_escape_string($conn, 'Tutorial');

            // create sql
            $sql = "INSERT INTO bookmarks(name, link, descriptions, folder) VALUES('$name', '$link', '$desc', '$folder')";

            // save to db and check
            if(mysqli_query($conn, $sql)){
             
			    header('Location: index.php');

            } else {
                // error
                echo 'Query error:' . mysqli_error($conn);
            }


            
            
		} 
    }
?>


<!DOCTYPE html>
<html lang="en">

    <?php include('templates/header.php'); ?>

    <div class="container-md my-5 bg-light">


        <section id="contact">
            <div class="container-lg">
                <h2 class="text-center">Add new bookmark</h2>
                    <div class="row justify-content-center my-5">
                        <div class="col-lg-6">

                     
                            <form action="add.php" method="POST">
                                <label class="form-label">
                                    Name
                                </label>
                                <div class="input-group mb-1">
                                    <input
                                    type="text"
                                    id="name"
                                    class="form-control"
                                    name="name"
                                    />
                                </div>
                                <div class="text-danger mb-4">
                                    <?php 
                                        echo $errors['name'];
                                    ?>
                                </div>

                                <label class="form-label">Link
                                </label>
                                <div class="input-group mb-1">
                                    <input
                                    type="url"
                                    id="link"
                                    class="form-control"
                                    name="link"
                                    />
                                </div>
                                <div class="text-danger mb-4"">
                                    <?php 
                                        echo $errors['link'];
                                    ?>
                                </div>

                                

                                <div class="mb-4 mt-5 form-floating">
                                    <textarea
                                    class="form-control"
                                    id="desc"
                                    style="height: 140px"
                                    placeholder="desc"
                                    name="desc"
                                    ></textarea>
                                    <label for="desc">Descriptions</label>
                                </div>
                                <div class="mb-4 text-center">
                                    <button type="submit" class="btn btn-danger"  name="submit">Submit</button>
                                </div>
                             </form>

                    </div>
                </div>
            </div>
            </section>

    </div>

    <?php include('templates/footer.php'); ?>
</html>