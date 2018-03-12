<?php 
	namespace tests\http;
	use http\Calendar;
class calculateDaysTest extends \PHPUnit\Framework\TestCase
{
  /**
    * @dataProvider dataProvider
    */
   public function testCalculateDays($startDate, $trainingCount, $schedule, $expectedResult)
   {
	   $calendar = new Calendar();
       self::assertEquals($expectedResult, $calendar->calculateDays($startDate, $trainingCount, $schedule));
   }


   public function dataProvider()
   {   
       return [
           ['2016-04-18', 6, [2,4,6], 13],
           ['2016-04-18', 6, [1,3,5], 12],
           ['2016-04-18', 6, [1,4], 18],
           ['2016-04-19', 6, [2,4,6], 12],
           ['2016-04-21' , 1, [2,4,6], 1],
           ['2016-05-01', 2, [2], 10],
           ['2016-05-10', 12, [2,4,6], 26],
           ['2016-05-30', 3, [2], 16],
           ['2016-05-30', 3, [1,2,3,4,5,6], 3],
           ['2016-10-12', 2, [1], 13],
           ['2016-10-10', 200, [2,4,6], 466],
           ['2016-10-10', 200, [2,4,6], 467]
       ];
   }

}
