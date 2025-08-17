<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long transcription_id string text true pending int trial_remains_num int trial_remains_until_date
 * @return messages.TranscribedAudio
 */

final class TranscribedAudio extends Instance {
	public function request(int $transcription_id,string $text,? true $pending = null,? int $trial_remains_num = null,? int $trial_remains_until_date = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcfb9d957);
		$flags = 0;
		$flags |= is_null($pending) ? 0 : (1 << 0);
		$flags |= is_null($trial_remains_num) ? 0 : (1 << 1);
		$flags |= is_null($trial_remains_until_date) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeLong($transcription_id);
		$writer->tgwriteBytes($text);
		if(is_null($trial_remains_num) === false):
			$writer->writeInt($trial_remains_num);
		endif;
		if(is_null($trial_remains_until_date) === false):
			$writer->writeInt($trial_remains_until_date);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['pending'] = true;
		else:
			$result['pending'] = false;
		endif;
		$result['transcription_id'] = $reader->readLong();
		$result['text'] = $reader->tgreadBytes();
		if($flags & (1 << 1)):
			$result['trial_remains_num'] = $reader->readInt();
		else:
			$result['trial_remains_num'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['trial_remains_until_date'] = $reader->readInt();
		else:
			$result['trial_remains_until_date'] = null;
		endif;
		return new self($result);
	}
}

?>