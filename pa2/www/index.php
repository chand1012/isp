<?php

$result = null;

$DBuser = 'root';
$DBpass = $_ENV['MYSQL_ROOT_PASSWORD'];
$database = 'mysql:host=database:3306;dbname=docker';
$conn = new PDO($database, $DBuser, $DBpass);

// if post request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $flag = 0;
    // check if flag is set
    if (isset($_POST["flag"])) {
        $flag = 1;
    }

    // if title is empty
    if (empty($title)) {
        $result = "Title is required";
        echo $result;
    } else {
        // if price is empty
        if (empty($price)) {
            $result = "Price is required";
            echo $result;
        } else {
            // if quantity is empty
            if (empty($quantity)) {
                $result = "Quantity is required";
                echo $result;
            } else {
                
                // if all fields are filled
                // post to the database
                $sql = "INSERT INTO books (title, price, quantity, flag) VALUES ('$title', '$price', '$quantity', '$flag')";
                $result = $conn->prepare($sql);
                $result->execute();
            
            }
        }
    }
} 
$result = $conn->prepare("SELECT * FROM books ORDER BY id ASC");
$result->execute();

?>

<!--HTML table-->
<table>
    <tr>
        <th>Title</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Discontinued?</th>
    </tr>
    <?php for($i=0; $row = $result->fetch(); $i++){ ?>
        <tr>
            <td><?php echo $row['title']; ?></td>
            <td>$<?php echo $row['price']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td><?php echo $row['flag'] ? 'Yes' : 'No'; ?></td>
        </tr>
    <?php } ?>
</table>

<!-- Form to add new book -->
<form action="index.php" method="post">
    <label>Title: <input type="text" name="title" /></label>
    <label>Price: <input type="text" name="price" /></label>
    <label>Quantity: <input type="text" name="quantity" /></label>
    <!-- if input is not set, send "off" -->
    <label>Discontinued: <input type="checkbox" name="flag"  /></label>
    <input type="submit" value="Add Book" />
</form>