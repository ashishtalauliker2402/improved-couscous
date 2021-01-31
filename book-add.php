<?php
require_once 'functions.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insert Book</title>
    <script>
        function show_value(x)
        {
            document.getElementById("slider_value").innerHTML=x;
        }
    </script>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Book:Name: </td>
                <td><input type="text" name="bookname" id="bookname" /></td>
            </tr>
            <tr>
                <td>Author Email: </td>
                <td><input type="text" name="authoremail" id="authoremail" /></td>
            </tr>
            <tr>
                <td>Cover Picture: </td>
                <td><input type="file" name="coverpic" id="coverpic" /></td>
            </tr>
            <tr>
                <td>Date Published: </td>
                <td><input type="date" name="publishdate" id="publishdate" /></td>
            </tr>
            <tr>
                <td>Review: </td>
                <td><input type="text" name="review" id="review" /></td>
            </tr>
            <tr>
                <td>ISBN Number: </td>
                <td><input type="text" name="isbn" id="isbn" /></td>
            </tr>
            <tr>
                <td>Price: </td>
                <td><input type="number" name="price" id="price" step=0.01 /></td>
            </tr>
            <tr>
                <td>Category: </td>
                <td>
                    <select name="category" id="category">
                        <option value="0" disabled selected value>Select</option>
                        <option value="1">Magezine</option>
                        <option value="2">Novel</option>
                        <option value="3">Textbook</option>
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
                        <option value="0" disabled selected value>Select</option>
                        <option value="is_paperback">Paperback</option>
                        <option value="is_hardback">Hardback</option>
                        <option value="is_ebook">Ebook</option>
                    </select>
                </td>
            </tr>
            <!-- <tr>
                <td>Paperback: </td>
                <td><input type="radio" name="type" id="type" value="is_paperback" /></td>
            </tr>
            <tr>
                <td>Hardback: </td>
                <td><input type="radio" name="type" id="type" value="is_hardback" /></td>
            </tr>
            <tr>
                <td>Ebook: </td>
                <td><input type="radio" name="type" id="type" value="is_ebook" /></td>
            </tr> -->
            <tr>
                <td>Stock: </td>
                <td><input type="checkbox" name="stock" id="stock" value="1" /></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="input_form" value="Add Book"></td>
            </tr>
        </table>
    </form>
</body>
</html>