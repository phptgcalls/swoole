<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgroupcall call inputpeer participant bool muted int volume bool raise_hand bool video_stopped bool video_paused bool presentation_paused
 * @return Updates
 */

final class EditGroupCallParticipant extends Instance {
	public function request(object $call,object $participant,? bool $muted = null,? int $volume = null,? bool $raise_hand = null,? bool $video_stopped = null,? bool $video_paused = null,? bool $presentation_paused = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa5273abf);
		$flags = 0;
		$flags |= is_null($muted) ? 0 : (1 << 0);
		$flags |= is_null($volume) ? 0 : (1 << 1);
		$flags |= is_null($raise_hand) ? 0 : (1 << 2);
		$flags |= is_null($video_stopped) ? 0 : (1 << 3);
		$flags |= is_null($video_paused) ? 0 : (1 << 4);
		$flags |= is_null($presentation_paused) ? 0 : (1 << 5);
		$writer->writeInt($flags);
		$writer->write($call->read());
		$writer->write($participant->read());
		if(is_null($muted) === false):
			$writer->tgwriteBool($muted);
		endif;
		if(is_null($volume) === false):
			$writer->writeInt($volume);
		endif;
		if(is_null($raise_hand) === false):
			$writer->tgwriteBool($raise_hand);
		endif;
		if(is_null($video_stopped) === false):
			$writer->tgwriteBool($video_stopped);
		endif;
		if(is_null($video_paused) === false):
			$writer->tgwriteBool($video_paused);
		endif;
		if(is_null($presentation_paused) === false):
			$writer->tgwriteBool($presentation_paused);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>