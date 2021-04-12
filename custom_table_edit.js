$(document).ready(function () {
  $("#data_table").Tabledit({
    deleteButton: false,
    editButton: false,
    columns: {
      identifier: [0, "id"],
      editable: [
        [1, "Speedway_No"],
        [2, "Customer_Fee"],
        [3, "Service_Fee"],
      ],
    },
    hideIdentifier: true,
    url: "live_edit.php",
  });
});
