<?php

$result = null;

$DBuser = 'root';
$DBpass = $_ENV['MYSQL_ROOT_PASSWORD'];
$database = 'mysql:host=database:3306;dbname=docker';
$conn = new PDO($database, $DBuser, $DBpass);

// if post request
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // if the delete button was clicked
    if (isset($_POST["delete"])) {
        $sql = "DELETE FROM books WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $_POST["id"]);
        $stmt->execute();
    } else {

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
                // if all fields are filled
                // post to the database
                $sql = "INSERT INTO books (title, price, quantity, flag) VALUES ('$title', '$price', '$quantity', '$flag')";
                if (isset($_POST["id"]) && !empty($_POST["id"])) {
                    $id = $_POST["id"];
                    $sql = "UPDATE books SET title = '$title', price = '$price', quantity = '$quantity', flag = '$flag' WHERE id = '$id'";
                }
                $result = $conn->prepare($sql);
                $result->execute();
            
            
            }
        }
    }
} 
$result = $conn->prepare("SELECT * FROM books ORDER BY id ASC");
$result->execute();

?>
<head>
    <title>ZippyBooks</title>
    <script type="text/javascript">
        function editButton(id) {
            // get the data from the divs
            console.log(id);
            var title = document.getElementById("title" + id).innerHTML;
            var price = document.getElementById("price" + id).innerHTML;
            var quantity = document.getElementById("quantity" + id).innerHTML;
            var flag = document.getElementById("flag" + id).innerHTML;

            // set the values in the form
            document.getElementById("title").value = title;
            document.getElementById("price").value = price;
            document.getElementById("quantity").value = quantity;
            document.getElementById("flag").checked = flag.includes("Yes");
            document.getElementById("id").value = id;
            document.getElementById("submit").value = "Update Book";
        }

        function clearForm() {
            document.getElementById("title").value = "";
            document.getElementById("price").value = "";
            document.getElementById("quantity").value = "";
            document.getElementById("flag").value = "";
            document.getElementById("id").value = "";
            document.getElementById("submit").value = "Add Book";
        }
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<!--HTML table-->
<table class="table">
    <tr>
        <th>Title</th>
        <th>$Price</th>
        <th>Quantity</th>
        <th>Discontinued?</th>
        <th>Delete</th>
        <th>Edit</th>
    </tr>
    <?php for($i=0; $row = $result->fetch(); $i++){ ?>
        <tr>
            <td><div id="title<?php echo $row['id'] ?>"><?php echo $row['title']; ?></div></td>
            <td><div id="price<?php echo $row['id'] ?>"><?php echo $row['price']; ?></div></td>
            <td><div id="quantity<?php echo $row['id'] ?>"><?php echo $row['quantity']; ?></div></td>
            <td><div id="flag<?php echo $row['id'] ?>"><?php echo $row['flag'] ? 'Yes' : 'No'; ?></div></td>
            <td>
                <form action="index.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input class="btn btn-danger" type="submit" name="delete" value="Delete">
                </form>
            </td>
            <td>
                <button class="btn btn-secondary" onclick="editButton('<?php echo $row['id'] ?>')" id="<?php echo $row['id'] ?>"> Edit </button>
            </td>
        </tr>
    <?php } ?>
</table>

<!-- Form to add new book -->
<div class="container">
    <form action="index.php" method="post">
        <label class="form-label">Title: <input class="form-control" type="text" name="title" id="title"/></label>
        <br>
        <label class="form-label">Price: <input class="form-control" type="text" name="price" id="price"/></label>
        <br>
        <label class="form-label">Quantity: <input class="form-control" type="text" name="quantity" id="quantity"/></label>
        <br>
        <label class="form-label">Discontinued: <input type="checkbox" name="flag" id="flag" /></label>
        <br>
        <input type="hidden" name="id" id="id" />
        <br>
        <input class="btn btn-primary" type="submit" id="submit" value="Add Book" />
    </form>
    <button class="btn btn-danger" onclick="clearForm()">Cancel</button>
</div>