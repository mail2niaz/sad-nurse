    jQuery(document).ready(function(){
/* Operator List */
        jQuery('#operatordyntable').dataTable({
            "sPaginationType": "full_numbers",
            aoColumnDefs: [
				  {
				     bSortable: false,
				     aTargets: [ -1 ]
				  }
				]
        }).columnFilter({
			aoColumns: [ null,
				     { type: "text" },
				     null,
				     null,
				     null,
             		null
				]
				});

/* Patient List */
        jQuery('#patientdyntable').dataTable({
            "sPaginationType": "full_numbers",
            "aaSorting": [ [1,'asc'], [2,'asc'] ],
        }).columnFilter({
			aoColumns: [ null,
				     { type: "text" },
				     { type: "text" },
				     null,
             		null
				]
				});

/* Patient info list */
        jQuery('#patientinfodyntable').dataTable({
            "sPaginationType": "full_numbers",
            aoColumnDefs: [
				  {
				     bSortable: false,
				     aTargets: [ -1 ]
				  }
				]
        });

/* Contract List */
       jQuery('#contractlistdyntable').dataTable({
            "sPaginationType": "full_numbers",
            "aaSorting": [ [1,'asc'], [2,'asc'] ],
        }).columnFilter({
			aoColumns: [ null,
				     { type: "text" },
				     { type: "text" },
				     null,
             		null
				]
				});

/* CMS List */
        jQuery('#cmsdyntable').dataTable({
            "sPaginationType": "full_numbers",
            "aaSortingFixed": [[0,'asc']],
            "fnDrawCallback": function(oSettings) {
                jQuery.uniform.update();
            }
        });

        /* Intervent Type List */
        jQuery('#interventtypelistdyntable').dataTable({
            "sPaginationType": "full_numbers",
            aoColumnDefs: [
				  {
				     bSortable: false,
				     aTargets: [ -1 ]
				  }
				]
        }).columnFilter({
			aoColumns: [ null,
				     { type: "text" },
				     { type: "text" },
				     null
				]
				});

    });


