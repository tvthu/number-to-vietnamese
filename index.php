<?php


$mangso = array('không', 'một', 'hai', 'ba', 'bốn', 'năm', 'sáu', 'bảy', 'tám', 'chín');
function dochangchuc($so, $daydu)
{
    global $mangso;
    $chuoi = "";
    $chuc = floor($so / 10);
    $donvi = $so % 10;
    if ($chuc > 1) {
        $chuoi = " " . $mangso[$chuc] . " mươi";
        if ($donvi == 1) {
            $chuoi .= " mốt";
        }
    } else if ($chuc == 1) {
        $chuoi = " mười";
        if ($donvi == 1) {
            $chuoi .= " một";
        }
    } else if ($daydu && $donvi > 0) {
        $chuoi = " lẻ";
    }
    if ($donvi == 5 && $chuc > 1) {
        $chuoi .= " lăm";
    } else if ($donvi > 1 || ($donvi == 1 && chuc == 0)) {
        $chuoi .= " " . $mangso[$donvi];
    }
    return $chuoi;
}

function docblock($so, $daydu)
{
    global $mangso;
    $chuoi = "";
    $tram = floor($so / 100);
    $so = $so % 100;
    if ($daydu || $tram > 0) {
        $chuoi = " " . $mangso[$tram] . " trăm";
        $chuoi .= dochangchuc($so, true);
    } else {
        $chuoi = dochangchuc($so, false);
    }
    return $chuoi;
}

function dochangtrieu($so, $daydu)
{
    $chuoi = "";
    $trieu = floor($so / 1000000);
    $so = $so % 1000000;
    if ($trieu > 0) {
        $chuoi = docblock($trieu, $daydu) . " triệu";
        $daydu = true;
    }
    $nghin = floor($so / 1000);
    $so = $so % 1000;
    if ($nghin > 0) {
        $chuoi .= docblock($nghin, $daydu) . " nghìn";
        $daydu = true;
    }
    if ($so > 0) {
        $chuoi .= docblock($so, $daydu);
    }
    return $chuoi;
}

function docso($so)
{
    global $mangso;
    if ($so == 0) return $mangso[0];
    $chuoi = "";
    $hauto = "";
    do {
        $ty = $so % 1000000000;
        $so = floor($so / 1000000000);
        if ($so > 0) {
            $chuoi = dochangtrieu($ty, true) . $hauto . $chuoi;
        } else {
            $chuoi = dochangtrieu($ty, false) . $hauto . $chuoi;
        }
        $hauto = " tỷ";
    } while ($so > 0);
    return $chuoi;
}


$contents .= '578 => ' . docso(578) . '<br />';
$contents .= '1000 => ' . docso(1000) . '<br />';
$contents .= '35000 => ' . docso(35000) . '<br />';
$contents .= '100000 => ' . docso(100000) . '<br />';
$contents .= '1000000 => ' . docso(1000000) . '<br />';
$contents .= '1500000000 => ' . docso(1500000000) . '<br />';

echo $contents;