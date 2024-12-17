 var radio;

	function searchs()
	{
	var radioButtons = document.getElementsByName("radioValue");
      for (var x = 0; x < radioButtons.length; x ++) 
	  {
        if (radioButtons[x].checked) 
		{
			 radio = radioButtons[x].id;
        }
      }
	  //alert(radio);
	  
	   hostname = window.location.hostname;
 	url_book =  "http://"+hostname+"/ad_library/index.php/search_con/book_ajaxsearch/"+radio;
	new Ajax.Autocompleter("check_key_name", "autocomplete_book", url_book, {});
	  
	}