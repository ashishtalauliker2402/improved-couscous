<?php
require_once 'functions.php';
$row = update_get();
$is_mag_selected = '';
$is_novel_selected = '';
$is_textbook_selected = '';
$is_paper_selected = '';
$is_hard_selected = '';
$is_ebook_selected = '';
if($row['type'] == 1){
    $is_mag_selected = 'selected';
}
if($row['type'] == 2){
    $is_novel_selected = 'selected';
}
if($row['type'] == 3){
    $is_textbook_selected = 'selected';
}
if($row['is_paperback'] == 1){
    $is_paper_selected = 'selected';
}
if($row['is_hardback'] == 1){
    $is_hard_selected = 'selected';
}
if($row['is_ebook'] == 1){
    $is_ebook_selected = 'selected';
}
?>
<html>
<head>
    <title>Books</title>
    <script>
        function show_value(x)
        {
            document.getElementById("slider_value").innerHTML=x;
        }
    </script>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $row['book_id']; ?>" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Book:Name: </td>
                <td><input type="text" name="bookname" id="bookname" value="<?php echo $row['book_name'] ?>" /></td>
            </tr>
            <tr>
                <td>Author Email: </td>
                <td><input type="text" name="authoremail" id="authoremail" value="<?php echo $row['author_email'] ?>" /></td>
            </tr>
            <tr>
                <td>Cover Picture: </td>
                <td>
                <img src="img/<?php echo $row['cover_picture'] ?>" height="100" width="100">
                    <input type="file" name="coverpic" id="coverpic" value="<?php echo $row['cover_picture'] ?>" />
                </td>
            </tr>
            <tr>
                <td>Date Published: </td>
                <td><input type="date" name="publishdate" id="publishdate" value="<?php echo $row['dt_publish'] ?>" /></td>
            </tr>
            <tr>
                <td>Review: </td>
                <td><input type="text" name="review" id="review" value="<?php echo $row['review'] ?>" /></td>
            </tr>
            <tr>
                <td>ISBN Number: </td>
                <td><input type="text" name="isbn" id="isbn" value="<?php echo $row['isbn_number'] ?>" /></td>
            </tr>
            <tr>
                <td>Price: </td>
                <td><input type="text" name="price" id="price" value="<?php echo $row['price'] ?>" /></td>
            </tr>
            <tr>
                <td>Category: </td>
                <td>
                    <select name="category" id="category" >
                        <option value="1" <?php echo $is_mag_selected ?>>Magezine</option>
                        <option value="2" <?php echo $is_novel_selected?>>Novel</option>
                        <option value="3" <?php echo $is_textbook_selected?>>Textbook</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Rating: </td>
                <td><input type="range" name="rating" id="rating" min="0" max="10" value="5" onchange="show_value(this.value);"/><label id="slider_value"></label></td>
            </tr>
            <tr>
                <td>Book Type: </td>
                <td>
                    <select name="type" id="type">
                        <option value="is_paperback" <?php echo $is_paper_selected ?>>Paperback</option>
                        <option value="is_hardback" <?php echo $is_hard_selected ?>>Hardback</option>
                        <option value="is_ebook" <?php echo $is_ebook_selected ?>>Ebook</option>
                    </select>
                </td>
            </tr>
            <!-- <tr>
                <td>Paperback: </td>
                <td><input type="radio" name="type" id="type" value="is_paperback" /></td>
            </tr>
            <tr>
                <td>Hardback: </td>'.
                <td><input type="radio" name="type" id="type" value="is_hardback" /></td>
            </tr>
            <tr>
                <td>Ebook: </td>
                <td><input type="radio" name="type" id="type" value="is_ebook" /></td>
            </tr> -->
            <tr>
                <td>Stock: </td>
                <td><input type="checkbox" name="stock" id="stock" value="<?php echo $row['is_stock'] ?>" /></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="update_form" value="Update Book"></td>
            </tr>
        </table>
        <input type="hidden" name="book_id" value="<?php echo $row['book_id']; ?>" />
    </form>
        

</body>
</html>