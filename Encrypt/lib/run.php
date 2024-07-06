    <?php
    $output = "1213";
    $res = exec('java -jar CryptoLib.jar', $output);
    print_r($res);
    print_r($output);
    ?>
