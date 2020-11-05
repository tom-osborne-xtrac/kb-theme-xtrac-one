// ===== Scroll to Top ==== 
jQuery(function ($) {
	$(window).scroll(function() {
	    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
	        $('#return-to-top').fadeIn(200);    // Fade in the arrow
	    } else {
	        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
	    }
	});
});
jQuery(function ($) {
	$('#return-to-top').click(function() {      // When arrow is clicked
	    $('body,html').animate({
	        scrollTop : 0                       // Scroll to top of body
	    }, 500);
	});
});


// ======== Clickable Table rows ==========
jQuery(function($) {
	$('tr').click( function() {
	    var href =  $(this).find('a').attr('href');
	    if ( href ) {
	    	window.location = href;
	    }
	});
});


// ======== Video Sizing ==========
jQuery(function($) {
	$(function() {
	
	    var $allVideos = $("iframe[src^='//player.vimeo.com'], iframe[src^='//www.youtube.com'], object, embed"),
	    $fluidEl = $("figure");
	
		$allVideos.each(function() {
	
		  $(this)
		    // jQuery .data does not work on object/embed elements
		    .attr('data-aspectRatio', this.height / this.width)
		    .removeAttr('height')
		    .removeAttr('width');
	
		});
	
		$(window).resize(function() {
	
		  var newWidth = $fluidEl.width();
		  $allVideos.each(function() {
	
		    var $el = $(this);
		    $el
		        .width(newWidth)
		        .height(newWidth * $el.attr('data-aspectRatio'));
	
		  });
	
		}).resize();
	
	});
});


// ============== PROJECT CODE FILTER ====================

function projectCodeFilter() {
  // Declare variables
  var input, filter, divOuter, divInner, a, i, txtValue;
  input = document.getElementById('projectCodeFilterInput');
  filter = input.value.toUpperCase();
  divOuter = document.getElementById("projectCodeFilterList");
  divInner = document.getElementsByClassName("projectCode");

  // Loop through all list items, and hide those who don't match the search query
  for (i = 0; i < divInner.length; i++) {
    a = divInner[i].getElementsByTagName("a")[0];
    txtValue = a.textContent || a.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      divInner[i].style.display = "";
    } else {
      divInner[i].style.display = "none";
    }
  }
}

// ============== TABLE FILTER ====================

function tableFilter(inputID, tableID, col) {
  // Declare variables 
  var input, filter, table, tr, td, i, txtValue;
  
  // initialise input parameters
  var inputID = inputID;
  var tableID = tableID;
  var col = col;
  
  //set variables
  input = document.getElementById(inputID);	// input field where user enters search term
  filter = input.value.toUpperCase();		// make uppercase, so search is not case sensitive
  table = document.getElementById(tableID);	// the table we are filtering
  tr = table.getElementsByTagName("tr");	// find all rows and add them to the tr array
    
  // Loop through all table rows, and hide those that don't match the search query
  for (i = 0; i < tr.length; i++) {
  	td = tr[i].getElementsByTagName("td")[col];		
  	
	if (td) {
	  txtValue = td.textContent || td.innerText;
	  if (txtValue.toUpperCase().indexOf(filter) > -1) {
	    tr[i].style.display = "";
	  } else {
	    tr[i].style.display = "none";
	  }
	}
  }
}

function filterTable(event) {
    var filter = event.target.value.toUpperCase();
    var rows = document.querySelector("#table_htcode tbody").rows;
    var cols = document.querySelector("#table_htcode tbody").rows[0].cells.length;
    console.log(cols);
        
    for (var i = 1; i < rows.length; i++) {
        var Col1 = rows[i].cells[0].textContent.toUpperCase();
        var Col2 = rows[i].cells[1].textContent.toUpperCase();
        var Col3 = rows[i].cells[2].textContent.toUpperCase();
        var Col4 = rows[i].cells[3].textContent.toUpperCase();
        var Col5 = rows[i].cells[4].textContent.toUpperCase();
        var Col6 = rows[i].cells[5].textContent.toUpperCase();
        var Col7 = rows[i].cells[6].textContent.toUpperCase();
        var Col8 = rows[i].cells[7].textContent.toUpperCase();
        var Col9 = rows[i].cells[8].textContent.toUpperCase();
        var Col10 = rows[i].cells[9].textContent.toUpperCase();
        var Col11 = rows[i].cells[10].textContent.toUpperCase();
        
        if (Col1.indexOf(filter) > -1 || Col2.indexOf(filter) > -1 || Col3.indexOf(filter) > -1 || Col4.indexOf(filter) > -1 || Col5.indexOf(filter) > -1 || Col6.indexOf(filter) > -1 || Col7.indexOf(filter) > -1 || Col8.indexOf(filter) > -1 || Col9.indexOf(filter) > -1 || Col10.indexOf(filter) > -1 || Col11.indexOf(filter) > -1 ) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }      
    }
}

if(document.querySelector('#filter_ht_htcode')) {
	document.querySelector('#filter_ht_htcode').addEventListener('keyup', filterTable, false);
}

// ==== fetch data =====

// ======== Table Filter by Column Drop Down List =========
// This code configures the tablesorter javascript program

$(function() {
  var $table1 = $("#table_htcode") // HT codes table config
  	.tablesorter({
  		widgets : [ 'filter' ],
  		widgetOptions : {
	      filter_columnFilters   : true,
	      filter_matchType   : { 'input': 'match', 'select': 'match' },
	      filter_onlyAvail : 'filter_onlyAvail',
	      filter_external : '.search',
	    }	
	 });
});

//FETCH DATA FUNCTION

function fetchData() {

	fetch("http://172.20.20.135/wp-content/themes/xtrac-one/js/test.csv")  //make this url a file from user input
		
		.then(response => response.text()) 
		.then(data => { 
			console.log("CSV File: \n", data);
		
			var csvData = Papa.parse(data); 	// parse csv to JSON format
			console.log("JSON Format: \n", csvData);
			
			var numRows = csvData.data.length;
			console.log("Rows: \n", numRows);
			
			//split JSON data into row arrays
			for (i=0; i<numRows; i++) {
				var row = csvData.data[i];
				console.log(row);			
				
				var numCols = csvData.data[i].length;

				//split rows into cells
				for (j=0; j<numCols; j++) {
					var cell = csvData.data[i][j];
					console.log(cell);
				}
			}
		});
}