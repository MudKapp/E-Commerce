<?php require_once('Database.php');?>    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="./js/script.js" defer></script>
</head>
<body>
<?php
    $result;
        if(isset($_GET['search'])){
            $q = '%' . $_GET['search'] . '%';
            $q = htmlspecialchars(strip_tags($q));
            $conn = new Database();
            $stm = "SELECT id, name, price, image FROM products WHERE name LIKE :q;";
            $sth = $conn->prepare($stm);
            $sth->bindParam(':q',$q,PDO::PARAM_STR);
            if(!$sth->execute()){
                die('ERROR: Could not search database');
            }
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        }
    ?>
    <div class="container ">
        <div class="col ">
                <form class="form-inline my-4 row" action="/" method="get">
                <div class="col-8 col-md-10">
                    <div class="form-group">
                        <input class="form-control w-100"  name="search" type="text" >
                    </div>
                </div>
                <div class="col-4 col-md-2">
                    <button class="btn btn-primary px-5">Search</button>
                </div>
                </form>
            <?php if(isset($result)): ?>
            <div class="row">
                <table class="table table-hover table-bordered "  >
                    <thead class="thead-dark">
                        <th></th>
                        <th>Name</th>
                        <th>(£)Price</th>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $product): ?>
                            <tr class="product" data-id = <?php echo $product['id']?>>
                                <td><img class="mx-auto d-block" src="<?php echo $product['image'] ?>" alt="Product Image" width='100' ></td>
                                <td><?php echo $product['name']?></td>
                                <td style="text-align:center;"><?php echo "£" . number_format($product['price'],2) ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </div>
    </div>
    

</body>
</html>