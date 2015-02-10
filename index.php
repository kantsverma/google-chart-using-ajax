<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">
    
    // Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);
      
    function drawChart() {
      var jsonData = $.ajax({
          url: "getPieChart.php",
          type: 'post',
          data: {formType:1},
          dataType:"json",
          async: false
          }).responseText;
          
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data, {width: 400, height: 240});
    }
      // load dynamic chart 
    function loadChart(id){
      //alert(id);
      if(id){
         var jsonData = $.ajax({
          url: "getPieChart.php",
          type: 'post',
          data: {formType:id},
          dataType:"json",
          async: false
          }).responseText;

          // Create our data table out of JSON data loaded from server.
          var data = new google.visualization.DataTable(jsonData);

          // Instantiate and draw our chart, passing in some options.
          var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
          chart.draw(data, {width: 400, height: 240});
        
      }
    }
    </script>
  </head>

  <body>
    <!--Div that will hold the pie chart-->
    <div id="chartFirst">
      <lable>Select form</lable>
      <select id="mySelect" onchange="loadChart(this.value)">
        <option value="1">form1</option>
        <option value="2">form2</option>
        <option value="3">form3</option>
        <option value="4">form4</option>
      </select>
      <div id="chart_div"></div>
      
    </div> 
    
  </body>
</html>
