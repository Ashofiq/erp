class Global{

  	sendReq($url, $data, $method, callback){
        var data = '';
    	$.ajax({
            type: $method,
            url: $url,
            data: $data,
            contentType: "application/json; charset=utf-8",
            success: function(result){
                callback(result);
            }, error: function (response) {
                switch (true) {
                    case typeof response.responseText !== 'undefined':
                        console.log(response.responseText);
                        break;
                    case response.statusText !== 'abort' && e.status === 0:
                        alert('Please check your internet connection');
                        break;
                    case response.statusText === 'abort':
                        break;
                    default:
                        console.error(response);
                }
            }
        });

        return data;
    }

    setChosenValue(response, htmlId, title) {
        var selectList = $('select[id="'+ htmlId +'"]');
        selectList.chosen();
        selectList.empty();
        selectList.append('<option value="" disabled selected>--Select '+ title +'--</option>');
        $.each(response, function(index, element) {
          selectList.append('<option value="' + element.id + '">' + element.accHead +'('+ element.accOrigin +')' +'</option>');
        });
        selectList.trigger('chosen:updated');
    }
}