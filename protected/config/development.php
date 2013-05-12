<?php

return CMap::mergeArray(
    require(dirname(__FILE__) . '/main.php'),
    array(
        'components' => array(
            'db' => require(dirname(__FILE__) . '/db.php'),
        ),
    )
);