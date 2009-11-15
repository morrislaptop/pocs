<?php
	foreach ($signatures as $signature)
	{
		$signature['Signature']['personal_note'] = nl2br($signature['Signature']['personal_note']);
		$keys = array();
		$values = array();
		foreach ($signature as $alias => $fields) {
			foreach ($fields as $field => $value) {
				$keys[] = '%' . $alias . '.' . $field . '%';
				$values[] = $value;
			}
		}

		if ( $signature['Signature']['not_in_australia'] ) {
			$letter = $pmLetter;
		}
		else {
			$letter = $ausLetter;
		}

		$letter = str_replace($keys, $values, $letter);
		?>
		<div style="border-top: 1px dotted #000; page-break-after: always;">
			<?php
				echo $letterhead;
				echo $letter;
			?>
		</div>
		<?php
	}
?>