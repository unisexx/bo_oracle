<table class="tbadd">			
				<tr>
					<th>ส่วนกลาง</th>
					<td id="multiselect">
						<div>
							<div><u>หน่วยงานส่วนกลางทั้งหมด</u></div>
							<br clear="all">
							<select multiple id="select1_div" style="width:350px;">
							<?php foreach($central_division as $item):?>
							<option value="<?php echo $item['id']?>"><?php echo $item['title']?></option>
							<?php endforeach;?>
							</select>
							<a href="#" id="add_div">เพิ่ม &gt;&gt;</a>
						 </div>
						 <div>
							<div><u>หน่วยงานส่วนกลางที่เลือก</u></div>
							<br clear="all">
							<select multiple id="select2_div" style="width:350px;">
								<?php foreach($division_selected as $division): ?>
									<option value="<?php echo $division['id']?>"><?php echo $division['title']?></option>
								<?php endforeach;?>
							</select>
							<a href="#" id="remove_div">&lt;&lt; ลบ</a>
						 </div>
						 <div class='loadingicon'></div>
						 <br clear="all">
					</td>
				</tr>
</table>