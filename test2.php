<?php
preg_match_all('/^0852(?P<missingnumber>\d{4})(108)$/','08521234108',$result);


var_dump($result);
