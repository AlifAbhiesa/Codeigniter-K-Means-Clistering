<?php

//echo json_encode(kmeans(array(25500, 17250, 20000, 28500, 28500, 20500, 20500, 27000, 22000), 3));
echo json_encode(kmeans(array(25500, 17250, 20000, 28500, 28500, 20500, 20500, 27000, 22000), 3));

function assign_initial_positions($data, $k)
{
        $min = min($data);
        $max = max($data);
        $int = ceil(abs($max - $min) / $k);
        while($k-- > 0)
        {
                $cPositions[$k] = $min + $int * $k;
        }
        return $cPositions;
}
