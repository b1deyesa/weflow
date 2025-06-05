<?php

if (!function_exists('currency')) {
    function currency($value, $prefix = 'Rp')
    {
        return $prefix . number_format($value, 0, ',', '.');
    }
}

if (!function_exists('days')) {
    function days($values)
    {
        $days = [
            1 => 'Mon',
            2 => 'Tue',
            3 => 'Wed',
            4 => 'Thu',
            5 => 'Fri',
            6 => 'Sat',
            7 => 'Sun',
        ];
        

        $activeDays = array_keys(json_decode($values, true));

        $result = '<div class="d-flex gap-1">';

        foreach ($days as $index => $day) {
            if (in_array($index, $activeDays)) {
                $result .= '<span class="bg-secondary text-light rounded-1 d-block text-center" style="width: 35px; padding: .1em .3em; font-size: .8em">' . $day . '</span> ';
            } else {
                $result .= '<span class="border border-secondary text-secondary rounded-1 d-block text-center" style="width: 35px; padding: .1em .3em; font-size: .8em">' . $day . '</span> ';
            }
        }

        $result .= '</div>';
        
        return $result;
    }
}

if (!function_exists('avail_days')) {
    function avail_days($values, $choose)
    {
        $days = [
            1 => 'Mon',
            2 => 'Tue',
            3 => 'Wed',
            4 => 'Thu',
            5 => 'Fri',
            6 => 'Sat',
            7 => 'Sun',
        ];
        
        $choose = array_keys($choose);
        
        $activeDays = array_keys(json_decode($values, true));

        $result = '<div class="d-flex gap-1">';

        foreach ($days as $index => $day) {
            if (in_array($index, $activeDays)) {
                if (in_array($index, $choose)) {
                    $result .= '<span class="bg-success text-light rounded-1 d-block text-center" style="width: 35px; padding: .1em .3em; font-size: .8em;">' . $day . '</span> ';
                } else {
                    $result .= '<span class="bg-secondary text-light rounded-1 d-block text-center" style="width: 35px; padding: .1em .3em; font-size: .8em; opacity: .5">' . $day . '</span> ';
                }
            } else {
                if (!empty(array_intersect([$index], $choose))) {
                    $result .= '<span class="bg-danger text-light rounded-1 d-block text-center" style="width: 35px; padding: .1em .3em; font-size: .8em;">' . $day . '</span> ';
                } else {
                    $result .= '<span class="border border-secondary text-secondary rounded-1 d-block text-center" style="width: 35px; padding: .1em .3em; font-size: .8em; opacity: .5">' . $day . '</span> ';
                }
            }
        }
        
        
        $result .= '</div>';
        
        return $result;
    }
}

if (!function_exists('day')) {
    function day($values)
    {
        $days = [
            1 => 'Mon',
            2 => 'Tue',
            3 => 'Wed',
            4 => 'Thu',
            5 => 'Fri',
            6 => 'Sat',
            7 => 'Sun',
        ];

        $activeDays = array_keys(json_decode($values, true));
        
        $result = '<div class="d-flex gap-1">';

        foreach ($days as $index => $day) {
            if (in_array($index, $activeDays)) {
                $result .= '<span class="bg-secondary text-light rounded-1 d-block text-center" style="width: 35px; padding: .1em .3em; font-size: .8em">' . $day . '</span> ';
            }
        }

        $result .= '</div>';
        
        return $result;
    }
}

if (!function_exists('status')) {
     function status($bool)
    {
        return $bool ? '<span class="text-success">Active</span>' : '<span class="text-danger">Inactive</span>'; 
    }
}