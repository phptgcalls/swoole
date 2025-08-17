<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer int msg_id long transcription_id string text true pending
 * @return Update
 */

final class UpdateTranscribedAudio extends Instance {
	public function request(object $peer,int $msg_id,int $transcription_id,string $text,? true $pending = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x84cd5a);
		$flags = 0;
		$flags |= is_null($pending) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->writeInt($msg_id);
		$writer->writeLong($transcription_id);
		$writer->tgwriteBytes($text);
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
		$result['peer'] = $reader->tgreadObject();
		$result['msg_id'] = $reader->readInt();
		$result['transcription_id'] = $reader->readLong();
		$result['text'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>