 var radio;

	function search_jou()
	{
	var radioButtons = document.getElementsByName("radioValue");
      for (var x = 0; x < radioButtons.length; x ++) 
	  {
        if (radioButtons[x].checked) 
		{
			 radio = radioButtons[x].id;
        }
      }
	//  alert(radio);
	  
	hostname = window.location.hostname;
 	url_journal =  "http://"+hostname+"/ad_library/index.php/search_con/journal_ajaxsearch/"+radio;
	new Ajax.Autocompleter("check_key_name", "autocomplete_journal", url_journal, {});
	  
	}