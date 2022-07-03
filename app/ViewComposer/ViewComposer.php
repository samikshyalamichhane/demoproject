<?php
namespace App\ViewComposer;

use App\Helpers\Nepali_Calendar as HelpersNepali_Calendar;
use App\Models\Setting;
use Illuminate\View\View;

class ViewComposer {
	public function __construct(HelpersNepali_Calendar $calendar) {
		$this->calendar=$calendar;
	}
	public function compose(View $view) {
		$calendar= $this->calendar;
		$setting = Setting::first();
		$view->with(['calendar'=>$calendar,'setting'=>$setting]);
	}

}
