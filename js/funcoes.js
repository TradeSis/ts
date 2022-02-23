var wURL = '';

		function chamaAJAX(wURL,wType="get",wdataType="json") {
			var res = [];
			
			$.ajax({
					url: wURL,
					type: wType,
					async: false,

					dataType: wdataType,
				
					success: function (json_get) {
						res = json_get;
						/*
						obj = json_get;
						for(var i in obj) {
							//  alert(JSON.stringify(obj[i], null, 4));
							//   alert(obj[i].numeroNFSe);
							//	res.push(obj[i]);
						}
						*/
					//  alert(JSON.stringify(res, null, 4));

						
					},
					error: function (xhr, status, errorThrown) {

						alert("errorThrown=" + errorThrown);
					}
				})
				return res;
			}
