<?php
class Hijri_Hijrimodule_Helper_Hijridate extends Mage_Core_Helper_Abstract

{
	public

	function Greg2Hijri($day, $month, $year, $string = false)
	{
		function intPart($float)
		{
			if ($float < - 0.0000001) return ceil($float - 0.0000001);
			else return floor($float + 0.0000001);
		}

		function MonthName($month)
		{
			$month = (int)$month;
			static $months = array(
				"Muharram",
				"Safar",
				"Rabee al-Awwal",
				"Rabee al-Akhar",
				"Jumada al-Awwal",
				"Jumada al-Akhar",
				"Rajab",
				"Shaban",
				"Ramadan",
				"Shawwal",
				"Dhu al-Qa'dah",
				"Dhu al-Hijjah"
			);
			return $months[$month];
		}

		$day = (int)$day;
		$month = (int)$month;
		$year = (int)$year;
		if (($year > 1582) or (($year == 1582) and ($month > 10)) or (($year == 1582) and ($month == 10) and ($day > 14)))
		{
			$jd = intPart((1461 * ($year + 4800 + intPart(($month - 14) / 12))) / 4) + intPart((367 * ($month - 2 - 12 * (intPart(($month - 14) / 12)))) / 12) - intPart((3 * (intPart(($year + 4900 + intPart(($month - 14) / 12)) / 100))) / 4) + $day - 32075;
		}
		else
		{
			$jd = 367 * $year - intPart((7 * ($year + 5001 + intPart(($month - 9) / 7))) / 4) + intPart((275 * $month) / 9) + $day + 1729777;
		}

		$l = $jd - 1948440 + 10632;
		$n = intPart(($l - 1) / 10631);
		$l = $l - 10631 * $n + 354;
		$j = (intPart((10985 - $l) / 5316)) * (intPart((50 * $l) / 17719)) + (intPart($l / 5670)) * (intPart((43 * $l) / 15238));
		$l = $l - (intPart((30 - $j) / 15)) * (intPart((17719 * $j) / 50)) - (intPart($j / 16)) * (intPart((15238 * $j) / 43)) + 29;
		$month = intPart((24 * $l) / 709);
		$day = $l - intPart((709 * $month) / 24);
		$year = 30 * $n + $j - 30;
		$month = MonthName($month - 1);
		$date = array();
		$date['year'] = $year;
		$date['month'] = $month;
		$date['day'] = $day;
		if (!$string) return $date;
		else return "{$day} {$month}, {$year}";
	}
}

?>