console.time('fetchData');
function fetchData(tableID) {
	fetch("http://172.20.20.135/wp-content/themes/xtrac-one/js/database.csv")  // eventually make this url a file from user input		
		.then(response => response.text()) 
		.then(data => { 												//console.log("CSV File: \n", data);
			const csvData = Papa.parse(data); 							console.log("JSON Format: \n", csvData);		
			const numRows = csvData.data.length; 						console.log("Rows:", numRows);
			const numCols = csvData.data[0].length; 					console.log("Cols:", numCols);
			const dataTable = document.getElementById(tableID);			console.log("Table ID: ", tableID);

			// Table Header
			const thead = document.createElement("thead");
			const tr_head = document.createElement("tr");
			const colTitles = new Array;
			dataTable.appendChild(thead); 	// add thead tag
			thead.appendChild(tr_head);		// add tr header tag
			for (i=0; i<numCols; i++) {
				const th = document.createElement("th");
				tr_head.appendChild(th).textContent = csvData.data[0][i];
				colTitles.push(csvData.data[0][i]);
			}

			// Populate Data; split JSON data into rows, then in to cells
			for (j=1; j<numRows; j++) {
				const tr = document.createElement("tr");
				dataTable.appendChild(tr);
				for (k=0; k<numCols; k++) {
					const cellData = csvData.data[j][k];
					const cellAttrVal = "col-" ;                    
					const td = document.createElement("td");
					td.setAttribute("data-tag", colTitles[k]);
					tr.appendChild(td).textContent = cellData;
				}				
			}
		});
}
console.timeEnd('fetchData');