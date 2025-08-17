<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param groupcall call long chat_id
 * @return Update
 */

final class UpdateGroupCall extends Instance {
	public function request(object $call,? int $chat_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x97d64341);
		$flags = 0;
		$flags |= is_null($chat_id) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($chat_id) === false):
			$writer->writeLong($chat_id);
		endif;
		$writer->write($call->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['chat_id'] = $reader->readLong();
		else:
			$result['chat_id'] = null;
		endif;
		$result['call'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>