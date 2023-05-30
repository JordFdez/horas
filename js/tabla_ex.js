//tabla con botones 

    function fecha() { //obtener nombre fichero
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

$(document).ready(function () {

    $('#mydatatable tfoot th').each(function () {
        var title = $(this).text();

         //codigo columna alta
        if ($(this).hasClass('alta_gasto')) {
            $(this).html(
                '<input id="date-from-alta" type="text" placeholder="Desde.." />' +
                '<input id="date-to-alta" type="text" placeholder="Hasta.." />'
            );
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var dateFrom = $('#date-from-alta').val();
                    var dateTo = $('#date-to-alta').val();
                    var date = data[0];

                    if ((dateFrom == '' && dateTo == '') ||
                        (dateFrom == '' && Date.parse(date) <= Date.parse(dateTo)) ||
                        (Date.parse(dateFrom) <= Date.parse(date) && dateTo == '') ||
                        (Date.parse(dateFrom) <= Date.parse(date) && Date.parse(date) <= Date.parse(dateTo))) {
                        return true;
                    }
                    return false;
                }
            );
            
        }


        //codigo columna fecha
        else if ($(this).hasClass('date')) {
            $(this).html(
                '<input id="date-from1" type="text" placeholder="Desde.." />' +
                '<input id="date-to1" type="text" placeholder="Hasta.." />'
            );
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var dateFrom = $('#date-from1').val();
                    var dateTo = $('#date-to1').val();
                    var date = data[1];

                    if ((dateFrom == '' && dateTo == '') ||
                        (dateFrom == '' && Date.parse(date) <= Date.parse(dateTo)) ||
                        (Date.parse(dateFrom) <= Date.parse(date) && dateTo == '') ||
                        (Date.parse(dateFrom) <= Date.parse(date) && Date.parse(date) <= Date.parse(dateTo))) {
                        return true;
                    }
                    return false;
                }
            );
        }

         //codigo columna fecha (horas)
        else if ($(this).hasClass('date_horas')) {
            $(this).html(
                '<input id="date-from1" type="text" placeholder="Desde.." />' +
                '<input id="date-to1" type="text" placeholder="Hasta.." />'
            );
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var dateFrom = $('#date-from1').val();
                    var dateTo = $('#date-to1').val();
                    var date = data[0];

                    if ((dateFrom == '' && dateTo == '') ||
                        (dateFrom == '' && Date.parse(date) <= Date.parse(dateTo)) ||
                        (Date.parse(dateFrom) <= Date.parse(date) && dateTo == '') ||
                        (Date.parse(dateFrom) <= Date.parse(date) && Date.parse(date) <= Date.parse(dateTo))) {
                        return true;
                    }
                    return false;
                }
            );
        }
        
        // Código para columna estado
        else if ($(this).hasClass('estado')) {
      
      $(this).html(
        '<select><option value="">Todos</option><option value="APROBADA">APROBADA</option><option value="NO APROBADA">NO APROBADA</option></select>'
      );

      var selectElement = $(this).find('select');

      selectElement.on('change', function () {
        var selectedValue = $(this).val();
        if (selectedValue === '') {
          table.column($(this).parent().index() + ':visible').search('').draw();
        }
        else{
        table.column($(this).parent().index() + ':visible').search('^'+selectedValue + '$', true, false).draw();
        }
    });
        }

        //codigo para resto columnas
        else{
            $(this).html('<input type="text" placeholder="Filtrar.." />');
        }
        
    });
     

        

    var table = $('#mydatatable').DataTable({
        "dom": 'B<"float-inherit"i><"float-right"f>t<"float-left"l><"float-right"p><"clearfix">',
        // B botones, i de informacion, f de filtro, t de tabla, l largo tabla, p botones de paginas
        "responsive": false,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        
        },
        
        "order": [
            [0, "desc"]
        ],
        "initComplete": function () {
            this.api().columns().every(function () {
                var that = this;

                $('input', this.footer()).on('keyup change', function () {
                    if ($(this).closest('th').hasClass('date')) {
                                console.log('Filtering dates..');
                                table.draw();
                            }
                    else if ($(this).closest('th').hasClass('alta_gasto')){
                        console.log('Filtering dates..');
                        table.draw();
                    }
                    else if ($(this).closest('th').hasClass('date_horas')){
                        console.log('Filtering dates..');
                        table.draw();
                    }
                    else {
                        if (that.search() !== this.value) {
                            that
                                .search(this.value)
                                .draw();
                        }}
                });
            })
        },
            
        "buttons": [
            {
                extend: 'excel', 
                filename: fecha(),
                excelStyles:{
                    template:'header_orange'
                }
            }, 

            {
                extend: 'pdf', 
                filename: fecha(),
                orientation: 'landscape',
                pageSize: 'LEGAL'
                    
            },
            
            'print']
    });
}
);