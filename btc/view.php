<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BTC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Dropdown
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
                </li>
                <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            </div>
        </div>
    </nav>
    <br>
    <div class="container">
        <div class="card" style="padding:20px">
            <p style="text-align:center;font-size:48px;">Bitcoin Price</p>
            <table class="table table-striped">
                <tr class="table-info">
                    <td>No</td>
                    <td>Currency Code</td>
                    <td>Exchange Rate Now</td>
                    <td>Exchange Rate Preview</td>
                    <td>Difference</td>
                    <td>Percentage</td>
                    <td>Last Refreshed</td>
                    <td>Bid Price</td>
                    <td>Ask Price</td>
                </tr>
                <?php
                    require_once '../koneksi.php';
                    $i = 1;
                    $query_data = $db->prepare("SELECT * FROM stock");
                    $query_data->execute();
                    while($data = $query_data->fetch(PDO::FETCH_ASSOC)){
                        $last_id = $data['id']+1;
                        $query_preview = $db->prepare("SELECT exchange_rate FROM stock WHERE id = :id");
                        $query_preview->bindParam(':id',$last_id);
                        $query_preview->execute();
                        $preview = $query_preview->fetch(PDO::FETCH_ASSOC);
                ?>
                <tr>
                    <td><?=$i++?></td>
                    <td><?=$data['currency_code']?> to <?=$data['to_currency_code']?></td>
                    <td><?=$data['exchange_rate']?></td>
                    <td <?php if(isset($preview['exchange_rate'])){
                                if($data['exchange_rate'] > $preview['exchange_rate']){
                                    echo "style='color:red'";    
                                }else{
                                    echo "style='color:green'";    
                                }}
                        ?>>
                        <?php if(isset($preview['exchange_rate'])){
                            echo $preview['exchange_rate'];
                            }?>
                    </td>
                    <td <?php if(isset($preview['exchange_rate'])){
                                if($data['exchange_rate'] > $preview['exchange_rate']){
                                    echo "style='color:red'";    
                                }else{
                                    echo "style='color:green'";    
                                }}
                        ?>>
                        <?php 
                            if(isset($preview['exchange_rate'])){
                                if($data['exchange_rate'] > $preview['exchange_rate']){
                                    echo number_format($difference = $data['exchange_rate'] - $preview['exchange_rate'], 2, '.', '');
                                    echo "<button  class='btn btn-danger'><i class='bi bi-arrow-down-square-fill'></i></button>";
                                }else{
                                    echo number_format($difference = $preview['exchange_rate'] - $data['exchange_rate'], 2, '.', '');
                                    echo "<button  class='btn btn-success'><i class='bi bi-arrow-up-square-fill'></i></button>";
                                }
                            }
                        ?>
                    </td>
                    <td <?php if(isset($preview['exchange_rate'])){
                                if($data['exchange_rate'] > $preview['exchange_rate']){
                                    echo "style='color:red'";    
                                }else{
                                    echo "style='color:green'";    
                                }}
                        ?>>
                        <?= number_format($difference / $data['exchange_rate'] * 100, 3, '.', '')?>%
                    </td>
                    <td><?=//$time_here = date("Y-m-d H:i:s", strtotime(sprintf("+6 hours",$data['last_refreshed'])))
                        $data['last_refreshed']?></td>
                    <td><?=$data['bid_price']?></td>
                    <td><?=$data['ask_price']?></td>
                </tr>
                <?php }?>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>