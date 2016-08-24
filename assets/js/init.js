
  $(function() {
    $( document ).tooltip();
  });

		
		(function(){
 
    var _z = console;
    Object.defineProperty( window, "console", {
	get : function(){
	    if( _z._commandLineAPI ){
		throw "Sorry, Can't exceute scripts!";
            }
	    return _z; 
	},
	set : function(val){
	    _z = val;
	}
    });
 
})();

$(document).ready(function() {


 $('#companylist tfoot th').each( function () {
        var title = $('#companylist  thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
  $('#companylist').dataTable( {
	dom: 'T<"clear">lfrtip',
	"aLengthMenu": [[10, 15, 25, 35, 50, 100, -1], [10, 15, 25, 35, 50, 100, "All"]],
	tableTools: {
	        "sSwfPath": "./assets/media/copy_csv_xls_pdf.swf",
            "aButtons": [
                {
                    "sExtends": "copy",
                    "sButtonText": "Copy to clipboard"
                },
                {
                    "sExtends": "csv",
                    "sButtonText": "Save to CSV"
                },
				 {
                    "sExtends": "print",
                    "sButtonText": "Print"
                },
				 {
                    "sExtends": "pdf",
                    "sButtonText": "Creat PDF"
                },
                {
                    "sExtends": "xls",
                    "oSelectorOpts": {
                        page: 'current'
                    },
					"sFileName": "*.xls"
                }
            ]
        }
} );
    // DataTable
    var table = $('#companylist ').DataTable();

 
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            that
                .search( this.value )
                .draw();
        } );
    } );
	
	 $('#blhilist tfoot th').each( function () {
        var title = $('#blhilist  thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
 $('#blhilist').dataTable( {
	dom: 'T<"clear">lfrtip',
	"aLengthMenu": [[10, 15, 25, 35, 50, 100, -1], [10, 15, 25, 35, 50, 100, "All"]],
	tableTools: {
	        "sSwfPath": "./assets/media/copy_csv_xls_pdf.swf",
            "aButtons": [
                {
                    "sExtends": "copy",
                    "sButtonText": "Copy to clipboard"
                },
                {
                    "sExtends": "csv",
                    "sButtonText": "Save to CSV"
                },
				 {
                    "sExtends": "print",
                    "sButtonText": "Print"
                },
				 {
                    "sExtends": "pdf",
                    "sButtonText": "Creat PDF"
                },
                {
                    "sExtends": "xls",
                    "oSelectorOpts": {
                        page: 'current'
                    },
					"sFileName": "*.xls"
                }
            ]
        }
} );
    // DataTable
    var table = $('#blhilist ').DataTable();
	table.order( [ 3, 'desc' ] ) .draw();
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            that
                .search( this.value )
                .draw();
        } );
    } );
	
	
	 $('#datepicker').datepicker({ dateFormat: 'yy-mm-dd' })
  $('#datepicker2').datepicker({ dateFormat: 'yy-mm-dd' })
	
	
	
	 $('#flist tfoot th').each( function () {
        var title = $('#flist  thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
	
	$('#flist').dataTable( {
dom: 'T<"clear">lfrtip',
	dom: 'T<"clear">lfrtip',
	"aLengthMenu": [[10, 15, 25, 35, 50, 100, -1], [10, 15, 25, 35, 50, 100, "All"]],
	tableTools: {
	        "sSwfPath": "./assets/media/copy_csv_xls_pdf.swf",
            "aButtons": [
                {
                    "sExtends": "copy",
                    "sButtonText": "Copy to clipboard"
                },
                {
                    "sExtends": "csv",
                    "sButtonText": "Save to CSV"
                },
				 {
                    "sExtends": "print",
                    "sButtonText": "Print"
                },
				 {
                    "sExtends": "pdf",
                    "sButtonText": "Creat PDF"
                },
                {
                    "sExtends": "xls",
                    "oSelectorOpts": {
                        page: 'current'
                    },
					"sFileName": "*.xls"
                }
            ]
        }
} );
 
    // DataTable
    var table = $('#flist ').DataTable();
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            that
                .search( this.value )
                .draw();
        } );
    } );
	
	
    // Setup - add a text input to each footer cell
    $('#labourlist tfoot th').each( function () {
        var title = $('#labourlist thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
 $('#labourlist').dataTable( {
	dom: 'T<"clear">lfrtip',
	"aLengthMenu": [[10, 15, 25, 35, 50, 100, -1], [10, 15, 25, 35, 50, 100, "All"]],
	tableTools: {
	        "sSwfPath": "./assets/media/copy_csv_xls_pdf.swf",
            "aButtons": [
                {
                    "sExtends": "copy",
                    "sButtonText": "Copy to clipboard"
                },
                {
                    "sExtends": "csv",
                    "sButtonText": "Save to CSV"
                },
				 {
                    "sExtends": "print",
                    "sButtonText": "Print"
                },
				 {
                    "sExtends": "pdf",
                    "sButtonText": "Creat PDF"
                },
                {
                    "sExtends": "xls",
                    "oSelectorOpts": {
                        page: 'current'
                    },
					"sFileName": "*.xls"
                }
            ]
        }
} );
    // DataTable
    var table = $('#labourlist').DataTable();
	
	
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            that
                .search( this.value )
                .draw();
        } );
    } );
	
	
	 $('#embassylist tfoot th').each( function () {
        var title = $('#embassylist thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
  $('#embassylist').dataTable( {
	dom: 'T<"clear">lfrtip',
	"aLengthMenu": [[10, 15, 25, 35, 50, 100, -1], [10, 15, 25, 35, 50, 100, "All"]],
	tableTools: {
	        "sSwfPath": "./assets/media/copy_csv_xls_pdf.swf",
            "aButtons": [
                {
                    "sExtends": "copy",
                    "sButtonText": "Copy to clipboard"
                },
                {
                    "sExtends": "csv",
                    "sButtonText": "Save to CSV"
                },
				 {
                    "sExtends": "print",
                    "sButtonText": "Print"
                },
				 {
                    "sExtends": "pdf",
                    "sButtonText": "Creat PDF"
                },
                {
                    "sExtends": "xls",
                    "oSelectorOpts": {
                        page: 'current'
                    },
					"sFileName": "*.xls"
                }
            ]
        }
} );
 
    // DataTable
    var table = $('#embassylist').DataTable();
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            that
                .search( this.value )
                .draw();
        } );
    } );
} );

 $(function() {
            $("input:text:visible:first").focus();
        });
		
	


		
function redirect(){
				document.location.href="aprint.php";
}

$('#agentlist tfoot th').each( function () {
        var title = $('#agentlist  thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
	
	

 
 

 
    
    var table = $('#agentlist ').DataTable( {
	dom: 'T<"clear">lfrtip',
	"order": [[ 1, "desc" ]],
	"aLengthMenu": [[10, 15, 25, 35, 50, 100, -1], [10, 15, 25, 35, 50, 100, "All"]],
	tableTools: {
	        "sSwfPath": "./assets/media/copy_csv_xls_pdf.swf",
            "aButtons": [
                {
                    "sExtends": "copy",
                    "sButtonText": "Copy to clipboard"
                },
                {
                    "sExtends": "csv",
                    "sButtonText": "Save to CSV"
                },
				 {
                    "sExtends": "print",
                    "sButtonText": "Print"
                },
				 {
                    "sExtends": "pdf",
                    "sButtonText": "Creat PDF"
                },
                {
                    "sExtends": "xls",
                    "oSelectorOpts": {
                        page: 'current'
                    },
					"sFileName": "*.xls"
                }
            ]
        }

 });
 

	
  table.column( '0:visible' ).order( 'desc' );
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            that
                .search( this.value )
                .draw();
        } );
    } );

 $('#slipsreport thead th').each( function () {
        var title = $('#slipsreport   thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
	
	

 
 

 
    
    var table = $('#slipsreport ').DataTable( {
	dom: 'T<"clear">lfrtip',
	"order": [[ 1, "desc" ]],
	"aLengthMenu": [[10, 15, 25, 35, 50, 100, -1], [10, 15, 25, 35, 50, 100, "All"]],
	tableTools: {
	        "sSwfPath": "./assets/media/copy_csv_xls_pdf.swf",
            "aButtons": [
                {
                    "sExtends": "copy",
                    "sButtonText": "Copy to clipboard"
                },
                {
                    "sExtends": "csv",
                    "sButtonText": "Save to CSV"
                },
				 {
                    "sExtends": "print",
                    "sButtonText": "Print"
                },
				 {
                    "sExtends": "pdf",
                    "sButtonText": "Creat PDF"
                },
                {
                    "sExtends": "xls",
                    "oSelectorOpts": {
                        page: 'current'
                    },
					"sFileName": "*.xls"
                }
            ]
        }

 });
 

	
  table.column( '0:visible' ).order( 'desc' );
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            that
                .search( this.value )
                .draw();
        } );
    } );