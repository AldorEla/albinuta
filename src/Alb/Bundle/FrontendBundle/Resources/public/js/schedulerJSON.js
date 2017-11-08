// Working CASES:
// CASE_1, CASE_3, CASE_$, CASE_5

// Define main element which provides the string used as parameter of the Scheduler function
var class_name = 'date-5'; // change this to test other CASE
var date = document.getElementsByClassName(class_name);
var date_string = date[0].innerHTML;
var scheduledDateTime_CASE = Scheduler(date_string);
console.log(scheduledDateTime_CASE);

/** Process the received schedule like string into organized rows.
 * Return a JSON string.
 */
function Scheduler(string) {
  var scheduler = [];
  var periods = [];
  var allWeekDays = getAllWeekDays();
  var scheduleData = [];
  var scheduleDays = [];
  var scheduleHours = '';

  var schedule = [];
  
  if(string.length) {
    var strDate = string;
    var dateParts = strDate.split(",");
    
    var scheduledHours = getScheduledHours(dateParts);

    for(var i=0;i<dateParts.length;i++) {
      schedule = dateParts[i].split(/:(.+)/);
      scheduleDays = schedule[0];
      scheduleHours = scheduledHours[i];
      if(schedule[1]) {
        // If no scheduleHours are found in the current string, get the hours for the next found
        scheduleHours = schedule[1];
      }
      // Push initial arrays
      if(scheduleDays.match("-")) {
        // Process range of days given
        var givenWeekDays = [];
        
        for(j=0;j<scheduleDays.trim().split("-").length;j++) {
          givenWeekDays = scheduleDays.toLowerCase().trim().split("-");
        }
        
        var scheduledWeekDays = getAllScheduledWeekDays(allWeekDays, givenWeekDays);
        
        var openDay = '';
        var closeDay = '';
        var openHour = '';
        var closeHour = '';
        for(k=0;k<scheduledWeekDays.length;k++) {
          openDay = capitalize(scheduledWeekDays[k]);
          closeDay = capitalize(scheduledWeekDays[k]);
          if(scheduleHours) {
            openHour = scheduleHours.toLowerCase().trim().split("-")[0].trim();
            closeHour = scheduleHours.toLowerCase().trim().split("-")[1].trim();
          }
          
          scheduleData.push(
            {
              // 1. Open Day
              "openDay": openDay, 
              // 2. Close Day
              "closeDay": closeDay, 
              // 3. Open Hour
              "openHour": openHour, 
              // 4. Close Hour
              "closeHour": closeHour
            }
          );
        }
      } else {
        // Process single day given
        openDay = scheduleDays.trim();
        closeDay = scheduleDays.trim();
        if(scheduleHours) {
          openHour = scheduleHours.trim().split("-")[0].trim();
          closeHour = scheduleHours.trim().split("-")[1].trim();
        }
        
        scheduleData.push(
          {
            // 1. Open Day
            "openDay": openDay, 
            // 2. Close Day
            "closeDay": closeDay, 
            // 3. Open Hour
            "openHour": openHour, 
            // 4. Close Hour
            "closeHour": closeHour
          }
        );
      }
    }

    scheduler.push({"regularHours": {"periods": scheduleData}});
  }
  return JSON.stringify(scheduler);
}

/** Capitalize string
 */
function capitalize(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

/** Get All days of the week in an array
 */
function getAllWeekDays() {
  var weekDays = new Array(7);
  weekDays[0] = "monday";
  weekDays[1] = "tuesday";
  weekDays[2] = "wednesday";
  weekDays[3] = "thursday";
  weekDays[4] = "friday";
  weekDays[5] = "saturday";
  weekDays[6] = "sunday";
  return weekDays;
}

/** Get Day Full Name
 */
function getDayName(name) {
  switch(name) {
    case 'mon':
      name = 'monday';
      break;
    case 'tue':
      name = 'tuesday';
      break;
    case 'wed':
      name = 'wednesday';
      break;
    case 'thu':
      name = 'thursday';
      break;
    case 'fri':
      name = 'friday';
      break;
    case 'sat':
      name = 'saturday';
      break;
    case 'sun':
      name = 'sunday';
      break;
    default:
      break
  }
  return name;
}

/** Get All Week Days from schedule
 */
function getAllScheduledWeekDays(allWeekDays, givenWeekDays) {
  // Define empty array for the returned array
  var scheduledWeekDays = new Array();
  // Define the indexes for the start and end of days range
  var firstIndex = '';
  var lastIndex = '';
  
  // Establish the first and last indexes from the array of full week days
  for(k=0;k<allWeekDays.length;k++) {
    for(l=0;l<givenWeekDays.length;l++) {
      // Apply trim to remove whitespaces from the given week days array, as we need perfect match
      if(getDayName(givenWeekDays[0].trim()) == allWeekDays[k] && firstIndex == '') {
        firstIndex = k;
      }
      // Apply trim to remove whitespaces from the given week days array, as we need perfect match
      if(getDayName(givenWeekDays[1].trim()) == allWeekDays[k] && lastIndex == '') {
        lastIndex = k;
      }
    }
  }
  // Push the days from range in the return array
  for(m=0;m<allWeekDays.length;m++) {
    if(m >= firstIndex && m <= lastIndex) {
      scheduledWeekDays.push(allWeekDays[m]);
    }
  }
  
  return scheduledWeekDays;
}

/** Get Scheduled Hours for all array items
 */
function getScheduledHours(dateParts) {
  var hours = [];
  var hour = '';
  for(var i=0;i<dateParts.length;i++) {
    schedule = dateParts[i].split(/:(.+)/);
    if(schedule[1]) {
      hour = schedule[1];
    }
    hours.push(i, hour);
  }
    
  hours.forEach(function(i, v) {
    if(v >= 0 && i.length && i != '') {
      var i = i;
      hours.forEach(function(j,k) {
        if(k >= 0 && j == '' && v > k) {
          hours[k] = i;
        } else {
          return false;
        }
      });
    }
  });
  
  return hours;
}