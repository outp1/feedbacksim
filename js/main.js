$(".feedback").submit(function (e) { 
  e.preventDefault();
            $.ajax({
                type: "POST", 
                url: "contacts/feedapi", 
                data: new FormData($('.feedback')[0]),
		processData: false,
		contentType: false,
                success: function (data) {
			console.log(data);
			if (data['result'] == 'ok') alert("Ваш отзыв отправлен!");
			else alert("Ошибка");
                }
            });
        });

$(".login").submit(function (e) { 
  e.preventDefault();
            $.ajax({
                type: "POST", 
                url: "login/login", 
                data: new FormData($('.login')[0]),
		processData: false,
		contentType: false,
                success: function (data) {
			console.log(data);
			if (data['result'] == 'admin') {
				document.location.href="/adminpanel"	
			}
			else alert("Неверный логин или пароль");
                }
            });
        });

$(".acccept_review").click (function (e) { 
  e.preventDefault();
		data = {action: 'accept_review', review_id: e.currentTarget.attributes['id'].value};
            $.ajax({
                type: "POST", 
                url: "adminpanel/moderate", 
                data: data,
		dataType: 'html',
                success: function (data) {
			location.reload()	
		}
            });
        });


