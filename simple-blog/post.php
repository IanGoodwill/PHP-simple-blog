<?php
require './connection.php';
include './nav.php';

if (isset( $_GET['id'])) {
    $id = (integer) $_GET['id']; // this is typecasting, it forces the input to be an integer
    $sql = ' SELECT * FROM posts WHERE id=' .$id.';';
    if ( $result = $connection->query( $sql ) ) {
        $message = 'Post Found!';
        $post;
        // retrieve the post data, only getting one post this time
        while ( $row = $result->fetch_assoc() ) // if one thing you can do it on one line
            $post = $row; 
    } else {
        $message = "an error was encountered while trying to retieve this post.";
        $message .= '<br><pre>' .print_r( $connection->error_list, TRUE ). '</pre>';
    }

} else {
    header( 'Location: index.php' ); // redirect the user to the index to try again
    die; // terminate script just incase
}



?><!DOCTYPE html>

<html>

    <head>
        <title><?php echo $post['title']; ?> </title>
        <link rel="stylesheet" type="text/css" href="./css/main.css">
    </head>

    <body>

        <h1><?php echo $post['title']; ?></h1>
        <?php if ( $message ) echo "<p>{$message}</p>"; // show a message ?>
        <p>
            <time><?php echo date( 'Y.m.d', $post['date']); ?> </time>
            <?php echo $post['content']; ?>
        </p>

        <?php

        // setting up pagination.
        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 10;
        $offset = ($pageno-1) * $no_of_records_per_page;

        $total_pages_sql = "SELECT COUNT(*) FROM posts";
        $result = mysqli_query($connection,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $sql = "SELECT * FROM posts LIMIT $offset, $no_of_records_per_page";
        $res_data = mysqli_query($connection,$sql);
        while($row = mysqli_fetch_array($res_data)){
            
        }
        mysqli_close($connection);
    ?>

    <ul class="pagination">
        <li><a href="?pageno=1">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
    </ul>

    </body>

</html>

