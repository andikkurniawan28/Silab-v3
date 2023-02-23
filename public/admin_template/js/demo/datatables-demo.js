// Call the dataTables jQuery plugin
// $(document).ready(function() {
//   $('#dataTable').DataTable( {
//       "order": [[ 0, "desc" ]],
//       dom: 'Bfrtip',
//       buttons: [
//           'copy', 'csv', 'excel', 'pdf', 'print'
//       ]

//     } );
// });

$(document).ready(function() {
  $('#dataTable').DataTable( {
    //   "paging": false,
      "displayLength":10,
      dom: 'Bfrtip',
      buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
      ],
      "order": [[ 0, "desc" ]],
  } );
} );
