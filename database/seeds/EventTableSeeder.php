<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EventTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */

	// type : ['SOLAR','LUNAR','GREGORIAN']


	public function run()
	{
		$year = 2019;

		//farvardin

		DB::table('event')->insert([

			'title'     => 'آغاز عید نوروز',
			'type'      => 'SOLAR',
			'isHoliday' => true,
			'date'      => \Illuminate\Support\Carbon::create($year , 3 , 21)

		]);

		DB::table('event')->insert([

			'title'     => 'آغاز عید نوروز',
			'type'      => 'SOLAR',
			'isHoliday' => true,
			'date'      => \Illuminate\Support\Carbon::create($year , 3 , 22)

		]);

		DB::table('event')->insert([

			'title'     => 'هجوم به مدرسه فیضیه قم (1342 ه.ش)',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 3 , 22)

		]);

		DB::table('event')->insert([

			'title'     => 'آغاز عملیات فتح المبین (1361 ه.ش)',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 3 , 22)

		]);

		DB::table('event')->insert([

			'title'     => 'آغاز عید نوروز',
			'type'      => 'SOLAR',
			'isHoliday' => true,
			'date'      => \Illuminate\Support\Carbon::create($year , 3 , 23)

		]);

		DB::table('event')->insert([

			'title'     => 'آغاز عید نوروز',
			'type'      => 'SOLAR',
			'isHoliday' => true,
			'date'      => \Illuminate\Support\Carbon::create($year , 3 , 24)

		]);

		DB::table('event')->insert([

			'title'     => 'روز امید شناسی، روز شادباش نویسی',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 3 , 26)

		]);

		DB::table('event')->insert([

			'title'     => 'روز هنرهای نمایشی',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 3 , 27)

		]);

		DB::table('event')->insert([

			'title'     => 'همه پرسی تغییر نظام شاهنشاهی به جمهوری اسلامی ایران (1358 ه.ش)',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 3 , 30)

		]);

		DB::table('event')->insert([

			'title'     => 'جشن آبانگاه',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 3 , 30)

		]);

		DB::table('event')->insert([

			'title'     => 'روز جمهوری اسلامی ایران',
			'type'      => 'SOLAR',
			'isHoliday' => true,
			'date'      => \Illuminate\Support\Carbon::create($year , 4 , 1)

		]);

		DB::table('event')->insert([

			'title'     => 'روز طبیعت',
			'type'      => 'SOLAR',
			'isHoliday' => true,
			'date'      => \Illuminate\Support\Carbon::create($year , 4 , 2)

		]);

		DB::table('event')->insert([

			'title'     => 'جشن سیزده بدر',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 4 , 2)

		]);

		DB::table('event')->insert([

			'title'     => 'روز ذخایر ژنتیکی و زیستی',
			'type'      => 'GREGORIAN',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 4 , 4)

		]);

		DB::table('event')->insert([

			'title'     => 'سروش روز، جشن سروشگان',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 4 , 6)

		]);

		DB::table('event')->insert([

			'title'     => 'روز سلامت',
			'type'      => 'GREGORIAN',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 4 , 7)

		]);

		DB::table('event')->insert([

			'title'     => 'شهادت آیت الله سید محمد باقر صدر و خواهرش بنت الهدی (1359 ه.ش)',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 4 , 8)

		]);

		DB::table('event')->insert([

			'title'     => 'فروردین روز، جشن فروردینگان',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 4 , 8)

		]);

		DB::table('event')->insert([

			'title'     => 'روز ملی فناوری هسته ای',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 4 , 9)

		]);

		DB::table('event')->insert([

			'title'     => 'روز هنر انقلاب اسللامی',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 4 , 9)

		]);

		DB::table('event')->insert([

			'title'     => 'شهادت سید مرتضی آوینی (1372 ه.ش)',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 4 , 9)

		]);

		DB::table('event')->insert([

			'title'     => 'قطع مناسبات سیاسی ایران و آمریکا (1359 ه.ش)',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 4 , 9)

		]);

		DB::table('event')->insert([

			'title'     => 'شهادت امیر سپهبد امیر صیاد شیرازی (1378 ه.ش)',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 4 , 10)

		]);

		DB::table('event')->insert([

			'title'     => 'سالروز افتتاح حساب شماره 100 و تاسیس بنیاد مسکن انقلاب اسلامی (1358 ه.ش)',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 4 , 10)

		]);

		DB::table('event')->insert([

			'title'     => 'روز بزرگ داشت عطار نیشابوری',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 4 , 14)

		]);

		DB::table('event')->insert([

			'title'     => 'روز ارتش جمهوری اسلامی و نیروی زمینی',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 4 , 18)

		]);

		// ordibehesht

		DB::table('event')->insert([

			'title'     => 'روز بزرگداشت سعدی',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 4 , 21)

		]);

		DB::table('event')->insert([

			'title'     => 'تاسیس سپاه پاسداران انقلاب اسلامی (1358 ه.ش)',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 4 , 22)

		]);

		DB::table('event')->insert([

			'title'     => 'اعلام انقلاب فرهنگی (1359 ه.ش)',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 4 , 22)

		]);

		DB::table('event')->insert([

			'title'     => 'روز زمین پاک',
			'type'      => 'GREGORIAN',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 4 , 22)

		]);

		DB::table('event')->insert([

			'title'     => 'جشن گیاه آوری',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 4 , 22)

		]);

		DB::table('event')->insert([

			'title'     => 'روز بزرگداشت شیخ بهایی',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 4 , 23)

		]);

		DB::table('event')->insert([

			'title'     => 'اردیبهشت روز، جشن اردیبهشتگان',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 4 , 23)

		]);

		DB::table('event')->insert([

			'title'     => 'شکست حمله نظامی آمریکا به ایران در طبس (1359 ه.ش)',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 4 , 25)

		]);

		DB::table('event')->insert([

			'title'     => 'روز ایمنی حمل و نقل',
			'type'      => 'GREGORIAN',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 4 , 27)

		]);

		DB::table('event')->insert([

			'title'     => 'روز شورا ها',
			'type'      => 'GREGORIAN',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 4 , 29)

		]);

		DB::table('event')->insert([

			'title'     => 'روز ملی خلیج فارس',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 4 , 30)

		]);

		DB::table('event')->insert([

			'title'     => 'آغاز عملیات بیت المقدس (1361 ه.ش)',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 4 , 30)

		]);

		DB::table('event')->insert([

			'title'     => 'شهادت مرتضی مطهری (1358 ه.ش)',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 5 , 2)

		]);

		DB::table('event')->insert([

			'title'     => 'روز معلم',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 5 , 2)

		]);

		DB::table('event')->insert([

			'title'     => 'روز جهانی مستضعفان',
			'type'      => 'GREGORIAN',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 5 , 2)

		]);

		DB::table('event')->insert([

			'title'     => 'روز بزرگداشت شیخ صدوق',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 5 , 5)

		]);

		DB::table('event')->insert([

			'title'     => 'روز پیام آوری زرتشت',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 5 , 5)

		]);

		DB::table('event')->insert([

			'title'     => 'روز بیماری های خاص',
			'type'      => 'GREGORIAN',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 5 , 8)

		]);

		DB::table('event')->insert([

			'title'     => 'روز بزرگداشت شیخ کلینی',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 5 , 9)

		]);

		DB::table('event')->insert([

			'title'     => 'روز اسناد ملی و میراث مکتوب',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 5 , 9)

		]);

		DB::table('event')->insert([

			'title'     => 'لغو امتیاز تنباکو به فتوای آیت الله میرزا حسن شیرازی (1270 ه.ش)',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 5 , 14)

		]);

		DB::table('event')->insert([

			'title'     => 'روز پاسداشت زبان فارسی، بزرگداشت فردوسی',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 5 , 15)

		]);

		DB::table('event')->insert([

			'title'     => 'روز ارتباطات و روابط عمومی',
			'type'      => 'GREGORIAN',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 5 , 17)

		]);

		DB::table('event')->insert([

			'title'     => 'روز بزرگداشت حکیم عمر خیام',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 5 , 18)

		]);

		DB::table('event')->insert([

			'title'     => 'روز ملی جمعیت',
			'type'      => 'SOLAR',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 5 , 20)

		]);

		DB::table('event')->insert([

			'title'     => 'روز اهدای عضو، اهدای زندگی',
			'type'      => 'GREGORIAN',
			'isHoliday' => false,
			'date'      => \Illuminate\Support\Carbon::create($year , 5 , 21)

		]);

		//khordad
	}
}
