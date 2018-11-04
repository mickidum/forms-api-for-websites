jQuery(document).ready(function($) {

    $('.htmllinks a').each(function(index, el) {
        $.post('list.php', {pretty_links: 1, htmlfile: 'html/' + el.id + '.html'}, function(data) {
            var plink = $(data).find('.event-code-name-head1').text();
            $(el).text(plink);
        });
    });
    
    $('.htmllinks').on('click', 'a', function(event) {
        event.preventDefault();
        $('html, body').scrollTop(0);
        $('#popup').show();
        $('.loading').show();
        $('#event_c_name').html($(this).attr('id'));
        $('#popup-csv-link').data('csv', $(this).attr('id'));
        $('#delete-link').data('delete', $(this).attr('id'));
        $.post('list.php', {popup: 1, htmlfile: 'html/' + $(this).attr('id') + '.html'}, function(data) {
            setTimeout(function(){
                $('.loading').fadeOut();
                $('#popup #res').html(data + '</tbody></table>');
            }, 200);
        });
    });
    $('body').on('click', '.closebtn', function(event) {
        event.preventDefault();
        $('#popup').hide();
    });

    $('body').on('click', '.old-lists-btn', function(event) {
        event.preventDefault();
        $('.show-hide').fadeIn();
    });

    $('body').on('click', '.closebtnall', function(event) {
        event.preventDefault();
        $('.show-hide').hide();
        $('#popup').hide();
    });

    $('body').on('click', '#exit', function(event) {
        event.preventDefault();
        $.post('list.php', {logout: 1}, function(data) {
            window.location.reload();
        });
    });

    $('body').on('click', '.popup-csv-link', function(event) {
        event.preventDefault();
        var table = $(this).parent().siblings('.content').find('table tr');
        var rows = [];
        $.each(table, function(index, val) {
            var arr = $(this).children().toArray();
            var arr1 = arr.map(function(x) {
                return x.innerText;
            })
            rows.push(arr1);
        });
        exportToCsv($(this).data('csv') + '.csv', rows);
    });

    $('body').on('click', '.delete-link', function(event) {
        event.preventDefault();
        var obj = {};
        var htmlFileUrl = 'html/' + $(this).data('delete') + '.html';
        var csvFileUrl = 'csv/' + $(this).data('delete') + '.csv';
        obj.delete = 1;
        obj.htmlfile = htmlFileUrl;
        obj.csvfile = csvFileUrl;
        var conf = confirm('DELETE TABLE :' + $(this).data("delete") + '?');
        if (conf) {
            $.post('list.php', obj, function(data) {
                window.location.reload();
            });
        }
    });
});

function exportToCsv(filename, rows) {
    var processRow = function (row) {
        var finalVal = '';
        for (var j = 0; j < row.length; j++) {
            var innerValue = row[j] === null ? '' : row[j].toString();
            if (row[j] instanceof Date) {
                innerValue = row[j].toLocaleString();
            };
            var result = innerValue.replace(/"/g, '""');
            if (result.search(/("|,|\n)/g) >= 0)
                result = '"' + result + '"';
            if (j > 0)
                finalVal += ',';
            finalVal += result;
        }
        return finalVal + '\n';
    };

    var csvFile = '';
    for (var i = 0; i < rows.length; i++) {
        csvFile += processRow(rows[i]);
    }

    var blob = new Blob([new Uint8Array([0xEF, 0xBB, 0xBF]), csvFile], { type: 'text/csv;charset=utf-8;' });
    if (navigator.msSaveBlob) { // IE 10+
        navigator.msSaveBlob(blob, filename);
    } else {
        var link = document.createElement("a");
        if (link.download !== undefined) { // feature detection
            // Browsers that support HTML5 download attribute
            var url = URL.createObjectURL(blob);
            link.setAttribute("href", url);
            link.setAttribute("download", filename);
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    }
}

