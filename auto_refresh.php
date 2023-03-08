<?php
$page = $_SERVER['PHP_SELF'];
$sec = "60";
date_default_timezone_set("Asia/Bangkok");
$date_time = date("Y-m-d H:i:s");
require_once 'koneksi.php';
?>
<html>
    <head>
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    </head>
    <body>
    <?php
        //echo "Watch the page reload itself in 10 second!";
        $json = file_get_contents('https://www.alphavantage.co/query?function=CURRENCY_EXCHANGE_RATE&from_currency=BTC&to_currency=USD&apikey=W850ZLPGM75SAE3D');

        $data = json_decode($json,true);
        
        //print_r($data);
        $result = $data['Realtime Currency Exchange Rate'];  
        print_r($data['Realtime Currency Exchange Rate']);
        echo "<br>";
        echo $result['1. From_Currency Code'];
        echo "<br>";
        echo $result['2. From_Currency Name'];
        echo "<br>";
        echo $result['3. To_Currency Code'];
        echo "<br>";
        echo $result['4. To_Currency Name'];
        echo "<br>";
        echo $result['5. Exchange Rate'];
        echo "<br>";
        echo $result['6. Last Refreshed'];
        echo "<br>";
        echo $result['7. Time Zone'];
        echo "<br>";
        echo $result['8. Bid Price'];
        echo "<br>";
        echo $result['9. Ask Price'];
        echo "<br>";
        $insert = $db->prepare("INSERT INTO stock (currency_code,currency_name,to_currency_code,to_currency_name,exchange_rate,last_refreshed,time_zone,bid_price,ask_price,created_at) VALUES (:currency_code,:currency_name,:to_currency_code,:to_currency_name,:exchange_rate,:last_refreshed,:time_zone,:bid_price,:ask_price,:created_at)");
        $insert->bindParam(':currency_code',$result['1. From_Currency Code']);
        $insert->bindParam(':currency_name',$result['2. From_Currency Name']);
        $insert->bindParam(':to_currency_code',$result['3. To_Currency Code']);
        $insert->bindParam(':to_currency_name',$result['4. To_Currency Name']);
        $insert->bindParam(':exchange_rate',$result['5. Exchange Rate']);
        $insert->bindParam(':last_refreshed',$result['6. Last Refreshed']);
        $insert->bindParam(':time_zone',$result['7. Time Zone']);
        $insert->bindParam(':bid_price',$result['8. Bid Price']);
        $insert->bindParam(':ask_price',$result['9. Ask Price']);
        $insert->bindParam(':created_at',$date_time);
        $insert->execute();
        exit;

    ?>
    
    </body>
</html>