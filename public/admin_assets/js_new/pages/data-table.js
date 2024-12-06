//[Data Table Javascript]



//Project:	Novo Admin - Responsive Admin Template

//Primary use:   Used only for the Data Table



$(function () {

    "use strict";



    $('#example1').DataTable();

    $('#example2').DataTable({

      'paging'      : true,

      'lengthChange': false,

      'searching'   : false,

      'ordering'    : true,

      'info'        : true,

      'autoWidth'   : false

    });


var currentDate = new Date().toLocaleDateString().replace(/\//g, '-');
    $('#countryTable').DataTable({
        pageLength: 25,
		dom: 'Bfrtip',
		// buttons: [
		// 	'copy', 'csv', 'excel', 'pdf', 'print'
        // ],
         buttons: [
            {
                extend: 'copy',
                text: 'copy',
                title: 'Country_Data_' + currentDate // Set dynamic title for Copy
            },
            {
                extend: 'csvHtml5',
                text: 'csv',
                title: 'Country_Data_' + currentDate // Set dynamic title for CSV
            },
            {
                extend: 'excelHtml5',
                text: 'excel',
                title: 'Country_Data_' + currentDate // Set dynamic title for Excel
            },
            {
                extend: 'pdfHtml5',
                text: 'pdf',
                title: 'Country_Data_' + currentDate, // Set dynamic title for PDF
                orientation: 'portrait',
                pageSize: 'A4'
            },
            {
                extend: 'print',
                text: 'print',
                title: 'Country_Data_' + currentDate // Set dynamic title for Print
            }
        ]
    });

    $('#stateTable').DataTable({
        pageLength: 25,
		dom: 'Bfrtip',
		// buttons: [
		// 	'copy', 'csv', 'excel', 'pdf', 'print'
        // ],
         buttons: [
            {
                extend: 'copy',
                text: 'copy',
                title: 'State_Data_' + currentDate // Set dynamic title for Copy
            },
            {
                extend: 'csvHtml5',
                text: 'csv',
                title: 'State_Data_' + currentDate // Set dynamic title for CSV
            },
            {
                extend: 'excelHtml5',
                text: 'excel',
                title: 'State_Data_' + currentDate // Set dynamic title for Excel
            },
            {
                extend: 'pdfHtml5',
                text: 'pdf',
                title: 'State_Data_' + currentDate, // Set dynamic title for PDF
                orientation: 'portrait',
                pageSize: 'A4'
            },
            {
                extend: 'print',
                text: 'print',
                title: 'State_Data_' + currentDate // Set dynamic title for Print
            }
        ]
    });

    $('#cityTable').DataTable({
        pageLength: 25,
		dom: 'Bfrtip',
		// buttons: [
		// 	'copy', 'csv', 'excel', 'pdf', 'print'
        // ],
         buttons: [
            {
                extend: 'copy',
                text: 'copy',
                title: 'city_Data_' + currentDate // Set dynamic title for Copy
            },
            {
                extend: 'csvHtml5',
                text: 'csv',
                title: 'city_Data_' + currentDate // Set dynamic title for CSV
            },
            {
                extend: 'excelHtml5',
                text: 'excel',
                title: 'city_Data_' + currentDate // Set dynamic title for Excel
            },
            {
                extend: 'pdfHtml5',
                text: 'pdf',
                title: 'city_Data_' + currentDate, // Set dynamic title for PDF
                orientation: 'portrait',
                pageSize: 'A4'
            },
            {
                extend: 'print',
                text: 'print',
                title: 'city_Data_' + currentDate // Set dynamic title for Print
            }
        ],

    });

    $('#bussinessTable').DataTable({
        pageLength: 25,
		dom: 'Bfrtip',
		// buttons: [
		// 	'copy', 'csv', 'excel', 'pdf', 'print'
        // ],
         buttons: [
            {
                extend: 'copy',
                text: 'copy',
                title: 'Bussiness_Data_' + currentDate // Set dynamic title for Copy
            },
            {
                extend: 'csvHtml5',
                text: 'csv',
                title: 'Bussiness_Data_' + currentDate // Set dynamic title for CSV
            },
            {
                extend: 'excelHtml5',
                text: 'excel',
                title: 'Bussiness_Data_' + currentDate // Set dynamic title for Excel
            },
            {
                extend: 'pdfHtml5',
                text: 'pdf',
                title: 'Bussiness_Data_' + currentDate, // Set dynamic title for PDF
                orientation: 'portrait',
                pageSize: 'A4'
            },
            {
                extend: 'print',
                text: 'print',
                title: 'Bussiness_Data_' + currentDate // Set dynamic title for Print
            }
        ]
    });

    $('#pageTable').DataTable( {
        pageLength: 25,
		dom: 'Bfrtip',
		// buttons: [
		// 	'copy', 'csv', 'excel', 'pdf', 'print'
        // ],
         buttons: [
            {
                extend: 'copy',
                text: 'copy',
                title: 'Page_Data_' + currentDate // Set dynamic title for Copy
            },
            {
                extend: 'csvHtml5',
                text: 'csv',
                title: 'Page_Data_' + currentDate // Set dynamic title for CSV
            },
            {
                extend: 'excelHtml5',
                text: 'excel',
                title: 'Page_Data_' + currentDate // Set dynamic title for Excel
            },
            {
                extend: 'pdfHtml5',
                text: 'pdf',
                title: 'Page_Data_' + currentDate, // Set dynamic title for PDF
                orientation: 'portrait',
                pageSize: 'A4'
            },
            {
                extend: 'print',
                text: 'print',
                title: 'Page_Data_' + currentDate // Set dynamic title for Print
            }
        ]
    });

    $('#cmsTable').DataTable({
        pageLength: 25,
		dom: 'Bfrtip',
		// buttons: [
		// 	'copy', 'csv', 'excel', 'pdf', 'print'
        // ],
         buttons: [
            {
                extend: 'copy',
                text: 'copy',
                title: 'CMS_Data_' + currentDate // Set dynamic title for Copy
            },
            {
                extend: 'csvHtml5',
                text: 'csv',
                title: 'CMS_Data_' + currentDate // Set dynamic title for CSV
            },
            {
                extend: 'excelHtml5',
                text: 'excel',
                title: 'CMS_Data_' + currentDate // Set dynamic title for Excel
            },
            {
                extend: 'pdfHtml5',
                text: 'pdf',
                title: 'CMS_Data_' + currentDate, // Set dynamic title for PDF
                orientation: 'portrait',
                pageSize: 'A4'
            },
            {
                extend: 'print',
                text: 'print',
                title: 'CMS_Data_' + currentDate // Set dynamic title for Print
            }
        ]
    });

    $('#employeeTable').DataTable({
        pageLength: 25,
		dom: 'Bfrtip',
		// buttons: [
		// 	'copy', 'csv', 'excel', 'pdf', 'print'
        // ],
         buttons: [
            {
                extend: 'copy',
                text: 'copy',
                title: 'Employee_Data_' + currentDate // Set dynamic title for Copy
            },
            {
                extend: 'csvHtml5',
                text: 'csv',
                title: 'Employee_Data_' + currentDate // Set dynamic title for CSV
            },
            {
                extend: 'excelHtml5',
                text: 'excel',
                title: 'Employee_Data_' + currentDate // Set dynamic title for Excel
            },
            {
                extend: 'pdfHtml5',
                text: 'pdf',
                title: 'Employee_Data_' + currentDate, // Set dynamic title for PDF
                orientation: 'portrait',
                pageSize: 'A4'
            },
            {
                extend: 'print',
                text: 'print',
                title: 'Employee_Data_' + currentDate // Set dynamic title for Print
            }
        ]
    });

    $('#clientTable').DataTable({
        pageLength: 25,
		dom: 'Bfrtip',
		// buttons: [
		// 	'copy', 'csv', 'excel', 'pdf', 'print'
        // ],
         buttons: [
            {
                extend: 'copy',
                text: 'copy',
                title: 'Client_Data_' + currentDate // Set dynamic title for Copy
            },
            {
                extend: 'csvHtml5',
                text: 'csv',
                title: 'Client_Data_' + currentDate // Set dynamic title for CSV
            },
            {
                extend: 'excelHtml5',
                text: 'excel',
                title: 'Client_Data_' + currentDate // Set dynamic title for Excel
            },
            {
                extend: 'pdfHtml5',
                text: 'pdf',
                title: 'Client_Data_' + currentDate, // Set dynamic title for PDF
                orientation: 'portrait',
                pageSize: 'A4'
            },
            {
                extend: 'print',
                text: 'print',
                title: 'Client_Data_' + currentDate // Set dynamic title for Print
            }
        ]
    });

    $('#casTable').DataTable({
        pageLength: 25,
		dom: 'Bfrtip',
		// buttons: [
		// 	'copy', 'csv', 'excel', 'pdf', 'print'
        // ],
         buttons: [
            {
                extend: 'copy',
                text: 'copy',
                title: 'CAS_Data_' + currentDate // Set dynamic title for Copy
            },
            {
                extend: 'csvHtml5',
                text: 'csv',
                title: 'CAS_Data_' + currentDate // Set dynamic title for CSV
            },
            {
                extend: 'excelHtml5',
                text: 'excel',
                title: 'CAS_Data_' + currentDate // Set dynamic title for Excel
            },
            {
                extend: 'pdfHtml5',
                text: 'pdf',
                title: 'CAS_Data_' + currentDate, // Set dynamic title for PDF
                orientation: 'portrait',
                pageSize: 'A4'
            },
            {
                extend: 'print',
                text: 'print',
                title: 'CAS_Data_' + currentDate // Set dynamic title for Print
            }
        ]
	});

	$('#example').DataTable( {

		dom: 'Bfrtip',

		buttons: [

			'copy', 'csv', 'excel', 'pdf', 'print'

		]

    });

    $('#scandoctableexample').DataTable( {

		// dom: 'Bfrtip',

		// buttons: [

		// 	'copy', 'csv', 'excel', 'pdf', 'print'

		// ]

    });

    $('#otherdoctableexample').DataTable( {

		// dom: 'Bfrtip',

		// buttons: [

		// 	'copy', 'csv', 'excel', 'pdf', 'print'

		// ]

    });

    $('#notificationtableexample').DataTable( {

		// dom: 'Bfrtip',

		// buttons: [

		// 	'copy', 'csv', 'excel', 'pdf', 'print'

		// ]

    });





	$('#tickets').DataTable({

	  'paging'      : true,

	  'lengthChange': true,

	  'searching'   : true,

	  'ordering'    : true,

	  'info'        : true,

	  'autoWidth'   : false,

	});



	$('#productorder').DataTable({

	  'paging'      : true,

	  'lengthChange': true,

	  'searching'   : true,

	  'ordering'    : true,

	  'info'        : true,

	  'autoWidth'   : false,

	});





	$('#complex_header').DataTable();



	//--------Individual column searching



    // Setup - add a text input to each footer cell

    $('#example5 tfoot th').each( function () {

        var title = $(this).text();

        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );

    } );



    // DataTable

    var table = $('#example5').DataTable({

    	pageLength : 5,

    });



    // Apply the search

    table.columns().every( function () {

        var that = this;



        $( 'input', this.footer() ).on( 'keyup change', function () {

            if ( that.search() !== this.value ) {

                that

                    .search( this.value )

                    .draw();

            }

        } );

    } );





	//---------------Form inputs

	var table = $('#example6').DataTable();



    $('button').click( function() {

        var data = table.$('input, select').serialize();

        // alert(

        //     "The following data would have been submitted to the server: \n\n"+

        //     data.substr( 0, 120 )+'...'

        // );

        return false;

    } );









  }); // End of use strict
