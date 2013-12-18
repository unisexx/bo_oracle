<table>
	<tr>
		<?
		foreach($column as $item): 
		
		for ($i = 0; $i < $item->FieldCount(); $i++) {
            $fld = $rs->FetchField($i);
            $aRet[$lngCountFields] = $fld->name;
			echo '<td>'.$aRet[$lngCountFields].'</td>';
            $lngCountFields++;
        
		}
		endforeach;
		?>
	</tr>
	<?
		foreach($result as $item): 
	?>
	<tr>
		
		<td></td>		
	</tr>	
	<? endforeach;?>
</table>