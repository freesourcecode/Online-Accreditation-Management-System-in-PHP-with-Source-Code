 <?php
 $requestID = isset($_GET['request']) ? $_GET['request'] :'';

 if ($requestID=='') {
   # code...
    $sql ="SELECT * FROM `tblschools`s, `tblrequestdocuments` r,tblschedule sc WHERE s.`SCHOOLID`=r.`SchoolID` AND r.RequestID=sc.RequestID AND Scheduled=1 AND s.SCHOOLID='".$_SESSION['SCHOOLID']."'  GROUP BY r.RequestID";
 }else{
    $sql ="SELECT * FROM `tblschools`s, `tblrequestdocuments` r,tblschedule sc WHERE s.`SCHOOLID`=r.`SchoolID` AND r.RequestID=sc.RequestID AND Scheduled=1 AND s.SCHOOLID='".$_SESSION['SCHOOLID']."' AND  r.RequestID='{$requestID}' GROUP BY r.RequestID";

 }
 // $sql = "SELECT `ScheduleID`, `RequestID`, `DateCreated`, `DateSchedule`, `EndScheduleDate`, `Remarks`, `AgencyID`, `AgencyName`, `SchoolID`, `SchoolName`, `Settled` FROM `tblschedule`";
  $resCur =   $mydb->setQuery($sql);
  $maxRows = $mydb->num_rows($resCur);

  if ($maxRows) {
    # code...
    $result = $mydb->loadResultList(); 
    foreach($result as $row)
    {
      $settled = $row->Settled; 
      $edate = date_format(date_create($row->DateSchedule),'Y-m-d');
      $tdate = date('Y-m-d');
 
         $data[] = array(
            'id'   => $row->ScheduleID,
            'title'   => $row->SchoolName,
            'start'   => $row->DateSchedule,
            'end'   => $row->EndScheduleDate,
            'remarks'   => $row->Settled,
            'eventstatus'   => $row->AlreadyEvaluated,
            'invno'   => $row->RequestID,
            'type' => 'Red',
            'backgroundColor'=> '#f39c12', //yellow
            'borderColor'    => '#f39c12' //yellow
          ); 
      
  
    }
  }else{

    $data[] = array(
      'id'   => '',
      'title'   => '',
      'start'   =>'',
      'end'   => '',
      'remarks'   => '',
      'eventstatus'   =>'',
      'invno'   => '',
      'type' => 'Red',
      'backgroundColor'=> '#f39c12', //yellow
      'borderColor'    => '#f39c12' //yellow
    ); 

  }

    

?>  

<!-- for scheduling  Page specific script --> 
<script>
      
 

   $(function () {
 
    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendar.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    // initialize the external events
    // ----------------------------------------------------------------- 
    var calendar = new Calendar(calendarEl, {

      headerToolbar: {
        left  : 'prev,next today',
        center: 'title',
        right : 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      themeSystem: 'bootstrap',
      //Random default events 
      events : <?php echo json_encode($data); ?>,
      selectable: true,
      selectConstraint: {
          start: moment(date,'MM/DD/YYYY').subtract(1, 'days'),
          end:moment(date,'MM/DD/YYYY').add(1, 'month')
      },
      // editable:true, 
      eventResize:function(info)
      {
          // var start = $.fullCalendar.formatDate(info.event.start, "yyyy-MM-d HH:mm:ss");
          // var end = $.fullCalendar.formatDate(info.event.end, "yyyy-MM-d HH:mm:ss");  
           var start = moment(info.event.start).format('YYYY-MM-DD:HH:mm:ss');// the "Z" will adjust for time zone
           var end = moment(info.event.end).format('YYYY-MM-DD:HH:mm:ss');
          var id = info.event.id;
        // alert(id)
         
             $.ajax({
                url:"<?php echo web_root;?>agency/scheduling/controller.php?action=update",
                type:"POST",
                data:{startDate:start, endDate:end, scheduleID:id},
                success:function(data)
                { 
                 Toast.fire({
                    icon: 'success',
                    title: data
                  })
                }
             });
      },

       eventDrop:function(info)
          {

     

           var start = moment(info.event.start).format('YYYY-MM-DD:HH:mm:ss');// the "Z" will adjust for time zone
           var end = moment(info.event.end).format('YYYY-MM-DD:HH:mm:ss');
           var id = info.event.id;
          // alert(end);

             $.ajax({
              url:"<?php echo web_root;?>agency/scheduling/controller.php?action=update",
              type:"POST",
              data:{startDate:start, endDate:end, scheduleID:id},
              success:function(data)
              {  
               Toast.fire({
                  icon: 'success',
                  title: data
                })
              }
             });
          },

          eventClick:function(info)
          {
           // if(confirm("Are you sure you want to remove it?"))
           // {
           //  var id = info.event.id;
           //  // alert(id);
           //  $.ajax({
           //   url:"<?php echo web_root;?>agency/scheduling/controller.php?action=delete", 
           //   type:"POST",
           //   data:{id:id},
           //   success:function()
           //   {
           //    window.location ='index.php';
           //   }
           //  })
           // }
          }, 
        //    eventMouseover:function(event,domEvent,view){

        //     var el=$(this);

        //     var layer='<div id="events-layer" class="fc-transparent"><span id="delbut'+event.id+'" class="btn btn-default trash btn-xs">Trash</span></div>';
        //     el.append(layer);

        //     el.find(".fc-transparent").css("pointer-events","none");

        //     $("#delbut"+event.id).click(function(){
        //         calendar.fullCalendar('removeEvents', event._id);
        //     });
        // },
        // eventMouseout:function(event){
        //     $("#events-layer").remove();
        // },
        
    });

    calendar.render(); 
 
  })
 
</script>
 
  
           