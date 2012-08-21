<!--
<div style="width: 60%;">
<h2><a href="{base_url}webshop/producten/bekijk/{item_title_alias}">{item_title}</a></h2>
<h1>prijs: &euro;{item_price2}</h1><br>
beschrijving:<br> {item_description}<br>
<br>
</div>
<hr />
-->
<style>
#item_search
{
	color: #000;
}
</style>


<div id="item_search">
<br />
<table id="item_search" class="ui-widget ui-widget-content" >
	<thead>
		<tr class="ui-widget-header ">
			<th width="110">Afbeelding</td>
			<th>Naam</td>
			<th>Prijs</td>
			<th>&nbsp;</td>
		</tr>
	</thead>
	<tbody>
		{webshop}
		<tr>
			<td><a href="{base_url}webshop/producten/bekijk/{item_title_alias}"><img src="{item_image}" height="100" width="100" /></a></td>
			<td><a href="{base_url}webshop/producten/bekijk/{item_title_alias}">{item_title}</a></td>
			<td>&euro; {item_price2}</td>
			<td><a href="{base_url}webshop/producten/bekijk/{item_title_alias}"><img src="http://cdn1.iconfinder.com/data/icons/aspneticons_v1.0_Nov2006/shopping_cart_16x16.gif" />Bestellen</a></td>
		</tr>
		{/webshop}
    </tbody>
</table>
</div>