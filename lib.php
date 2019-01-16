<?php
/*
 * Thu vien co 4 cap:
 * doc so hang ty
 * doc so hang trieu
 * doc so theo tung block 3 so
 * doc so hang chuc
 *
 */


// Name of numbers, 0 to 9
$array_number_name = array('không', 'một', 'hai', 'ba', 'bốn', 'năm', 'sáu', 'bảy', 'tám', 'chín');

/**
 * Ham doc so hang chuc
 *
 * @param $so
 * @param $daydu
 * @return string
 */
function docHangChuc($so, $daydu)
{
    global $array_number_name;
    $chuoi = "";
    $chuc = floor($so / 10);
    $donvi = $so % 10;
    if ($chuc > 1) {
        $chuoi = " " . $array_number_name[$chuc] . " mươi";
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
    if ($donvi == 5 && $chuc >= 1) {
        $chuoi .= " lăm";
    } else if ($donvi > 1 || ($donvi == 1 && chuc == 0)) {
        $chuoi .= " " . $array_number_name[$donvi];
    }
    return $chuoi;
}

/**
 * Ham xu ly doc so theo tung block 3 so
 *
 * @param $so
 * @param $daydu
 * @return string
 */
function docblock($so, $daydu)
{
    global $array_number_name;
    $chuoi = "";
    $tram = floor($so / 100);
    $so = $so % 100;
    if ($daydu || $tram > 0) {
        $chuoi = " " . $array_number_name[$tram] . " trăm";
        $chuoi .= docHangChuc($so, true);
    } else {
        $chuoi = docHangChuc($so, false);
    }
    return $chuoi;
}


/**
 * Ham ho tro doc so hang trieu
 *
 * @param $so
 * @param $daydu
 * @return string
 */
function docHangTrieu($so, $daydu)
{
    $chuoi = "";

    $trieu = floor($so / 1000000);
    $so = $so % 1000000;

    // Neu so hien tai >= 1 trieu
    if ($trieu > 0) {
        $chuoi = docblock($trieu, $daydu) . " triệu";
        $daydu = true;
    }


    $nghin = floor($so / 1000);
    $so = $so % 1000;

    // Neu so hien tai >= 1 nghin
    if ($nghin > 0) {
        $chuoi .= docblock($nghin, $daydu) . " nghìn";
        $daydu = true;
    }


    if ($so > 0) {
        $chuoi .= docblock($so, $daydu);
    }

    return $chuoi;
}


/**
 * Ham chuyen tu so sang tieng viet
 *
 * @param $numberInput
 * @return string
 */
function numberToString($numberInput)
{
    global $array_number_name;
    if ($numberInput == 0) return $array_number_name[0]; // Neu so bang 0, thi tra ve


    $strResult = ""; // Ket qua dang chu
    $hauto = ""; // Hau to hang ty, chi co gia tri khi >= 1 ty.

    do {
        $ty = $numberInput % 1000000000; // mot ti


        // mot ti, lay phan nguyen khi chia cho 1 ty
        // vi du, 2,5 ty thi ta duoc 2 ( 2 ty )
        // neu 0,5 ty thi ta duoc 0 ( EMPTY )
        $numberInput = floor($numberInput / 1000000000);

        if ($numberInput > 0) {
            $strResult = docHangTrieu($ty, true) . $hauto . $strResult; // Lay ket qua doc so hang trieu, khi tong so lon hon 1 ty
        } else {
            $strResult = docHangTrieu($ty, false) . $hauto . $strResult; // Lay ket qua doc so hang trieu, khi tong so nho hon 1 ty
        }
        $hauto = " tỷ";
    } while ($numberInput > 0);


    return $strResult;
}