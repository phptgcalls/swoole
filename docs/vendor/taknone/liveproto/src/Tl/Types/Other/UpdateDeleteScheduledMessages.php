<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer Vector<int> messages Vector<int> sent_messages
 * @return Update
 */

final class UpdateDeleteScheduledMessages extends Instance {
	public function request(object $peer,array $messages,? array $sent_messages = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf2a71983);
		$flags = 0;
		$flags |= is_null($sent_messages) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->tgwriteVector($messages,'int');
		if(is_null($sent_messages) === false):
			$writer->tgwriteVector($sent_messages,'int');
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['peer'] = $reader->tgreadObject();
		$result['messages'] = $reader->tgreadVector('int');
		if($flags & (1 << 0)):
			$result['sent_messages'] = $reader->tgreadVector('int');
		else:
			$result['sent_messages'] = null;
		endif;
		return new self($result);
	}
}

?>