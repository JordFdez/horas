
    function fecha() {
      var date = new Date();
      var year = date.getFullYear();
      var month = ("0" + (date.getMonth() + 1)).slice(-2);
      var day = ("0" + date.getDate()).slice(-2);
      var hours = ("0" + date.getHours()).slice(-2);
      var minutes = ("0" + date.getMinutes()).slice(-2);
      return (
        "BaumControl_" +
        year +
        "-" +
        month +
        "-" +
        day +
        "_" +
        hours +
        "-" +
        minutes
      );
    }