<?php
class Hijri_Hijrimodule_Helper_Hijridate extends Mage_Core_Helper_Abstract

{
		public	function intPart($float)
		{
			if ($float < - 0.0000001) return ceil($float - 0.0000001);
			else return floor($float + 0.0000001);
		}

		public function MonthName($month)
		{
			
			$month = (int)$month;
			$locale = Mage::app()->getLocale()->getLocaleCode();
			if ($locale === 'ar_SA') {
				$months = array(
					"محرم",
					"صفر",
					"ربيع الأول",
					"ربيع الآخر",
					"جمادى الأولى",
					"جمادى الآخرة",
					"رجب",
					"شعبان",
					"رمضان",
					"شوال",
					"ذو القعدة",
					"ذو الحجة"
				);
			} else {
				 $months = array(
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
			}
			
			return $months[$month];
		}
		
	public function Greg2Hijri($day, $month, $year, $string = false)
	{


		$day = (int)$day;
		$month = (int)$month;
		$year = (int)$year;
		if (($year > 1582) or (($year == 1582) and ($month > 10)) or (($year == 1582) and ($month == 10) and ($day > 14)))
		{
			$jd = $this->intPart((1461 * ($year + 4800 + $this->intPart(($month - 14) / 12))) / 4) + $this->intPart((367 * ($month - 2 - 12 * ($this->intPart(($month - 14) / 12)))) / 12) - $this->intPart((3 * ($this->intPart(($year + 4900 + $this->intPart(($month - 14) / 12)) / 100))) / 4) + $day - 32075;
		}
		else
		{
			$jd = 367 * $year - $this->intPart((7 * ($year + 5001 + $this->intPart(($month - 9) / 7))) / 4) + $this->intPart((275 * $month) / 9) + $day + 1729777;
		}

		$l = $jd - 1948440 + 10632;
		$n = $this->intPart(($l - 1) / 10631);
		$l = $l - 10631 * $n + 354;
		$j = ($this->intPart((10985 - $l) / 5316)) * ($this->intPart((50 * $l) / 17719)) + ($this->intPart($l / 5670)) * ($this->intPart((43 * $l) / 15238));
		$l = $l - ($this->intPart((30 - $j) / 15)) * ($this->intPart((17719 * $j) / 50)) - ($this->intPart($j / 16)) * ($this->intPart((15238 * $j) / 43)) + 29;
		$month = $this->intPart((24 * $l) / 709);
		$day = $l - $this->intPart((709 * $month) / 24);
		$year = 30 * $n + $j - 30;
		$month = $this->MonthName($month - 1);
		$date = array();
		$date['year'] = $year;
		$date['month'] = $month;
		$date['day'] = $day;
		if (!$string) return $date;
		else return "{$day} {$month}, {$year}";
	}
}

?>
