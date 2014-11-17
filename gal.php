<?php

    /**

        About!

    **/

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>The LINICKX clock gallery</title>

<link rel="author" href="https://plus.google.com/+NickBettison" title="Nick Bettison on Google+" />
<link rel="help" href="http://www.linickx.com/3941/the-linickx-clock-power-by-jquery-css3-and-google-app-engine" />
<style type="text/css">

body {
    font-family: monospace;
    font-size: 1.5em;
}

a:link, a:visited, a:active {
    color: #aa0000;
}
.container {
  position: absolute;
  left: 10%;
  top: 10%;
}

.box {
  width: 80%;
  padding: 0.1% 2% 0.1% 2%;
}

table{
    border: 1px solid black;
    table-layout: fixed;
    width: 200px;
}

th, td {
    border: 1px solid black;
    overflow: hidden;
    width: 200px;
}


</style>
</head>
<body>
    <div class="container">
        <div class="box">
            <h1>Gallery</h1>

            <table>

                <?php
                $memcache = new Memcache;
                echo '<tr>';
                for ($i = 1; $i < 21; $i++) {

                    $bg_meta_key = "bg_meta_" . $i;

                    if ($bg_meta = $memcache->get($bg_meta_key)) {
                        echo "<td>";
                        echo "<a href=" . "\"";
                        print($bg_meta['background_url']);
                        echo "\"" . ">";
                        echo "<img src=\"";
                        echo "/bg?id=" . $i;
                        echo "\"" .  "alt=" . "\"bg: " . $i . "\"" . 'height="200" width="200"';
                        echo "/></a>";
                    }


                    $tmp = $i / 5;
                    if (is_int($tmp)) {
                        echo "</td></tr> \n <tr>";
                    } else {
                        echo "</td> \n";
                    }
                }
                ?>

            </table>
        </div>
    </div>
</body>
</html>
