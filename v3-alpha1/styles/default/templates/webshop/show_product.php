{webshop}
<script>
$(document).ready(function(){
	$(".button_cart").click( function()
	{
		var data = { 'item_id' : {item_id}, 'user_id' : {user_id}, 'amount' :  1 }
		var jqxhr = $.post("{base_url}webshop/winkelmandje/add_to_cart/", "data="+$.toJSON(data), function(response) {
			//if(response=="success")
			//{
				alert(response);
				location.reload(true);
			//}
		});
	
	});
});
</script>
<script type="text/javascript"  >
      document.write('<BASE HREF="http://'+document.domain+'/">');
      document.domain = 'cmswire.nl';
</script>
<h2 style="float:right;" >&euro; {item_price2}</h2>
<h1>{item_title}</h1><br/>
<div class="button_cart" style="float:right; width: 120px; height:30px; text-align:center; padding-top:10px; border: solid #F30; background: #F93">
  <strong>Bestellen</strong></div>
  Categorie: {category_name}<br /><br /><br /><br />
<img src="{item_image}" style="float:left; padding-right: 10px; position:static;" />
{item_description}<br>
<br>

{/webshop}