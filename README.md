# Hijri Date Plugin for Magento 1.9

## Working example

Showing Hijri date on [alhudapublications.org](https://alhudapublications.org) welcome navigation bar

## Usage

Add the following code to your theme `header.phtml`

```php
$jd = Mage::getModel('core/date')->date('d');
$jm = Mage::getModel('core/date')->date('m');
$jy = Mage::getModel('core/date')->date('Y');

echo Mage::helper('hijridate/hijridate')->Greg2Hijri($jd, $jm, $jy, true);
```