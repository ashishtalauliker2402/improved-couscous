<?php
require_once 'connection.php';

function get_all_data(){
    global $conn;
    $result = mysqli_query($conn, "SELECT BK.book_id, BK.book_name, BK.author_email, BK.cover_picture, BK.dt_publish, BK.review, BK.isbn_number, BK.price, C.categories, BK.rating, BK.is_paperback, BK.is_hardback, BK.is_ebook, BK.is_stock, BK.dt_modified FROM book_categories AS BC LEFT JOIN books AS bk ON BC.book_id=BK.book_id LEFT JOIN categories AS C ON BC.cat_id=C.cat_id");

    echo '
    <table width="100%" border="1">
        <tr>
            <td>Book:Name: </td>
            <td>Author Email: </td>
            <td>Cover Picture: </td>
            <td>Date Published: </td>
            <td>Review: </td>
            <td>ISBN Number: </td>
            <td>Price: </td>
            <td>Category: </td>
            <td>Rating: </td>
            <td>Paperback: </td>
            <td>Hardback: </td>
            <td>Ebook: </td>
            <td>Stock: </td>
            <td>Date Modified: </td>
            <td>Operations</td>
        </tr>
    ';

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo'
                <tr>'.
                    '<td>'.$row["book_name"].'</td>'.
                    '<td>'.$row["author_email"].'</td>'.
                    '<td><img src="img/'.$row['cover_picture'].'" height="100" width="100"></td>'.
                    '<td>'.$row["dt_publish"].'</td>'.
                    '<td>'.$row["review"].'</td>'.
                    '<td>'.$row["isbn_number"].'</td>'.
                    '<td>'.$row["price"].'</td>'.
                    '<td>'.$row["categories"].'</td>'.
                    '<td>'.$row["rating"].'</td>'.
                    '<td>'.$row["is_paperback"].'</td>'.
                    '<td>'.$row["is_hardback"].'</td>'.
                    '<td>'.$row["is_ebook"].'</td>'.
                    '<td>'.$row["is_stock"].'</td>'.
                    '<td>'.$row["dt_modified"].'</td>'.
                    '<td><a href="book-edit.php?id='.$row['book_id'].'">Update</a></td>'.
                    '<td><a href="book-delete.php?id='.$row['book_id'].'" onclick="return confirm(\'Are you Sure?\');">Delete</a></td>'.
                '</tr>
            ';
        }
    echo '</table>';
    } else "<h3>Database fail</h3";
}

function update_get(){
    if(isset($_GET['id']) && is_numeric($_GET['id'])){
        global $conn;
        $id = $_GET['id'];
        $get_id = mysqli_query($conn, "SELECT BK.book_id, BK.book_name, BK.author_email, BK.cover_picture, BK.dt_publish, BK.review, BK.isbn_number, BK.price, BK.type, C.categories, BK.rating, BK.is_paperback, BK.is_hardback, BK.is_ebook, BK.is_stock, BK.dt_modified FROM book_categories AS BC LEFT JOIN books AS BK ON BC.book_id=BK.book_id LEFT JOIN categories AS C ON BC.cat_id=C.cat_id WHERE BK.book_id=$id");
        if(mysqli_num_rows($get_id) == 1){
            $row = mysqli_fetch_assoc($get_id);
            return($row);
        }
    }
}

if(isset($_POST["input_form"])){
    if(isset($_POST['bookname']) && isset($_POST['authoremail'])){
        if(!empty($_POST['bookname']) && !empty($_POST['authoremail']) && !empty($_POST['publishdate']) && !empty($_POST['review']) && !empty($_POST['isbn']) && !empty($_POST['price'])  && !empty($_POST['category'])  && !empty($_POST['rating']) && !empty($_POST['type'])){
            $stock = 0;
            $bookname = $_POST['bookname'];
            $authoremail = $_POST['authoremail'];
            if (!filter_var($authoremail, FILTER_VALIDATE_EMAIL)){
                die("Email format incorrect!");
            }
            // $coverpic = $_OST['coverpic'];
            if($_FILES['coverpic']['name']!=''){
                $coverpic = $_FILES['coverpic'];
                $filename = $_FILES['coverpic']['name'];
                $filetempname = $_FILES['coverpic']['tmp_name'];
                $filesize = $_FILES['coverpic']['size'];
                $fileerror = $_FILES['coverpic']['error'];
                $filetype = $_FILES['coverpic']['type'];

                $fileext = explode('.', $filename);
                $fileactualext = strtolower(end($fileext));
                $allow = array('jpg', 'jpeg', 'png');

                if(in_array($fileactualext, $allow)){
                    if($fileerror === 0){
                        if($filesize < 2097152){
                            $filenamenew = uniqid('', true).".".$fileactualext;
                            $filedestination = 'img/'.$filenamenew;
                            move_uploaded_file($filetempname, $filedestination);
                        }else{
                            echo "Your file is too big";
                        }
                    }else{
                        echo "There was an error uploading your file";
                    } 
                }else{
                    echo 'Only jpg and png files allowed';
                }
            }else{
                $filenamenew = '';
            }
            $publishdate = $_POST['publishdate'];
            $review = $_POST['review'];
            $isbn = $_POST['isbn'];
            if(!preg_match("/^ISBN[0-9]{6}$/", $isbn)){
                die("ISBN format incorrect");
            }
            $price = $_POST['price'];
            $category = $_POST['category'];
            if($category === '1' || $category === '2' || $category === '3'){
                
            }else{
                die("Invalid Genre");
            }
            $rating = $_POST['rating'];
            $type = $_POST['type'];
            if($type === 'is_paperback' || $type === 'is_hardback' || $type === 'is_ebook'){
                
            }else{
                die("Invalid Book Type");
            }
            if(isset($_POST['stock'])){
                $stock = 1;
            }
        }else{
            die('Fields cannot be empty'. mysqli_error($conn));
        }
    
        $insert_query = mysqli_query($conn, "INSERT INTO books (book_name, author_email, cover_picture, dt_publish, review, isbn_number, price, type, rating, $type, is_stock) VALUES('$bookname', '$authoremail', '$filenamenew', '$publishdate', '$review', '$isbn', $price, $category, $rating, 1, $stock)");
        if($insert_query){
            $last_id = $conn->insert_id;
            echo '<h3>Insert Successful</h3>';
        } else {
            die('Could not enter data: '. mysqli_error($conn));
        }
        
        $insert_query2 = mysqli_query($conn, "INSERT INTO book_categories (book_id, cat_id) VALUES ($last_id, $category)");
        if($insert_query2){
            echo '<h3>Insert Successful</h3>';
            echo "<script>window.location.href = 'book-list.php';</script>";
        } else {
            die('Could not enter the data: '. mysqli_error($conn));
        }
    }else{
        echo "<h4>Please fill all fields</h4>";
    }
}

if(isset($_POST['update_form'])){
    if(isset($_POST['bookname']) && isset($_POST['authoremail'])){
        if(!empty($_POST['bookname']) && !empty($_POST['authoremail']) && !empty($_POST['publishdate']) && !empty($_POST['review']) && !empty($_POST['isbn']) && !empty($_POST['price'])  && !empty($_POST['category'])  && !empty($_POST['rating']) && !empty($_POST['type'])){
            $book_id = $_POST['book_id'];
            $stock = 0;
            $bookname = $_POST['bookname'];
            $authoremail = $_POST['authoremail'];
            if (!filter_var($authoremail, FILTER_VALIDATE_EMAIL)){
                die("Email format incorrect!");
            }
            // $coverpic = $_POST['coverpic'];
            if($_FILES['coverpic']['name']!=''){
                $coverpic = $_FILES['coverpic'];
                $filename = $_FILES['coverpic']['name'];
                $filetempname = $_FILES['coverpic']['tmp_name'];
                $filesize = $_FILES['coverpic']['size'];
                $fileerror = $_FILES['coverpic']['error'];
                $filetype = $_FILES['coverpic']['type'];

                $fileext = explode('.', $filename);
                $fileactualext = strtolower(end($fileext));
                $allow = array('jpg', 'jpeg', 'png');

                if(in_array($fileactualext, $allow)){
                    if($fileerror === 0){
                        if($filesize < 2097152){
                            $filenamenew = uniqid('', true).".".$fileactualext;
                            $filedestination = 'img/'.$filenamenew;
                            move_uploaded_file($filetempname, $filedestination);
                        }else{
                            echo "Your file is too big";
                        }
                    }else{
                        echo "There was an error uploading your file";
                    } 
                }else{
                    echo 'Only jpg and png files allowed';
                }
            }else{
                $filenamenew = '';
            }
            
            $publishdate = $_POST['publishdate'];
            $review = $_POST['review'];
            $isbn = $_POST['isbn'];
            if(!preg_match("/^ISBN[0-9]{6}$/", $isbn)){
                die("ISBN format incorrect");
            }
            $price = $_POST['price'];
            $category = $_POST['category'];
            if($category === '1' || $category === '2' || $category === '3'){
                
            }else{
                die("Invalid Book Type");
            }
            $rating = $_POST['rating'];
            $type = $_POST['type'];
            if($type === 'is_paperback' || $type === 'is_hardback' || $type === 'is_ebook'){
                
            }else{
                die("Invalid Book Type");
            }
            if(isset($_POST['stock'])){
                $stock = 1;
            }
            
        }else{
            die('Fields cannot be empty'. mysqli_error($conn));
        }
    
        $update_query1 = mysqli_query($conn, "UPDATE books SET is_paperback=0, is_hardback=0, is_ebook=0 WHERE book_id=$book_id");
        if($update_query1){
            echo '<h3>Update 1 Successful</h3>';
        } else {
            die('Could not enter data: '. mysqli_error($conn));
        }
        
        $update_query2 = mysqli_query($conn, "UPDATE books SET book_name='$bookname', author_email='$authoremail', cover_picture='$filenamenew', dt_publish='$publishdate', review='$review', isbn_number='$isbn', price=$price, type=$category, rating=$rating, $type=1, is_stock=$stock WHERE book_id=$book_id");
        if($update_query2){
            echo '<h3>Update 2 Successful</h3>';
            echo "<script>window.location.href = 'book-list.php';</script>";
        } else {
            die('Could not enter data: '. mysqli_error($conn));
        }

        // $update_query3 = mysqli_query($conn, "UPDATE book_categories SET cat_id=$category WHERE book_id=$book_id");
        // if($update_query3){
        //     echo '<h3>Update 3 Successful</h3>';
        // } else {
        //     die('Could not enter the data: '. mysqli_error($conn));
        // }
    }else{
        echo "<h4>Please fill all fields</h4>";
    }
}

function delete(){
    global $conn;
    if(isset($_GET['id']) && is_numeric($_GET['id'])){
        $book_id = $_GET['id'];
        $delete_query1 = mysqli_query($conn, "DELETE FROM books WHERE book_id=$book_id");

        if($delete_query1){
            echo "<script>alert('Data Deleted');window.location.href = 'book-list.php';</script>";
            exit;
        }else{
            echo 'Something went wrong';
        }
    }
}

?>