<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgroupcall call int duration
 * @return MessageAction
 */

final class MessageActionGroupCall extends Instance {
	public function request(object $call,? int $duration = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7a0d7f42);
		$flags = 0;
		$flags |= is_null($duration) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($call->read());
		if(is_null($duration) === false):
			$writer->writeInt($duration);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['call'] = $reader->tgreadObject();
		if($flags & (1 << 0)):
			$result['duration'] = $reader->readInt();
		else:
			$result['duration'] = null;
		endif;
		return new self($result);
	}
}

?>