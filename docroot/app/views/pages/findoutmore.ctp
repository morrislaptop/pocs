<?php echo $javascript->codeblock('
            $(document).ready(function(){
                //Caption Sliding (Partially Hidden to Visible)
                $(\'.boxgrid.caption\').hover(function(){
                    $(".cover", this).stop().animate({top:\'89px\'},{queue:false,duration:160});
                }, function() {
                    $(".cover", this).stop().animate({top:\'120px\'},{queue:false,duration:160});
                });
            });
        ', true);
        
        ?>
<div id="slidingboxwrapper"> 
        <div class="boxgrid caption">  
            <?php echo $html->image('findoutmore/1.jpg'); ?> 
             <div class="cover boxcaption">  
            <h3>WHY PROTECT THE CORAL SEA?</h3>  
            <p><span class="highlighted">Lorem ipsum</span> dolor sit amet, consectetur adipiscing elit. Quisque dolor eros, tristique id auctor quis</p>  
            </div>  
        </div>
        <div class="boxgrid caption">  
            <?php echo $html->image('findoutmore/2.jpg'); ?> 
             <div class="cover boxcaption">  
            <h3>WHERE IS THE CORAL SEA?</h3>  
            <p><span class="highlighted">Lorem ipsum</span> dolor sit amet, consectetur adipiscing elit. Quisque dolor eros, tristique id auctor quis</p>  
            </div>  
        </div>
        <div class="boxgrid caption">  
            <?php echo $html->image('findoutmore/3.jpg'); ?> 
             <div class="cover boxcaption">  
            <h3>HISTORY OF THE CORAL SEA</h3>  
            <p><span class="highlighted">Lorem ipsum</span> dolor sit amet, consectetur adipiscing elit. Quisque dolor eros, tristique id auctor quis</p>  
            </div>  
        </div>
        <div class="boxgrid caption">  
            <?php echo $html->image('findoutmore/4.jpg'); ?> 
             <div class="cover boxcaption">  
            <h3>FISHING IN THE CORAL SEA</h3>  
            <p><span class="highlighted">Lorem ipsum</span> dolor sit amet, consectetur adipiscing elit. Quisque dolor eros, tristique id auctor quis</p>  
            </div>  
        </div>
        <div class="boxgrid caption">  
            <?php echo $html->image('findoutmore/5.jpg'); ?> 
             <div class="cover boxcaption">  
            <h3>PROTECTED SPECIES</h3>  
            <p><span class="highlighted">Lorem ipsum</span> dolor sit amet, consectetur adipiscing elit. Quisque dolor eros, tristique id auctor quis</p>  
            </div>  
        </div>
        <div class="boxgrid caption">  
            <?php echo $html->image('findoutmore/6.jpg'); ?> 
             <div class="cover boxcaption">  
            <h3>RESOURCES</h3>  
            <p><span class="highlighted">Lorem ipsum</span> dolor sit amet, consectetur adipiscing elit. Quisque dolor eros, tristique id auctor quis</p>  
            </div>  
        </div>
        <div class="boxgrid caption">  
            <?php echo $html->image('findoutmore/7.jpg'); ?> 
             <div class="cover boxcaption">  
            <h3>KIDS</h3>  
            <p><span class="highlighted">Lorem ipsum</span> dolor sit amet, consectetur adipiscing elit. Quisque dolor eros, tristique id auctor quis</p>  
            </div>  
        </div>
        <div class="boxgrid caption">  
            <?php echo $html->image('findoutmore/8.jpg'); ?> 
             <div class="cover boxcaption">  
            <h3>VIDEO GALLERY</h3>  
            <p><span class="highlighted">Lorem ipsum</span> dolor sit amet, consectetur adipiscing elit. Quisque dolor eros, tristique id auctor quis</p>  
            </div>  
        </div>
        <div class="boxgrid caption">  
            <?php echo $html->image('findoutmore/9.jpg'); ?> 
             <div class="cover boxcaption">  
            <h3>OUR SUPPORTERS</h3>  
            <p><span class="highlighted">Lorem ipsum</span> dolor sit amet, consectetur adipiscing elit. Quisque dolor eros, tristique id auctor quis</p>  
            </div>  
        </div>
</div>  
<br />
<div id="howcanihelp">
    <table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%"><tr valign="middle"><td align="center" width="35%">
    <?php echo $html->image('howcanihelph1.png', array('class' => 'padded2')); ?></td> <td align="left"> 
    <?php    echo $html->image('voice.png', array('class' => 'padded2')); 
        echo $html->image('tellyourfriends.png', array('class' => 'padded2')); 
        echo $html->image('whatsourgoal.png', array('class' => 'padded2')); ?>
        </td></tr></table> 
</div>