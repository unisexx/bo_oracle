<script type="text/javascript">
	$(document).ready(function(){
		$("select[name=budgetyear]").change(function(){
			bgyear = $(this).val();
			window.location='<?=JS_FIX_URLPATH;?>/budget_report_1/index?budgetyear=' + bgyear;
		})
	})
</script>
<h3>ตารางแสดงความเชื่อมโยงแผนงบประมาณประจำปี  <?=@$budgetyear;?></h3>
<fieldset>
	<legend>ระบุปีงบประมาณ</legend> 
<? echo form_dropdown("budgetyear",get_option("byear","varchar(byear)","cnf_set_time","status = 1 order by byear"),@$budgetyear,'','-- เลือกปีงบประมาณ --');?>
</fieldset>
<? if($budgetyear > 0):?>
<table class="tbReport" >
    <tr bgcolor="#EFF7E8">
    	<td style="width:250px;">ยุทธศาสตร์-กลุยุทธ์หน่วยงาน</td>
        <td style="width:250px;">แผนงาน </td>
        <td style="width:250px;">เป้าหมายเชิงยุทธศาสตร์ </td>
        <td style="width:250px;">เป้าหมายการให้บริการกระทรวง </td>
        <td style="width:250px;">ยุทธศาสตร์กระทรวง </td>
        <td style="width:250px;">เป้าหมายการให้บริการหน่วยงาน </td>
        <td style="width:250px;">กลยุทธ์หน่วยงาน </td>
        <td style="width:250px;">ผลผลิต </td>
        <td style="width:250px;">นโยบายการจัดสรรงบประมาณ </td>
        <td style="width:250px;">กิจกรรมหลัก </td>
        <td style="width:250px;">กิจกรรมย่อย</td>
    </tr>
    <?
	
		$sql = "SELECT * FROM CNF_STRATEGY WHERE PID=0 AND SYEAR=".($budgetyear-543)." ORDER BY ID ";
		$strategyResult = $this->budget_plan->get($sql,TRUE);
		foreach($strategyResult as $strategy)		
		{
	?>
			    <tr>
               <td style="width:33%;"><?=$strategy['title'];?></td>
                 <td bgcolor="#CCCCCC">&nbsp;</td>
				 <td bgcolor="#CCCCCC">&nbsp;</td>
				 <td bgcolor="#CCCCCC">&nbsp;</td>
				 <td bgcolor="#CCCCCC">&nbsp;</td>
				 <td bgcolor="#CCCCCC">&nbsp;</td>
				 <td bgcolor="#CCCCCC">&nbsp;</td>
				 <td bgcolor="#CCCCCC">&nbsp;</td>
				 <td bgcolor="#CCCCCC">&nbsp;</td>
				 <td bgcolor="#CCCCCC">&nbsp;</td>
				 <td bgcolor="#CCCCCC">&nbsp;</td>
                </tr>	     
                <?
					$sql = "SELECT * FROM CNF_STRATEGY WHERE 
					BUDGETSTRATEGYID=".$strategy['id']."					
					   AND CNF_STRATEGY.PlanID=0 ORDER BY ID ";
					$planResult = $this->budget_plan->get($sql,TRUE);
					foreach($planResult as $plan)					
					{
				?>
                <tr>
                <td  >&nbsp;</td>
                 <td ><?=$plan['title'];?></td>
				 <td bgcolor="#CCCCCC">&nbsp;</td>
				 <td bgcolor="#CCCCCC">&nbsp;</td>
				 <td bgcolor="#CCCCCC">&nbsp;</td>
				 <td bgcolor="#CCCCCC">&nbsp;</td>
				 <td bgcolor="#CCCCCC">&nbsp;</td>
				 <td bgcolor="#CCCCCC">&nbsp;</td>
				 <td bgcolor="#CCCCCC">&nbsp;</td>
				 <td bgcolor="#CCCCCC">&nbsp;</td>
				 <td bgcolor="#CCCCCC">&nbsp;</td>
                </tr>
                
						<? 
                        $sql = "SELECT * FROM CNF_STRATEGY WHERE 
                        CNF_STRATEGY.BUDGETSTRATEGYID=".$strategy['id']."
                        AND CNF_STRATEGY.PLANID = ".$plan['id']." 
                        AND CNF_STRATEGY.STRATEGYTARGETID = 0
                        ORDER BY ID ";
                        $strategyTargetResult = $this->budget_plan->get($sql,TRUE);
						foreach($strategyTargetResult as $strategyTarget)                        
                        {
                        ?>
                        <tr>
                            <td  >&nbsp;</td>
                             <td >&nbsp;</td>
                             <td ><?=$strategyTarget['title'];?></td>
                             <td bgcolor="#CCCCCC">&nbsp;</td>
                             <td bgcolor="#CCCCCC">&nbsp;</td>
                             <td bgcolor="#CCCCCC">&nbsp;</td>
                             <td bgcolor="#CCCCCC">&nbsp;</td>
                             <td bgcolor="#CCCCCC">&nbsp;</td>
                             <td bgcolor="#CCCCCC">&nbsp;</td>
                             <td bgcolor="#CCCCCC">&nbsp;</td>
                             <td bgcolor="#CCCCCC">&nbsp;</td>
                        </tr>
                        
                        		<? 
								$sql = "SELECT * FROM CNF_STRATEGY WHERE 
										CNF_STRATEGY.BUDGETSTRATEGYID=".$strategy['id']."
										AND CNF_STRATEGY.PLANID = ".$plan['id']." 
										AND CNF_STRATEGY.STRATEGYTARGETID = ".$strategyTarget['id']."
										AND CNF_STRATEGY.MINISTRYTARGETID=0
										ORDER BY ID ";
								$ministryTargetResult = $this->budget_plan->get($sql,TRUE);
								foreach($ministryTargetResult as $ministryTarget)								
								{
								?>
								<tr>
                                        <td  >&nbsp;</td>
                                         <td >&nbsp;</td>
                                         <td >&nbsp;</td>
                                         <td ><?=$ministryTarget['title'];?></td>
                                         <td bgcolor="#CCCCCC">&nbsp;</td>
                                         <td bgcolor="#CCCCCC">&nbsp;</td>
                                         <td bgcolor="#CCCCCC">&nbsp;</td>
                                         <td bgcolor="#CCCCCC">&nbsp;</td>
                                         <td bgcolor="#CCCCCC">&nbsp;</td>
                                         <td bgcolor="#CCCCCC">&nbsp;</td>
                                         <td bgcolor="#CCCCCC">&nbsp;</td>
								</tr>                                
								<? 
								$sql = "SELECT * FROM CNF_STRATEGY WHERE 
										CNF_STRATEGY.BUDGETSTRATEGYID=".$strategy['id']."
										AND CNF_STRATEGY.PLANID = ".$plan['id']." 
										AND CNF_STRATEGY.STRATEGYTARGETID = ".$strategyTarget['id']."
										AND CNF_STRATEGY.MINISTRYTARGETID = ".$ministryTarget['id']."
										AND CNF_STRATEGY.MINISTRYSTRATEGYID=0
										ORDER BY ID ";
								$ministryStrategyResult = $this->budget_plan->get($sql,TRUE);
								foreach($ministryStrategyResult as $ministryStrategy)								
								{
								?>
								<tr>
                                        <td  >&nbsp;</td>
                                         <td >&nbsp;</td>
                                         <td >&nbsp;</td>
                                         <td >&nbsp;</td>
                                         <td ><?=$ministryStrategy['title'];?></td>
                                         <td bgcolor="#CCCCCC">&nbsp;</td>
                                         <td bgcolor="#CCCCCC">&nbsp;</td>
                                         <td bgcolor="#CCCCCC">&nbsp;</td>
                                         <td bgcolor="#CCCCCC">&nbsp;</td>
                                         <td bgcolor="#CCCCCC">&nbsp;</td>
                                         <td bgcolor="#CCCCCC">&nbsp;</td>
								</tr>
                                <? 
                                    $sql = "SELECT * FROM CNF_STRATEGY WHERE 
                                            CNF_STRATEGY.BUDGETSTRATEGYID=".$strategy['id']."
                                            AND CNF_STRATEGY.PLANID = ".$plan['id']." 
                                            AND CNF_STRATEGY.STRATEGYTARGETID = ".$strategyTarget['id']."
                                            AND CNF_STRATEGY.MINISTRYTARGETID = ".$ministryTarget['id']."
											AND CNF_STRATEGY.MINISTRYSTRATEGYID = ".$ministryStrategy['id']."
                                            AND CNF_STRATEGY.SECTIONTARGETID=0
                                            ORDER BY ID ";
                                    $sectionTargetResult = $this->budget_plan->get($sql,TRUE);
									foreach($sectionTargetResult as $sectionTarget)                                    
                                    {
                                    ?>
                                    <tr>
                                            <td  >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td ><?=$sectionTarget['title'];?>&nbsp;</td>
                                             <td bgcolor="#CCCCCC">&nbsp;</td>
                                             <td bgcolor="#CCCCCC">&nbsp;</td>
                                             <td bgcolor="#CCCCCC">&nbsp;</td>
                                             <td bgcolor="#CCCCCC">&nbsp;</td>
                                             <td bgcolor="#CCCCCC">&nbsp;</td>
                                    </tr>
                                    <? 
                                    $sql = "SELECT * FROM CNF_STRATEGY WHERE 
                                            CNF_STRATEGY.BUDGETSTRATEGYID=".$strategy['id']."
                                            AND CNF_STRATEGY.PLANID = ".$plan['id']." 
                                            AND CNF_STRATEGY.STRATEGYTARGETID = ".$strategyTarget['id']."
                                            AND CNF_STRATEGY.MINISTRYTARGETID = ".$ministryTarget['id']."
											AND CNF_STRATEGY.MINISTRYSTRATEGYID = ".$ministryStrategy['id']."
											AND CNF_STRATEGY.SECTIONTARGETID = ".$sectionTarget['id']."
                                            AND CNF_STRATEGY.SECTIONSTRATEGYID=0
                                            ORDER BY ID ";
                                    $sectionStrategyResult = $this->budget_plan->get($sql,TRUE);
									foreach($sectionStrategyResult as $sectionStrategy)                                    
                                    {
                                    ?>
                                    <tr>
                                            <td  >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td ><?=$sectionStrategy['title'];?>&nbsp;</td>
                                             <td bgcolor="#CCCCCC">&nbsp;</td>
                                             <td bgcolor="#CCCCCC">&nbsp;</td>
                                             <td bgcolor="#CCCCCC">&nbsp;</td>
                                             <td bgcolor="#CCCCCC">&nbsp;</td>
                                    </tr>
                                    <? 
                                    $sql = "SELECT * FROM CNF_STRATEGY WHERE 
                                            CNF_STRATEGY.BUDGETSTRATEGYID=".$strategy['id']."
                                            AND CNF_STRATEGY.PLANID = ".$plan['id']." 
                                            AND CNF_STRATEGY.STRATEGYTARGETID = ".$strategyTarget['id']."
                                            AND CNF_STRATEGY.MINISTRYTARGETID = ".$ministryTarget['id']."
											AND CNF_STRATEGY.MINISTRYSTRATEGYID = ".$ministryStrategy['id']."
											AND CNF_STRATEGY.SECTIONTARGETID = ".$sectionTarget['id']."
											AND CNF_STRATEGY.SECTIONSTRATEGYID = ".$sectionStrategy['id']."
                                            AND CNF_STRATEGY.PRODUCTIVITYID=0											
                                            ORDER BY ID ";
                                    $productivityResult = $this->budget_plan->get($sql,TRUE);
									foreach($productivityResult as $productivity)                                    
                                    {
                                    ?>
                                    <tr>
                                            <td  >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td ><?=$productivity['title'];?>&nbsp;</td>
                                             <td bgcolor="#CCCCCC">&nbsp;</td>
                                             <td bgcolor="#CCCCCC">&nbsp;</td>
                                             <td bgcolor="#CCCCCC">&nbsp;</td>
                                    </tr>
                                    <? 
                                    $sql = "SELECT * FROM CNF_STRATEGY WHERE 
                                            CNF_STRATEGY.BUDGETSTRATEGYID=".$strategy['id']."
                                            AND CNF_STRATEGY.PLANID = ".$plan['id']." 
                                            AND CNF_STRATEGY.STRATEGYTARGETID = ".$strategyTarget['id']."
                                            AND CNF_STRATEGY.MINISTRYTARGETID = ".$ministryTarget['id']."
											AND CNF_STRATEGY.MINISTRYSTRATEGYID = ".$ministryStrategy['id']."
											AND CNF_STRATEGY.SECTIONTARGETID = ".$sectionTarget['id']."
											AND CNF_STRATEGY.SECTIONSTRATEGYID = ".$sectionStrategy['id']."
											AND CNF_STRATEGY.PRODUCTIVITYID = ".$productivity['id']."											
                                            AND CNF_STRATEGY.BUDGETPOLICYID=0											
                                            ORDER BY ID ";
                                    $budgetPolicyResult = $this->budget_plan->get($sql,TRUE);
									foreach($budgetPolicyResult as $budgetPolicy)                                    
                                    {
                                    ?>
                                    <tr>
                                            <td  >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td ><?=$budgetPolicy['title'];?>&nbsp;</td>
                                             <td bgcolor="#CCCCCC">&nbsp;</td>
                                             <td bgcolor="#CCCCCC">&nbsp;</td>
                                    </tr>
                                    <?
									$sql = "SELECT * FROM CNF_STRATEGY WHERE 
                                            CNF_STRATEGY.BUDGETSTRATEGYID=".$strategy['id']."
                                            AND CNF_STRATEGY.PLANID = ".$plan['id']." 
                                            AND CNF_STRATEGY.STRATEGYTARGETID = ".$strategyTarget['id']."
                                            AND CNF_STRATEGY.MINISTRYTARGETID = ".$ministryTarget['id']."
											AND CNF_STRATEGY.MINISTRYSTRATEGYID = ".$ministryStrategy['id']."
											AND CNF_STRATEGY.SECTIONTARGETID = ".$sectionTarget['id']."
											AND CNF_STRATEGY.SECTIONSTRATEGYID = ".$sectionStrategy['id']."
											AND CNF_STRATEGY.PRODUCTIVITYID = ".$productivity['id']."									
											AND CNF_STRATEGY.BUDGETPOLICYID = ".$budgetPolicy['id']."											
                                            AND CNF_STRATEGY.MAINACTID=0											
                                            ORDER BY ID ";
                                    $mainActResult = $this->budget_plan->get($sql,TRUE);
                                    foreach($mainActResult as $mainAct)                                    
                                    {
                                    ?>
                                    <tr>
                                            <td  >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td ><?=$mainAct['title'];?>&nbsp;</td>
                                             <td bgcolor="#CCCCCC">&nbsp;</td>
                                    </tr>
									<?
									$sql = "SELECT * FROM CNF_STRATEGY WHERE 
                                            CNF_STRATEGY.BUDGETSTRATEGYID=".$strategy['id']."
                                            AND CNF_STRATEGY.PLANID = ".$plan['id']." 
                                            AND CNF_STRATEGY.STRATEGYTARGETID = ".$strategyTarget['id']."
                                            AND CNF_STRATEGY.MINISTRYTARGETID = ".$ministryTarget['id']."
											AND CNF_STRATEGY.MINISTRYSTRATEGYID = ".$ministryStrategy['id']."
											AND CNF_STRATEGY.SECTIONTARGETID = ".$sectionTarget['id']."
											AND CNF_STRATEGY.SECTIONSTRATEGYID = ".$sectionStrategy['id']."
											AND CNF_STRATEGY.PRODUCTIVITYID = ".$productivity['id']."									
											AND CNF_STRATEGY.BUDGETPOLICYID = ".$budgetPolicy['id']."											
											AND CNF_STRATEGY.MAINACTID = ".$mainAct['id']."																													
                                            ORDER BY ID ";
                                    $subActResult = $this->budget_plan->get($sql,TRUE);
                                    foreach($subActResult as $subAct)                                    
                                    {
                                    ?>
                                    <tr>
                                            <td  >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td >&nbsp;</td>
                                             <td ><?=$subAct['title'];?>&nbsp;</td>
                                    </tr>
<?               
									}
									}
									}
									}
								}
							}
						}
					}
				}
			}
		}
?>
    </table>
<? endif;?>
