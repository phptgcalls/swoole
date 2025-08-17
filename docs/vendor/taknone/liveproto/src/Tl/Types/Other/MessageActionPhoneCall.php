<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long call_id true video phonecalldiscardreason reason int duration
 * @return MessageAction
 */

final class MessageActionPhoneCall extends Instance {
	public function request(int $call_id,? true $video = null,? object $reason = null,? int $duration = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x80e11a7f);
		$flags = 0;
		$flags |= is_null($video) ? 0 : (1 << 2);
		$flags |= is_null($reason) ? 0 : (1 << 0);
		$flags |= is_null($duration) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeLong($call_id);
		if(is_null($reason) === false):
			$writer->write($reason->read());
		endif;
		if(is_null($duration) === false):
			$writer->writeInt($duration);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 2)):
			$result['video'] = true;
		else:
			$result['video'] = false;
		endif;
		$result['call_id'] = $reader->readLong();
		if($flags & (1 << 0)):
			$result['reason'] = $reader->tgreadObject();
		else:
			$result['reason'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['duration'] = $reader->readInt();
		else:
			$result['duration'] = null;
		endif;
		return new self($result);
	}
}

?>