    <?php
    //$output = "1213";
    $res = exec('java -jar ibl-col-encrypt.jar', $output);
    print_r($res);
    print_r($output);
    ?>
