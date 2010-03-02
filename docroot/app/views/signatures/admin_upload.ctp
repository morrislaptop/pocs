<div class="signatures form">
<?php
    $sessionKey = 'Signatures.import';
    $import = $session->read($sessionKey);
    $session->del($sessionKey);

    if ( $import )
    {
        ?>
        <div id="flashMessage" class="message">
            <p>Results of your import:</p>
            <ul>
                <li><?php echo $import['created']; ?> <?php __n('record', 'records', $import['created']); ?> created</li>
                <?php
                    if ( $import['errors'] )
                    {
                        $errorsCount = count($import['errors']);
                        ?>
                        <li>
                            <?php echo $errorsCount; ?> <?php __n('error', 'errors', $errorsCount); ?> occured:
                            <ul>
                                <?php
                                    foreach ($import['errors'] as $line => $whys)
                                    {
                                        ?>
                                        <li>
                                            Line <?php echo $line; ?>
                                            <?php
                                                foreach ($whys as $why)
                                                {
                                                    ?>
                                                    <li><?php echo $why; ?></li>
                                                    <?php
                                                }
                                            ?>
                                        </li>
                                        <?php
                                    }
                                ?>
                            </ul>
                        </li>
                        <?php
                    }
                ?>
            </ul>
        </div>
        <?php
    }
?>
<?php echo $form->create('Signature', array('action' => 'upload', 'type' => 'file'));?>
	<fieldset>
 		<legend><?php __('Add Signatures');?></legend>
	    <?php
		    echo $form->input('source');
		    echo $form->input('file', array('type' => 'file'));
	    ?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Signatures', true), array('action' => 'index'));?></li>
	</ul>
</div>
