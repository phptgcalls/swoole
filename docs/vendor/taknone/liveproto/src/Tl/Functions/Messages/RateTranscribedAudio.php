<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int msg_id long transcription_id bool good
 * @return Bool
 */

final class RateTranscribedAudio extends Instance {
	public function request(object $peer,int $msg_id,int $transcription_id,bool $good) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7f1d072f);
		$writer->write($peer->read());
		$writer->writeInt($msg_id);
		$writer->writeLong($transcription_id);
		$writer->tgwriteBool($good);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>